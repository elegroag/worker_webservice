<?php
define('SEPARATOR', '/');
define('FCPATH', __DIR__ . SEPARATOR);

require_once FCPATH . 'lib/init.php';
require_once FCPATH . 'lib/nusoap.php';

$soapclient = new nusoap_client("http://".LocalEnv::$server_name.':'.LocalEnv::$server_port."/WebServiceNuevo/ConsultarAfiliado.php?wsdl", true);

$error = $soapclient->getError();

if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}

try {
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != "POST") {
        throw new Exception("No dispone de permisos para acceder por medio del metodo solicitado http", 405);
    }

    if(isset($_POST)){
        if(isset($_POST['TipoIdentificacion']) && isset($_POST['NumeroIdentificacion']) && isset($_POST['TipoAfiliado'])){
            $salida = $soapclient->call(
            "ConsultarAfiliado",
            array(
                "TipoIdentificacion" => strval($_POST['TipoIdentificacion']),
                "NumeroIdentificacion"=> strval($_POST['NumeroIdentificacion']),
                "CodigoCaja"=> '13',
                "TipoAfiliado"=> strval($_POST['TipoAfiliado'])
            ));  
        } else {
            throw new Exception('Error se requiere de los parametros TipoIdentificacion:char(2), NumeroIdentificacion:char(18), CodigoCaja:char(2), TipoAfiliado:char(1)', 406);
        }
    } else {
        throw new Exception("Error se requiere de los parametros metodo POST", 406);
    }

	if(count($salida) == 0){
		$data = array(
			'message' => 'Consulta realizada con éxito, no hay registros disponibles con los criterios de busqueda indicados',
			'response' => $salida
		);
	} else {
		$data = array(
			'message' => 'Consulta realizada con éxito',
			'response' => $salida
		);
	}
    echo json_encode($data);
    
} catch (Exception $err) {

    echo json_encode(array(
        "message" => $err->getMessage(),
        "success" =>  false
    ));
    $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');    
    header($protocol . ' ' . $err->getCode() . ' ' . "Method Not Allowed");
}