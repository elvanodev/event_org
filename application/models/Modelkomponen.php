<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : komponen
 * di Buat oleh Diar PHP Generator
 * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelkomponen extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListkomponen() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idkomponen," .
                "NmKomponen," .
                "isshow" .
                " FROM komponen   order by idkomponen ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul['0'] = '-';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idkomponen] = $row->NmKomponen;
        }
        return $xBuffResul;
    }

    function getListkomponen($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where NmKomponen like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idkomponen," .
                "NmKomponen," .
                "isshow" .
                " FROM komponen $xSearch order by idkomponen DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailkomponen($xidkomponen) {
        $xStr = "SELECT " .
                "idkomponen," .
                "NmKomponen," .
                "isshow" .
                " FROM komponen  WHERE idkomponen = '" . $xidkomponen . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexkomponen() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idkomponen," .
                "NmKomponen," .
                "isshow" .
                " FROM komponen order by idkomponen DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertkomponen($xidkomponen, $xNmKomponen, $xisshow) {
        $xStr = " INSERT INTO komponen( " .
                "idkomponen," .
                "NmKomponen," .
                "isshow) VALUES('" . $xidkomponen . "','" . $xNmKomponen . "','" . $xisshow . "')";
        $query = $this->db->query($xStr);
        return $xidkomponen;
    }

    Function setUpdatekomponen($xidkomponen, $xNmKomponen, $xisshow) {
        $xStr = " UPDATE komponen SET " .
                "idkomponen='" . $xidkomponen . "'," .
                "NmKomponen='" . $xNmKomponen . "'," .
                "isshow='" . $xisshow . "' WHERE idkomponen = '" . $xidkomponen . "'";
        $query = $this->db->query($xStr);
        return $xidkomponen;
    }

    function setDeletekomponen($xidkomponen) {
        $xStr = " DELETE FROM komponen WHERE komponen.idkomponen = '" . $xidkomponen . "'";

        $query = $this->db->query($xStr);
    }

}

?>