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
            default:
                return '';
                break;
        }
    }

    public function tipoDocumentoDetalle($tipdoc){
        switch ($tipdoc) {
            case '1':
                return 'CC';
                break;
            case '2':
                return 'TI';
                break;
            case '4':
                return 'CE';
                break;
            case '5':
                return 'NUIP';
                break;
            case '6':
                return 'PA';
                break;
            default:
                return 'CC';
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
