<?php

/* author name auto complete */
jQuery("#search_auth").autocomplete({          

source: function( request, response ) {          

	 jQuery.ajax({

		url : '<?php echo get_bloginfo('template_url');?>/search_author.php',

		dataType: "json",

		type:'post',

	data: {

	   term: request.term

	},

	 success: function( data ) {

	  // response( data );
	   
	  response( jQuery.map( data, function( item ) {               

		return {                  

		  value: item.name
		 
		}

	  }));

	}

	  });

	},
		 
});
	
?>
<?php

jQuery("#job_city").autocomplete({
source: function( request, response ) {
  
	 jQuery.ajax({
		url : '<?php echo get_bloginfo('template_url');?>/search_city.php',
		dataType: "json",
		type:'post',
	data: {
	   //name_startsWith: request.term,
	   term: request.term
	},
	 success: function( data ) {
	  // response( data );
	  
	  response( jQuery.map( data, function( item ) {
	   
		return {
		  
		  value: item.state
		 
		}
	  }));
	}
	  });
	},
	autoFocus: true,
	minLength: 0        
});
	
?>
<?php

/* search_city.php */

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