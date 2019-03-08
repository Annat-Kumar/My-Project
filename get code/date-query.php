
<?php 
function new_customer_count_since_midnight() {
       global $wpdb;
       $args = array(
      'date_query' => array( 
        array( 'after' => '7 hours ago', 'inclusive' => true )       
			)
		);

$users_count=  count( get_users($args));    
return $users_count;

}



function new_customer_count_last_24() {
	$args = array(
      'date_query' => array( 
        array( 'after' => '24 hours ago', 'inclusive' => true )  
			)
		);
$users_count=  count( get_users($args));    
   return $users_count;
}


function order_count_since_midnight() {
	
	$cur_date = current_time('Y-m-d');
	 
	 $args = array(
    'meta_key'     => 'order_date',
	'meta_value'   => $cur_date,
		);
   
   $users_count=  count( get_users($args));    
   return $users_count;
   
}
function customer_order()
{

	global $wpdb; 
	$table_name = $wpdb->prefix . "usermeta";				 
	//$sql45 = $wpdb->get_results("SELECT * FROM $table_name AS usr, wp_usermeta AS usm WHERE usr.ID = 'usm.user_id' AND (usm.meta_key = 'order' and usm.meta_value != 'delete' and usm.meta_value != 'done') group by usr.ID");	

	$results = $wpdb->get_results("SELECT * FROM $table_name WHERE meta_key = 'order' and meta_value='process'");	
	
	foreach ($results as $val) {
	  $data[] = $val->user_id; 
	}
	if(isset($data))
	{
	 return $data;
	}

}
/* fetch order with table jois*/
function collections_order()
{
   
   global $wpdb; 
	$table_name = $wpdb->prefix . 'users';				 
	$sql = $wpdb->get_results("SELECT * FROM $table_name AS usr, wp_usermeta AS usm WHERE usr.ID = 'usm.user_id' AND (usm.meta_key = 'order' and usm.meta_value = 'done') group by usr.ID");				 	   
	foreach ($sql as $cus) {
		$data[] = $cus;
		 $data++;
	}
	 if(isset($data))
	{
	 return $data;
	}

}

function process_order($status)
{
   
    $args = array(
    'meta_key'     => 'order',
	'meta_value'   => 'process',
		);
$query = count(get_users($args ));
return $query;

}


function process_order1($status){ 

$start_date = date('Y-m-01') ."<br>";
$end_date= date('Y-m-t') ."<br>";
  
$date1 = str_replace('-', '/', $end_date);
$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
   $args = array(
   		
      'meta_query' => array( 
   array( 'relation' => 'AND',  
   array( 'key' => 'order_completed',
   'value' => array($start_date,$tomorrow),
   'compare' => 'BETWEEN'
   ),    
	array('key' => 'order',
	'value' => 'done',
	'compare' => '='
	)
   )
   ));

$users_count=  count( get_users($args));
return $users_count;


}

function mailing_customer()
{
	global $wpdb; 
	$table_name = $wpdb->prefix . 'users';				 
	$sql = $wpdb->get_results('SELECT usr.* FROM $table_name AS usr, wp_usermeta AS usm where usr.ID = "usm.user_id" AND (usm.meta_key = "mailing" and usm.meta_value != "complete") group by usr.ID');
	$cntrow_st= $wpdb->num_rows;
    if($cntrow_st > 0 )
    {
		foreach ($sql as $cus) {
			$data[] = $cus;
		}
		 if(isset($data))
		{
		 return $data;
		}
    }
}
?>