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
	  
<?php


$pic = $_FILES['upload_image'];
//   echo "<pre>";print_r($pic);die;
$path = $pic['name'];
?>
   <img src="{$image_file}" alt="file not found" /></br>
 <?php   $upload_overrides = array( 'test_form' => false );

     $reg_errors = new WP_Error;

  if (empty( $pic ) ) {
     
     $reg_errors->add('upload_image', 'Profile Pic is required');
    
    } 
 
     
$filename = basename($pic['name']);

 $wp_filetype = wp_check_filetype($filename, null );

 $uploadedfile = array(
            'name'     => $_FILES['upload_image']['name'],
            'type'     => $_FILES['upload_image']['type'],
            'tmp_name' => $_FILES['upload_image']['tmp_name'],
            'error'    => $_FILES['upload_image']['error'],
            'size'     => $_FILES['upload_image']['size']	

        );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
if (!$movefile['error']) {
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_parent' => $parent_post_id,
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $movefile['file']);
    if (!is_wp_error($attachment_id)) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $movefile['file'] );
        wp_update_attachment_metadata( $attachment_id,  $attachment_data );
    }
    update_user_meta($user,'wp_user_avatar',$attachment_id);


  echo '<div class="msg">You have update your profile picture </div>';

            
        header( "refresh:5;url=".get_bloginfo('url')."/edit-profile" );

  }
  else
  {
    foreach ( $reg_errors->get_error_messages() as $error ) {
           
            echo '<div class="error">'.$error.'</div>';
        }
  }
  

}

?>