
<?php
	
	function post_published_notification( $ID, $post ) {
	$media = get_attached_media('text/csv',$ID );
	$m_id = $media[$ID+1]->post_title;
    $author = $post->post_author; /* Post author ID. */
    $name = get_the_author_meta( 'display_name', $author );
    $email = get_the_author_meta( 'user_email', $author );
    $title = $post->post_title;
    $permalink = get_permalink( $ID );
    $edit = get_edit_post_link( $ID, '' );
    $to[] = sprintf( '%s <%s>', $name, $email );
    $subject = sprintf( 'Published: %s', $title );
    $message = sprintf ('Congratulations, %s! Your article “%s” has been published.' . "\n\n", $name, $title );
    $message .= sprintf( 'View: %s', $permalink );
    $message .="<br>".$m_id;
    $headers[] = ''; 
	/*$to = 'sanjay@bytecodetechnologies.in';
	$subject = 'new post has published';
	$message = 'you can see new post published by admin.';*/
   // wp_mail( $to, $subject, $message, $headers );

}
//add_action( 'publish_post', 'post_published_notification', 10, 2 );
add_action( 'publish_post', 'impport_data_csv', 10, 2 );
function impport_data_csv( $ID, $post ) {
		
	global $wpdb;
	
	$author = $post->post_author;		
	$name = get_the_author_meta( 'display_name', $author );
    $email = get_the_author_meta( 'user_email', $author );
    $title = $post->post_title;
    $post_content = $post->post_content;
    $post_date = $post->post_date;
    $permalink = get_permalink( $ID );
    $edit = get_edit_post_link( $ID, '' );
    $to[] = sprintf( '%s <%s>', $name, $email );
    $subject = sprintf( 'Published: %s', $title );
    $message = sprintf ('Congratulations, %s! Your data “%s” has been imported sucessfully.' . "\n\n", $name, $title );
    $message .= sprintf( 'View: %s', $permalink );
  
    $headers[] = ''; 
	$cat = get_the_category($ID);
	$cat_name = $cat[0]->name ;
	if($cat[0]->term_id ==2)
	{	
		$tags = wp_get_post_tags($ID);
		if($tags)
		{
		//preg_match_all('!\d+!', $tags, $matches);
		$datatable = $wpdb->prefix . 'wpdatatables';
		$select_table = $wpdb->get_row("SELECT mysql_table_name FROM $datatable WHERE id = $tags");
		if($select_table){	
		$table_name = $select_table->mysql_table_name ;		
		$date = date("Y.m.d");
		$insert = 	$wpdb->insert( 
			$table_name, 
			array( 
				'id' => $ID, 
				'title' => $title ,
				'content' => $post_content ,
				'categories' => $cat_name,
				'date' => $date, 
			), 
			array( 
				'%s', 
			) 
		);
		if($insert){
				$subject = 'Scraped data published sucessfully';
				$message = sprintf ('Congratulation, %s! Your scraped data “%s” has been published sucessfully.' . "\n\n", $name, $title );
				$headers[] = ''; 
				
				//wp_mail( $to, $subject, $message, $headers );					
				 
			}else{				
				$subject = 'Unable to import scraped data';
				$message = sprintf ('Sorry, %s! Your data “%s” is unable to published right now! Please try again later' . "\n\n", $name, $title );
				$message .= "\n\n".$wpdb->last_error;
				$message .= "id =>".$ID."title =>".$title."cate =>".$cat_name."date =>".$date;
				$headers[] = ''; 
				//wp_mail( $to, $subject, $message, $headers );
			}
		}
		else{
				$subject = 'Unable to import scraped data';
				$message = sprintf ('Sorry, %s! Your data “%s” is unable to published right now! Your table id is not correct' . "\n\n", $name, $title );				
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
		}
		}
		else{
				$subject = 'Unable to import scraped data';
				$message = sprintf ('Sorry, %s! Your data “%s” is unable to published right now! Your table id is not correct' . "\n\n", $name, $title );				
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
		}
			
	}
	else if($cat[0]->term_id ==3)
	{
		
	if(!has_excerpt($ID)){		
		$subject = 'Unable to import CSV data';
		$message = 'Sorry you have not mention table id! Without table name it is unable to import data';
		
		$headers[] = ''; 
		//wp_mail( $to, $subject, $message, $headers );

	}
	else {
	$expcerpt = strip_tags(get_the_excerpt($ID));
	$datatable = $wpdb->prefix . 'wpdatatables';
	$select_table = $wpdb->get_row("SELECT mysql_table_name FROM $datatable WHERE id = $expcerpt");
	if($select_table){	
	$table_name = $select_table->mysql_table_name ;

	$media = get_attached_media('text/csv',$ID );
	$mylink = $wpdb->get_row( "SELECT *  FROM `wp_posts` WHERE `post_parent` = $ID" );
	$guid = $media[$mylink->ID]->guid;
	$site_url = site_url();
	$path = str_replace($site_url,'',$guid);
	$full_url = ABSPATH.$path;
	
	$file = fopen($full_url,"r"); 
		$row=0;
		$count=0;
		while(! feof($file))
		{
			$count++;
			fgetcsv($file);			
		}
		fclose($file);	
		
		if (($handle = fopen($full_url, "r")) !== FALSE) 
		{
		  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
			{
				$row++;
				if($row)
				{
					$result[]=$data;
				}
				
			}
			$key = array();
			$key = $result[0];
			unset($result[0]);
			$new_array = array();
			foreach($result as $results){
				for($i=0;$i <= count($results)-1;$i++){
					
					$new_arrays[str_replace('_','',$key[$i])] = trim($results[$i]);										
				}
				
				$insert = $wpdb->insert($table_name,$new_arrays,array('%s') );	
				
			}
			if($insert){
				
				wp_mail( $to, $subject, $message, $headers );					
				 
			}else{
				//$to = 'sanjay@bytecodetechnologies.in';
				$subject = 'Unable to import CSV data';
				$message = sprintf ('Sorry, %s! Your article “%s” has not published.' . "\n\n", $name, $title );
				//$message .= 'table id is not correct';
				//$message .= "\n\n".$wpdb->last_error;
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
			}				
		}
	  }
	  else {
				$subject = 'Unable to import CSV data';		
				$message = 'table id is not correct';
				//$message .= "\n\n".$wpdb->last_error;
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
	  }
	 }
	}
		
}
?>