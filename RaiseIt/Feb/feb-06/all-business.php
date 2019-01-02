<?php 
/**
* Template Name: All Business
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
		<h2>Your All Business</h2>
	</div>

<div class="tab-pane" id="tab_default_7">


<div class="search_ret loader_serach1">

<div id="search12"> 

 <input id="search_ret_names" name="search_ret_names" class="form-control input-lg" placeholder="Search business name">
 <!-- <input type="button" id="serach_retas" class="btn btn-default" value="Go"> -->
</div>
<div class="loader12">
 <div id="dvLoading1" style="display:none;"></div>
</div>
</div>

<div>
<?php
global $paged3; global $args3;
$paged3 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args3 = null;
$args3 = array( 'post_type' => 'retailer', 'posts_per_page' => 10,'post_status' =>'publish','paged' => $paged3,'author' =>   $user->ID);
$loop3 = new WP_Query( $args3 );
if( $loop3->have_posts()){
while ( $loop3->have_posts() ) : $loop3->the_post();
  ?>
  <div class="col-md-4 col-sm-6 post_list nnew_post">
    <figure>
      <div class="post_border">
        <div class="thumb_image">
          <div class="blanks">
            <?php

            //$feature_image_1 = get_field('feature_image_1',$post->ID);
            $feature_image1 =  get_the_post_thumbnail_url($post->ID);
            ?>


            <?php if($feature_image1){
              echo'<img class="img-responsive innerimages" src="'.$feature_image1.'">';
            }
            else{
              echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
            </div>
          </div>
          <div class="com_div">
            <div class="col-sm-12 col-md-12 post_titl1">

              <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
              echo '<h4 class="title_event">' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>';?>
            </div>
            <div class="col-sm-12 col-md-12 post_titl">
              <?php echo '<p>'; echo wp_trim_words( get_the_content(), '4', '...' );  echo'</p>';?>
              <?php $retailer_id1 = $post->ID; 
              ?>
            </div>
          </div>
        </div>
        <?php 
        if(is_user_logged_in())
        { 
          if($current_user->ID == $user->ID || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
          {

            ?>
            <figcaption>
              <ul class="list-inline list-unstyled hvrbtn">
                <li><a href="<?php echo get_permalink(); ?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo home_url();?>/edit-business-event?ids=<?php the_ID(); ?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_bus<?php echo the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
              </ul>

            </figcaption>

            <?php } } ?>
            <!-- popup for delete -->
            <div class="modal fade" id="myModal33_bus<?php echo the_ID();?>" role="dialog">
              <div class="modal-dialog delete_modal">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Business event!</h4>
                  </div>

                  <div class="modal-body">
                    <h3>Are you sure you want to delete your Business Name? </h3>
                    <!-- <h4>This <u> cannot </u> be undone</h4> -->
                    <form action="" method="post" class="form_delete" id="">
                      <ul class="list-inline list-unstyled">
                        <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                        <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
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
      echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> No business event available</span></div>";
    }
    if(isset($_GET['del_id'])){
      $else_del_id = $_GET['del_id'];
      wp_delete_post($else_del_id);
      global $wpdb;
      $del = $wpdb->query('DELETE FROM wp_post_relationships where r_id =  "'.$else_del_id.'"');

      header("location:".site_url()."/user/".$username);
    }
    ?>
  </div>

  <div id="show_posts"></div>

</div>

 </div>
</div>
</div>
</div>
</div>