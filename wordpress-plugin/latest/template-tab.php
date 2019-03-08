<?php 
/* Template Name: tabbing */

if ( isset($_GET['del_id']) ) {
	$table_id = $_GET['del_id']; 
	$table = 'wp_wpdatatables';
	$qry = $wpdb->delete( $table, array( 'id' => $table_id ) );
	if ( $qry ) {
		//echo 'Table Deleted';
		header('Location: '.site_url('/tabs/').' ');
	} else{
		echo 'Error deleting table';
	}

} 

get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<button id="addBtn" value="">+ New</button>
			<button id="myBtn" value="">Edit</button>
			<button id="delBtn" value="">Delete</button>
			<?php
			global $wpdb;
			$getwpdatatables = $wpdb->get_results("SELECT * FROM wp_wpdatatables");
		//echo "<pre>";
		//print_r($getwpdatatables);die;
			$idcount =  count($getwpdatatables);
			echo "<div class='container'><div class='row'>";
			if($idcount != 0)
			{
				foreach($getwpdatatables as $data_id)
				{
					?>
					<div id="shortcode<?php echo $data_id->id; ?>" class="tabcontent">
						<?php echo do_shortcode('[wpdatatable id="'.$data_id->id.'"]') ?>
					</div>
					<?php } 
					echo "<div class='all_tab_button'>";
					$count = 1;
					foreach($getwpdatatables as $data_id)
						{ ?>
							<div class="btn-row">
								<button class="tablink" onclick="openPage('shortcode<?php echo $data_id->id; ?>', <?php echo $data_id->id; ?>)"><?php echo $data_id->title; ?></button>
								<?php if (is_user_logged_in()) { ?>
								<a class="delete-btn" data-toggle="modal" data-target="#myModal<?php echo $data_id->id; ?>"><img src="http://bytecodetechnologies.co.in/wordpress-plugin/wp-content/uploads/2018/11/delete.png"/></a>
								<?php } ?>

								<button style="display:none" class="update-btn" id="<?php echo $data_id->id;?>" data-attr="<?php echo $data_id->title?>">Change table name</button>
								 
							</div>

							<!-- modal start here -->
							
							<!-- Modal -->
							<?php if (is_user_logged_in()) { ?>
							  <div class="modal fade del-modal" id="myModal<?php echo $data_id->id; ?>" role="dialog">
							    <div class="modal-dialog modal-dialog-centered">
							    
							      <!-- Modal content-->
							      <div class="modal-content">
							        <div class="modal-header">
							          <button type="button" class="close" data-dismiss="modal">&times;</button>
							          <h2 class="modal-title">Delete Table</h2>
							        </div>
							        <div class="modal-body">
							          <p>Are you sure you want to delete this table?</p>
							        </div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							          <a class="btn btn-default delete-btn-new" href="<?php echo site_url()?>/tabs?del_id=<?php echo $data_id->id; ?>">Delete</a>
							        </div>
							      </div>
							      
							    </div>
							  </div>
							<?php } ?>
							<!-- modal ends here -->

							<?php $count++; ?><?php }echo "</div>"; } else { ?>
							<h1>You dont have any data</h1> 
							<?php } ?>
							<input type="hidden" value="" id="get_id">
						</div></div>


						<!-- delete table query -->


		<!---add edit row --->
			
			
			<div id="myModal" class="edit-table">

				<!-- Modal content -->
				<div class="modal-content">
					<span class="close">&times;</span>
					<div class="edit-content">
						<div class="append-html"></div>
						<button class="can">Cancel</button>
						<button id="update" class="update">Update</button>
					</div>
				</div>

			</div>
		<!--- End --->
		<!---add edit row --->
			
			
			<div id="editModel" class="edit-table-name">

				<!-- Modal content -->
				<div class="modal-content">
					<span class="close">&times;</span>
					<div class="edit-name-content">	
						<h1>Change Your table name</h1>
						<div class="tab-content">
							<span class="">Table name </span>	
							<input type="text" value="" id="table_name" name="table_name">
							<input type="hidden" value="" name="table_id" id="table_id">
						</div>
						<button class="can">Cancel</button>
						<button id="update_tab" class="update update-tab">Update</button>
					</div>
				</div>

			</div> 
		<!--- End --->

</main>
</div>
</div>

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
.edit-table-name {
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

.modal-backdrop {
    z-index: 999 !important;
}
.modal-dialog {
    margin-top: 50px;
}
.update-btn {
color: rgb(51, 51, 51);
background: rgb(255, 255, 255) none repeat scroll 0% 0%;
}
.btn-row:hover .update-btn {
    display: block !important;
    position: absolute;
}
.btn-row {
    display: inline-block;
    position: relative;
}
.tab-content {margin-bottom: 5%;} 
</style>

<script>
(function($) {
$('.all_tab_button .tablink:first').attr('id', 'defaultOpen');
$('.show_popup').click(function()
{
$('#myModal').modal({ show: true})
});
})( jQuery );
</script>
<script>
function openPage(pageName,elmnt) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    document.getElementById("get_id").value = elmnt;
   // elmnt.style.backgroundColor = color;

}
function changeTabname(){
	alert('you can change tabe name');
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


$(".btn-row").on("click" ,".update-btn", function(){
	var id = this.id;
	//table = this.data-attr;
	table_name =  $(this).attr("data-attr");
	$("#table_name").val(table_name);	
	$("#table_id").val(id);	
	$('.edit-table-name').show();
});
		
</script>

<script>
jQuery(document).ready(function($)
{
	var url = window.location.origin;
	var admin_url ="/wordpress-plugin/wp-admin/admin-ajax.php";
	var ajaxUrl = url+admin_url;
		
		/* row select*/
 
    $('tbody').on( 'click', 'tr', function () {
		
		var table_id = $(this).parent().parent().attr('id');
		var table_t = "#"+table_id ;
		var table = $(table_t).DataTable();
		var buttons = table.buttons( ['.edit_table', '.delete_table_entry'] );
		$('.append-html').html('');
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
	
	/*update table name*/
	$("#update_tab").on("click", function(){
		
		table_id = $("#table_id").val();
		table_name = $("#table_name").val();
		
		var url=ajaxUrl; 
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'update_table_name',
					table_id : table_id,
					table_name : table_name,
				},         				
				success: function(responseq) 
				{														
					if(responseq =='success')
					{	
						alert('Table name changed successfully');
						$('.edit-table-name').hide();
						// window.location.reload();
						   window.setTimeout(function(){window.location.reload()}, 3000);
					}
					else if(responseq =='fail'){
						 alert('sorry! unable to update table name');
						 //window.location.reload();
						window.setTimeout(function(){window.location.reload()}, 3000);
					}
				}
				
				});
				
	});
	/* add new row */
	$("#addBtn").on("click", function(){
									
		
		$("#update").removeClass('update-row');
		$("#update").addClass('add-row');
		$("#update").html('Save');
		
		
		table_id = $("#get_id").val();
		
		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'add_row',
					table_id : table_id,
				},         
				beforeSend: function() 
				{
					   //$(".loader").show();                      
				},
				success: function(responseq) 
				{														
					$('.append-html').append(responseq);
					$('.edit-table').show();
				}
				
				});
		
	});
		/* END */
	/* insert row */
	
	$("#myModal").on("click" , ".add-row", function(){
		alert('data being inserted. plz wait.');
				var i;
		table_id = $("#get_id").val();
		count_col = $("#count_col").val();	
		col = [];
		cmt = [];
		for(i=2; i <= count_col ; i++)
		{
			col[i] = $("#col_"+i).val();
			cmt[i] = $("#cmt_"+i).val();
		}
				
		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'insert_row',
					count_col:count_col,
					table_id:table_id,
					col:col,
					cmt:cmt,
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
		
		table_id = $("#get_id").val();
		row_id = $("#myBtn").val();
		if(row_id =='')
		{
			alert('please select row');
			event.preventDefault(false);
		}
		$("#update").removeClass('add-row ');
		$("#update").addClass('update-row');
		$("#update").html('Update');

		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'edit_data',
					table_id : table_id,
					row_id : row_id,
				},         
				beforeSend: function() 
				{
					   //$(".loader").show();                      
				},
				success: function(responseq) 
				{					
					// alert('success');
					
					/* var obj = jQuery.parseJSON(responseq);
					col_len = obj.column.length;
					console.log(col_len); */									
					
					$('.append-html').append(responseq);
					$('.edit-table').show();
				}
				
				});
		});
		
	
	/* update row */
	$("#myModal").on("click",".update-row", function(){
		//alert('update row');
		
		table_id = $("#get_id").val();
		row_id = $("#myBtn").val();
		total_col = $("#total_col").val();		
		
		col = [];
		cmt = [];
		for(i=2; i <= total_col ; i++)
		{
			col[i] = $("#editcol_"+i).val();
			cmt[i] = $("#editcmt_"+i).val();
		}
		
		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'update_table',
					row_id:row_id ,
					table_id:table_id,
					total_col:total_col,
					col:col,
					cmt:cmt,
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
		
		table_id = $("#get_id").val();
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
					table_id:table_id,
				},         				
				success: function(responseq) 
				{				
					if(responseq == 'deleted')
					{
						alert('data deleted successfully');
						 window.location.reload();
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
		$('.edit-table-name').hide();
		$(this).removeClass('selected');
		$('.append-html').html('');
	});
	$(".can").on("click", function(){
		//$("#myBtn").val('');
		$('.edit-table').hide();
		$('.edit-table-name').hide();
		$('.append-html').html('');
		
	});

	
});
</script> 

<?php
get_footer();
?>



