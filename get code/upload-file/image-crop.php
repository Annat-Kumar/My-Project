<!DOCTYPE html>
<html>
<head>
    <title>Upload Files using normal form and PHP</title>
	 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
  <form enctype="multipart/form-data" method="post" action="upload.php">
    <div class="row">
      <label for="fileToUpload">Select Files to Upload</label><br />
      <input type="file" name="filesToUpload[]" id="filesToUpload" multiple="multiple" />
      <output id="filesInfo"></output>
    </div>
    <div class="row">
      <input type="submit" value="Upload" />
    </div>
  </form>
</body>
</html>

<script>
jQuery(document).ready(function($){
	//alert("checked and fined working fine");

	if (window.File && window.FileReader && window.FileList && window.Blob) {
    document.getElementById('filesToUpload').onchange = function(){
        var files = document.getElementById('filesToUpload').files;
        for(var i = 0; i < files.length; i++) {
            resizeAndUpload(files[i]);
        }
    };
} else {
    alert('The File APIs are not fully supported in this browser.');
}
 
function resizeAndUpload(file) {
var reader = new FileReader();
    reader.onloadend = function() {
 
    var tempImg = new Image();
    tempImg.src = reader.result;
    tempImg.onload = function() {
 
        var MAX_WIDTH = 400;
        var MAX_HEIGHT = 300;
        var tempW = tempImg.width;
        var tempH = tempImg.height;
        if (tempW > tempH) {
            if (tempW > MAX_WIDTH) {
               tempH *= MAX_WIDTH / tempW;
               tempW = MAX_WIDTH;
            }
        } else {
            if (tempH > MAX_HEIGHT) {
               tempW *= MAX_HEIGHT / tempH;
               tempH = MAX_HEIGHT;
            }
        }
 
        var canvas = document.createElement('canvas');
        canvas.width = tempW;
        canvas.height = tempH;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(this, 0, 0, tempW, tempH);
        var dataURL = canvas.toDataURL("image/jpeg");
 
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(ev){
            document.getElementById('filesInfo').innerHTML = 'Done!';
        };
 
        xhr.open('POST', 'uploadResized.php', true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var data = 'image=' + dataURL;
        xhr.send(data);
      }
 
   }
   reader.readAsDataURL(file);
}


});
</script>

<html lang="en">
<head>
  <title>PHP - jquery ajax crop image before upload using croppie plugins</title>
  <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
</head>
<body>


<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">Image Upluad</div>
	  <div class="panel-body">


	  	<div class="row">
	  		<div class="col-md-4 text-center">
				<div id="upload-demo" style="width:350px"></div>
	  		</div>
	  		<div class="col-md-4" style="padding-top:30px;">
				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="upload">
				<br/>
				<button class="btn btn-success upload-result">Upload Image</button>
	  		</div>
	  		<div class="col-md-4" style="">
				<div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
	  		</div>
	  	</div>


	  </div>
	</div>
</div>


<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {

//alert('check-success-response');
		$.ajax({
			url: "ajaxpro.php",
			type: "POST",
			data: {"image":resp},
			success: function (data) {
				
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
			}
		});
	});
});


</script>


</body>
</html>