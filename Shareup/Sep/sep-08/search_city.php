<?php

require_once('../../../wp-load.php');
global $wpdb;
$term="";
 $term= $_POST['term'];
//$term='Aaron';
$search = array();

$res = $wpdb->get_results("SELECT *  FROM cities where city LIKE '".$term."%' OR city  LIKE '%".$term."%' OR city LIKE '%".$term."' LIMIT 8");

 foreach($res as $key=>$v)
  {
   $state=$v->city;
   $code= $v->state_code;
   $post_t= $state.', '.$code;
   array_push($search,array('state'=>$post_t));
  }
	
    echo json_encode($search);


?>