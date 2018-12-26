<?php

/*
Template name:product-details
*/

get_header();

require_once('ProductScraper.php');


?>

<form method="post" name="product-form" action="#">
<input type="text" name="product_url" placeholder="https://www.amazon.com/gp/product/B00I8BICB2..">
<input type="submit" name="submit_url" value="Submit Url">
</form>
<?php


if(isset($_POST['submit_url']))
{
		
	$scraped_Values	= $_POST['product_url'] ;
	$scrapedValues = Array();
 $scrapedValues147 = ProductScraper::getInfo('https://www.amazon.com/gp/product/B00I8BICB2/ref=s9_acsd_top_hd_bw_b3OSvIh_c_x_w?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-3&pf_rd_r=HSWNNJH1NEGBWKW7SDG5&pf_rd_r=HSWNNJH1NEGBWKW7SDG5&pf_rd_t=101&pf_rd_p=86cb3aa2-2cf4-5158-a14d-80184ff240a1&pf_rd_p=86cb3aa2-2cf4-5158-a14d-80184ff240a1&pf_rd_i=3109924011'); 
 
// echo $scraped_Values ;echo "<br>";
 $scrapedValues = ProductScraper::getInfo("$scraped_Values"); 


//echo "<pre>";print_r($scrapedValues);


//testing output

echo "Title: $scrapedValues[0] <br />";

echo "Price: " . $scrapedValues[1] . "<br />";

echo "Description: $scrapedValues[2] <br />";

//echo "Images: "; print_r($scrapedValues[3]); echo '<br />';

//echo "Normalized url: $scrapedValues[4] <br />";


}
 
//get_footer();
?>

