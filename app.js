$(function() {
    // Get the form.
    var form = $('#ajax-contact');

    // Get the messages div.
    // var formMessages = $('#form-messages');

    // Set up an event listener for the contact form.
    $(form).submit(function(event) {
        // Stop the browser from submitting the form.
        event.preventDefault();


        if ($('#email').val() !== '') {
            // Serialize the form data.
            var formData = $('#email').val();
            // Submit the form using AJAX.
            $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: {
                        email: formData
                    }
                })
                .done(function(response) {
                    // Make sure that the formMessages div has the 'success' class.
                    $('#email').val();
                    $('#btn-subscribe').text('Thank You');
                    $('#btn-subscribe').css({
                        'background-color': '#0ea51c',
                        'border-color': '#0ea51c'
                    });
                })
                .fail(function(data) {
                    alert('Error! something happens');
                });
        }

    });
});
