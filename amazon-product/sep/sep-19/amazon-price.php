<html>

<head>
<meta charset="UTF-8">
<title></title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>

<form method="get">

<label>ASIN:<input name="asin"></label>
</form>
<?php

$asin = filter_input(INPUT_GET , 'asin');
if(!empty($asin)){
	echo "<hr>";
	
	
	$baseUrl =  'https://www.amazon.com/gp/product/' ;
	$html = file_get_contents($baseUrl. $asin);
	//$isMatched = preg_match('|"priceblock_ourprice".*\$(.*)<|' , $html ,$match);
	$isMatched = preg_match('|"priceblock_ourprice".*\$(.*)<|', $html, $match);
	$price = 0;
	echo "<pre>";print_r($match);echo "</pre>";
	if($isMatched && isset($match))
	{
		$price = $match;
	}
	
}
echo "<h1>{$price}</h1>";


?>

<?php

$link = 'https://www.amazon.com/Learning-PHP-MySQL-JavaScript-jQuery/dp/1491978910/';
$page_content = file_get_contents($link);

if(preg_match('/<span class=\"a-size-medium a-color-price header-price\">(.*?)<\/span>/i',
    $page_content, $matches)) {

   echo  $price = trim($matches[1]);
} else {
   // echo "Price not found.";
    $price = 0;
}

?>
<?php
	$baseUrl =  $scraped_Values;
	$html = file_get_contents($scraped_Values);
	//print_r($html);
	$isMatched = preg_match('|"priceblock_ourprice".*\$(.*)<|', $html, $match);
	$price = 0;
	echo "<pre>";print_r($match);echo "</pre>";
?>