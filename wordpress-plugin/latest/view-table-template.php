<?php
/**
 * Template Name:databseTable  
 */
get_header(); ?>
<?php 
global $wpdb;
//print_r(get_attached_media(120 ));
//echo "<pre>";
//ini_set('allow_url_fopen',1); 
$id = 2975;
$post_id = 2975;
$post = get_post($post_id);
//echo "<pre>";print_r();die;
//$cat = get_the_category($post_id);
//echo $cat[0]->term_id;die;
 /*  $tags = wp_get_post_tags($id);
  //echo "<pre>";print_r( wp_get_post_tags()) ;die;
	$str = '[wpdatatable id=9]';
preg_match_all('!\d+!', $str, $matches);
//print_r($matches[0][0]);die;

   //echo "<pre>";print_r($tags);die;
   $tag_name = $tags[0]->name ;
   preg_match_all('!\d+!', $tag_name, $matches);
//print_r($matches[0][0]);die;

//echo "<pre>";print_r($post);die;
if(has_excerpt($id)){
		$expcerpt = get_the_excerpt($id);
	}*/
//echo $post->post_excerpt;echo "<br>";
//echo $expcerpt;die;

	$author = $post->post_author;		
	$name = get_the_author_meta( 'display_name', $author );
    $email = get_the_author_meta( 'user_email', $author );
    $title = $post->post_title;
    $post_content = $post->post_content;
    $post_date = $post->post_date;
    $permalink = get_permalink( $id );
    $edit = get_edit_post_link( $id, '' );
	$cat = get_the_category($id);
	$cat_name = $cat[0]->name ;
	
	//echo "<pre>";print_r();die;
	
	$expcerpt = strip_tags(get_the_excerpt($id));

	$datatable = $wpdb->prefix . 'wpdatatables';
	$select_table = $wpdb->get_row("SELECT mysql_table_name FROM $datatable WHERE id = $expcerpt");
	
	if($select_table){	
	$table_name = $select_table->mysql_table_name ;

	$media = get_attached_media('text/csv',$id );
	$mylink = $wpdb->get_row( "SELECT *  FROM `wp_posts` WHERE `post_parent` = $id" );
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
			echo "<pre>";print_r($result);die;
			$key = array();
			$key = $result[0];
			unset($result[0]);
			$new_array = array();
			foreach($result as $results){
				for($i=0;$i <= count($results)-1;$i++){
					
					$new_arrays[str_replace('_','',$key[$i])] = trim($results[$i]);										
				}
				
				//$insert = $wpdb->insert($table_name,$new_arrays,array('%s') );	
				
			}
			echo "<pre>";print_r($new_arrays);die;
			if($insert){
				
				wp_mail( $to, $subject, $message, $headers );					
				 
			}else{
				//$to = 'sanjay@bytecodetechnologies.in';
				$subject = 'Unable to import CSV data';
				$message = sprintf ('Sorry, %s! Your article “%s” has not published.' . "\n\n", $name, $title );
				//$message .= 'table id is not correct';
				$message .= "\n\n".$wpdb->last_error;
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
/***

$table_name = 'wp_wpdatatable_5';
		$date = date("Y.m.d");
		$insert = 	$wpdb->insert( 
			$table_name, 
			array( 
				'id' => $id, 
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
								
				 echo "data inserted sucessfully";
			}else{				
				echo "last error=";$wpdb->last_error;
				
			}*/
die;			
/****/
$media = get_attached_media('text/csv',$id );
//$array = get_object_vars($media);

 
$mylink = $wpdb->get_row( "SELECT *  FROM `wp_posts` WHERE `post_parent` = $id" );
//echo"<pre>";print_r($mylink->ID);die;

//$url = ABSPATH."wp-content/uploads/2018/10/export-post-2018-10-12_10-23-53-17.csv"; 
$guid = $media[$mylink->ID]->guid;
//echo $guid;die;
$site_url = site_url();

$path = str_replace($site_url,'',$guid);
//echo $path;die;
$full_url = ABSPATH.$path;
//echo $full_url;die;

		$file = fopen($full_url,"r"); 
		//print_r(fgetcsv($file));  die; 
		$row=0;
		$count=0;
		while(! feof($file))
		{
			$count++;
			fgetcsv($file);
		
		}
		
			//echo "<pre>";print_r(fgetcsv($file)); echo "<pre>";print_r($resul_t);
			
		fclose($file);	
//die; 

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

			//echo "<pre>";print_r($result);die;
			$key = array();
			$key = $result[0];
			unset($result[0]);
			$new_arrays = array();
			foreach($result as $results){
				for($i=0;$i <= count($results)-1;$i++){
					/* if($key[$i] != 'post_date'){
						$new_arrays[$key[$i]] = trim($results[$i]);
					}	 */		
					$new_arrays[str_replace('_','',$key[$i])] = trim($results[$i]);				
				}
				echo '<pre>';print_r($new_arrays);die;
				//$insert = $wpdb->insert('wp_wpdatatable_8',$new_arrays,array( '%s') );	
				 $insert='success';/**/
				
			}
			if(!$insert){
					 echo '<pre>';print_r($wpdb->last_query);echo '</	pre>';
				} 
				else{
					echo "csv data imported successfully";
				}

		}
		die;
?> 
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			
			<!---- template content here -->
			
			<!--Creates the popup body-->
		
			
			
			<button id="addBtn" value="">+ New</button>
			<button id="myBtn" class="edit_abc" value="">Edit</button>
			<button id="delBtn" class="del_abc" value="">Delete</button>
			
			<div id="myModal" class="edit-table">

			  <!-- Modal content -->
			  <div class="modal-content">
				<span class="close">&times;</span>
				
				<div class="edit-content">
				
					<span>Column 1</span>
					<textarea id="col_one" name="col-one"></textarea>
					<span>coment 1</span>
					<input type="text" id="cmt1" name="cmt1" value="">
					<br/><br/>
					<span>Column 2</span>
					<textarea id="col_two" name="col-two"></textarea>
					<span>coment 2</span>
					<input type="text" id="cmt2" name="cmt2" value="">
					<br/><br/>
					<span>Column 3</span>
					<textarea id="col_three" name="col-three"></textarea>
					<span>coment 3</span>
					<input type="text" id="cmt3" name="cmt3" value="">
					<br/><br/>
					<span>Column 4</span>
					<textarea id="col_four" name="col-four"></textarea>
					<span>coment 4</span>
					<input type="text" id="cmt4" name="cmt4" value="">
					<br/><br/>
					
					<button class="can">Cancel</button>
					<button id="update" class="update">Update</button>
				</div>
				
			  </div>

			</div>

			<!--  delete row -->

			<div id="myModal" class="del-table">

			  <!-- Modal content -->
			  <div class="modal-content">
				<span class="close">&times;</span>
				
				<div class="edit-content">
					Delete Row				
				</div>
				
			  </div>

			</div>
			<!---- template content END -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<style>
/* The Modal (background) */
.edit-table {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
	height: 100% auto;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
.can{	
background-color: #e11818;
}
.update{
background-color: #49b649;
float: right;
}
</style>
<script>
var editor; // use a global for the submit and return data rendering in the examples
 
jQuery(document).ready(function($) {
    editor = new $.fn.dataTable.Editor( {
        "ajax": "http://localhost:5050" + "/users_details",
    "table": "#table_users",
    "idSrc": "_id",
    "fields": [{
            "label": "First Name:",
            "name": "first_name"
        }, {
            "label": "Last Name:",
            "name": "last_name"
        }, {
            "label": "Email:",
            "name": "email"
        }, {
            "label": "Diet Plan:",
            "name": "diet_plan"
        }
    ]
});
 
$('#table_users').DataTable({
    dom: "Bfrtip",
 
    "ajax": {
        "url": "http://localhost:5050" + "/users_details",
        "dataSrc": ""
    },
    columns: [
              {
               data: null, render: function (data, type, row) {
                // Combine the first and last names into a single table field
                return data.first_name + ' ' + data.last_name;
            }},
        //{ data: "email" },
        {
            "data": "email", // can be null or undefined
            "defaultContent": "<i>Not set</i>"
        },
        //{ data: "diet_plan" },
        {
            "data": "diet_plan", // can be null or undefined
            "defaultContent": "<i>Not set</i>"
        }
    ],
    select: true,
    buttons: [
        { extend: "create", editor: editor },
        { extend: "edit", editor: editor },
        { extend: "remove", editor: editor }
    ]
}); 
    } );  /**/
//});
jQuery(document).ready(function($)
{
	var url = window.location.origin;
	var admin_url ="/wordpress-plugin/wp-admin/admin-ajax.php";
	var ajaxUrl = url+admin_url;
			
 
    $('tbody').on( 'click', 'tr', function () {
		
		//var className = $(this).parent().parent().attr('id');
    
		//alert(className);
		var table = $('#table_1').DataTable();
	
		var buttons = table.buttons( ['.edit_table', '.delete_table_entry'] );
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			buttons.disable();
			$('#myBtn').attr('disabled','disabled');
			$('#delBtn').attr('disabled','disabled');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
			buttons.enable();
			$('#myBtn').removeAttr('disabled');
			$('#delBtn').removeAttr('disabled');
        } 
	});
	
	/* add new row */
	$("#addBtn").on("click", function(){
					
		
		col_one = $("#col_one").val('');
		col_two = $("#col_two").val('');
		col_three = $("#col_three").val('');
		col_four = $("#col_four").val('');
		
		cmt1 = $("#cmt1").val('');
		cmt2 = $("#cmt2").val('');
		cmt3 = $("#cmt3").val('');
		cmt4 = $("#cmt4").val('');
		$("#update").removeClass('update-row');
		$("#update").addClass('add-row');
		$("#update").html('Save');
		$('.edit-table').show();
		
	});
		/* END */



	/* insert row */
	
	$("#myModal").on("click",".add-row", function(){
		alert('data being inserted. plz wait.');
		//$('.edit-table').show();
		//alert('kskas');			
	
		col_one = $("#col_one").val();
		col_two = $("#col_two").val();
		col_three = $("#col_three").val();
		col_four = $("#col_four").val();
		
		cmt1 = $("#cmt1").val();
		cmt2 = $("#cmt2").val();
		cmt3 = $("#cmt3").val();
		cmt4 = $("#cmt4").val();
		
		value = [];
		value[0] = col_one;value[1] = cmt1;value[2] = col_two;value[3] = cmt2;value[4] = col_three;value[5] = cmt3;value[6] = col_four;value[7] = cmt4;
		//alert(col_one + col_two + col_three + col_four);
		
		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'insert_row',
					value: value ,
				},         
				beforeSend: function() 
				{
					   //$(".loader").show();                      
				},
				success: function(responseq) 
				{					
					 if(responseq == "success")
					 {
						 alert('data inserted successfully');
						 window.location.reload();
					 }
					 else{
						 alert('unable to insert data! please try later');
					 }
				}
				
				});
		});
		
	/* end */
	$("#myBtn").on("click", function(){
		
		row_id = $("#myBtn").val();
		if(row_id =='')
		{
			alert('please select row');
			event.preventDefault(false);
		}
		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'edit_data',
					row_id : row_id,
				},         
				beforeSend: function() 
				{
					   //$(".loader").show();                      
				},
				success: function(responseq) 
				{					
					// alert('success');
					
					var obj = jQuery.parseJSON(responseq);
					//console.log(obj);
					col_f = obj.col_one;
					col_s = obj.col_two;
					col_t = obj.col_three;
					col_fr = obj.col_four;					
					cmt_f = obj.cmt_one;
					cmt_s = obj.cmt_two;
					cmt_t = obj.cmt_three;
					cmt_fr = obj.cmt_four;
					
					$("#col_one").val(col_f);
					$("#cmt1").val(cmt_f);					
					$("#col_two").val(col_s);
					$("#cmt2").val(cmt_s);					
					$("#col_three").val(col_t);
					$("#cmt3").val(cmt_t);					
					$("#col_four").val(col_fr);
					$("#cmt4").val(cmt_fr);
					
					$("#update").html('Update');
					$("#update").removeClass('add-row');
					$("#update").addClass('update-row');
					$('.edit-table').show();
				}
				
				});
		});
		
	
	/* update row */
	$("#myModal").on("click",".update-row", function(){
				
		row_id = $("#myBtn").val();
		col_one = $("#col_one").val();
		col_two = $("#col_two").val();
		col_three = $("#col_three").val();
		col_four = $("#col_four").val();
		
		cmt1 = $("#cmt1").val();
		cmt2 = $("#cmt2").val();
		cmt3 = $("#cmt3").val();
		cmt4 = $("#cmt4").val();
		
		value = [];
		value[0] = col_one;value[1] = cmt1;value[2] = col_two;value[3] = cmt2;value[4] = col_three;value[5] = cmt3;value[6] = col_four;value[7] = cmt4;
		//alert(col_one + col_two + col_three + col_four);
		
		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'update_table',
					row_id:row_id ,
					value: value ,
				},         
				beforeSend: function() 
				{
					   //$(".loader").show();                      
				},
				success: function(responseq) 
				{					
					 if(responseq == "success")
					 {
						 alert('data updated successfully');
						 window.location.reload();
					 }
					 else{
						 alert('unable to update data! please try later');
					 }
				}
				
				});
		});
		
		/* end */
	$("#delBtn").on("click", function(){
		
		row_id = $("#myBtn").val();

		if(row_id =='')
		{
			alert('please select row');
			event.preventDefault(false);
		}
		if (confirm("Are you sure?")) {
        
			var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'delete_data',
					row_id : row_id,
				},         				
				success: function(responseq) 
				{				
					if(responseq == 'deleted')
					{
						alert('data deleted successfully');
						 //window.location.reload();
					}
					else {
						alert('due to some technical problem unable to delete your data!');
					}
				}
				
			});
		
		}
		return false;	
		
	});
		
	$(".close").on("click", function(){
		//$("#myBtn").val('');
		$('.edit-table').hide();
		$(this).removeClass('selected');
	});
	$(".can").on("click", function(){
		//$("#myBtn").val('');
		$('.edit-table').hide();
		
	});

	
});
</script>
<?php get_footer();  ?>
					
		