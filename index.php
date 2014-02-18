<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
date_default_timezone_set('America/Los_Angeles');

// use autoloader
require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/view.php';
require 'libs/model.php';
require 'libs/snapchat.php';
require 'libs/session.php';
require 'libs/api.php';
require 'libs/solvemedialib.php';
/*
$currentTime = time();
$filePath = 'time.txt';
//$file = file($filePath);

$f = fopen($filePath, 'r+');
$savedTime = fgets($f);
fclose($f);

$compare = 0;
$compare = $currentTime - $savedTime;


if ($compare > 600) {
	$newTime = $currentTime;
	file_put_contents($filePath, $newTime);
	$nPath = '/srv/www/snapchat.am/public_html/libs/number';
	$f = fopen($nPath, 'r+');
	$ip = fgets($f);
	echo $ip;
	fclose($f);
	$ip = $ip + 1;
	file_put_contents($nPath, $ip);	
}
*/
$app = new Bootstrap();


?>