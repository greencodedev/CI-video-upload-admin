$('#forget-password').click(function() {
    $('.login-form').hide();
    $('.forget-form').show();
});

$('#back-btn').click(function() {
    $('.login-form').show();
    $('.forget-form').hide();
});

$('#register-btn').click(function() {
    $('.login-form').hide();
    $('.register-form').show();
});

$('#register-back-btn').click(function() {
    $('.login-form').show();
    $('.register-form').hide();
});

$('.login_btn').click(function() {
    var baseurl = $("#baseurl").val();
    if (validate_login() == true) {
        var posting = $.post(baseurl + "index.php/user/loginproc", {'username': $("#username").val(), 'password': $("#password").val()});
        posting.done(function(data) {
            var result = JSON.parse(data);
            if (result.error == "success" && result.permission != 0) {
                window.location.href = baseurl + "index.php/video/all";
            } else if (result.permission == 0) {
                $('.alert-danger', $('.login-form')).show();
                $('.login-form .alert-danger .error-text').html("Please wait for agreement from Admin.");
            } else {
                $('.alert-danger', $('.login-form')).show();
                $('.login-form .alert-danger .error-text').html("login was failed.");
            }
        });
    }
})

$('#register-submit-btn').click(function() {
    var baseurl = $("#baseurl").val();
    if (validate_register() == true) {
        var posting = $.post(
                        baseurl + "index.php/user/register", 
                        {
                            'username': $("#reg_username").val(), 
                            'password': $("#reg_password").val(),
                            'realname': $("#realname").val(),
                            'email'   : $("#email").val(),
                            'address' : $("#address").val(),
                            'phonenum': $("#phonenumber").val(),
                        }
                    );
        posting.done(function(data) {
            var result = JSON.parse(data);
            if (result.error = "success") {
                $('.alert-danger', $('.register-form')).show();
                $('.register-form .alert-danger .error-text').html("Success! Please wait for agreement from Admin!");
            } else {
                $('.alert-danger', $('.register-form')).show();
                $('.register-form .alert-danger .error-text').html("Registration was failed.");
            }
        });
    }
})

// validation 
function validate_login() {
    if ($('#username').val() == "" || $('#password').val() == "") {
        $('.alert-danger', $('.login-form')).show();
        $('.login-form .alert-danger .error-text').html("Enter any username and password.");
        return false;
    }
    return true;
}

function validate_register() {
    if ($('#realname').val() == "" || $('#reg_username').val() == "" || $('#reg_password').val() == "" || $('#rpassword').val() == "") {
        $('.alert-danger', $('.register-form')).show();
        $('.register-form .alert-danger .error-text').html("Enter your information correctly.");
        return false;
    } else if ($('#reg_password').val() != $('#rpassword').val()) {
        $('.alert-danger', $('.register-form')).show();
        $('.register-form .alert-danger .error-text').html("Enter your password correctly.");
        return false;
    }
    return true;
}