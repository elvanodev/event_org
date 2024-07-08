<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : kecamatan
 * di Buat oleh Diar PHP Generator */

class modelkecamatan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListkecamatan() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx" . ",kode_kecamatan" .
                ",kecamatan" .
                ",idkabupaten" .
                ",idprovinsi" .
                " FROM kecamatan   order by kecamatan ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--kecamatan--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kecamatan;
        }
        return $xBuffResul;
    }

    function getListkecamatan($xAwal, $xLimit, $xSearch = '') {
        if (!empty($xSearch)) {
            $xSearch = "Where idx like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx" .
                ",kode_kecamatan" .
                ",kecamatan" .
                ",idkabupaten" .
                ",idprovinsi" .
                " FROM kecamatan $xSearch order by kode_kecamatan ASC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailkecamatan($xidx) {
        $xStr = "SELECT " .
                "idx" .
                ",kode_kecamatan" .
                ",kecamatan" .
                ",idkabupaten" .
                ",idprovinsi" .
                " FROM kecamatan  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexkecamatan() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx" .
                ",kode_kecamatan" .
                ",kecamatan" .
                ",idkabupaten" .
                ",idprovinsi" .
                " FROM kecamatan order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertkecamatan($xidx, $xkode_kecamatan, $xkecamatan, $xidkabupaten, $xidprovinsi) {
        $xStr = " INSERT INTO kecamatan( " .
                "idx" .
                ",kode_kecamatan" .
                ",kecamatan" .
                ",idkabupaten" .
                ",idprovinsi" .
                ") VALUES('" . $xidx . "','" . $xkode_kecamatan . "','" . $xkecamatan . "','" . $xidkabupaten . "','" . $xidprovinsi . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatekecamatan($xidx, $xkode_kecamatan, $xkecamatan, $xidkabupaten, $xidprovinsi) {
        $xStr = " UPDATE kecamatan SET " .
                "idx='" . $xidx . "'" .
                ",kode_kecamatan='" . $xkode_kecamatan . "'" .
                ",kecamatan='" . $xkecamatan . "'" .
                ",idkabupaten='" . $xidkabupaten . "'" .
                ",idprovinsi='" . $xidprovinsi . "'" .
                "WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletekecamatan($xidx) {
        $xStr = " DELETE FROM kecamatan WHERE kecamatan.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $this->setInsertLogDeletekecamatan($xidx);
    }

    function setInsertLogDeletekecamatan($xidx) {
        $xidpegawai = $this->session->userdata('idpegawai');
        $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'kecamatan',now(),$xidpegawai)";
        $query = $this->db->query($xStr);
    }
    function getListkecamatanbykabupaten($idkabupaten){
        $xBuffResul = array();
        if (!empty($idkabupaten)) {
            $xSearch = "Where idkabupaten ='" . $idkabupaten . "'";
        }else $xSearch='';
        $xStr = "SELECT " .
                "idx" .
                ",kode_kecamatan" .
                ",kecamatan" .
                ",idkabupaten" .
                ",idprovinsi" .
                " FROM kecamatan $xSearch order by kecamatan ASC" ;
//        echo $xStr;
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--kecamatan--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kecamatan;
        }
        return $xBuffResul;
    }
}
