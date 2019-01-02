<?php 
/**
* Template Name: Author Approved Event
*
* Login Page Template.
*
* @author Ahmad Awais
* @since 1.0.0
*/
get_header(); 

$user = wp_get_current_user();
$user_id =  $user->ID;
?>
<div class="container">
	<div class="row">
		<div class="div_box">
			<div class="second_divbox">
<?php include('author-sidebar.php'); ?>
<div class="col-md-10 col-sm-9 col-xs-12">
	<div class="info_about">
      <h2>Your Approved Events</h2>
    </div>

     <?php
     global $paged; global $args;
     $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
     $args= null;
     $args = array( 'post_type' => 'fundraiser', 'posts_per_page' => 10,'post_status' =>'publish','paged' => $paged,'author' => $user->ID);
     $loop1 = new WP_Query( $args );
     if( $loop1->have_posts())
     {
      while ( $loop1->have_posts() ) : $loop1->the_post();
        ?>
        <?php
        $feature_image_app = get_the_post_thumbnail_url($POST_ID);
        ?>
        <div class="col-md-4 col-sm-6 post_list">
         <figure>

          <div class="post_border">
            <div class="thumb_image">
              <div class="blanks">
                <?php if($feature_image_app){
                  echo'<img class="img-responsive innerimages" src="'.$feature_image_app.'">';
                }
                else{
                  echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                </div>
              </div>
              <div class="com_div">
                <div class="col-sm-12 col-md-12 post_titl1">
                  <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                  echo '<h4>' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>';?>
                </div>
                <div class="col-sm-12 col-md-12 post_titl">
                  <?php echo '<p class="aaa">'; echo wp_trim_words( get_the_content(), '5', '..' );  echo'</p>';?>
                  <h5 class="hvrnone">
                    <?php

                    $fundraiser_id = $post->ID;
                    global $wpdb;
                    $aproved_query = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$fundraiser_id");
                    $count = count($aproved_query);
                    foreach ($aproved_query as $key => $new_approved)
                    {
                      $rr_id11 = $new_approved->r_id;
                      $post_slug11 = get_post_field( 'post_name', $rr_id11 );
                    }
                    
                    $approved_new_qry = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id = $rr_id11 AND f_id = $fundraiser_id");
                         // echo $count = count($approved_new_qry);

                    foreach ($approved_new_qry as $key => $newquery11)
                    {
                      $r_new11 = $newquery11->r_name;
                      $r_neww22 = $newquery11->f_auth_name;
                      $outh_id = $newquery11->rr_author_id;
                      $auth_name= get_the_author_meta('first_name', $outh_id).' '.get_the_author_meta('last_name', $outh_id);
                      ?>
                      <?php echo ucfirst($auth_name);?>
                      <?php  }
                      
                      ?>
                    </h5>
                  </div>
                </div>
              </div>
              <?php
              if(is_user_logged_in())
              {  
               if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
               { 
                ?>
                <figcaption>
                  <ul class="list-inline list-unstyled hvrbtn">
                    <li><a href="<?php echo get_permalink(); ?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo the_ID();?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                    <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_fund<?php echo the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                  </ul>
                </figcaption>
                <?php } } ?>

                <div class="modal fade" id="myModal33_fund<?php echo the_ID();?>" role="dialog">
                  <div class="modal-dialog delete_modal">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Event!</h4>
                      </div>
                      <div class="modal-body">
                        <h3>Are you sure you want to delete your Event Name?</h3>
                        <!-- <h4>This <u> cannot </u> be undone</h4> -->
                        <form action="" method="post" class="form_delete">
                          <ul class="list-inline list-unstyled">
                            <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                            <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id1=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>

                          </ul>
                        </form> 
                      </div>
                    </div>

                  </div>
                </div>


              </figure>
            </div>



            <?php 
          endwhile;
          wp_reset_query();
        }
        else{
          echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> There is no event available. You haven't added any events yet, please click on add event button to start fundraising</span></div>";
        }

        if(isset($_GET['del_id1'])){
          $else_del_id1 = $_GET['del_id1'];
          wp_delete_post($else_del_id1);
      global $wpdb;
      $del = $wpdb->query('DELETE FROM wp_post_relationships where f_id =  "'.$else_del_id1.'"');
          header("location:".site_url()."/user/".$username);
        }

        ?>
    </div>
</div>
</div>
</div>
</div>
<?php
//include('edit_profileimg.php');
get_footer();
?>