<?php 
require_once FCPATH . 'lib/LocalEnv.php';
require_once FCPATH . 'lib/ADOdb.php';
require_once FCPATH . 'lib/AntiXSS.php';

abstract class AbsServices 
{

    protected $db;
    protected $infoData = array();
    public function __construct()
    {
        LocalEnv::Init();
        ADOdb::Connect();
        $this->db = ADOdb::$Db;
    }
    
    public abstract function Info();

    public function coddocDetalleToCode($coddoc){
        switch ($coddoc) {
            case 'CC':
                return '1';
                break;
            case 'TI':
                return '2';
                break;
            case 'CE':
                return '4';
                break;
            case 'NUIP':
                return '5';
                break;
            case 'PA':
                return '6';
                break;
            case 'RC':
                return '7';
                break;
            case 'PEP':
                return '8';
                break;
            case 'CB':
                return '9';
                break;
            case 'MTF':
                return '10';
                break;
            case 'CD':
                return '11';
                break;
            case 'ISE':
                return '12';
                break;
            case 'V':
                return '13';
                break;
            case 'PT':
                return '14';
                break;
            default:
                return '1';
                break;
        }
    }

    public function tipoDocumentoDetalle($tipdoc){
        switch ($tipdoc) {
            case '1':
                return 'CEDULA CIUDADANIA';
                break;
            case '2':
                return 'TARJETA IDENTIDAD';
                break;
            case '4':
                return 'CEDULA EXTRANJERIA';
                break;
            case '5':
                return 'NUIP';
                break;
            case '6':
                return 'PASAPORTE';
                break;
            case '7':
                return 'REGISTRO CIVIL';
                break;
            case '8':
                return 'PERMISO ESPECIAL DE PERMANENCIA';
                break;
            case '9':
                return 'CERTIFICADO CABILDO';
                break;
            case '10':
                return 'TARJETA DE MOVILIDAD FRONTERIZA';
                break;                
            case '11':
                return 'CARNET DIPLOMATICO';
                break;
            case '12':
                return 'ISE';
                break;
            case '13':
                return 'VISA';
                break;
            case '14':
                return 'PERMISO PROTECCIÓN TEMPORAL';
                break;
            default:
                return 'CEDULA';
                break;
        }
    }

    public function estadoDetalle($estado){
        switch ($estado) {
            case 'A':
                return 'ACTIVO';
                break;
            case 'I':
                return 'INACTIVO';
                break;
            case 'M':
                return 'MUERTO';
                break;
            default:
                return 'NO DEFINIDO';
                break;
        }
    }

    public function getInfoData(){
        return $this->infoData;
    }
}
