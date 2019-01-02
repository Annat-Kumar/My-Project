<?php 
/**
* Template Name: Author Pending Event
*
* Login Page Template.
*
* @author Ahmad Awais
* @since 1.0.0
*/
get_header(); 

$user = wp_get_current_user();
$user_id =  $user->ID;
$username =  $user->user_nicename;
?>

<div class="container">
<div class="row">
<div class="div_box">
<div class="second_divbox">
<?php include('author-sidebar.php'); ?>
<div class="col-md-10 col-sm-9 col-xs-12">

<div class="info_about">
<h2>Your Pending Events</h2>
</div>

      <div>

        <!-- ============================ --> 
        <div id="panding_acco" class="main">
          <div class="accordions">
            <div class="accordion-section">
              <a class="accordion-section-title" href="#accordion-1">Your Pending Events</a>
              <div id="accordion-1" class="accordion-section-content">
                <div class="border_acc1">

                  <?php 
                  global $paged2; global $args2;
                  $paged2 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                  $args2 = null;


                  $args2 = array( 'post_type' => 'fundraiser', 'posts_per_page' => 10,'post_status' =>'draft','paged' => $paged,'author' => $user->ID);

                  $loop2 = new WP_Query($args2);
                  if( $loop2->have_posts()){

                    while ( $loop2->have_posts() ) : $loop2->the_post();
                      ?>

                      <?php
                      $pending_ids = get_the_ID();

                      $new_query2 = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $pending_ids");
                      foreach ($new_query2 as $key => $new_qry2)
                      {
                       $rr_id2 = $new_qry2->r_id;
                       $post_slug2 = get_post_field( 'post_name', $rr_id2 );
                     }



                      $check_stats = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id = $rr_id2 AND f_id=$pending_ids");
                      ?>


                      <div class="col-md-4 col-sm-6 post_list pending_list">
                        <figure>
                          <div class="post_border">
                            <div class="thumb_image">
                              <div class="blanks">

                                <?php 

                                $pending_ids = get_the_ID();

                    // $pending_img  = get_field('feature_image_1',$pending_ids);
                                $prnding_url1 = get_the_post_thumbnail_url($pending_ids); 


                                if($prnding_url1){
                                  echo'<img class="img-responsive innerimages" src="'.$prnding_url1.'">';
                                }
                                else{
                                  echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                                </div>
                              </div>
                              <div class="com_div">
                                <div class="col-sm-12 col-md-12 post_titl1">
                                  <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                                  echo '<h4 class="title_event">' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>'; ?>
                                </div>
                                <div class="col-sm-12 col-md-12 post_titl">
                                  <?php echo '<p>'; echo wp_trim_words( get_the_content(), '3', '...' );  echo'</p>';?>
                                  <p class="hvrnone"><span>Status:</span> Pending <p/>
                                  </div>
                                </div>

                              </div>

                              <?php 
                              if(is_user_logged_in())
                              { 
                               if($current_user->ID == $user->ID || (in_array("administrator", $user->roles)) || (in_array("editor", $user->roles)))
                               {
                                ?>
                                <figcaption>
                                  <ul class="list-inline list-unstyled hvrbtn">
                                    <li><a href="<?php echo home_url();?>/fundraiser/?p=<?php echo the_ID();?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo the_ID();?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_pend<?php the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                  </ul>
                                </figcaption>


                                <?php 
                              }
                            }
                            ?>
                            <!-- popup for delete -->
                            <div class="modal fade" id="myModal33_pend<?php the_ID();?>" role="dialog">
                              <div class="modal-dialog delete_modal">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">    
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete pending event!</h4>
                                  </div>

                                  <div class="modal-body">
                                    <h3>Are you sure you want to delete your pending event? </h3>
                                    <!-- <h4>This <u> cannot </u> be undone</h4> -->
                                    <form action="" method="post" class="form_delete" id="del<?php the_ID();?>">
                                      <ul class="list-inline list-unstyled">
                                        <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                                        <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id111=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
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
                    else
                    {
                      echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> No event available </span></div>";
                    }

                    if(isset($_GET['del_id111']))
                    {

                      $else_del_id2 = $_GET['del_id111'];
                      wp_delete_post($else_del_id2);
      global $wpdb;
      $del = $wpdb->query('DELETE FROM wp_post_relationships where f_id ="'.$else_del_id2.'"');
                      header("location:".site_url()."/user/".$username);
                    }

                   ?>


                  </div>

                </div><!--end .accordion-section-content-->
              </div><!--end .accordion-section-->

              <div class="accordion-section">
                <a class="accordion-section-title" href="#accordion-2">Your Requested Events</a>
                <div id="accordion-2" class="accordion-section-content">
                  <div class="border_acc">

                    <?php

                    global $res_paged; global $res_args;
                    $res_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $res_args  = null;
                    $res_args  = array( 'post_type' => 'fundraiser', 'posts_per_page' => -1,'post_status' =>'none','paged' => $paged,'author' =>  $user->ID);
                    $res_loop = new WP_Query($res_args);
                    if( $res_loop->have_posts()){
                     while ( $res_loop->have_posts() ) : $res_loop->the_post();
                      ?>

                      <?php

                      $fundraiser_id2 = $post->ID;

                      global $wpdb;
                      $new_query2 = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $fundraiser_id2");
                      foreach ($new_query2 as $key => $new_qry2)
                      {
                       $rr_id2 = $new_qry2->r_id;
                       $post_slug2 = get_post_field( 'post_name', $rr_id2 );


                     }

                     $test_qery2 = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id=$rr_id2 AND f_id=$fundraiser_id2");
                     foreach ($test_qery2 as $key => $new_qq22)
                     {
                      $test_qery22 = $new_qq22->r_name;

                      $post_slugslice = stripslashes(stripslashes(stripslashes($test_qery22)));
                      $post_slugsnew = str_replace('\"', '', $post_slugslice);
                      $test_qery2211 = $new_qq22->status;
                      ?>

                      <?php
                      if($test_qery2211 == 'none' || $test_qery2211== '0'){



    //$res_image = get_field('feature_image_1',$fundraiser_id2);
                        $res_imageurl =  get_the_post_thumbnail_url($fundraiser_id2);

                        ?>
                        <div class="col-md-4 col-sm-6 post_list pending_list">
                          <figure>
                            <div class="post_border">
                              <div class="thumb_image">
                                <div class="blanks">
                                  <?php if($res_imageurl){
                                    echo'<img class="img-responsive innerimages" src="'.$res_imageurl.'">';
                                  }
                                  else{
                                    echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                                  </div>
                                </div>

                                <div class="com_div">
                                  <div class="col-sm-12 col-md-12 post_titl1">
                                    <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                                    echo '<h4 class="title_event">' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>'; ?>
                                  </div>

                                  <div class="col-sm-12 col-md-12 post_titl">
                                    <?php echo '<p>'; echo wp_trim_words( get_the_content(), '5', '...' );  echo'</p>';?>
                                    <p class="hvrnone"><span>Requested To:</span>  <a href="<?php site_url()?>/retailer/<?php echo $post_slug2;?>"><?php echo wp_trim_words($post_slugsnew, '3', '...');?></a></p>

                                  </div>
                                </div>
                              </div>



                              <?php 
                              if(is_user_logged_in())
                              { 
                               if($current_user->ID == $user->ID || (in_array("administrator", $user->roles)) || (in_array("editor", $user->roles)))
                               {

                                ?>

                                <figcaption>
                                  <ul class="list-inline list-unstyled hvrbtn">
                                    <li><a href="<?php echo home_url();?>/fundraiser/?p=<?php echo the_ID();?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                    <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo the_ID();?>" data-toggle="tooltip2" title="Edit!" ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_req<?php the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                  </ul>

                                </figcaption>
                                <?php 
                              }
                            }
                            ?>

                            <!-- popup for delete -->
                            <div class="modal fade" id="myModal33_req<?php the_ID();?>" role="dialog">
                              <div class="modal-dialog delete_modal">

                                <!-- Modal content-->
                                <div class="modal-content">

                                  <div class="modal-header">    
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete requested event!</h4>
                                  </div>


                                  <div class="modal-body">
                                    <h3>Are you sure you want to delete your requested event?</h3>
                                    <!-- <h4>This <u> cannot </u> be undone</h4> -->
                                    <form action="" method="post" class="form_delete" id="del<?php the_ID();?>">
                                      <ul class="list-inline list-unstyled">
                                        <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                                        <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_idres=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
                                      </ul>
                                    </form> 
                                  </div>


                                </div>

                              </div>
                            </div>  



                          </figure>
                        </div>
                        <?Php }?>

                        <?php
                      }
                    endwhile;
                    wp_reset_query();
                  }
                  if(isset($_GET['del_idres']))
                  {
                    $else_del_res = $_GET['del_idres'];
                    wp_delete_post($else_del_res);
      global $wpdb;
      $del = $wpdb->query('DELETE FROM wp_post_relationships where f_id =  "'.$else_del_res.'"');
                    header("location:".site_url()."/user/".$username);
                  }
                  ?>


                </div>
              </div><!--end .accordion-section-content-->
            </div><!--end .accordion-section-->

            <div class="accordion-section">
              <a class="accordion-section-title" href="#accordion-3">Your Disapproved Events</a>
              <div id="accordion-3" class="accordion-section-content">
                <div class="border_acc">
                  <?php
                  $res_args  = array( 'post_type' => 'fundraiser', 'posts_per_page' => -1,'post_status' =>'none','author' => $user->ID);
                  $res_loop = new WP_Query($res_args);
                  if( $res_loop->have_posts()){
                    while ( $res_loop->have_posts() ) : $res_loop->the_post();
                      $fundraiser_id22 = $post->ID;

                      $new_query_dis = $wpdb->get_results("SELECT * FROM wp_post_relationships where status = 2 AND f_id = $fundraiser_id22");
                      $count = count($new_query_dis);

                      foreach ($new_query_dis as $key => $dis_status)
                      {

                        $dis_post_fund_id = $dis_status->f_id;
                        $dis_post_name    = $dis_status->f_name;
                        $post_slug = get_post_field( 'post_name', $dis_post_fund_id );
                        $dis_f_img_url =  get_the_post_thumbnail_url($dis_post_fund_id);
                        ?>
                        <div class="col-md-4 col-sm-6 post_list pending_list">
                          <figure>

                            <div class="post_border">
                              <div class="thumb_image">
                                <div class="blanks">
                                  <?php if($dis_f_img_url){
                                    echo'<img class="img-responsive innerimages" src="'.$dis_f_img_url.'">';
                                  }
                                  else{
                                    echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                                  </div>
                                </div>
                                <div class="com_div">

                                  <div class="col-sm-12 col-md-12 post_titl1">
                                    <?php $trimtitle = $dis_post_name; $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                                    echo '<h4 class="title_event"><a href ="'.site_url().'/?post_type=fundraiser&p='.$dis_post_fund_id.'&preview=true">'.$shorttitle.'</a><h4>';


                                    ?>
                                  </div>
                                  <div class="col-sm-12 col-md-12 post_titl">
                                    <?php echo '<p>'; echo wp_trim_words( get_the_content(), '3', '...' );  echo'</p>';?>
                                  </div>
                                </div>
                              </div>

                              <?php 
                              if(is_user_logged_in())
                              { 
                                if($current_user->ID == $user->ID)
                                {

                                  ?>
                                  <figcaption>
                                    <ul class="list-inline list-unstyled hvrbtn">
                                      <li><a href="<?php echo home_url();?>/fundraiser/?p=<?php echo the_ID();?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                      <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo $dis_post_fund_id;?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                      <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_dis<?php echo $dis_post_fund_id;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                    </ul> 

                                  </figcaption>

                                  <!-- popup for delete -->
                                  <div class="modal fade" id="myModal33_dis<?php echo $dis_post_fund_id;;?>" role="dialog">
                                    <div class="modal-dialog delete_modal">

                                      <!-- Modal content-->
                                      <div class="modal-content">



                                       <div class="modal-header">                           

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Delete Disapproved event!</h4>
                                      </div>

                                      <div class="modal-body">
                                        <h3>Are you sure you want to delete your disapproved event?</h3>
                                        <!-- <h4>This <u> cannot </u> be undone</h4> -->
                                        <form action="" method="post" class="form_delete" id="del<?php the_ID();?>">
                                          <ul class="list-inline list-unstyled">
                                            <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                                            <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id_dis=<?php echo $dis_post_fund_id;?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
                                          </ul>
                                        </form> 
                                      </div>


                                    </div>

                                  </div>
                                </div> 


                                <?php 

                              } } 

                              if(isset($_GET['del_id_dis']))
                              {

                                $else_del_id2 = $_GET['del_id_dis'];
                                wp_delete_post($else_del_id2);
      global $wpdb;
      $del = $wpdb->query('DELETE FROM wp_post_relationships where f_id =  "'.$else_del_id2.'"');
                                header("location:".site_url()."/user/".$username);
                              }



                              ?>


                            </figure>
                          </div>

                          <?php 
                        } 

                      endwhile;
                    }


                    else{
                      echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> No disapproved event!</span></div>";
                    }
                    ?>

                  </div>
                </div><!--end .accordion-section-content-->
              </div><!--end .accordion-section-->
            </div><!--end .accordion-->      
          </div>
</div>


<!-- =============End accordion=============== -->





</div>
</div>
</div>
</div>
</div>

<?php
get_footer();
?>