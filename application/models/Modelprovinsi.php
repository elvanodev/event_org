<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : provinsi
 * di Buat oleh Diar PHP Generator */

class modelprovinsi extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListprovinsi() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx" . ",kode_provinsi" .
                ",provinsi" .
                " FROM provinsi   order by provinsi ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[null] = '-';
        foreach ($query->result() as $row) {
            //$xBuffResul[$row->kode_provinsi] = $row->provinsi;
            $xBuffResul[$row->idx] = $row->provinsi;
        }
        return $xBuffResul;
    }

    function getListprovinsi($xAwal, $xLimit, $xSearch = '') {
        if (!empty($xSearch)) {
            $xSearch = "Where idx like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx" .
                ",kode_provinsi" .
                ",provinsi" .
                " FROM provinsi $xSearch order by kode_provinsi ASC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailprovinsi($xidx) {
        $xStr = "SELECT " .
                "idx" .
                ",kode_provinsi" .
                ",provinsi" .
                " FROM provinsi  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexprovinsi() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx" .
                ",kode_provinsi" .
                ",provinsi" .
                " FROM provinsi order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertprovinsi($xidx, $xkode_provinsi, $xprovinsi) {
        $xStr = " INSERT INTO provinsi( " .
                "idx" .
                ",kode_provinsi" .
                ",provinsi" .
                ") VALUES('" . $xidx . "','" . $xkode_provinsi . "','" . $xprovinsi . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateprovinsi($xidx, $xkode_provinsi, $xprovinsi) {
        $xStr = " UPDATE provinsi SET " .
                "idx='" . $xidx . "'" .
                ",kode_provinsi='" . $xkode_provinsi . "'" .
                ",provinsi='" . $xprovinsi . "'" .
                "WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteprovinsi($xidx) {
        $xStr = " DELETE FROM provinsi WHERE provinsi.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $this->setInsertLogDeleteprovinsi($xidx);
    }

    function setInsertLogDeleteprovinsi($xidx) {
        $xidpegawai = $this->session->userdata('idpegawai');
        $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'provinsi',now(),$xidpegawai)";
        $query = $this->db->query($xStr);
    }

}
