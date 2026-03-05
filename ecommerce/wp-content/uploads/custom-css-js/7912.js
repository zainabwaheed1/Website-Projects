<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(window).on('load', function($){
		jQuery('#process-flow .app-feature-thumb').find('img').addClass('process-flow-img').attr('id', 'tab_imgapp-feature-item1');
	jQuery('#process-flow .app-feature-thumb').append('<img decoding="async" class="process-flow-img" id="tab_imgapp-feature-item2" src="https://wordpresss-data.s3.me-south-1.amazonaws.com/Ai_imges/Saleh_Ai_Nurture.png" alt=""><img decoding="async" class="process-flow-img" id="tab_imgapp-feature-item3" src="https://wordpresss-data.s3.me-south-1.amazonaws.com/Ai_imges/Saleh_Ai_Qualify.png" alt=""><img decoding="async" class="process-flow-img" id="tab_imgapp-feature-item4" src="https://wordpresss-data.s3.me-south-1.amazonaws.com/Ai_imges/Saleh_Ai_Convert.png" alt="">');
});
jQuery(window).on('load', function(){
    jQuery(".MuiBox-root.css-rt18yi").delay(2000).fadeIn(500);
});


jQuery(document).ready(function( $ ){
	$('.feature_box').mouseover(function(){
	tabid = this.id;
	$('.img_box').hide();
	$('#tab_img'+tabid).show();
	});
	
	$('.app-feature-tab').mouseover(function(){
	$('.app-feature-tab').removeClass('active');
	$(this).addClass('active');
	tabid = this.id;
	$('.process-flow-img').hide();
	$('#tab_img'+tabid).css("display", "block");
	});
	
	$('.MuiBox-root.css-1e561k9').click(function(){
	$(".MuiBox-root.css-rt18yi").fadeOut(500);
	});
	
// 	 hide mobile navbar
   $("nav.navbar.validnavs .navbar-nav >li").click(function(){
// 	     alert("clickk");
    	$(".collapse.navbar-collapse.collapse-mobile").removeClass('show');
	     $(".overlay-screen").removeClass('opened');
   });
	
// Sticky Header Js
  $(window).on("scroll", function () {
    var Width = $(document).width();
    var scroll = $(window).scrollTop();

    if ($("body").scrollTop() > 30 || $("html").scrollTop() > 30) {
      if (Width < 1023) {
        $(".transparent-nav").addClass("nav-fixed-wrapper");
	  }
    } else {
      $(".transparent-nav").removeClass("nav-fixed-wrapper");
    }
  });
	
});

</script>
<!-- end Simple Custom CSS and JS -->
