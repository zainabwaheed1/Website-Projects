<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
// Insert img before categories
document.addEventListener('DOMContentLoaded', function() {
  const listItems = document.querySelectorAll('.sidebar-item.widget.widget_block li.cat-item');
  listItems.forEach((listItem) => {
    const image = document.createElement('img');
    image.src = 'https://erisinnovate.ai/wp-content/uploads/2023/07/betterdocs-cat-icon.svg';
    image.classList.add('categories_img');
    listItem.prepend(image);
  });
});
// ------------------------------------


jQuery(document).ready(function( $ ){
	 window.onscroll = function () {
        if ($('.ticket_management').pageYOffset > 20) {
			$('.software-feature-area').addClass("active");
		}
 }

// 	First Section Tab code
	   $('.ticket_management .features-list .item:first-child').click(function(){
checkPopUp('pop1')
		   $(this).addClass("active").siblings().removeClass("active");
		    let imgTag1 = $('<img>').attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/3.jpg').attr('alt', 'Image');
  $(".ticket_management .features-list .item:first-child").click(function(){
    $(".cover").fadeIn("300");
  })
	     $("<div/>").attr('class','pop1').appendTo('.row.align-center .col-lg-6.left-info'); 
      $('.pop1').append(imgTag1, '<i class="fa fa-times e close_popup" aria-hidden="true"></i>').addClass('ticket_management1');
	  $('.close_popup').click(function(){  
// 		  Get the div element
		var divElement = document.querySelector('.pop1');
		if (divElement.classList.contains('hide_div')) {
		  divElement.classList.remove('hide_div');
		} else {
		  divElement.classList.add('hide_div');
		}
   });		   
   });

// 	----------------------------------------------------------
	  $('.ticket_management .features-list .item:nth-child(2)').click(function(){
		  checkPopUp('pop2');
		$(this).addClass("active").siblings().removeClass("active");
		let imgTag2 = $('<img>').attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/4.jpg').attr('alt', 'Image');
        $("<div/>").attr('class','pop2').appendTo('.row.align-center .col-lg-6.left-info'); 
      $('.pop2').append(imgTag2, '<i class="fa fa-times close_popup" aria-hidden="true"></i>').addClass('ticket_management1');
	  $('.close_popup').click(function(){
 	var divElement = document.querySelector('.pop2');
		if (divElement.classList.contains('hide_div')) {
		  divElement.classList.remove('hide_div');
		} else {
		  divElement.classList.add('hide_div');
		}
   });
   });
// -------------------------------------------------------------------
	  $('.ticket_management .features-list .item:last-child').click(function(){
		  checkPopUp('pop3');
		$(this).addClass("active").siblings().removeClass("active");
		let imgTag3 = $('<img>').attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/5.jpg').attr('alt', 'Image');
          $("<div/>").attr('class','pop3').appendTo('.row.align-center .col-lg-6.left-info'); 
      $('.pop3').append(imgTag3, '<i class="fa  fa-times  close_popup" aria-hidden="true"></i>').addClass('ticket_management1');
	  $('.close_popup').click(function(){
     	var divElement = document.querySelector('.pop3');
		if (divElement.classList.contains('hide_div')) {
		  divElement.classList.remove('hide_div');
		} else {
		  divElement.classList.add('hide_div');
		}
   });
   });
// ---------------------------------------------------------	 
// Section Second Tab code
	$(window).on('load', function() {
			$('.featured-image-style.col-lg-6.thumb img') .attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/1.jpg').fadeIn();
		$('li.featured-image-style2:first-child').addClass('featured_image_active')
      });
	
    $('.discover_tabs li.featured-image-style2:first-child').click(function(){
		$('.featured-image-style.col-lg-6.thumb img') .attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/1.jpg').fadeIn();
   })
	  $('.col-lg-6.info.ml-auto ul li:nth-child(2)').click(function(){
		$('.featured-image-style.col-lg-6.thumb img') .attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/2.jpg');
   })
	  $('.discover_tabs li.featured-image-style2:last-child').click(function(){
		$('.featured-image-style.col-lg-6.thumb img') .attr('src', 'https://erisinnovate.ai/wp-content/uploads/2023/07/6.jpg');
   })
		
 $(document).ready(function() {
    $(".col-lg-6.info.ml-auto ul li").click(function() {
    $(this).addClass("featured_image_active");
    // Remove "active" class from sibling lis
    $(this).siblings().removeClass("featured_image_active");
   });
 });
});
		function checkPopUp(className){
			let popUp = document.querySelector('.'+className)
		  if(popUp){
		  popUp.remove()	
		  }
}

// hide nav onclick li
jQuery('ul#menu-main-menu li').click(function(){
	jQuery('.collapse .navbar-collapse.collapse-mobile.show').removeClass('show');
	jQuery('.overlay-screen.opened').removeClass('opened');
})


        
  </script>
<!-- end Simple Custom CSS and JS -->
