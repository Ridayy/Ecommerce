$(document).ready(function(){
    console.log('loaded');

    

});

function readURL(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#product_img')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


