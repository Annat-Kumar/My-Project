<?php
require_once('ProductScraper.php');

// Test urls
/*
 http://www.zappos.com/lucky-brand-abbey-road-dune?zlfid=111 
 http://store.americanapparel.net/rsa642sg.html 
 http://www.llbean.com/webapp/wcs/stores/servlet/CategoryDisplay?storeId=1&catalogId=1&langId=-1&categoryId=18584&productId=91702&qs=3009652
*/

$scrapedValues = Array();
 //$scrapedValues = ProductScraper::getInfo('https://www.amazon.com/gp/product/B07GLHFS76/ref=s9_acsd_top_hd_bw_bjy9Q3_c_x_2_w?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-3&pf_rd_r=QW6T8Z799MVTY90A0CMJ&pf_rd_r=QW6T8Z799MVTY90A0CMJ&pf_rd_t=101&pf_rd_p=0413a613-0704-5f0f-bfa7-6b5609338512&pf_rd_p=0413a613-0704-5f0f-bfa7-6b5609338512&pf_rd_i=679271011'); 
 $scrapedValues = ProductScraper::getInfo('https://www.amazon.com/gp/product/B00I8BICB2/ref=s9_acsd_top_hd_bw_b3OSvIh_c_x_w?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-3&pf_rd_r=HSWNNJH1NEGBWKW7SDG5&pf_rd_r=HSWNNJH1NEGBWKW7SDG5&pf_rd_t=101&pf_rd_p=86cb3aa2-2cf4-5158-a14d-80184ff240a1&pf_rd_p=86cb3aa2-2cf4-5158-a14d-80184ff240a1&pf_rd_i=3109924011');  $scrapedValues = ProductScraper::getInfo('https://www.ebay.com/itm/Alpine-Swiss-Niko-Men-s-Down-Jacket-Puffer-Bubble-Coat-Packable-Light-Warm-Parka/312203105417?var=610862055043'); 
//echo "<pre>";print_r($scrapedValues);

//testing output
echo "Title: $scrapedValues[0] <br />";
echo "Price: " . $scrapedValues[1] . "<br />";
echo "Description: $scrapedValues[2] <br />";
//echo "Images: "; print_r($scrapedValues[3]); echo '<br />';
//echo "Normalized url: $scrapedValues[4] <br />";

?>

