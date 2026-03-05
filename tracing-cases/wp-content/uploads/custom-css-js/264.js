<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function($){

    $('.block-shadow').each(function(){

        var stars   = $(this).find('.slide-icons');
        var content = $(this).find('.slide-content');
        var info    = $(this).find('.slide-info');

        // Move stars to very top
        $(this).prepend(stars);

        // Move content after stars
        stars.after(content);

        // Move title + subtitle after content
        content.after(info);

    });

});

jQuery(document).ready(function ($) {
    setTimeout(function () {
        const slider = document.querySelector("#mySwiper-1");

        if (slider && slider.swiper) {
            slider.swiper.params.centeredSlides = true;
            slider.swiper.update();
        }
    }, 300);
});

jQuery(document).ready(function ($) {

    // Target ONLY this specific filter
    var $ul = $('ul.xpro-filter-attribute-list[data-filter-key="pa_price-range"]');

    // Get all li items
    var items = $ul.find('li').get();

    // Sort by the first number (start price)
    items.sort(function (a, b) {
        var aStart = parseInt($(a).data('filter-value').split('-')[0]);
        var bStart = parseInt($(b).data('filter-value').split('-')[0]);
        return aStart - bStart;
    });

    // Create dropdown
    var $select = $('<select class="price-range-dropdown"></select>');
    $select.append('<option value="">Select Price Range</option>');

    // Add sorted items into dropdown
    $.each(items, function (i, li) {
        var value = $(li).dataset ? li.dataset.filterValue : $(li).data('filter-value');
        var text = $(li).text().trim();

        $select.append('<option value="' + value + '">' + text + '</option>');
    });

    // Insert dropdown
    $ul.before($select);

    // Hide original list
    $ul.hide();

    // Trigger filter when dropdown changes
    $select.on('change', function () {
        var selected = $(this).val();
        $ul.find('li[data-filter-value="' + selected + '"]').trigger('click');
    });

});

jQuery(document).ready(function($){

    var $select = $('select.orderby');

    // Remove specific options
    $select.find('option[value="popularity"]').remove();
    $select.find('option[value="price"]').remove();
    $select.find('option[value="price-desc"]').remove();

});

jQuery(document).ready(function($){
    $('.woocommerce-MyAccount-navigation-link').click(function(){
        var link = $(this).find('a').attr('href');
        if(link){
            window.location = link;
        }
    });

    // Optional: change cursor to pointer
    $('.woocommerce-MyAccount-navigation-link').css('cursor','pointer');
});
</script>
<!-- end Simple Custom CSS and JS -->
