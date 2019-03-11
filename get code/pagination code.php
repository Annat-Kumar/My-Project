<?php if ($query1->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
  <nav class="prev-next-posts">
    <div class="prev-posts-link">
      <?php echo get_next_posts_link( 'Older Entries', $query1->max_num_pages ); // display older posts link ?>
    </div>
    <div class="next-posts-link">
      <?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
    </div>
  </nav>
<?php } ?>

<?php else: ?>
  <article>
    <h1>Sorry...</h1>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  </article>
<?php endif; ?>
<?php 

/* 
=============================
Put this code in theme's functions.php file 
*/

function pagination($pages = '', $range = 1)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
    
  if(1 != $pages)
  {         
	echo '<div class="col-md-12 text-center">';
	echo '<nav aria-label="Page navigation">';
	echo '<ul class="pagination">';
   
	//if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
	if($paged > 1 && $showitems < $pages)     
    echo "<li><a href='".get_pagenum_link($paged - 1)."' aria-label=\"Previous\"><span aria-hidden=\"true\">«</span></a>";
 
	 for ($i=1; $i <= $pages; $i++)
	 {
		 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		 {
			 echo ($paged == $i)? "<li class=\"active-2\"><a>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
		 }
	 }
 
	 if ($paged < $pages && $showitems < $pages) echo "<li><a aria-label=\"Next\" href=\"".get_pagenum_link($paged + 1)."\"> <span aria-hidden=\"true\">»</span></a>";  
	 //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         
	echo '</ul>';
		 echo '</nav>';
	echo "</div>\n";
	 }
}

 use this below code to display pagination wherever need.

if (function_exists("pagination")) 
{
   pagination($query->max_num_pages);
}
-------------------------
 // Also, use this code to get pagination properly working.

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 
  $args = array(
   'post_type' => 'equipment',
   's' => $s,
   'posts_per_page' => 1,
   'paged' => $paged,
   'orderby' => 'title',
   'post_status' => 'publish',

// ================================= //
//Ajax Paging
//-------------
?>
<?php //next_posts_link('&laquo; Older Entries', $query1->max_num_pages) ?>
<?php //previous_posts_link('Newer Entries &raquo;') ?>
<?php //next_posts_link('&raquo; Newer Entries', $query1->max_num_pages) ?>
<?php //previous_posts_link('Newer Entries &laquo;') ?>


<input type="hidden" id="gif"value="<?php echo get_template_directory_uri().'/images/loader.png';?>">
<!--<div><img src="<?php echo get_template_directory_uri().'/images/loader.gif';?>"></img></div>-->

<script>
jQuery(function($) {
    $('#all').on('click', '#pagination12 a', function(e){
        e.preventDefault();
        var link = $(this).attr('href');
		//$('#all').hide();
        $('#all').hide(1500, function(){
            $(this).load(link + ' #all', function() {
                $(this).fadeIn(100);
            });
        });
    });
	});
</script>	
