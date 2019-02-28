
<?php
// Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    jQuery($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    jQuery('#gallery-photo-add').on('change', function() {
		//alert('testing');
        imagesPreview(this, '.gallery');
    });
	
?>


<script>

var uploadField = document.getElementById("f_fund_images");
uploadField.onchange = function() {
	if(this.files[0].size > 5242880){
		alert("Event image is too Big , please upload image with size upto 5MB");
		this.value = "";
	};
};
</script>  
