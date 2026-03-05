/*
* Enhanced Testimonial Marquee v2.3
* Improvements: Better video hover integration, performance optimizations, enhanced error handling
* © Unlimited Elements for Elementor
*/

(function (jQuery) {
    'use strict';

    function UCTestimonialMarquee(marqueeElements, options = {}) {
        if (!marqueeElements || !marqueeElements.length) {
            console.warn('UCTestimonialMarquee: No marquee elements provided');
            return null;
        }

        let g_marquee = Array.from(marqueeElements);
        let resizeObserver = null;
        let isInitialized = false;

        const utils = {
            debounce(func, wait, immediate) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        timeout = null;
                        if (!immediate) func.apply(this, args);
                    };
                    const callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(this, args);
                };
            },

            isElementVisible(element) {
                if (!element) return false;
                const rect = element.getBoundingClientRect();
                return rect.width > 0 && rect.height > 0;
            },

            getViewportWidth() {
                return window.innerWidth || document.documentElement.clientWidth;
            },

            isBreakPoint(breakpoint) {
                const breakpointsArray = [319, 767, 1024, 1920];
                const viewportWidth = this.getViewportWidth();
                const index = breakpointsArray.indexOf(breakpoint);
                if (index === -1) return false;
                const min = breakpointsArray[index - 1] || 0;
                const max = breakpointsArray[index];
                return viewportWidth > min && viewportWidth <= max;
            }
        };

function cloneSlider() {
    g_marquee.forEach((item, index) => {
        try {
            if (!item || !item.children) return;

            const originalChildren = Array.from(item.children);

            // clone forward (append to end)
            originalChildren.forEach(child => {
                const clone = child.cloneNode(true);
                clone.querySelectorAll('.ue-video').forEach(video => {
                    video.dataset.initialized = 'false';
                });
                item.appendChild(clone);
            });

            /* clone backward (prepend to start, in reverse order to keep sequence)
            [...originalChildren].reverse().forEach(child => {
                const clone = child.cloneNode(true);
                clone.querySelectorAll('.ue-video').forEach(video => {
                    video.dataset.initialized = 'false';
                });
                item.insertBefore(clone, item.firstChild);
            }); */

        } catch (error) {
            console.error(`UCTestimonialMarquee: Error cloning slider ${index}:`, error);
        }
    });
}


        function wrapSlides() {
            g_marquee.forEach((item, index) => {
                try {
                    if (!item) return;
                    if (!item.querySelector('.uc-logo-wrapper')) {
                        item.innerHTML = `<div class="uc-logo-wrapper">${item.innerHTML}</div>`;
                    }
                } catch (error) {
                    console.error(`UCTestimonialMarquee: Error wrapping slides ${index}:`, error);
                }
            });
        }

        function setWidth() {
            g_marquee.forEach((parentItem, index) => {
                try {
                    if (!parentItem) return;
                    const $parent = jQuery(parentItem);
                    const wasHidden = parentItem.style.display === 'none';
                    if (wasHidden) parentItem.style.display = 'flex';

                    const parentWidth = parentItem.offsetWidth;
                    const slides = parentItem.querySelectorAll('.uc_video_marquee_holder');
                    const viewportWidth = utils.getViewportWidth();

                    const config = {
                        height: parseInt($parent.attr('data-height')) || 100,
                        margin: parseInt($parent.data('margin')) || 0,
                        itemsMobile: parseInt($parent.data('mobile-items')) || 1,
                        itemsTablet: parseInt($parent.data('tablet-items')) || 2,
                        itemsDesktop: parseInt($parent.data('desktop-items')) || 3,
                        direction: $parent.data('direction') || 'right'
                    };

                    let currentItems = config.itemsDesktop;
                    if (utils.isBreakPoint.call(utils, 767)) currentItems = config.itemsMobile;
                    else if (utils.isBreakPoint.call(utils, 1024)) currentItems = config.itemsTablet;
                    else if (viewportWidth > 1920) currentItems = config.itemsDesktop;

                    if (config.direction === 'up' || config.direction === 'down') {
                        parentItem.style.height = `${(config.height + config.margin) * currentItems}px`;
                    }

                    Array.from(slides).forEach((slide, slideIndex) => {
                        try {
                            if (config.direction === 'right' || config.direction === 'left') {
                                slide.style.marginRight = `${config.margin}px`;
                                slide.style.width = `${Math.max((parentWidth / currentItems) - config.margin, 0)}px`;
                            } else if (config.direction === 'up' || config.direction === 'down') {
                                slide.style.marginTop = `${config.margin}px`;
                                slide.style.height = `${config.height}px`;
                            }
                        } catch (error) {
                            console.warn(`UCTestimonialMarquee: Error setting slide ${slideIndex} dimensions:`, error);
                        }
                    });

                    if (wasHidden) setTimeout(() => { parentItem.style.display = 'flex'; }, 100);

                } catch (error) {
                    console.error(`UCTestimonialMarquee: Error setting width for marquee ${index}:`, error);
                }
            });
        }

        function setAnimationOptions() {
            g_marquee.forEach((item, index) => {
                try {
                    if (!item) return;
                    const $item = jQuery(item);
                    const speed = parseInt($item.data('speed')) || 5000;
                    const marqueeList = item.children[0];
                    if (!marqueeList) return;

                    const slidesAmount = Math.max(Math.floor(marqueeList.children.length / 4), 1);
                    const duration = `${(speed * slidesAmount) / 1000}s`;
                    marqueeList.style.animationDuration = duration;
                    marqueeList.style.WebkitAnimationDuration = duration;

                    const pauseOnHover = $item.data('paused');
                    if (pauseOnHover) {
                        marqueeList.removeEventListener('mouseenter', pauseAnimation);
                        marqueeList.removeEventListener('mouseleave', resumeAnimation);

                        marqueeList.addEventListener('mouseenter', pauseAnimation);
                        marqueeList.addEventListener('mouseleave', resumeAnimation);
                    }

                    function pauseAnimation(event) {
                        event.target.style.animationPlayState = 'paused';
                        event.target.style.WebkitAnimationPlayState = 'paused';
                    }
                    function resumeAnimation(event) {
                        event.target.style.animationPlayState = 'running';
                        event.target.style.WebkitAnimationPlayState = 'running';
                    }

                } catch (error) {
                    console.error(`UCTestimonialMarquee: Error setting animation for marquee ${index}:`, error);
                }
            });
        }

        function initializeWithVideoSupport() {
            try {
                cloneSlider();
                cloneSlider(); // Double clone for seamless loop
                wrapSlides();
                setWidth();
                setAnimationOptions();

                setTimeout(() => { initializeVideoHovers(); }, 200);

                isInitialized = true;
            } catch (error) {
                console.error('UCTestimonialMarquee: Error during initialization:', error);
            }
        }

function initializeVideoHovers() {
    g_marquee.forEach((marqueeItem, index) => {
        try {
            const $marquee = jQuery(marqueeItem);
            const $parentCarousel = $marquee.closest('.ue-video-carousel');

            if ($parentCarousel.length && !$parentCarousel.data('videoHoverInitialized')) {
                UEVideoHoverWidget($parentCarousel, { isMarquee: true, debug: options.debug || false });
                $parentCarousel.data('videoHoverInitialized', true); // mark as initialized
            }
        } catch (error) {
            console.error(`UCTestimonialMarquee: Error initializing video hovers for marquee ${index}:`, error);
        }
    });
}


        const handleResize = utils.debounce(() => {
            if (!isInitialized) return;
            try {
                setWidth();
                setTimeout(() => { initializeVideoHovers(); }, 300);
            } catch (error) {
                console.error('UCTestimonialMarquee: Error during resize:', error);
            }
        }, 250);

        function setupResizeObserver() {
            if ('ResizeObserver' in window) {
                try {
                    resizeObserver = new ResizeObserver(handleResize);
                    g_marquee.forEach(item => { if (item) resizeObserver.observe(item); });
                } catch (error) {
                    console.warn('UCTestimonialMarquee: ResizeObserver setup failed, fallback to window resize', error);
                    window.addEventListener('resize', handleResize);
                }
            } else {
                window.addEventListener('resize', handleResize);
            }
        }

        const api = {
            reinitialize() {
                try {
                    setWidth();
                    setTimeout(() => { initializeVideoHovers(); }, 200);
                } catch (error) {
                    console.error('UCTestimonialMarquee: Error during reinitialize:', error);
                }
            },
            destroy() {
                try {
                    if (resizeObserver) {
                        resizeObserver.disconnect();
                        resizeObserver = null;
                    } else {
                        window.removeEventListener('resize', handleResize);
                    }
                    g_marquee.forEach(marqueeItem => {
                        if (!marqueeItem) return;
                        const $parentCarousel = jQuery(marqueeItem).closest('.ue-video-carousel');
                        if ($parentCarousel.length) {
                            const cleanup = $parentCarousel.data('videoHoverCleanup');
                            if (cleanup) cleanup();
                        }
                    });
                    isInitialized = false;
                } catch (error) {
                    console.error('UCTestimonialMarquee: Error during destroy:', error);
                }
            },
            getState() {
                return { isInitialized, marqueeCount: g_marquee.length, viewportWidth: utils.getViewportWidth() };
            }
        };

        initializeWithVideoSupport();
        setupResizeObserver();
        return api;
    }

    window.UCTestimonialMarquee = UCTestimonialMarquee;

    window.UCInitializeMarquee = function(selector, options = {}) {
        const elements = jQuery(selector);
        if (!elements.length) {
            console.warn('UCInitializeMarquee: No elements found for selector:', selector);
            return null;
        }
        return UCTestimonialMarquee(elements, options);
    };

})(jQuery);
