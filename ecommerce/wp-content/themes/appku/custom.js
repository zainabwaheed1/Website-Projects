jQuery(document).ready(function($) {
    $('#wpcf7-f6046-p6047-o1 form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form data
        var formData = new FormData(this);

        // Make an AJAX POST request to your Django API endpoint
        $.ajax({
            url: 'https://portal.beyonderissolutions.com/api/demo/request-demo/',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle the API response if needed
                console.log('API Response:', response);
            },
            error: function(error) {
                // Handle errors
                console.error('API Error:', error);
            }
        });
    });
});