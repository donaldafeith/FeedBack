<script src="//code.jquery.com/jquery-latest.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>       

<script type="text/javascript">
$(document).ready(function () {
    $('.contactusform').validate({
        rules: {
            name: {
                required: true
            },
            telno: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            town: {
                required: true
            },
            device: {
                required: true
            },
            message: {
                required: true
            }, 
        },
        messages: {
            name: {
                required: "Please enter your full name."
            },
            telno: {
                required: "Please enter your phone number."
            },
            email: {
                required: "Please enter your email address."
            },
            town: {
                required: "Please enter your town."
            },
            device: {
                required: "Please select your device."
            },
            message: {
                required: "Please enter your message."
            }, 

        },
        
        submitHandler: function (form) {
        $("#simple-msg").html("Sending...");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
                type: "POST",
                url: formURL,
                data: postData,
                success:function(data, textStatus, jqXHR) {
                   $("#simple-msg").html('<p>Thanks for your request - we will be in touch soon!</p>');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   $("#simple-msg").html('<p>Message failed to send. Please try again!</p>');
                }
            });
            
        }
    }); 
});
</script>