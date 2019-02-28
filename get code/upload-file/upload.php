<?php


if(isset($_POST['submit_situation'])){
  $date = date('F d, Y', time());
    $us_id=get_current_user_id();
  $old_app=get_post_meta($_POST['request_for_post'],'applicants',true);
  $des=$_POST['request_desc'];
  $media=$_FILES['request_media']['name'];
  $upload_overrides = array( 'test_form' => false );
  $uploadedfile = array(
            'name'     => $_FILES['request_media']['name'],
            'type'     => $_FILES['request_media']['type'],
            'tmp_name' => $_FILES['request_media']['tmp_name'],
            'error'    => $_FILES['request_media']['error'],
            'size'     => $_FILES['request_media']['size']

        );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		
?>

	<form name="situation" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="request_for_post" name="request_for_post">
        <input type="hidden" class="author_of_post" name="author_of_post"/>
        <input type="hidden" id="request_by_user" name="request_by_user" value="<?php echo get_current_user_id();?>">

        <span class="request_form request_explain">Explain your situation</span>
        <textarea name="request_desc" placeholder="It's your life. Be Detailed, Descriptive and Honest."></textarea>
        
        <span class="request_form request_explain">Media</span>
        <input type="file" name="request_media">  
        
        <input type="submit" class="send_request" name="submit_situation" value="Send Request"/>

      </form>