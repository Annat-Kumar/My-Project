<?php 
/**
 * Template Name: Profile Pic
 *
 * Registration Page Template.
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); 
 ?>
 <div class="row enigma_blog_wrapper">
<div class="container inner_page">
<div class="inner3">
<?php 
global $pic;
 if ( have_posts()) :  the_post(); 

 endif; 
  $user=get_current_user_id();
if (isset($_POST['submit'])) 
{

       
      
         $pic        =   $_POST['profile_pic'];

    
    $reg_errors = new WP_Error;

  if (empty( $pic ) ) {
     
     $reg_errors->add('profile_pic', 'Profile Pic is required');
    
    } 
 
     
$filename = basename($pic);
$upload_file = wp_upload_bits($filename, null, file_get_contents($pic));
if (!$upload_file['error']) {
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_parent' => $parent_post_id,
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
    if (!is_wp_error($attachment_id)) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
        wp_update_attachment_metadata( $attachment_id,  $attachment_data );
    }
    update_user_meta($user,'wp_user_avatar',$attachment_id);


  echo '<div class="msg">You have update your profile picture .';

            
        header( "refresh:5;url=".get_bloginfo('url')."/posts" );

  }
  else
  {
    foreach ( $reg_errors->get_error_messages() as $error ) {
           
            echo '<div class="error">'.$error.'</div>';
        }
  }
  

}

?>

 
<?php the_content();?>

    <form name="picture" action="" method="post" id="picture">
   <b>Your Current Profile Picture: </b><?php echo get_avatar( $user, 100 ); ?>
      <div class="form-group">
      
          <!-- <label for="inputPassword">Profile Picture <strong class="required">*</strong></label>  -->
          <input type="hidden" id="my_hidden_input" name="profile_pic" value="<?php echo $pic; ?>">
         <?php  echo do_shortcode('[ajax-file-upload  on_success_set_input_value="#my_hidden_input"]'); ?>
         <!-- <input class="up_file" type="file" style="display: none;"> -->
        
       
        </div> 
         <div class="form-group">
           
           
                <input type="submit" id="submit_pic"  value="Update" name="submit" class="form-control">
               
               
          
        </div>
      
    </form>
    
</div>
</div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function()
  {
jQuery('.up_pic').click( function() {
    jQuery('.up_file').trigger( 'click' );
} );

  });
</script>


<?php get_footer();?>
