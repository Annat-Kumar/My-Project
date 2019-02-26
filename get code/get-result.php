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
		}else{
		$wpdb->insert( $table_name, array(
		'usr_id' => $userid,
		'notes' => $production,
		'status' => '1'
		) );
		}

print_r($_POST);die;

/* echo "<br>Query executed is ".$wpdb->last_query;
		echo "<br>Query result is ".$wpdb->last_result;
		echo "<br>Error is ".$wpdb->last_error; */
		?>
		


 <?php 
        global $current_user;
        get_currentuserinfo();
        $id_donor = $current_user->ID;
        global $wpdb;
        $get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
       //$ccount = count($get_donate_posts);
        $user_type = get_usermeta($id_donor , $meta_key = 'user_type' );
        if ( get_post_status ( $post->ID ) == 'publish' ) {
          if(is_user_logged_in()) 
          { 

            global $wpdb;
            $r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

            foreach ($r_id as $key => $lo_url) {
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
?>
<?php 
$Update = $wpdb->query("UPDATE wp_post_relationships SET status = '$status'");
?>