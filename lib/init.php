<?php
error_reporting(E_ALL);
ini_set("upload_max_filesize", "20M");
ini_set('display_errors', 1);
date_default_timezone_set('America/Bogota');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, X-POST, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: POST");
header("Allow: POST");
header("Content-type: application/json; charset=utf-8");

try {
	require_once FCPATH. 'lib/http_response.php';
	require_once FCPATH. 'lib/LocalEnv.php';
	require_once FCPATH. 'lib/ADOdb.php';
	require_once FCPATH. 'lib/AntiXSS.php';

	$contentType = @$_SERVER["CONTENT_TYPE"];
	if ($contentType == "application/json") {
		header('Content-Type:application/json; charset=utf-8');
		$contens = file_get_contents('php://input');
		$_POST = json_decode($contens, true);
	}

	if(!isset($_SERVER['SERVER_NAME'])){
		$_SERVER['SERVER_NAME'] = LocalEnv::$server_name;
		$_SERVER['SERVER_PORT'] = LocalEnv::$server_port;
	}

	$method = $_SERVER['REQUEST_METHOD'];
    if($method != "POST") {
        throw new Exception("No dispone de permisos para acceder por medio del metodo solicitado http", 405);
    }
	
	LocalEnv::Init();
	ADOdb::Connect();
} catch (Exception $err) {
	echo json_encode(array(
		"success" => false,
		"error" => $err->getMessage() . ', ' . $err->getLine()
	));
	http_response_code(401);
	exit();
}
