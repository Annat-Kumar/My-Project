<?php
include_once('conn.php');
include_once'pagination.php';

define('home_url', 'http://bytecodetechnologies.co.in/proxy-list/');
 
$proxy_total = mysqli_fetch_row(mysqli_query($conn , "SELECT COUNT(proxy) FROM tools_proxy "));
$live_proxy = mysqli_fetch_row(mysqli_query($conn ,"SELECT COUNT(proxy) FROM tools_proxy WHERE status = 'live' "));
$sorted_proxy = mysqli_fetch_row(mysqli_query($conn ,"SELECT COUNT(proxy) FROM tools_proxy WHERE location <> '' "));
$https_proxy = mysqli_fetch_row(mysqli_query($conn ,"SELECT COUNT(proxy) FROM tools_proxy WHERE type = 'https' "));
$anon_proxy = mysqli_fetch_row(mysqli_query($conn ,"SELECT COUNT(proxy) FROM tools_proxy WHERE anonymity = 'elite' "));
$latest_update = mysqli_fetch_row(mysqli_query($conn ,"SELECT updated FROM tools_proxy ORDER BY updated desc LIMIT 1"));
$api_users = mysqli_fetch_row(mysqli_query($conn ,"SELECT COUNT(*) FROM getmeproxy_payments"));

$country_type = "<option value=''></option>";
$sort_by_country = mysqli_query($conn ,"SELECT DISTINCT location, proxy FROM tools_proxy WHERE location !=''");
while($row_country = mysqli_fetch_array($sort_by_country)) {
	$country_type .= "<option value='".$row_country['location']."'>".$row_country['location']."</option>";
}

//Pagination
$adjacents = 4;
$page = intval($_GET["page"]);
if($page<=0) $page = 1;
$reload = dirname($_SERVER['PHP_SELF']);

$location = mysqli_real_escape_string($conn ,trim($_POST['country']));
$type = mysqli_real_escape_string($conn ,trim($_POST['type']));
$status = mysqli_real_escape_string($conn ,trim($_POST['status']));
$download = mysqli_real_escape_string($conn ,trim($_POST['download']));
$speed = mysqli_real_escape_string($conn ,trim($_POST['speed']));
$show_old = trim($_POST['old']);
$show = $_POST['show'];
$anonymity_search = mysqli_real_escape_string($conn , trim($_POST['anonymity']));

if($show_old == 'asc') {
	$sort_order = 'asc';
} else {
	$sort_order = 'desc';
}

if($anonymity_search == "high") {
    $anon = "elite";
} elseif($anonymity_search == "medium") {
    $anon = "anonymous";
} elseif($anonymity_search == "transparent") {
    $anon = "transparent";
}

$query = "SELECT * FROM tools_proxy WHERE location LIKE '%{$location}%' AND type LIKE '%{$type}' AND status LIKE '%{$status}%' AND conn_time LIKE '{$speed}%' AND anonymity LIKE '%{$anon}%'  ORDER BY  updated $sort_order";

$get_data = mysqli_query($conn ,$query);
//print_r($get_data);die;
if(!isset($show)) {
	$rpp = 15;
	$show_found_records = '';
} else {
	$rpp = 1000;
	$show_found_records = '<p><span class="label label-default">Total results found: '.mysql_num_rows($get_data).'</span></p>';
}

	//Pagination
	$tcount = mysqli_num_rows($get_data);
	$tpages = ($tcount) ? ceil($tcount/$rpp) : 1;
	$count = 0;
	$i = ($page-1)*$rpp;
	while(($count<$rpp) && ($i<$tcount)) {
		mysqli_data_seek($get_data, $i);
		$row_data = mysqli_fetch_array($get_data);


	if($row_data['status'] == 'live') {
		$state = "<span class='label label-success'><span class='glyphicon glyphicon-ok-sign'></span></span>";
	} else {
		$state = "<span class='label label-danger'><span class='glyphicon glyphicon-question-sign'></span></span>";
	}

	if($row_data['type'] == 'https') {
		$type_state = "<span class='label label-success'>HTTPS</span>";
	} else {
		$type_state = "<span class='label label-warning'>HTTP</span>";
	}

    if($row_data['anonymity'] == 'elite') {
        $anon_level = "<span class='label label-success'>HIGH</span>";
    } elseif($row_data['anonymity'] == 'anonymous') {
        $anon_level = "<span class='label label-warning'>MEDIUM</span>";
    } elseif($row_data['anonymity'] == 'transparent') {
        $anon_level = "<span class='label label-danger'>NONE</span>";
    }

	

	$proxy_ip = base64_encode($row_data['proxy']);
	$proxy_list1 = "jldfldsf";
	$proxy_list .= "<tr><td><script type='text/javascript'>document.write(Base64.decode(\"".$proxy_ip."\"))</script></td><td>".$type_state."</td><td>".$anon_level."</td><td>".$row_data['location']."</td><td>".$row_data['region']."</td><td>".$row_data['conn_time']." ms</td></tr>";
	$file_data .= $row_data['proxy'].";".$row_data['type'].";".$row_data['location']."\r\n";
	$i++;
	$count++;
}

	if(!empty($download) == 'yes') {
		$file_name = rand(100000, 1000000);
		    $handle = fopen("/var/www/getmeproxy/www/tmp/".$file_name.".txt", "w");
    		fwrite($handle, $file_data);
    		fclose($handle);
    		header('Content-Type: application/octet-stream');
    		header('Content-Disposition: attachment; filename='.basename('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt'));
    		header('Expires: 0');
    		header('Cache-Control: must-revalidate');
    		header('Pragma: public');
    		header('Content-Length: ' . filesize('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt'));
    		readfile('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt');
    		unlink('/var/www/getmeproxy/www/tmp/'.$file_name.'.txt');
    		exit;

		
	}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name=viewport content='width=device-width, initial-scale=1, maximum-scale=1'/>
    <meta name="yandex-verification" content="82aea8ea3da70e8c"/>
    <meta name="google-site-verification" content="2n1ZhaoPIBXgNBnLCrgR_taeCVs7v0nuHIc2MApUVuk" />

    <!-- Lang url generation -->
                                           
	<link href="/ar" hreflang="ar" rel=alternate type="text/html"/>
	<link href="/de" hreflang="de" rel=alternate type="text/html"/>
	<link href="/en" hreflang="en" rel=alternate type="text/html"/>
	<link href="/es" hreflang="es" rel=alternate type="text/html"/>
	<link href="/fr" hreflang="fr" rel=alternate type="text/html"/>
	<link href="/hi" hreflang="hi" rel=alternate type="text/html"/>
	<link href="/it" hreflang="it" rel=alternate type="text/html"/>
	<link href="/ja" hreflang="ja" rel=alternate type="text/html"/>
	<link href="/ms" hreflang="ms" rel=alternate type="text/html"/>
	<link href="/pt" hreflang="pt" rel=alternate type="text/html"/>
	<link href="/ru" hreflang="ru" rel=alternate type="text/html"/>
	<link href="/tr" hreflang="tr" rel=alternate type="text/html"/>
	<link href="/zh" hreflang="zh" rel=alternate type="text/html"/>
	<link href="/kr" hreflang="kr" rel=alternate type="text/html"/>
                          
	<meta name="robots" content="index,follow">

    <!-- End lang url generation -->

    <title> Free proxy list - Free proxy servers - proxio.io </title>

    <meta name=keywords content="proxy, free, list,http,https,socks4,socks5">
    <meta name=description content=" We have the largest proxy list online with 15,000 active proxy address in 190 countries and 700 cities.Copy the full fresh proxy list with just one click."/>


    <!-- Facebook -->
    <meta property=og:title content=" Free proxy list - Free proxy servers - proxio.io"/>
    <meta property=og:type content="article"/>
    <meta property=og:description content="We have the largest proxy list online with 15,000 active proxy address in 190 countries and 700 cities.Copy the full fresh proxy list with just one click."/>
    <meta property=og:site_name content="proxio.io"/>
    <meta property="og:url" content="proxio.io"/>
    <meta property="og:image" content="https://www.proxydocker.com/web/template/img/unblock-sites.png">
    <!-- End Facebook -->

    <!-- Twiteer -->
    <meta name=twitter:card content="summary"/>
    <meta name=twitter:title content=" Free proxy list - Free proxy servers - proxio.io"/>
    <meta name=twitter:description content="We have the largest proxy list online with 15,000 active proxy address in 190 countries and 700 cities.Copy the full fresh proxy list with just one click."/>
    <!-- End Twiteer -->

    <link rel=icon href="/template/img/favicon/favicon-32x32.png" sizes="32x32"/>
    <link rel="shortcut icon" href="/template/img/favicon/favicon-16x16.png" type="image/x-icon">		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
	       
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css">
	
	<style>
        a:active,a:hover{outline:0}.list-unstyled,.rrssb-buttons,.seemore{font-size:12px}.rrssb-buttons,.rrssb-buttons li,.rrssb-buttons li a,.tn-dropdown{box-sizing:border-box}.rrssb-buttons li a,.s-icon{-moz-osx-font-smoothing:grayscale}.navbar-default{background-color:#3a3f41}.navbar-collapse{margin-left:50px}.navbar,.navbar-toggle{border:none}.navbar-fixed-bottom,.navbar-fixed-top{position:fixed;right:0;left:0;z-index:1030}.navbar{position:relative;min-height:50px}.nav>li,.nav>li>a{display:block;position:relative}.navbar-default .navbar-nav>li{font-weight:400}.nav>li>a{padding:10px 15px}.nav>li>a:focus,.nav>li>a:hover{text-decoration:none;background-color:#eee}.navbar-nav>li>a{line-height:20px;padding-top:15px;padding-bottom:15px}.navbar-default .navbar-nav>li>a:focus,.navbar-default .navbar-nav>li>a:hover{color:#c5bcbc;background-color:transparent}.navbar-default .navbar-nav>li>a:hover{color:#b7aeae}.navbar-default .navbar-nav>.open>a,.navbar-default .navbar-nav>.open>a:focus,.navbar-default .navbar-nav>.open>a:hover{color:#fff;background-color:#464d54}.navbar-default .navbar-nav>li>a{color:#fff;display:inline-block;font-size:12px;font-weight:700}.navbar-default .navbar-brand,.navbar-default .navbar-brand:active,.navbar-default .navbar-brand:hover{color:#fff}.text-success,.text-success:hover{color:#44ACD6}.rrssb-buttons{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;height:36px;margin:0;padding:0;width:100%}.rrssb-buttons:after{clear:both}.rrssb-buttons:after,.rrssb-buttons:before{content:' ';display:table}.rrssb-buttons li{float:left;height:100%;line-height:18px;list-style:none;margin:0;padding:0 2px}.rrssb-buttons li.rrssb-facebook a{background-color:#306199}.rrssb-buttons li.rrssb-facebook a:hover{background-color:#244872}.rrssb-buttons li.rrssb-linkedin a{background-color:#007bb6}.rrssb-buttons li.rrssb-linkedin a:hover{background-color:#005983}.rrssb-buttons li.rrssb-twitter a{background-color:#26c4f1}.rrssb-buttons li.rrssb-twitter a:hover{background-color:#0eaad6}.rrssb-buttons li.rrssb-googleplus a{background-color:#e93f2e}.rrssb-buttons li.rrssb-googleplus a:hover{background-color:#ce2616}.rrssb-buttons li.rrssb-youtube a{background-color:#df1c31}.rrssb-buttons li.rrssb-youtube a:hover{background-color:#b21627}.rrssb-buttons li.rrssb-pinterest a{background-color:#b81621}.rrssb-buttons li.rrssb-pinterest a:hover{background-color:#8a1119}.rrssb-buttons li.rrssb-buyproxy a{background-color:#2E88E2}.rrssb-buttons li.rrssb-buyproxy a:hover{background-color:#3054BC}.rrssb-buttons li.rrssb-buyproxy2 a{background-color:#30ae3d}.rrssb-buttons li.rrssb-buyproxy2 a:hover{background-color:#1c9529}.rrssb-buttons li a{background-color:#ccc;border-radius:2px;display:block;-webkit-font-smoothing:antialiased;font-weight:700;height:100%;padding:11px 7px 12px 27px;position:relative;text-align:center;text-decoration:none;text-transform:uppercase;-webkit-transition:background-color .2s ease-in-out;transition:background-color .2s ease-in-out;width:100%}.side_bar_title,h4{font-weight:600}.rrssb-buttons li a .rrssb-icon{display:block;left:10px;padding-top:9px;position:absolute;top:0;width:10%}.rrssb-buttons li a .rrssb-icon svg{height:17px;width:17px}.rrssb-buttons li a .rrssb-icon svg circle,.rrssb-buttons li a .rrssb-icon svg path{fill:#fff}.rrssb-buttons li a .rrssb-text{color:#fff}a:focus,a:hover{color:#2a6496;text-decoration:underline}.rrssb-buttons li a:active{box-shadow:inset 1px 3px 15px 0 rgba(22,0,0,.25)}.rrssb-buttons li.small a{padding:0}.rrssb-buttons li.small a .rrssb-icon{left:auto;margin:0 auto;overflow:hidden;position:relative;top:auto;width:100%}.rrssb-buttons li.small a .rrssb-text{visibility:hidden}.rrssb-buttons.large-format,.rrssb-buttons.large-format li{height:auto}.rrssb-buttons.large-format li a{-webkit-backface-visibility:hidden;backface-visibility:hidden;border-radius:.2em;padding:8.5% 0 8.5% 12%}.rrssb-buttons.large-format li a .rrssb-icon{height:100%;left:7%;padding-top:0;width:12%}.rrssb-buttons.large-format li a .rrssb-icon svg{height:100%;position:absolute;top:0;width:100%}.rrssb-buttons.large-format li a .rrssb-text{-webkit-backface-visibility:hidden;backface-visibility:hidden}.rrssb-buttons.small-format{padding-top:5px}.rrssb-buttons.small-format li{height:80%;padding:0 1px}.rrssb-buttons.small-format li a .rrssb-icon{height:100%;padding-top:0}.rrssb-buttons.small-format li a .rrssb-icon svg{height:48%;position:relative;top:6px;width:80%}.rrssb-buttons.tiny-format{height:22px;position:relative}.rrssb-buttons.tiny-format li{padding-right:7px}.rrssb-buttons.tiny-format li a{background-color:transparent;padding:0}.facebookdiv_groupby,.facebookdiv_proxylist{padding:20px}.rrssb-buttons.tiny-format li a .rrssb-icon{height:100%}.rrssb-buttons.tiny-format li a .rrssb-icon svg{height:70%;width:100%}.facebookdiv{background:#fff;border:1px solid;box-shadow:0 1px 2px rgba(0,0,0,.1);border-color:#e5e6e9 #dfe0e4 #d0d1d5;border-radius:3px}.facebookdiv_proxylist,.facebookdiv_table{border-width:0 1px 1px}.facebookdiv_search{padding:12px 30px;margin-bottom:5px}.facebookdiv_proxydetail{border-width:1px;}.facebookdiv_subscribe{padding:50px 30px 30px}.facebookdiv_subscribe_min{padding:15px 10px;margin-bottom:10px}.facebookdiv_tools{padding:0 16px 5px;margin-bottom:10px}.facebookdiv_tools_left,.facebookdiv_tools_right{padding:0 0 5px 20px;min-width:148px;margin-bottom:10px}.facebookdiv_tools_right{margin-left:5%}.facebookdiv_ads{margin-bottom:10px;padding:1px 1px 0;width:303px;height:252px}.facebookdiv_suggest{margin-bottom:10px;padding:0 0 5px 20px;width:300px}.facebookdiv_google{padding:20px 20px 0}a{color:#374b5d}a:hover{cursor:pointer}a:focus{outline:-webkit-focus-ring-color auto 5px;outline-offset:-2px}ul li{color:#1d2129}.separate-line{background-color:#E9EBEE;height:1px;margin:0 10px 5px 0}.currencies-list .title,.title{margin-bottom:18px}.ipdetail_table .table>tbody>tr>th,.proxylist_table .table>tbody>tr>th,.table>tbody>tr>td{line-height:2;font-size:14px}.bordered-block{border:1px solid #ededed;background-color:#fff}.title{padding-left:28px}.bordered-block .title{margin-top:0;margin-bottom:17px}.bordered-block ul{margin:0}.list-unstyled{padding-left:0;list-style:none}.bordered-block ul a:hover{color:#36c;background:#ebf8f9}.bordered-block ul a{padding:14px 28px 10px;display:block;border-bottom:solid 1px #ededed;color:#656565;font-size:13px;text-decoration:none}p{font-family:"Open Sans",sans-serif;font-size:12px;line-height:25px;text-shadow:none;color:#777}.side_bar_title{font-family:"Roboto Slab",serif;color:#9FA2A9;font-size:13px;text-transform:none;line-height:2.5;margin-top:15px;margin-bottom:10px}.proxy-ping-span-wrap{width:70px;height:12px;border:1px solid #ccc;display:block}.proxy-ping-span{background:#0087c9;height:10px;padding:0;margin:0;display:block}.-active .tn-dropdown-arrow{display:block}.tn-dropdown-arrow{height:10px;display:none;position:absolute;width:100%}.tn-dropdown-arrow:before{top:5px;margin-left:-6px;box-shadow:0 0 5px 0 rgba(0,0,0,.15);border:1px solid #ccc;z-index:499}.tn-dropdown-arrow.-dark:after,.tn-dropdown-arrow.-dark:before{background-color:#64787e;border-color:#64787e}.tn-dropdown-arrow:after{top:6px;margin-left:-5px;z-index:501}.tn-dropdown-arrow:after,.tn-dropdown-arrow:before{content:'';position:absolute;left:50%;width:12px;height:12px;background-color:#fff;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}.tn-dropdown.-dark{border:none;color:#fff;background-color:#64787e}.-active .tn-dropdown,.tn-dropdown.-active{display:block}.tn-upgrade__dropdown{right:0;margin-top:10px;padding:12px 16px}.tn-dropdown{z-index:500;display:none;top:100%;background-color:#fff;border-radius:4px;border:1px solid #ccc;box-shadow:0 2px 5px 0 rgba(0,0,0,.25)}.tn-upgrade__dropdown-header{margin:0 0 10px;font-size:14px;font-weight:700;line-height:1}.tn-upgrade__list{font-size:12px;list-style-position:inside;padding:0;margin:0;line-height:18px}.tn-upgrade__list-item{white-space:nowrap;color:#fff;font-family:Ubuntu,sans-serif;font-weight:400;line-height:18px}.tn-dropdown__footer{margin-top:5px}.s-icon.-xs{font-size:12px;font-family:sem-icons-xs}.s-icon{fill:currentColor;line-height:1;font-style:normal;font-variant:normal;text-rendering:optimizeLegibility;-webkit-font-feature-settings:'liga';font-feature-settings:'liga'}.-s-block-center-child,.s-btn,.s-icon{vertical-align:middle}.tn-upgrade__dropdown-close{position:absolute;right:8px;top:8px;cursor:pointer;color:rgba(255,255,255,.5);background:0 0;border:none;outline:0;padding:0}.line-through{text-decoration:line-through}h1,h2,h3,h4,h5{font-family: 'Roboto Slab', serif;  }.my_title {margin-bottom: 15px;margin-top: 0px;font-size: 30px;font-weight: bold;color: #444;}
		 .navbar {
			display: none;
		}
		.d-block {
			display: block;
		}
			
		.facebookdiv.facebookdiv_search {
			display: none;
		}

		.adsbygoogle {
			display: none !important;
		}
		.col-lg-9 > .rrssb-buttons {display: none !important;}
		.col-lg-3 > .pull-right {display: none !important;}
	
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script async>

        var domain = window.location.origin;

        if(domain.includes("localhost"))
        {
            proxy_url="http://localhost/Proxydocker3.4/web/app_dev.php/"+"en"+"/";
        }
        else
        {
            proxy_url=domain+"/"+"en"+"/";
        }

    </script>

    <!-- End CSS -->

 
</head>
<header>

    <nav class="navbar navbar-default d-block" role="navigation">
        <div class="container" id="navfluid" style="margin-top: 8px;margin-bottom: 8px;">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand navbar-brand-img" href="<?php echo home_url ;?>">
                    <img src="<?php echo home_url ;?>/template/img/logo_db.png" alt="logo" style="height: 35px; margin-top:-10px; margin-left: -3px;">
                </a>

            </div>


            <div class="collapse navbar-collapse" id="navigationbar">
                <ul class="nav navbar-nav" >


                    <li>

                        <a href="http://bytecodetechnologies.co.in/proxy-list">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>


                    </li>                    


                    <li class="dropdown">
                      


                    <li>
                        <a href="<?php echo $home_url;?>my-ip-address.php">&nbsp;                        
						<i class="glyphicon glyphicon-map-marker"></i>
                            My ip</a>
                    </li>




                    </li>

                </ul>

                

                <ul class="nav navbar-nav navbar-right">                   

						<li>
                            <a id="signup" href="#">Sign up</a>
                        </li>
                    

                    <li class="dropdown">

						<a id="login" href="#" class="dropdown-toggle" data-toggle="dropdown">

                                Log in
                                <span class="caret"></span>

						</a>
                                              
                    </li>


                </ul>


            </div><!-- /.navbar-collapse -->


        </div><!-- /.container-fluid -->
    </nav>

</header>
<body style="background-color: #F5F5F5">

 <script type="text/javascript">var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}</script>
 

    