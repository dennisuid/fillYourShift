function setupImageCropping(context, canvas, img){
    context.canvas.height = img.height;
    context.canvas.width = img.width;
    context.drawImage(img, 0, 0);
    var cropper = canvas.cropper({
        aspectRatio: 16 / 9
    });
    $('#btnCrop').css('margin', '30px');
    $('#btnCrop').show();
    $('#photo').hide();
}
function cropAndUploadProfilePic() {
    var canvas = $("#canvas"),
        $result = $('#result'),
        context = "";
    if (typeof canvas.get(0) != "undefined")
    {
        context = canvas.get(0).getContext("2d");
    }
    $('#resume').on('change', function () {
        if (this.files[0].type.match(/^application\//)) {
            var reader = new FileReader();
            var formData = new FormData();
            formData.append('resume', this.files[0]);
            ajaxCallForUpload('/user/profile/resume',formData);
        }
    });
    $('#photo').on('change', function () {
        if (this.files && this.files[0]) {
            if (this.files[0].type.match(/^image\//)) {
                var reader = new FileReader();
                reader.onload = function (evt) {
                    var img = new Image();
                    img.onload = function () {
                        setupImageCropping(context, canvas, img);
                        $('#btnCrop').click(function () {
                            // Get a string base 64 data url
                            var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");
                            $('#image_uploaded').attr('src', croppedImageDataURL);
                            canvas.cropper('getCroppedCanvas').toBlob(function (blob) {
                                var formData = new FormData();
                                formData.append('photo', blob);
                                ajaxCallForUpload('/user/profile/getfile',formData);
                            });
                            $('.cropper-container').hide();
                        });
                        $('#btnRestore').click(function () {
                            canvas.cropper('reset');
                            $result.unwrap();
                        });
                    };
                    img.src = evt.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
            else {
                alert("Invalid file type! Please select an image file.");
            }
        }
        else {
            alert('No file(s) selected.');
        }
    });
}
$('#previous-exp1-role, #previous-exp2-role, #previous-exp3-role').on('change', function () {

    var data = new Array();
    data[$(this).attr('id')] = $(this).val();
    $.ajax({
        type: 'POST',
        url: '/user/profile/role',
        dataType: 'json',
        data: data
    });
});
function ajaxCallForUpload(ajaxUrl, formData){
    $.ajax(ajaxUrl, {
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function () {
            console.log('Upload success');
        },
        error: function () {
            console.log('Upload error');
        }
    });
}

$(document).ready(function () {
    cropAndUploadProfilePic();
});