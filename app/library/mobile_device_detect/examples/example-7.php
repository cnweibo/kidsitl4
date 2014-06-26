<?php

// http://detectmobilebrowsers.mobi/

require_once('mobile_device_detect.php');

// if the get value switch is sent we use it
if(isset($_GET['switch'])){
	$mobile = $_GET['switch']; // should be either 1 for true or empty for false
	setcookie('switch',$_GET['switch']); // set a cookie
	if(isset($_SERVER['HTTP_REFERER'])){ // if the referer is set send the user there
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
}else if(isset($_COOKIE['switch'])){ // if the cookie is set use it
	$mobile = $_COOKIE['switch'];
}else{ // else use the function to detect if it's a mobile or not
	$mobile = mobile_device_detect();
}

// this folowing section is purely to test it works on pagination
if(isset($_GET['page'])){
	$page = 'Page '.$_GET['page'];
}else{
	$page = 'Page 1';
}
$pages = '<ul>';
while(++$i<10){
	$pages .= '<li><a href=?page='.$i.'>Page '.$i.'</a></li>';
}
$pages .= '</ul>';
// end of pagination stuff

// show a desktop template for full browsers and a mobile template for mobiles
if($mobile==true){ 

  echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Mobile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <h1>'.$page.' MOBILE</h1>
    <h2>Plus support for pagination to state is kept through pageviews on your site.</p>
		'.$pages.'
    <p><a href="?switch=0">Show me the PC version</a></p>
  </body>
</html>';

}else{ 

  echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
  <html>
  <head>
    <title>Desktop</title>
    <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  </head>
  <body>
    <h1>'.$page.' DESKTOP</h1>
    <h2>Plus support for pagination to state is kept through pageviews on your site.</p>
		'.$pages.'
    <p><a href="?switch=1">Show me the mobile version</a></p>
  </body>
</html>';

}

?>