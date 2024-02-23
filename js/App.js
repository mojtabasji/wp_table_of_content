


document.addEventListener('DOMContentLoaded', function () {
    console.log('Apps is Here !) ...');
    jQuery.ajax({
        url: toc_ajax_object.ajax_url, // URL to the PHP file which will handle the data processing on the server side
        type: 'POST',
        data: {
            action: 'toc_ajax_action', // Action hook to identify the PHP function
            request: 'get_products', // The PHP function to be called
        },
        success: function (response) {
            // Handle the response (data received from the server)
            response = JSON.parse(response);
            console.log('AJAX Response:', response);

        },
        error: function (error) {
            console.error('AJAX Error:', error);
        },
    });
});

