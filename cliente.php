<?php
define('SEPARATOR', '/');
define('FCPATH', __DIR__ . SEPARATOR);
require_once FCPATH . 'lib/init.php';
require_once FCPATH . 'lib/nusoap.php';

try {
    $soapclient = new nusoap_client(
        "http://".LocalEnv::$server_private."/WebServiceNuevo/ConsultarAfiliado.php?wsdl", 
        true
    );

    $error = $soapclient->getError();
    if ($error) {
        throw new Exception($error, 404);
    }

    if(isset($_POST)){
        if(isset($_POST['TipoIdentificacion']) && isset($_POST['NumeroIdentificacion']) && isset($_POST['TipoAfiliado'])){
            $salida = $soapclient->call(
            "ConsultarAfiliado",
            array(
                "TipoIdentificacion" => $_POST['TipoIdentificacion'],
                "NumeroIdentificacion"=> $_POST['NumeroIdentificacion'],
                "CodigoCaja"=> $_POST['CodigoCaja'],
                "TipoAfiliado"=> $_POST['TipoAfiliado']
            ));
        } else {
            throw new Exception('Error se requiere de los parametros TipoIdentificacion:char(3), NumeroIdentificacion:char(18), CodigoCaja:char(2), TipoAfiliado:char(1)', 406);
        }
    } else {
        throw new Exception("Error se requiere de los parametros metodo POST", 406);
    }
    $error = $soapclient->getError();
    if ($error) {
        throw new Exception($error, 501);
    }

	if(count($salida) == 0 && $salida !== false){
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
    
} catch (Exception $_err) {

    echo json_encode(array(
        "message" => $_err->getMessage(),
        "success" =>  false,
        "line" =>  $_err->getLine(),
        "file" =>  $_err->getFile(),
    ));
    $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');    
    header($protocol . ' ' . $_err->getCode() . ' ' . "Method Not Allowed");
}