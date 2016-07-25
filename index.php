<?php

error_reporting(0);

require 'vendor/autoload.php';

use MaxMind\Db\Reader;

$ipAddress = $_SERVER['HTTP_X_XELSION_CLIENT_IP'];
$databaseFile = 'geolite2-country.mmdb';

$reader = new Reader($databaseFile);
$geo = $reader->get($ipAddress);
$reader->close();
$country = null;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (isset($geo['country']['iso_code']))
{
	$country = array(
		'code' => $geo['country']['iso_code'],
		'name' => $geo['country']['names']['en'],
	);
}

echo json_encode(array(
	'country' => $country,
));