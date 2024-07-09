<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : kabupaten
 * di Buat oleh Diar PHP Generator */

class modelkabupaten extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListkabupaten() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx" . ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                " FROM kabupaten   order by kabupaten ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--kabupaten--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kabupaten;
        }
        return $xBuffResul;
    }
    function getArrayListkabupatenkota() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "kabupaten.idx" . ",kode_kabupaten" .
                ",kabupaten" .
                ",kabupaten.idprovinsi " .
                " FROM kabupaten group by kabupaten.idx order by kabupaten.idx ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--kabupaten--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kabupaten;
        }
        return $xBuffResul;
    }

    function getListkabupaten($xAwal, $xLimit, $xSearch = '') {
        if (!empty($xSearch)) {
            $xSearch = "Where idx like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx" .
                ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                " FROM kabupaten $xSearch order by kode_kabupaten ASC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }
    function getListkabupatenbyprovinsi($idprovinsi) {
        $xBuffResul = array();
        $xSearch ='';
        if (!empty($idprovinsi)) {
            $xSearch = "Where idprovinsi ='" . $idprovinsi . "'";
        }
        $xStr = "SELECT " .
                "idx" .
                ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                " FROM kabupaten $xSearch order by kabupaten ASC" ;
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--kabupaten--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kabupaten;
        }
        return $xBuffResul;
    }

    function getDetailkabupaten($xidx) {
        $xStr = "SELECT " .
                "idx" .
                ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                " FROM kabupaten  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }
    function getDetailkabupatenbykode($xidx) {
        $xStr = "SELECT " .
                "idx" .
                ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                " FROM kabupaten  WHERE kode_kabupaten = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexkabupaten() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx" .
                ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                " FROM kabupaten order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertkabupaten($xidx, $xkode_kabupaten, $xkabupaten, $xidprovinsi) {
        $xStr = " INSERT INTO kabupaten( " .
                "idx" .
                ",kode_kabupaten" .
                ",kabupaten" .
                ",idprovinsi" .
                ") VALUES('" . $xidx . "','" . $xkode_kabupaten . "','" . $xkabupaten . "','" . $xidprovinsi . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatekabupaten($xidx, $xkode_kabupaten, $xkabupaten, $xidprovinsi) {
        $xStr = " UPDATE kabupaten SET " .
                "idx='" . $xidx . "'" .
                ",kode_kabupaten='" . $xkode_kabupaten . "'" .
                ",kabupaten='" . $xkabupaten . "'" .
                ",idprovinsi='" . $xidprovinsi . "'" .
                "WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletekabupaten($xidx) {
        $xStr = " DELETE FROM kabupaten WHERE kabupaten.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $this->setInsertLogDeletekabupaten($xidx);
    }

    function setInsertLogDeletekabupaten($xidx) {
        $xidpegawai = $this->session->userdata('idpegawai');
        $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'kabupaten',now(),$xidpegawai)";
        $query = $this->db->query($xStr);
    }

}
