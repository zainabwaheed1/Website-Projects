<?php
/**
 * @Packge     : Appku
 * @Version    : 1.0
 * @Author     : Appku
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    /**
    *
    * Hook for Footer Content
    *
    * Hook appku_footer_content
    *
    * @Hooked appku_footer_content_cb 10
    *
    */
    do_action( 'appku_footer_content' );


    wp_footer();
    ?>
<!-- <script src="//code.tidio.co/olna1z7wycbuhhi3cuunsadcxl135mjh.js" async></script> -->
<!-- <script>
   var typing=new Typed(".banner-text", {
       strings: ["", "Payroll", "Leaves", "Recruitment", "Attendance", "Employee Data", "Projects", "Meetings", "Performance","Gratuity"],
       typeSpeed: 100,
       backSpeed: 40,
       loop: true,
   });
</script>
<script>
   var erisbiztyping =new Typed(".banner-text-eris", {
       strings: ["", "Business Hurdles", "Workflows", "Sales Strategies", "Cashflows ", "Purchases", "Invoicing "],
       typeSpeed: 100,
       backSpeed: 40,
       loop: true,
   });
</script>
<script>
   var erisbot =new Typed(".banner-text-eris-aibot", {
       strings: ["", "Automate tasks", "Accelerate growth", "Capture leads", "Resolve queries", "Maximize efficiency "],
       typeSpeed: 100,
       backSpeed: 40,
       loop: true,
   });
</script>
 -->
<!-- Cursor Pointer -->
<script>
/*=====================
    Custom Cursor js 
==========================*/
const cursor = document.querySelector("#cursor");
const cursorBorder = document.querySelector("#cursor-border");
const cursorPos = {
    x: 0,
    y: 0
};
const cursorBorderPos = {
    x: 0,
    y: 0
};

document.addEventListener("mousemove", (e) => {
    cursorPos.x = e.clientX;
    cursorPos.y = e.clientY;

    cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
});

requestAnimationFrame(function loop() {
    const easting = 8;
    cursorBorderPos.x += (cursorPos.x - cursorBorderPos.x) / easting;
    cursorBorderPos.y += (cursorPos.y - cursorBorderPos.y) / easting;

    cursorBorder.style.transform = `translate(${cursorBorderPos.x}px, ${cursorBorderPos.y}px)`;
    requestAnimationFrame(loop);
});

document.querySelectorAll("[data-cursor]").forEach((item) => {
    item.addEventListener("mouseover", (e) => {
        if (item.dataset.cursor === "pointer") {
            cursorBorder.style.backgroundColor = "rgba(0, 144, 144, .4)";
            cursorBorder.style.setProperty("--size", "55px");
        }
        if (item.dataset.cursor === "pointer2") {
            cursorBorder.style.backgroundColor = "white";
            cursorBorder.style.mixBlendMode = "difference";
            cursorBorder.style.setProperty("--size", "60px");
        }
    });
    item.addEventListener("mouseout", (e) => {
        cursorBorder.style.backgroundColor = "unset";
        cursorBorder.style.mixBlendMode = "unset";
        cursorBorder.style.setProperty("--size", "30px");
    });
});
</script>

	<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
	<script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
<script id="rendered-js">
		/* ---- particles.js config ---- */

particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 130,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});


/* ---- stats.js config ---- */

var count_particles, stats, update;
stats = new Stats;
stats.setMode(0);
stats.domElement.style.position = 'absolute';
stats.domElement.style.left = '0px';
stats.domElement.style.top = '0px';
document.body.appendChild(stats.domElement);
count_particles = document.querySelector('.js-count-particles');
update = function() {
  stats.begin();
  stats.end();
  if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
    count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
  }
  requestAnimationFrame(update);
};
requestAnimationFrame(update);


	</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scriptUrl = 'https://chatbot.beyonderissolutions.com/scripts/bundle.js';
    const scriptElement = document.createElement('script');
    scriptElement.src = scriptUrl;
    scriptElement.type = 'text/javascript';

    // Intersection Observer for lazy loading the script
    const observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.body.appendChild(scriptElement);
                observer.disconnect(); // Stop observing once the script is loaded
            }
        });
    }, { threshold: 0.1 });

    // Trigger the observer for the script's future container element
    const target = document.createElement('div');
    target.style.height = '1px'; // Small invisible element to trigger the lazy load
    document.body.appendChild(target);
    observer.observe(target);
});
</script>

</body>
</html>