/*
* v2.5.9
* Unlimited Video Hover Carousel - Unlimited Elements for Elementor.
* © Unlimited Elements for Elementor.
*/

(function (jQuery) {
    'use strict';
    
    function isTouchDevice() {
        return 'ontouchstart' in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
    }
    
    window.UEVideoHoverWidget = function (container, options = {}) {
        if (!container || !container.length) return;
        
        // Read attributes from parent container
        const isDebug = container.attr('data-debug') === 'true' || options.debug === true;
        const autoplayCenter = container.attr('data-autoplay-center') === 'true';
        const playMode = container.attr('data-play-mode') || 'hover';
        const closeOnOutsideClick = container.attr('data-close-on-outside-click') !== 'false';
        const playSound = container.attr('data-play-sound') === 'true';
        const showLightbox = container.attr('data-show-lightbox') === 'true';
        const g_playingClassName = 'ue-video-playing';
        
        // All video items inside container
        const videoItems = container.find('.ue-hover-image-video');
        
        videoItems.each(function () {
            const objWidget = jQuery(this);
            const widgetId = objWidget.attr('id') || Math.random().toString(36).substr(2, 9);
            
            const image = objWidget.find('.ue-image')[0];
            const video = objWidget.find('.ue-video')[0];
            if (!image || !video) return;
            if (video.dataset.initialized === 'true') return;
            
            const isVimeo = video.tagName === 'IFRAME' && video.src && video.src.includes('vimeo.com');
            const isInMarquee = objWidget.closest('.uc_marquee').length > 0;
            
            let vimeoPlayer = null;
            let vimeoReady = false;
            let isHovered = false;
            let resetTimeout = null;
            let initializationTimeout = null;
            
            const videoState = { isPlaying: false, isReady: false, canPlay: false };
            const isMouseAlreadyOver = !isTouchDevice() && (objWidget.is(':hover') || isDebug);
                        
            function showVideo() {
                if (resetTimeout) 
                    clearTimeout(resetTimeout);
                
                if (isVimeo && !vimeoReady) 
                    return;
                
                if (!isVimeo && (!video.readyState || video.readyState < 3)) 
                    return;
                                
                objWidget.addClass(g_playingClassName);
                image.style.opacity = '0';
                videoState.isPlaying = true;
                
                try {
                    if (isVimeo && vimeoPlayer) {
                        vimeoPlayer.play().catch(err => console.warn('UEVideoHoverWidget: Vimeo play failed:', err));
                    } else if (video.play) {
                        const playPromise = video.play();
                        if (playPromise !== undefined) playPromise.catch(err => console.warn('UEVideoHoverWidget: Video play failed:', err));
                    }
                } catch (error) {
                    console.error('UEVideoHoverWidget: Error in showVideo:', error);
                }
            }
            
            function hideVideo() {
                isHovered = false;
                objWidget.removeClass(g_playingClassName);
                image.style.opacity = '1';
                videoState.isPlaying = false;
                
                try {
                    if (isVimeo && vimeoPlayer) {
                        vimeoPlayer.pause().then(() => {
                            resetTimeout = setTimeout(() => {
                                if (vimeoPlayer) vimeoPlayer.setCurrentTime(0.01).catch(err => console.warn('UEVideoHoverWidget: Vimeo setCurrentTime failed:', err));
                            }, 300);
                        }).catch(err => console.warn('UEVideoHoverWidget: Vimeo pause failed:', err));
                    } else if (video.pause) {
                        video.pause();
                        resetTimeout = setTimeout(() => {
                            try { video.currentTime = 0; } catch (e) { console.warn('UEVideoHoverWidget: Reset currentTime failed:', e); }
                        }, 300);
                    }
                } catch (error) {
                    console.error('UEVideoHoverWidget: Error in hideVideo:', error);
                }
            }
            
            objWidget.data('hideVideo', hideVideo);
            
            function initializeVideo() {
                try {
                    if (isVimeo) {
                        if (typeof Vimeo !== 'undefined' && Vimeo.Player) {
                            vimeoPlayer = new Vimeo.Player(video);
                            objWidget.data('vimeoPlayer', vimeoPlayer);
                            vimeoPlayer.ready()
                            .then(() => vimeoPlayer.setCurrentTime(0.01))
                            .then(() => vimeoPlayer.pause())
                            .then(() => {
                                if (autoplayCenter || !playSound) {
                                    return vimeoPlayer.setVolume(0);
                                } else {
                                    return vimeoPlayer.setVolume(1);
                                }
                            })
                            .then(() => {
                                vimeoReady = true;
                                videoState.isReady = true;
                                if (isHovered || isMouseAlreadyOver) showVideo();
                                maybeAutoplayCenter();
                            })
                            .catch(err => console.error('UEVideoHoverWidget: Vimeo initialization failed:', err));
                        } else {
                            console.error('UEVideoHoverWidget: Vimeo Player API not loaded');
                        }
                    } else {
                        video.muted = autoplayCenter || !playSound;
                        
                        // Force load for cached videos
                        video.preload = 'auto';
                        
                        const handleVideoReady = () => {
                            videoState.isReady = true;
                            videoState.canPlay = true;
                            video.dataset.ready = 'true';
                            if (isHovered || isMouseAlreadyOver) showVideo();
                            maybeAutoplayCenter();
                        };
                        
                        // Check if video is already loaded (cached)
                        if (video.readyState >= 3) {
                            handleVideoReady();
                        } else if ('IntersectionObserver' in window && !isInMarquee) {
                            const observer = new IntersectionObserver((entries, obs) => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        video.load();
                                        video.addEventListener('canplay', handleVideoReady, { once: true });
                                        obs.unobserve(entry.target);
                                    }
                                });
                            }, { rootMargin: '50px 0px', threshold: 0.1 });
                            observer.observe(video);
                        } else {
                            video.load();
                            video.addEventListener('canplay', handleVideoReady, { once: true });
                        }
                        
                        const onError = (e) => console.error('UEVideoHoverWidget: Video loading error:', e);
                        video.removeEventListener('error', onError);
                        video.addEventListener('error', onError);
                    }
                } catch (error) {
                    console.error('UEVideoHoverWidget: Error during video initialization:', error);
                }
            }
            
            function setupEventHandlers() {
                objWidget.off('.videohover');
                jQuery(document).off(`pointerup.videohover-${widgetId}`);
                jQuery(document).off(`click.videohover-${widgetId}`);
                
                if (!isTouchDevice() && !isDebug) {
                    if (playMode === 'hover') {
                        objWidget.on('mouseenter.videohover', () => { isHovered = true; if (videoState.isReady) showVideo(); });
                        objWidget.on('mouseleave.videohover', () => { isHovered = false; hideVideo(); });
                    } else if (playMode === 'click' && !showLightbox) {
                        objWidget.on('click.videohover', (e) => {
                            e.stopPropagation();
                            if (videoState.isPlaying) {
                                hideVideo();
                            } else if (videoState.isReady) {
                                
                                const currentContainer = objWidget.closest('[data-play-mode]');
                                
                                jQuery('.ue-hover-image-video.'+g_playingClassName).each(function () {
                                    if (this !== objWidget[0]) {
                                        const otherWidget = jQuery(this);
                                        const otherContainer = otherWidget.closest('[data-play-mode]');
                                        
                                        const isSameContainer = currentContainer.length && otherContainer.length &&
                                        currentContainer[0] === otherContainer[0];
                                        const isAutoplayContainer = otherContainer.attr('data-autoplay-center') === 'true';
                                        
                                        if (isSameContainer && !isAutoplayContainer && otherWidget.data('hideVideo')) {
                                            otherWidget.data('hideVideo')();
                                        }
                                    }
                                });
                                
                                isHovered = true;
                                
                                showVideo();
                            }
                        });
                        
                        if (closeOnOutsideClick && !window._ueVideoGlobalClickHandlerAttached) {
                            jQuery(document).on('click.videohover-global', (e) => {
                                if (!jQuery(e.target).closest('.ue-hover-image-video').length) {
                                    jQuery('.ue-hover-image-video.'+g_playingClassName).each(function () {
                                        const widget = jQuery(this);
                                        
                                        const widgetCloseOnOutside = widget.closest('[data-close-on-outside-click]').attr('data-close-on-outside-click');
                                        const shouldCloseOnOutside = widgetCloseOnOutside !== 'false';
                                        
                                        if (shouldCloseOnOutside && widget.data('hideVideo')) {
                                            widget.data('hideVideo')();
                                        }
                                    });
                                }
                            });
                            window._ueVideoGlobalClickHandlerAttached = true;
                        }
                    }
                } else if (!isDebug) {
                    objWidget.addClass('touch-device');
                    if (!showLightbox) {
                        objWidget.on('pointerup.videohover', (e) => {
                            if (e.pointerType !== 'touch' && e.pointerType !== 'pen') 
                                return;
                            
                            e.stopPropagation();
                            
                            if (!videoState.isReady) 
                                return;
                            
                            var objActiveParent = objWidget.closest(".uc-active-item");
                            
                            if(!objActiveParent || objActiveParent.length == 0)
                                return;
                            
                            if (isVimeo && vimeoPlayer) {
                                vimeoPlayer.getPaused().then(paused => paused ? showVideo() : hideVideo()).catch(err => console.warn('UEVideoHoverWidget: Vimeo getPaused failed:', err));
                            } 
                            else if (video.paused && video.dataset.ready === 'true') {
                                showVideo();
                            } else 
                                hideVideo();
                        });
                        
                        jQuery(document).on(`pointerup.videohover-${widgetId}`, (e) => {
                            if (!jQuery(e.target).closest(objWidget).length && videoState.isPlaying) hideVideo();
                        });
                        
                    }
                }
            }
            
            function maybeAutoplayCenter() {
                if (!autoplayCenter || !videoState.isReady || isInMarquee) return;
                
                const $carousel = objWidget.closest('.owl-carousel');
                const owl = $carousel.data('owl.carousel');
                if (!owl) return;
                
                const centerIndex = owl.relative(owl.current());
                const centerItem = $carousel.find('.owl-item').not('.cloned').eq(centerIndex)[0];
                const widgetSlide = objWidget.closest('.owl-item')[0];
                
                if (centerItem && widgetSlide && centerItem.contains(widgetSlide)) {
                    showVideo();
                } else {
                    hideVideo();
                }
            }
            
            function bindOwlCenterEvents() {
                const $carousel = objWidget.closest('.owl-carousel');
                
                if (!$carousel.length) 
                    return;
                
                maybeAutoplayCenter();
                
                $carousel.on('changed.owl.carousel', function () { 
                    maybeAutoplayCenter();                 
                    hideVideo();
                });
            }
            
            function init() {
                const initDelay = isInMarquee ? 300 : 0;
                initializationTimeout = setTimeout(() => {
                    initializeVideo();
                    setupEventHandlers();

                    const $carousel = objWidget.closest('.owl-carousel');
                    
                    $carousel.on('changed.owl.carousel', function () { 
                        hideVideo();
                    });
                    
                    if (autoplayCenter) 
                        bindOwlCenterEvents();
                    
                    video.dataset.initialized = 'true';
                    
                    const cleanup = () => {
                        if (resetTimeout) clearTimeout(resetTimeout);
                        if (initializationTimeout) clearTimeout(initializationTimeout);
                        objWidget.off('.videohover');
                        const widgetId = objWidget.attr('id');
                        if (widgetId) {
                            jQuery(document).off(`pointerup.videohover-${widgetId}`);
                            jQuery(document).off(`click.videohover-${widgetId}`);
                        }
                        if (vimeoPlayer) vimeoPlayer.destroy();
                        video.dataset.initialized = 'false';
                    };
                    objWidget.data('videoHoverCleanup', cleanup);
                }, initDelay);
            }
            
            init();
            
            let resizeTimeout;
            const handleResize = () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    if (video.dataset.initialized === 'true' && !isInMarquee) {
                        const cleanup = objWidget.data('videoHoverCleanup');
                        if (cleanup) cleanup();
                        UEVideoHoverWidget(objWidget); // Re-init after resize
                    }
                }, 300);
            };
            jQuery(window).on('resize.videohover', handleResize);
        });
        
        if (window.location.href.includes('&preview=true') || window.location.href.includes('?preview=true')) {
            console.log('%c UE Video Carousel v2.5.9 ready!', 'color: #00c896; font-weight: bold; font-size: 12px;');
        }
        
        return container;
    };
    
})(jQuery);