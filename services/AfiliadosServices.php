<?php 
require_once FCPATH . 'services/AbsServices.php';

class AfiliadosServices extends AbsServices
{

    protected $trabajador;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function findTrabajador($cedtra, $tipdoc) {
        $coddoc = $this->coddocDetalleToCode($tipdoc);
        $sql = "SELECT 
        cedtra,
        coddoc,
        priape, 
        segape, 
        prinom, 
        segnom,
        fecafi,
        estado,
        codcat,
        coddoc,
        fecnac 
        FROM subsi15 WHERE cedtra='{$cedtra}' and coddoc='{$coddoc}' LIMIT 1";
        $msubsi15 = $this->db->execute($sql);

        $trabajador = array();
        while (!$msubsi15->EOF) 
        {
            $trabajador = array(
                'cedula' => trim($msubsi15->fields["cedtra"]),
                'prinom' => trim($msubsi15->fields['prinom']),
                'segnom' => trim($msubsi15->fields['segnom']),
                'priape' => trim($msubsi15->fields['priape']),
                'segape' => trim($msubsi15->fields['segape']),
                'fecafi' => trim($msubsi15->fields["fecafi"]),
                'estado' => trim($msubsi15->fields["estado"]),
                'codcat' => trim($msubsi15->fields['codcat']),
                'coddoc' => trim($msubsi15->fields['coddoc']),
                'fecnac' => trim($msubsi15->fields['fecnac']),
            );

            $this->Info("T", $trabajador['codcat'], $trabajador);
            $this->findConyugesByTrabaja($trabajador);
            $this->findBenefiTrabaja($trabajador);
            $msubsi15->MoveNext();
        }
    }

    public function findConyugesByTrabaja($trabajador)
    {
        $cedtra = $trabajador['cedula'];
        $codcat = $trabajador['codcat'];
        $sql = "SELECT subsi20.*, subsi21.fecafi 
        FROM subsi20 
        INNER JOIN subsi21 ON subsi21.cedcon = subsi20.cedcon 
        WHERE subsi21.cedtra='{$cedtra}' AND 
        subsi21.comper='S'";
        
        $msubsi21 = $this->db->execute($sql);
        while (!$msubsi21->EOF) 
        {
            $conyuge = array(
                'cedula' => trim($msubsi21->fields["cedcon"]),
                'prinom' => trim($msubsi21->fields['prinom']),
                'segnom' => trim($msubsi21->fields['segnom']),
                'priape' => trim($msubsi21->fields['priape']),
                'segape' => trim($msubsi21->fields['segape']),
                'fecafi' => trim($msubsi21->fields["fecafi"]),
                'estado' => trim($msubsi21->fields["estado"]),
                'codcat' => $codcat,
                'coddoc' => trim($msubsi21->fields['coddoc']),
                'fecnac' => trim($msubsi21->fields['fecnac'])
            );
            $this->Info("B", $codcat, $conyuge);
            $msubsi21->MoveNext();
        }
    }

    public function findBenefiTrabaja($trabajador)
    {
        $cedtra = $trabajador['cedula'];
        $codcat = $trabajador['codcat'];
        $sql = "SELECT 
            subsi22.*, subsi23.fecafi 
            FROM subsi22
            INNER JOIN subsi23 ON subsi23.codben = subsi22.codben 
            WHERE subsi23.cedtra='{$cedtra}';
        ";
        $msubsi22 = $this->db->execute($sql);
        while (!$msubsi22->EOF) 
        {
            $beneficiario = array(
                'cedula' => trim($msubsi22->fields["documento"]),
                'prinom' => trim($msubsi22->fields['prinom']),
                'segnom' => trim($msubsi22->fields['segnom']),
                'priape' => trim($msubsi22->fields['priape']),
                'segape' => trim($msubsi22->fields['segape']),
                'fecafi' => trim($msubsi22->fields["fecafi"]),
                'estado' => trim($msubsi22->fields["estado"]),
                'fecest' => trim($msubsi22->fields['fecest']),
                'codcat' => $codcat,
                'coddoc' => trim($msubsi22->fields['coddoc']),
                'fecnac' => trim($msubsi22->fields['fecnac']),
            );
            $this->Info("B", $codcat, $beneficiario);
            $msubsi22->MoveNext();
        }
    }

    public function Info($tipo = '', $codcat = '', $msubsi = '')
    {
        $minfo = array(
            "TipoIdentificacion" => $this->tipoDocumentoDetalle($msubsi['coddoc']),
            "NumeroIdentificacion" => "{$msubsi['cedula']}",
            "PrimerApellido" => $msubsi['priape'],
            "SegundoApellido" => $msubsi['segape'],
            "PrimerNombre" => $msubsi['prinom'],
            "SegundoNombre" => $msubsi['segnom'],
            "FechaNacimiento" => $msubsi['fecnac'],
            "Categoria" => $codcat,
            "Estado" => $this->estadoDetalle($msubsi['estado']),
            "TipoAfiliado" => $tipo
        );
        $this->infoData[] = $minfo;
    }

}