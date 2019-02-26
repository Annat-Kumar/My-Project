<?php

 function curl_url($url,$ref="")
 {
   if(function_exists("curl_init"))
   {
     $ch_init = curl_init();
     $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; "."Windows NT 5.0)";
     $ch_init = curl_init();
     curl_setopt($ch_init, CURLOPT_USERAGENT, $user_agent);
     curl_setopt( $ch_init, CURLOPT_HTTPGET, 1 );
     curl_setopt( $ch_init, CURLOPT_RETURNTRANSFER, 1 );
     curl_setopt( $ch_init, CURLOPT_FOLLOWLOCATION , 1 );
     curl_setopt( $ch_init, CURLOPT_FOLLOWLOCATION , 1 );
     curl_setopt( $ch_init, CURLOPT_URL, $url );
     curl_setopt( $ch_init, CURLOPT_REFERER, $ref );
     curl_setopt ($ch_init, CURLOPT_COOKIEJAR, 'cookie.txt');
     $html = curl_exec($ch_init);
     curl_close($ch_init);
   }
  else
   {
     $hfile = fopen($url,"r");
     if($hfile)
     {
       while(!feof($hfile))
       {
         $html.=fgets($hfile,1024);
       }
     }
   }
  return $html;
 }
 
 
 $url='http://www.amazon.com/s/ref=sr_nr_p_72_0?rh=n%3A172282%2Ck%3Aiphone+5s%2Cp_72%3A1248879011&keywords=iphone+5s&ie=UTF8&qid=1406078696&rnid=1248877011';
$getelement = curl_url($url);            
preg_match_all ("/a[\s]+[^&amp;gt;]*?href[\s]?=[\s\"\']+"."(.*?)[\"\']+.*?&amp;gt;"."([^&amp;lt;]+|.*?)?&amp;lt;\/a&amp;gt;/", $getelement, $matches,PREG_PATTERN_ORDER);    
$matches = $matches[1];
$list = array();
    foreach($matches as $var)
        {    
           print_r($var."\n");
        }

$result=explode("/",$var);
if (count($result)>=5)
{
  if ($result[4]=='dp')
  {
    print_r($result[5]."<br />");
  }
}
?>