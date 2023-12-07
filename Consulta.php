<?php
date_default_timezone_set('America/Bogota');
require_once('lib/nusoap.php');

$rawPost = strcasecmp($_SERVER['REQUEST_METHOD'], "POST") == 0 ? (isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input")) : NULL;

$_SERVER['SERVER_NAME'] = LocalEnv::$server_name;
$_SERVER['SERVER_PORT'] = LocalEnv::$server_port;

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
		"CodigoCaja" => "xsd:string",
		"TipoAfiliado" => "xsd:string"
	),
	array('return' => 'tns:ConsultarAfiliadoList'),
	"urn:ServicioAfiliado",
	"urn:ServicioAfiliado#ConsultarAfiliado",
	"rpc",
	"encoded",
	"Regresa la informacion del nucleo"
);

$server->service($rawPost);

function ConsultarAfiliado($TipoIdentificacion = '', $NumeroIdentificacion = '', $CodigoCaja, $TipoAfiliado)
{
	$tipide = $TipoIdentificacion;
	$cedtra = $NumeroIdentificacion;
	$codcaj = $CodigoCaja;
	$tipafi = $TipoAfiliado;
	$encod = "utf-8";
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "Sys2020*";
	$db = "comfaca";
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	mysql_select_db($db, $conn);
	$info = array();

	if ($tipafi == 'T') {
		$sql = "SELECT * FROM subsi15 WHERE cedtra='$cedtra'";
		$result = mysql_query($sql);
		while ($msubsi15 = mysql_fetch_array($result)) {
			$x = "";
			foreach ($msubsi15 as $key => $value) {
				$x[strtolower($key)] = trim($value);
			}
			$msubsi15 = $x;
			info("T", $msubsi15['codcat'], $msubsi15, $info);
			sub20($msubsi15, $info);
			sub22($msubsi15, $info);
		}
	} else {
		sub20($cedtra, $info);
		sub22($cedtra, $info);
	}
	return $info;
}

function info($tipo = '', $codcat = '', $msubsi = '', &$info)
{
	if ($msubsi['coddoc'] == "1") {
		$tipide = 'CC';
	} elseif ($msubsi['coddoc'] == '2') {
		$tipide = 'TI';
	} elseif ($msubsi['coddoc'] == '4') {
		$tipide = 'CE';
	} elseif ($msubsi['coddoc'] == '5') {
		$tipide = 'NUIP';
	} elseif ($msubsi['coddoc'] == '6') {
		$tipide = 'PA';
	} else {
		$tipide = 'CC';
	}
	if (isset($msubsi['cedtra'])) $doc = $msubsi['cedtra'];
	if (isset($msubsi['cedcon'])) $doc = $msubsi['cedcon'];
	if (isset($msubsi['documento'])) $doc = $msubsi['documento'];
	$minfo = array(
		"TipoIdentificacion" => $tipide,
		"NumeroIdentificacion" => $doc,
		"PrimerApellido" => $msubsi['priape'],
		"SegundoApellido" => $msubsi['segape'],
		"PrimerNombre" => $msubsi['prinom'],
		"SegundoNombre" => $msubsi['segnom'],
		"FechaNacimiento" => $msubsi['fecnac'],
		"Categoria" => $codcat,
		"Estado" => $msubsi['estado'],
		"TipoAfiliado" => $tipo
	);
	$info[] = $minfo;
}

function sub20($msubsi, &$info)
{
	if (is_array($msubsi) && isset($msubsi['cedtra'])) {
		$sql = "SELECT cedcon FROM subsi21 WHERE cedtra='{$msubsi['cedtra']}' AND comper='S'";
		$codcat = $msubsi['codcat'];
	} else {
		$sql = "SELECT cedtra,cedcon FROM subsi21 WHERE cedcon='$msubsi' AND comper='S'";
	}
	$result2 = mysql_query($sql);
	while ($msubsi21 = mysql_fetch_array($result2)) {
		$x = "";
		foreach ($msubsi21 as $key => $value) {
			$x[strtolower($key)] = trim($value);
		}
		$msubsi21 = $x;
		if (!is_array($msubsi)) {
			$sql = "SELECT codcat FROM subsi15 WHERE cedtra='{$msubsi21['cedtra']}'";
			$result4 = mysql_query($sql);
			while ($msubsi15 = mysql_fetch_array($result4)) {
				$codcat = $msubsi15['codcat'];
			}
		}
		$sql = "SELECT * FROM subsi20 WHERE cedcon='{$msubsi21['cedcon']}'";
		$result3 = mysql_query($sql);
		while ($msubsi20 = mysql_fetch_array($result3)) {
			$x = "";
			foreach ($msubsi20 as $key => $value) {
				$x[strtolower($key)] = trim($value);
			}
			$msubsi20 = $x;
			info("B", $codcat, $msubsi20, $info);
		}
	}
}

function sub22($msubsi, &$info)
{
	if (is_array($msubsi) && isset($msubsi['cedtra'])) {
		$sql = "SELECT codben FROM subsi23 WHERE cedtra='{$msubsi['cedtra']}'";
		$codcat = $msubsi['codcat'];
	} else {
		$sql = "SELECT subsi23.cedtra,subsi23.codben FROM subsi22,subsi23 WHERE subsi22.codben=subsi23.codben AND subsi22.documento='$msubsi' limit 1";
	}
	$result2 = mysql_query($sql);
	while ($msubsi23 = mysql_fetch_array($result2)) {
		$x = "";
		foreach ($msubsi23 as $key => $value) {
			$x[strtolower($key)] = trim($value);
		}
		if (!is_array($msubsi)) {
			$sql = "SELECT codcat FROM subsi15 WHERE cedtra='{$msubsi23['cedtra']}'";
			$result4 = mysql_query($sql);
			while ($msubsi15 = mysql_fetch_array($result4)) {
				$codcat = $msubsi15['codcat'];
			}
		}
		$msubsi23 = $x;
		$sql = "SELECT * FROM subsi22 WHERE codben='{$msubsi23['codben']}'";
		$result3 = mysql_query($sql);
		while ($msubsi22 = mysql_fetch_array($result3)) {
			$x = "";
			foreach ($msubsi22 as $key => $value) {
				$x[strtolower($key)] = trim($value);
			}
			$msubsi22 = $x;
			info("B", $codcat, $msubsi22, $info);
		}
	}
}