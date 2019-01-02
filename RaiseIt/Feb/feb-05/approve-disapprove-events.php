<!-- approved disapproved events start-->

<div class="tab-pane" id="tab_default_12">
<div class="info_about">

<h2>Approve/Disapprove Events</h2>
</div>

<div class="col-sm-12 col-md-12 approved_disapproved">
<div class="panel-group" id="accordion">
  <h4> All Your Business Events List</h4>
  <div class="panel-heading main">
   <!-- <span class="event-id">Event ID</span> --> <span class="event-name">Business Location Name</span>
 </div>
 <?php
/******************** Event Approved functionality*****************************/







/******************** Event Disapproval functionality*****************************/

if(isset($_POST['submit_disap_event']) && !empty($_POST['submit_disap_event']))
{

 // $s_date = $_POST['s_date'];
  $s_time = $_POST['s_time'];

  $f_s_dates = date_create($_POST['s_date']);

  $s_date = date_format($f_s_dates,"Y/m/d");

  $f_e_dates = date_create($_POST['e_date']);

  $e_date = date_format($f_e_dates,"Y/m/d");


  //$e_date = $_POST['e_date'];
  $e_time = $_POST['e_time'];
  $email  = $_POST['email'];
  $e_id   = $_POST['e_id'];
  $r_id   = $_POST['r_id'];
  $e_title = $_POST['e_title'];
  $f_auth_name = $_POST['f_auth_name'];
  $f_comment = $_POST['comment'];

  $status = '0';
  $admin_email = get_option( 'admin_email' );

      //Send Email For Event Disaaproval

  global $wpdb;
  $Update = $wpdb->query("UPDATE wp_post_relationships SET status = '$status' WHERE r_id = '$r_id' AND f_id = '$e_id' ");

  $status="draft";
  $post_update = array( 'ID' => $e_id, 'post_status' => $status );
  wp_update_post($post_update); 

        // write the email content for fundraiser
  @$header .= "MIME-Version: 1.0\n";
  $header .= "Content-Type: text/html; charset=utf-8\n";
  @$headers .= "From:" . $admin_email;

  $message1 .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
  <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$f_auth_name) . 
  "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
  $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 25px;">Your request for '.$e_title.'  has been disapproved by retailer.','piereg</div>') . "</div>";

  $message1 .= __('<p style="padding: 0px 0;font-size: 18px;line-height: 30px;">No problem, you can still make a request to host your event with this retailer event by providing the new availability date and timing of your event.</p> <p style="padding: 0px 0;font-size: 18px;line-height: 30px;">Please check the new available date and time of the requested retailer event as below.</p>');

  $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">Start Date :-'.$s_date,'piereg</div>') . "</div>";

  $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">Expire Date:-'.$s_time,'piereg</div>') . "</div>";  

  $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">End time:-'.$e_date,'piereg</div>') . "</div>";

  $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">End time:-'.$e_time,'piereg</div>') . "</div>"; 

  $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">Message:-'.$f_comment,'piereg</div>') . "</div>"; 


  $message1 .='</div><div style=color: #999;padding: 50px 30px">
  <div style="">Regards,</div>
  <div style="">Raise It Team</div>            
  </div></body></html>';

  $subject = "Event Disapproval Notification";
  $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";

      // send the email to fundraiser
  $email1=wp_mail($email, $subject, $message1, $header);

  header("location:".site_url()."/user");



}

global $wp_query;
global $current_user;

      //get_currentuserinfo(); 

$user = wp_get_current_user();

$cc_user_email = $user->user_email;

$args = array( 'author' => $user->ID,'post_type' => 'retailer', 'posts_per_page' => -1,'post_status' =>'publish');

$query = new WP_Query( $args);

if($query->have_posts())
{
  $i=1;
  $post = get_the_ID(); 

  while ($query->have_posts()) : $query->the_post(); 
    ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">

          <!-- <span class="event_id"> <?php //the_id(); ?> </span> --> 
          <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ;?>" title="Click to see list of requested fundraiser events for this retailer."><?php the_title();?></a>

        </h4>
      </div>

      <div id="collapse<?php echo $i ;?>" class="panel-collapse collapse chcek_collapse">

        <?php

        global $wpdb;
        $count_data =$wpdb->get_results("SELECT *
          FROM wp_post_relationships as post
          JOIN wp_postmeta as meta
          on post.f_id = meta.post_id
          where meta_key = 'event_expire_date' and  r_id =".get_the_ID()."");
        $counnt = count($count_data);
        if($counnt == 0)
        {
          echo "<p>No request available</p>";
        }
        else{
          ?>

          <table class="widefat table table-bordered show_fnd">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>Fundraiser Name</th>
                <th>Event Name</th>                        
                <th>Event Start Date And Time</th>                        
                <th>Event End  Date  And Time </th>                                               
                <th>Approve/Disapprove</th>
                <th>Status</th>
                <th>Save</th>
              </tr>
            </thead>
            <tbody>                   

              <?php 
              global $wpdb;
              $data =$wpdb->get_results("SELECT *
                FROM wp_post_relationships as post
                JOIN wp_postmeta as meta
                on post.f_id = meta.post_id
                where meta_key = 'event_expire_date' and  r_id =".get_the_ID()."");

             // print_r($data);
             // echo $count = count($data);
              
              foreach($data as $nData)
              {
                $f_id      = $nData->f_id;
                $f_name    = $nData->f_name;
                $f_auth_id = $nData->f_auth_id;
                $statusN    = $nData->status;
                $f_auth_name = $nData->f_auth_name;
                $f_auth_email = $nData->f_auth_email;
                $f_date       = $nData->f_date;
                $f_stime = $nData->f_start_time;
                $f_etime = $nData->f_end_time;
              // $my_date = $f_date;
                $end_date = $nData->meta_value;
                
                ?>              

                <form method="post" action="#" class="approve_disapprove"> 

                  <tr>
                   <!-- <td><?php echo $f_id; ?></td> -->

                   <td><?php echo $f_auth_name; ?></td>

                   <td><?php echo $f_name; ?></td>

                   <td><?php echo  date(' jS F , Y', strtotime($f_date)); ?>                   
                     <?php echo date("g:i A", strtotime($f_stime)); ?></td>

                     <td><?php echo date(' jS F , Y', strtotime($end_date)); ?>                   
                       <?php echo date("g:i A", strtotime($f_etime)); ?></td>


                       <td>

                        <label class="radio-inline">
                          <input type="radio" name="status" value="approve" <?php if($statusN == 3 || $statusN == 1) echo 'checked ="checked"'; ?> data-rid_new="<?php echo get_the_ID(); ?>" data-f_id_new="<?php echo $f_id;?>" data-f_email_new="<?php echo $f_auth_email;?>" data-f_title_new="<?php echo $f_name; ?>" f_auth_name_new="<?php echo $f_auth_name;?>"> Approve</label>

                          <label class="radio-inline">
                            <input type="radio" name="status" value="disapp" <?php if($statusN == 2) echo 'checked ="checked"'; ?> data-rid_new2="<?php echo get_the_ID(); ?>" data-f_id_new="<?php echo $f_id;?>" data-f_email_new="<?php echo $f_auth_email;?>" data-f_title_new="<?php echo $f_name; ?>" f_auth_name_new="<?php echo $f_auth_name;?>">Disapprove</label>

                            <label class="radio-inline">
                              <input type="radio" name="status" value="disapprove" 
                              <?php if($statusN == 'none')
                              {

                              }elseif($statusN == 0)
                              {
                                echo 'checked ="checked"';
                              }
                              ?> data-title="<?php echo $f_name; ?>" data-fauthname="<?php echo $f_auth_name; ?>" data-email="<?php echo $f_auth_email; ?>" data-id="<?php echo $f_id; ?>" data-rid="<?php echo get_the_ID(); ?>">Change Time</label>

                            </td>
                            <td>
                             <?php 
                             if($statusN == 'none'){
                               echo '<span style="color:red">Pending</span>';

                             }else{
                               if($statusN == 3)
                               {
                                 echo '<span style="color:green">Waiting for approval</span>';
                               }elseif($statusN == 1) {
                                 echo '<span style="color:red">Approved</span>';
                               }
                               elseif($statusN == 0) {
                                 echo '<span style="color:red">Change Time Requested</span>';
                               }elseif($statusN == 2)                   {
                                 echo '<span style="color:#333">Disapproved</span>';
                               }elseif($statusN == 'none')                   {
                                 echo '<span style="color:#333">Pending</span>';
                               }
                             }
                             ?>
                           </td>
                           <td>
                             <input class="r_id_new" type="hidden" name="r_id" value="<?php echo get_the_ID(); ?>">
                             <input class="f_id_new" type="hidden" name="f_id" value="<?php echo $f_id; ?>">
                             <input class="f_email_new" type="hidden" name="f_email" value="<?php echo $f_auth_email; ?>">
                             <input class="f_title_new" type="hidden" name="f_title" value="<?php echo $f_name; ?>">
                             <input class="f_auth_name_new" type="hidden" name="f_auth_name" value="<?php echo $f_auth_name; ?>">
                             <input type="submit" value="Save" name="submit" class="approve_disapprove" <?php if($statusN == 3) { echo 'disabled = "disabled"' ;?> style="background-color: #b2c3a9;" <?php } ?>>
                             <!-- <span class="save_button"><i class="fa fa-floppy-o" aria-hidden="true"></i></span> -->

                           </td>
                         </tr>
                       </form>


                       <?php }?> 

                     </tbody>
                   </table>
                   <?php } ?>
                 </div>
               </div>

               <?php   
               $i++;
             endwhile;
             wp_reset_query();

           }else{
            echo "<div class='no_event alert alert-warning'>";
            echo '<tr>';
            echo '<td class="alert alert-warning">No event created!</td>';
            echo '</tr>';
            echo "</div>";
          } 
          ?>  

          <input id="rid_new" type="hidden"  value="">
          <input id="f_id_new" type="hidden"  value="">
          <input id="f_email_new" type="hidden"  value="">
          <input id="f_title_new" type="hidden"  value="">
          <input id="f_auth_name_new" type="hidden"  value="">
          
          <input id="divid" type="hidden"  value="">
          <input id="app_disapp_val" type="hidden"  value="">


        </table>        
      </div> <!-- Div-- accordion-->
    </div> <!--- Div--container-->
