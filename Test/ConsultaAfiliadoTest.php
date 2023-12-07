<?php 
require_once FCPATH . 'lib/PHPUnit/PHPUnitTestCase.php';
require_once FCPATH . 'services/AfiliadosServices.php';

class ConsultaAfiliadoTest extends PHPUnitTestCase
{
    public function __construct() {
    } 

    public function testBuscarConyuge() {
        $this->dumper("Buscar conyuges");
    }

    public function testBuscarTrabajador() {
        $afiliadosServices = new AfiliadosServices();
        $afiliadosServices->findTrabajador(1110491951, 'CC');
        $data = $afiliadosServices->getInfoData();
        $this->dumper($data);
        $this->assertTrue(is_array($data));
    }
}