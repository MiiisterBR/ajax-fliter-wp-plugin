jQuery(document).ready(function ($) {

    // when filter form is submit
    $('#filter').submit(function () {
        // get all data from form
        let filter = $('#filter');
        //send ajax request
        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize(), // form data
            type: filter.attr('method'), // POST
            beforeSend: function (xhr) {
                filter.find('button').text('Processing...'); // change button label
            },
            success: function (data) {
                filter.find('button').text('Apply filter'); // change button label after data
                $('#response').html(data); // insert data
            },
            error: function () {
                filter.find('button').text('Apply filter'); // change button label after data
                $('#response').html("<h3>Error....</h3>"); // insert data
            }
        });
        return false;
    });
});