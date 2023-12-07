<?php
define('SEPARATOR', '/');
define('FCPATH', __DIR__ . SEPARATOR);

ini_set("upload_max_filesize", "6M");
ini_set('display_errors', true);

error_reporting(E_ALL);
setlocale(LC_ALL, "es_CO");

date_default_timezone_set('America/Bogota');

require_once FCPATH . 'lib/LocalEnv.php';
require_once FCPATH . 'lib/nusoap.php';
require_once FCPATH . 'services/AfiliadosServices.php';

LocalEnv::Init();
$_SERVER['SERVER_NAME'] = LocalEnv::$server_name;
$_SERVER['SERVER_PORT'] = LocalEnv::$server_port;

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

