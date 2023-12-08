<?php
define('SEPARATOR', '/');
define('FCPATH', __DIR__ . SEPARATOR);

error_reporting(E_ALL & ~E_NOTICE);
ini_set("upload_max_filesize", "20M");
ini_set('display_errors', 1);
date_default_timezone_set('America/Bogota');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, X-POST, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

require_once FCPATH . 'lib/LocalEnv.php';
require_once FCPATH . 'lib/nusoap.php';
require_once FCPATH . 'services/AfiliadosServices.php';
LocalEnv::Init();

if(!isset($_SERVER['SERVER_NAME'])){
	$_SERVER['SERVER_NAME'] = LocalEnv::$server_name;
	$_SERVER['SERVER_PORT'] = LocalEnv::$server_port;
}

$rawPost = strcasecmp($_SERVER['REQUEST_METHOD'], "POST") == 0 ? (isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input")) : NULL;

$server = new soap_server;
$server->configureWSDL('ServicioAfiliado', 'urn:ServicioAfiliado');

$server->wsdl->addComplexType(
	'ConsultarAfiliado',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'TipoIdentificacion' => array('name' => 'TipoIdentificacion', 'type' => 'xsd:string'),
		'NumeroIdentificacion' => array('name' => 'NumeroIdentificacion', 'type' => 'xsd:string'),
		'PrimerApellido' => array('name' => 'PrimerApellido', 'type' => 'xsd:string'),
		'SegundoApellido' => array('name' => 'SegundoApellido', 'type' => 'xsd:string'),
		'PrimerNombre' => array('name' => 'PrimerNombre', 'type' => 'xsd:string'),
		'SegundoNombre' => array('name' => 'SegundoNombre', 'type' => 'xsd:string'),
		'FechaNacimiento' => array('name' => 'FechaNacimiento', 'type' => 'xsd:string'),
		'Categoria' => array('name' => 'Categoria', 'type' => 'xsd:string'),
		'Estado' => array('name' => 'Estado', 'type' => 'xsd:string'),
		'TipoAfiliado' => array('name' => 'TipoAfiliado', 'type' => 'xsd:string'),
	)
);
$server->wsdl->addComplexType(
	'ConsultarAfiliadoList',
	'complexType',
	'array',
	'',
	'SOAP-ENC:Array',
	array(),
	array(
		array('ref' => 'SOAP-ENC:arrayType', 'wsdl:arrayType' => 'tns:ConsultarAfiliado[]')
	),
	'tns:ConsultarAfiliado'
);

$server->register("ConsultarAfiliado", 
	array(
		"TipoIdentificacion" => "xsd:string",
		"NumeroIdentificacion" => "xsd:string",		
		"TipoAfiliado" => "xsd:string",
		"CodigoCaja" => "xsd:string",
	),
	array('return' => 'tns:ConsultarAfiliadoList'),
	"urn:ServicioAfiliado",
	"urn:ServicioAfiliado#ConsultarAfiliado",
	"rpc",
	"encoded",
	"Regresa la informacion del nucleo"
);

$server->service($rawPost);

function ConsultarAfiliado($TipoIdentificacion, $NumeroIdentificacion, $TipoAfiliado, $CodigoCaja)
{
	$NumeroIdentificacion = filter_var($NumeroIdentificacion, FILTER_SANITIZE_NUMBER_INT);
	
	$TipoIdentificacion = filter_var($TipoIdentificacion, FILTER_CALLBACK, array("options" => function($value){
		return str_replace('  ','',str_replace(array('.',',',';','(',')','|','+','-','$','&','#','@','  ',"\n")," ", $value));
	}));
	
	$CodigoCaja = filter_var($CodigoCaja, FILTER_SANITIZE_NUMBER_INT);
	
	$TipoAfiliado = filter_var($TipoAfiliado, FILTER_CALLBACK, array("options" => function($value){
		return str_replace('  ','',str_replace(array('.',',',';','(',')','|','+','-','$','&','#','@','  ',"\n")," ", $value));
	}));

	if($CodigoCaja != '13'){
		return false;
	}

	$afiliadosServices = new AfiliadosServices();
	switch ($TipoAfiliado) {
		case 'T':
			$afiliadosServices->findTrabajador($NumeroIdentificacion, $TipoIdentificacion);
			break;
		case 'B':
			$afiliadosServices->findBeneficiario($NumeroIdentificacion, $TipoIdentificacion);
			break;
		case 'C':
			$afiliadosServices->findConyuge($NumeroIdentificacion, $TipoIdentificacion);
			break;
		case 'I':
			$afiliadosServices->findTrabajador($NumeroIdentificacion, $TipoIdentificacion);
			break;
		case 'P':
			$afiliadosServices->findTrabajador($NumeroIdentificacion, $TipoIdentificacion);
			break;
		default:
		break;
	}
	return $afiliadosServices->getInfoData();
}

