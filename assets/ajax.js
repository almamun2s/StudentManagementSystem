jQuery(document).ready(function($) {

    $('#sms-search_class_lecturers').keyup( function(){
        const searchedValue = $('#sms-search_class_lecturers').val();
        const loading       = $('#sms-loading');

        var requestData = {
            search: searchedValue,
        };


        $.ajax({
            url: 'http://localhost/Projects/StudentManagementSystem/schools/searchLecturers', // URL of the API endpoint
            type: 'POST', 
            data: requestData,
            success: function(response) {
                loading.removeClass('d-none');
                $('#sms-search_class_lecturers_response').addClass('d-none');

            setTimeout( function (){
                loading.addClass('d-none');
                $('#sms-search_class_lecturers_response').removeClass('d-none');

                $('#sms-search_class_lecturers_response').html(response);
            }, 500);

            },
            // error: function(xhr, status, error) {
            //     // Handle errors
            //     console.error(xhr.responseText);
            // }
        });
        
    });

});
