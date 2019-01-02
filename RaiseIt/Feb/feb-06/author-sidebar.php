      <?php 
      $user_id = get_query_var( 'author' );
      $cover_image = get_field('banner_user_image', 'user_'.$user_id);
      $profile_image = get_field('profile_user_image', 'user_'.$user_id);



      ?>

      <div class="col-md-2 col-sm-3 col-xs-12 profile_name tabs_profile profile_left">
        <div class="pp_imge">
          <div class="img_profiles">
            <?php if($profile_image) { ?>
            <img class="img-responsive center-block profile-img" src="<?php echo $profile_image['url']; ?>">
            <?php } else {?>
            <img src="<?php echo site_url();?>/wp-content/uploads/2018/01/profile_img.png" class="img-responsive center-block profile-img">

            <?php } ?>
            <?php 
            if(is_user_logged_in())
            { 
             $user_id = get_query_var( 'author' );
             global $current_user;
             $current_user = wp_get_current_user();
             $username   =  $current_user->user_nicename;
             $user_roles = $current_user->roles;
             if($current_user->ID || (in_array("administrator", $current_user->roles)) || (in_array("editor", $current_user->roles)))
             {
              ?>
              <div class="camera">
                <button id="profile_picture" type="button" class="btn btn-info btn-default" data-toggle="modal" data-target="#edit_profile_popup" data-original-title="" title=""><i class="fa fa-camera" aria-hidden="true"></i></button></div>
                <?php  } }  ?>

              </div>

            </div>

            <!-- <button class="btn-default edit_profile">Edit</button> -->

            <ul class="nav nav-tabs tabs-right">
              <?php

              $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $author_page_url = site_url().'/user/'.$username.'/';
              if($actual_link == $author_page_url)
              {
                ?>
                <li <?php if(!is_user_logged_in()){ ?> class="active hide" <?php } else  {?> class="hide" <?php } ?>><a href="#tab_default_1" data-toggle="tab">
                  <span><i class="fa fa-users" aria-hidden="true"></i></span> About Me
                </a></li>
                <?php
              }
              else { ?>
              <li class="hide"><a href="<?php echo site_url();?>/user/<?php echo $username;?>">
                <span><i class="fa fa-users" aria-hidden="true"></i></span> About Me
              </a>
            </li>
            <?Php } ?>

            <li class="dropdownw myevent accordion">
              <a href="#" class="dropdown-togglew" data-toggle="dropdown">
                <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span> My Fundraising Events
              </a>

              <ul class="dropdown-menuw nested_events" style="display: none;">
                <li><a href="<?php echo site_url();?>/create-fundraising-event-page/"><span><i class="fa fa-plus" aria-hidden="true"></i></span>Add Event</a>
                </li>
                <li>
                  <a href="<?php echo site_url();?>/approved-event/" >
                    <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>Approved</a>
                  </li>
                  <?php
                  if($current_user->ID || (in_array("administrator", $current_user->roles)) || (in_array("editor", $current_user->roles)))
                  {
                    ?>
                    <li><a href="<?php echo site_url();?>/pending-event/"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Pending</a>
                    </li>
                    <li><a href="<?php echo site_url();?>/accepts-denies-events/"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Accepts/denies</a>
                    </li>
                    <?Php } ?>
                  </ul>


                  <li class="dropdownw myevents accordion">
                    <a href="#" class="dropdown-togglew new-link" data-toggle="dropdown">
                      <span><i class="fa fa-briefcase" aria-hidden="true"></i></span> My Business
                    </a>
                    <ul class="dropdown-menuw nested_events" style="display: none;">
                      <li><a href="<?php site_url();?>/create-fundraising-host-page"><span><i class="fa fa-plus" aria-hidden="true"></i></span>Add Business</a>
                      </li>
                      <li class="all_business">
                        <a href="<?php echo site_url();?>/all-business/"><span><i class="fa fa-briefcase" aria-hidden="true"></i></span>All Businesses </a>
                      </li>
                      <?Php
                      if($current_user->ID || (in_array("administrator", $current_user->roles)) || (in_array("editor", $current_user->roles)))
                       { ?>
                        <li class="apd_disapd"><a class="bus_tab2" href="<?php echo site_url();?>/approve-disapprove-events/" ><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Approve/Disapprove <br> Events</a>
                        </li>
                        <li class="apd_disapd"><a class="bus_tab2" href="<?php echo site_url();?>/total-donation/"><span><i class="fa fa-tags" aria-hidden="true"></i></span>Total Donation</a>
                        </li>
                        <?php } ?>
                      </ul>
                    </li>

                    <?php
                    if($current_user->ID|| (in_array("administrator", $current_user->roles)) || (in_array("editor", $current_user->roles)))
                    {

                      ?>

                      <li class="hide">
                        <a href="<?php echo site_url();?>/search-business/">
                          <span><i class="fa fa-search" aria-hidden="true"></i></span>Search Businesses
                        </a>
                      </li>
                      <?php } ?>
                      <?php
                      if($current_user->ID || (in_array("administrator", $current_user->roles)) || (in_array("editor", $current_user->roles)))
                      {

                        ?>


                        <li class="hide">
                          <a href="<?php echo site_url();?>/donation-history/">
                            <span><i class="fa fa-history" aria-hidden="true"></i></span>Donation History
                          </a>
                        </li>

                        <li class="hide accordion">
                          <a href="#" class="dropdown-togglew" data-toggle="dropdownw">
                            <span><i class="fa fa-cog" aria-hidden="true"></i></span> Account Settings 
                          </a>
                          <ul class="dropdown-menuw nested_events" style="display: none;">
                            <li class="hide">
                              <a type="button" class="btn  edit_info" data-toggle="modal" data-target="#edit_info_popup">
                                <span><i class="fa fa-pencil" aria-hidden="true"></i></span> Edit info 
                              </a>
                            </li> 
                            <li class="hide">
                              <a type="button" class="btn  edit_infos" data-toggle="modal" data-target="#change_password_popup">
                                <span><i class="fa fa-unlock" aria-hidden="true"></i></span> Change password 
                              </a>
                            </li>
                            <li class="hide">
                              <a type="button" class="btn  edit_infos" data-toggle="modal" data-target="#add_wepay_popup">
                                <span><i class="fa fa-plus" aria-hidden="true"></i></span> Add Wepay Info 
                              </a>
                            </li>

                            <?php } ?>       
                          </ul>  
                        </li>
                      </ul>
                    </div>

                    <?php 

/*            }
            else
            {
              header("location:".site_url());
            }
*/


            include_once('edit_profileimg.php');

            //include_once('edit_info.php');

            include_once('change_pass.php')

      //include_once('add_wepay.php');

            ?>