$(document).ready(function () {
    setTimeout(function () {
        $('.alert-danger').remove();
    }, 3000);
    $('#adduserForm').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
            },
            confirmpassword: {
                equalTo: "#password"
            },
        },
        messages: {
            name: 'Please enter user name',
            email: {
                required: 'Please enter user email',
                email: 'Please enter valid email address',
            },
            password: {
                required: 'Please enter password',
                minlength: 'Password must be at least 8 characters long',
            },
            confirmpassword: " Enter Confirm Password Same as Password",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});