var timer;
var pro = 0;
var flag_success = false;
var value = 10;

$('.btn-add').click(function() {
    if (pro > 0) {
        $('.btn-add btn-file').attr('disabled');
        return;
    }
    {
        var progress = '<div class="progress progress-striped"><div class="progress-bar progress-bar-success progress-value" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only"> </span></div></div>';

        var html = "<tr><td style='width: 30%;'>" + $('.fileinput-filename').html() + "</td><td style='width: 60%;'>" + progress + "</td><td style='width: 10%;'><button class='btnDel'>cancel</button></td></tr>";
        $('.files').append(html);
        timer = setInterval(increaseProgress, 500);        
        ajaxFileUpload();
    }
});

$('.video-upload-progress').on('click', '.btnDel', function() {
    $(this).closest('tr').remove();
})

function increaseProgress() {
    if (pro == 450) {
        pro = 0;
        clearInterval(timer);
        return;
    } else {
        pro = pro + value;
        $('.progress-value').css("width", pro);
    }
}

function ajaxFileUpload() {
    var base_url = $('#baseurl').val();
    var form_data = new FormData();
    var files_images = $("#uploadFiles")[0].files;


    for (var count = 0; count < files_images.length; count++) {
        var name = files_images[count].name;
        var extension = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(extension, ['avi', 'mpeg', 'mpg', 'mp4']) == -1)
        {
            toastr.error('Invalid type of file');
            return false;
        }
        else 
        {
            form_data.append("files[]", files_images[count]);
            // form_data.append("content", $('#contents').val());
        }
    }
    // 
    $.ajax({
        data: form_data,
        type: "POST",
        url: base_url + 'index.php/video/upload',
        crossOrigin: false,
        contentType: false,
        processData: false,
        success : function(response){
            if (response == "success") 
            {
                $('.progress-value').css("width", 450);
                $('.progress-bar-success').removeClass('progress-value');
                toastr.success('Success!');
            } 
            else
            {
                value = 0;
                toastr.error('Uploading was failed on server.');
            }
        },
        error: function() {
            value = 0;
            toastr.error('Uploading was failed on server. Please set FTP correctly.');
        }
    });
}
$('.goto-back').click(function() {
    var baseurl = $('#baseurl').val();
    window.location.href = baseurl + "index.php/video/all";
});