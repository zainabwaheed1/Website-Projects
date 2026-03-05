<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
// effect object rotate
window.addEventListener("scroll", () => {
  const rotationAngle = window.pageYOffset * 0.15;
  const rotateObjects = document.querySelectorAll(".rotate-effect img");
  rotateObjects.forEach((object) => {
    object.style.transform = `rotate(${rotationAngle}deg)`;
  });
});

jQuery(function($){
    $('.testimonial-carousel').owlCarousel({
        center: true,
        loop: true,
        margin: 30,
        nav: false,
		dots: false,
        autoplay: true,
          responsive: {
            0: {
              items: 1,
            },
            700: {
              items: 3,
            },
            1000: {
              items: 3,
            },
          },
    });
}); 

</script>
<!-- end Simple Custom CSS and JS -->
