var prevData;
$('.button-reset').click(function() {
    $('.form-group .form-control').removeAttr('disabled');
    $('button.button-submit').removeClass('hide');

    prevData = [$('#path_server').val(), $('#ftp_hostname').val(), $('#ftp_username').val(), $('#ftp_password').val()];
});

$('.button-submit').click(function() {
    var baseurl = $('#baseurl').val();
    if (validate()) {
        $('.form-group').removeClass('has-error');
        $.post(baseurl + 'index.php/settings/update', 
                {
                    "upload_path"  : $('#path_server').val(),
                    "ftp_server"   : $('#ftp_hostname').val(), 
                    "ftp_username" : $('#ftp_username').val(),
                    "ftp_password" : $('#ftp_password').val()
                },
                function(data) {
                    var response = JSON.parse(data);
                    if (response.error == "success") {
                        toastr.success("Success! Setting FTP server was updated.");
                        disableControls();
                    } else {
                        toastr.error("Failed! Please try again");
                        revertValue();
                    }
                }
        )
    }
});

function validate() {
    var flag = 1;
    if ($('#path_server').val() == "") {
        $('#path_server').parent('div').parent('.form-group').addClass('has-error');
        flag = 0;
    }
    if ($('#ftp_hostname').val() == "") {
        $('#ftp_hostname').parent('div').parent('.form-group').addClass('has-error');
        flag = 0;
    }
    if ($('#ftp_username').val() == "") {
        $('#ftp_username').parent('div').parent('.form-group').addClass('has-error');
        flag = 0;
    }
    if ($('#ftp_password').val() == "") {
        $('#ftp_password').parent('div').parent('.form-group').addClass('has-error');
        flag = 0;
    }
    return flag;
}

function disableControls() {
    $('.form-group .form-control').attr('disabled', true);
    $('button.button-submit').addClass('hide');
}

function revertValue() {
    $('#path_server').val(prevData[0]);
    $('#ftp_hostname').val(prevData[1]);
    $('#ftp_username').val(prevData[2]);
    $('#ftp_password').val(prevData[3]);
    disableControls();
}
