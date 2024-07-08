<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : usergroup
 * di Buat oleh Diar PHP Generator
 * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelusergroup extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListusergroup() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "NmUserGroup" .
                " FROM usergroup   order by idx ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul['0'] = '-';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->NmUserGroup;
        }
        return $xBuffResul;
    }

    function getListusergroup($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where NmUserGroup like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "NmUserGroup" .
                " FROM usergroup $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailusergroup($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "NmUserGroup" .
                " FROM usergroup  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexusergroup() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "NmUserGroup" .
                " FROM usergroup order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertusergroup($xidx, $xNmUserGroup) {
        $xStr = " INSERT INTO usergroup( " .
                "idx," .
                "NmUserGroup) VALUES('" . $xidx . "','" . $xNmUserGroup . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateusergroup($xidx, $xNmUserGroup) {
        $xStr = " UPDATE usergroup SET " .
                "idx='" . $xidx . "'," .
                "NmUserGroup='" . $xNmUserGroup . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteusergroup($xidx) {
        $xStr = " DELETE FROM usergroup WHERE usergroup.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>