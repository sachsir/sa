$(document).ready(function () {

    jQuery.validator.addMethod("regex", function (value, element, param) {
        return value.match(new RegExp("^" + param + "$"));
    });
    var ALPHA_REGEX = "[a-zA-Z_ ]*";

    jQuery.validator.addMethod(
        'Uppercase',
        function (value) {
            return /[A-Z]/.test(value);
        },
        'Your password must contain at least one Uppercase Character.'
    );
    jQuery.validator.addMethod(
        'Lowercase',
        function (value) {
            return /[a-z]/.test(value);
        },
        'Your password must contain at least one Lowercase Character.'
    );
    jQuery.validator.addMethod(
        'Specialcharacter',
        function (value) {
            return /[!@#$%^&*()_-]/.test(value);
        },
        'Your password must contain at least one Special Character.'
    );
    jQuery.validator.addMethod(
        'Onedigit',
        function (value) {
            return /[0-9]/.test(value);
        },
        'Your password must contain at least one digit.'
    );

    $("#registerform").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                regex: ALPHA_REGEX,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                Uppercase: true,
                Lowercase: true,
                Specialcharacter: true,
                Onedigit: true,
                maxlength: 18,
                minlength: 8,
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
        },
        messages: {
            name: {
                required: " Please enter your name",
                minlength: "Name need to be at least 2 characters long",
                regex: "Please enter characters only"
            },
            email: {
                required: " Please enter your email",
            },
            password: {
                required: "Please enter your password",
                minlength: "Password need to be at least 8 characters long",
                maxlength: "Password need to be atleast  18 characters long",
            },
            
        },
        submitHandler: function (form) {
            form.submit();
        }
    });



    $("#editform").validate({
        rules: {
            company: {
                required: true,
                minlength: 2,
            },
            description: {
                required: true,
                minlength: 10,
            },
        },
        messages: {
            company: {
                required: " Please enter your car company name",
                minlength: "Company name need to be at least 2 characters long",
            },
            description: {
                required: "Please enter your car description",
                minlength: "Description need to be at least 10 characters long",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });



    $("#addform").validate({
        rules: {
            image: {
                required: true,
            },
            company: {
                required: true,
                minlength: 2,
            },
            description: {
                required: true,
                minlength: 10,
            },
        },
        messages: {
            image: {
                required: " Please select your car image",
            },
            company: {
                required: " Please enter your car company name",
                minlength: "Company name need to be at least 2 characters long",
            },
            description: {
                required: "Please enter your car description",
                minlength: "Description need to be at least 10 characters long",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});