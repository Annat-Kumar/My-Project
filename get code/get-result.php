<?php
	
	$userid = $_REQUEST["usrid"];
	$production = $_REQUEST["production"];

	global $wpdb;

	$table_name = $wpdb->prefix . 'production';

	$results = $wpdb->get_var( "SELECT * FROM $table_name WHERE usr_id = $userid");
	
	//$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE usr_id = $userid");

	$cntrow= $wpdb->num_rows;

	if ($cntrow > 0 )
	{
		$wpdb->query($wpdb->prepare("UPDATE $table_name SET notes='$production' WHERE usr_id=$userid"));
	}
	else
	{
		$wpdb->insert( $table_name, array(
		'usr_id' => $userid,
		'notes' => $production,
		'status' => '1'
		) );
	}

print_r($_POST);die;

	/*
	echo "<br>Query executed is ".$wpdb->last_query;
	echo "<br>Query result is ".$wpdb->last_result;
	echo "<br>Error is ".$wpdb->last_error;
	*/
?>
		


 <?php 
        global $current_user;
        get_currentuserinfo();
        $id_donor = $current_user->ID;
        global $wpdb;
        $get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
       //$ccount = count($get_donate_posts);
        $user_type = get_usermeta($id_donor , $meta_key = 'user_type' );
        if ( get_post_status ( $post->ID ) == 'publish' ) 
		{
          if(is_user_logged_in()) 
          { 

            global $wpdb;
            $r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

            foreach ($r_id as $key => $lo_url) 
			{
              $llogo_url = $lo_url->retailer_logo;
              $rtlr_id = $lo_url->r_id;
              $post_author_id = $lo_url->f_auth_id;
              $event_auth_name = $lo_url->f_auth_name;
              $f_post_id = $lo_url->f_id;
              $rrr_author_id = $lo_url->rr_author_id;
              $donnor_id = $lo_url->donor_id ;
            }
		  }
		}
?>

<?php 

$current_users = wp_get_current_user();

$user_roless = $current_users->roles;

if((in_array("administrator", $user_roless)) ||  (in_array("editor", $user_roless)))
{

  $get_value = get_post_meta( get_the_ID(), 'show_post', true ); 
}

		global $current_user;
        get_currentuserinfo();
        $id_donor = $current_user->ID;
        global $wpdb;
        $get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
		
		//$wpdb->query($wpdb->prepare("UPDATE $table_name SET d_call='$dcall', notes='$notes', n_d_call='$ndcall' WHERE usr_id=$userid and status=$i"));
			  
			  $wpdb->update( 
					$table_name, 
					array( 
						'd_call' => $dcall,	
						'notes' => $notes	,
						'n_d_call' => $ndcall	,
					), 
					array( 
					'usr_id' => $userid ,
					'status' => $i 
					) 										
				);
?>
<?php 
$Update = $wpdb->query("UPDATE wp_post_relationships SET status = '$status'");
?>

<tbody>
<?php 
$query    = get_users();	
foreach($query as $user_list) {
?>
<tr>

<td><?php echo $user_list->user_nicename; ?></td>

<td><?php echo get_user_meta($user_list->ID, "phone", true); ?></td>

<td><?php echo $user_list->user_email; ?></td>

<td><?php echo $user_list->user_registered; ?></td>

<td><a href="/customer-report/?usrid=<?php echo $user_list->ID; ?>">Customer Report</a></td>


</tr>


<?php }?>
</tbody>


-----------------------------------------------------------
<?php 
		/**** Insert query ****/

		$wpdb->insert( $table_name, array(
		'usr_id' => $userid,
		'notes' => $production,
		'status' => '1'
		) );
		
		
		/**** Update query ****/
		$wpdb->query($wpdb->prepare("UPDATE $table_name SET notes='$production' WHERE usr_id=$userid"));
		
		$wpdb->update( 
					$table_name, 
					array( 
						'd_call' => $dcall,	
						'notes' => $notes	,
						'n_d_call' => $ndcall	,
					), 
					array( 
					'usr_id' => $userid ,
					'status' => $i 
					) 										
				);
				
		$wpdb->query($wpdb->prepare("UPDATE $table_name SET d_call='$dcall', notes='$notes', n_d_call='$ndcall' WHERE usr_id=$userid and status=$i"));
		
		$Update = $wpdb->query("UPDATE wp_post_relationships SET status = '$status'");
		
		$change_name = $_POST['table_name'];	
		$table_id = $_POST['table_id'];

		$table_name = $wpdb->prefix . 'wpdatatables';
		$update_value = array('title' => $change_name);
		$update =  $wpdb->update( 
			$table_name, 
			$update_value,
			array( 'id' => $table_id ), 
			array( 
				'%s'	
			), 
			array( '%s' ) 
		);


		if($update){
			echo "success";
		}else {
			echo "fail";
		}
		
		$update = $wpdb->query($wpdb->prepare("UPDATE wp_wpdatatable_2 SET newcolumn1 = '$column1_value' , newcolumn2 = '$column2_value',newcolumn3 = '$column3_value',newcolumn4 = '$column4_value' WHERE wp_wpdatatable_2.wdt_ID =".$wdt_id));
		
		/*** fetch result ***/
		
		$results = $wpdb->get_var( "SELECT * FROM $table_name WHERE usr_id = $userid");
		
		$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE usr_id = $userid");

		$cntrow= $wpdb->num_rows;
		
		$get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
		
		$r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

		$results = $wpdb->get_results( "SELECT id FROM $table_name where created_by = {$user_ID} and form_id = {$fid} ORDER BY id DESC");
		
		/*** join query ***/
		$sql = $wpdb->get_results('SELECT usr.* FROM $table_name AS usr, wp_usermeta AS usm where usr.ID = "usm.user_id" AND (usm.meta_key = "mailing" and usm.meta_value != "complete") group by usr.ID');
		
		/*** delete query ****/
		$delete = $wpdb->delete( $table_name, array( 'wdt_ID' => $row_id ) );
		$table_name = $wpdb->prefix . 'wpdatatable_2';
		$delete = $wpdb->delete( $table_name, array( 'wdt_ID' => $row_id ) );
		
?>