<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: POST");
header("Allow: POST");
header("Content-type: application/json; charset=utf-8");

$contentType = @$_SERVER["CONTENT_TYPE"];
if ($contentType == "application/json") {
	header('Content-Type:application/json; charset=utf-8');
	$contens = file_get_contents('php://input');
	$_POST = json_decode($contens, true);
}

ini_set("upload_max_filesize", "6M");
ini_set('display_errors', true);
error_reporting(E_ALL);
setlocale(LC_ALL, "es_CO");
date_default_timezone_set('America/Bogota');

$out = array();
try {
	require_once FCPATH. 'lib/LocalEnv.php';
	require_once FCPATH. 'lib/ADOdb.php';
	require_once FCPATH. 'lib/AntiXSS.php';
	
	LocalEnv::Init();
	ADOdb::Connect();
} catch (Exception $err) {
	echo json_encode(array(
		"success" => false,
		"flag" => false,
		"data" => null,
		"error" => $err->getMessage() . ', ' . $err->getLine()
	));
	http_response_code(401);
	exit();
}
