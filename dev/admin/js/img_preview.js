function readURL(input, output) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            output.attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#img_upload").change(function() {
    readURL(this, $("#prev_img"));
});
