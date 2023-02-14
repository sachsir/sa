$(document).ready(function () {
    $("#form").validate({
        
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            company: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            
        },
        
        // in 'messages' user have to specify message as per rules
        messages: {
            company: " Please enter your companysss",
            email: {
                required: " Please enter a email",
                minlength: " Your email must consist of at least 5 characters"
            },
            password: {
                required: " Please enter a password",
                minlength: " Your password must be consist of at least 5 characters"
            },
        },
      
    });
});



