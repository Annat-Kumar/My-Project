

<script>

var uploadField = document.getElementById("f_fund_images");
uploadField.onchange = function() {
	if(this.files[0].size > 5242880){
		alert("Event image is too Big , please upload image with size upto 5MB");
		this.value = "";
	};
};
</script>  
