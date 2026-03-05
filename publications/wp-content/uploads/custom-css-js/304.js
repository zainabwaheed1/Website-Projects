<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".music-title h2 a").forEach(title => {
    const words = title.textContent.trim().split(/\s+/);
    if (words.length > 3) {
      title.textContent = words.slice(0, 3).join(" ") + "...";
    }
  });
});


document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector(".mine-header");
    if (!header) return;

    const headerHeight = header.offsetHeight;
    const triggerPoint = headerHeight; // when sticky starts

    window.addEventListener("scroll", function () {
        if (window.scrollY > triggerPoint) {
            header.classList.add("is-sticky");
            document.body.classList.add("has-sticky-header");
        } else {
            header.classList.remove("is-sticky");
            document.body.classList.remove("has-sticky-header");
        }
    });
});
</script>
<!-- end Simple Custom CSS and JS -->
