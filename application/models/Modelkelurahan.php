<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : kelurahan
 * di Buat oleh Diar PHP Generator */

class modelkelurahan extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListkelurahan() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx" . ",kode_kelurahan" .
                ",idkecamatan" .
                ",kelurahan" .
                " FROM kelurahan   order by kelurahan ASC ";
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--Kelurahan--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kelurahan;
        }
        return $xBuffResul;
    }

    function getListkelurahan($xAwal, $xLimit, $xSearch = '') {
        if (!empty($xSearch)) {
            $xSearch = "Where idx like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx" .
                ",kode_kelurahan" .
                ",idkecamatan" .
                ",kelurahan" .
                " FROM kelurahan $xSearch order by kode_kelurahan ASC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailkelurahan($xidx) {
        $xStr = "SELECT " .
                "idx" .
                ",kode_kelurahan" .
                ",idkecamatan" .
                ",kelurahan" .
                " FROM kelurahan  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexkelurahan() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx" .
                ",kode_kelurahan" .
                ",idkecamatan" .
                ",kelurahan" .
                " FROM kelurahan order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertkelurahan($xidx, $xkode_kelurahan, $xidkecamatan, $xkelurahan) {
        $xStr = " INSERT INTO kelurahan( " .
                "idx" .
                ",kode_kelurahan" .
                ",idkecamatan" .
                ",kelurahan" .
                ") VALUES('" . $xidx . "','" . $xkode_kelurahan . "','" . $xidkecamatan . "','" . $xkelurahan . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatekelurahan($xidx, $xkode_kelurahan, $xidkecamatan, $xkelurahan) {
        $xStr = " UPDATE kelurahan SET " .
                "idx='" . $xidx . "'" .
                ",kode_kelurahan='" . $xkode_kelurahan . "'" .
                ",idkecamatan='" . $xidkecamatan . "'" .
                ",kelurahan='" . $xkelurahan . "'" .
                "WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeletekelurahan($xidx) {
        $xStr = " DELETE FROM kelurahan WHERE kelurahan.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $this->setInsertLogDeletekelurahan($xidx);
    }

    function setInsertLogDeletekelurahan($xidx) {
        $xidpegawai = $this->session->userdata('idpegawai');
        $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'kelurahan',now(),$xidpegawai)";
        $query = $this->db->query($xStr);
    }
    function getListkelurahanbykecamatan($xidkecamatan){
        $xBuffResul = array();
        if (!empty($xidkecamatan)) {
            $xSearch = "Where idkecamatan ='" . $xidkecamatan . "'";
        }else $xSearch='';
        $xStr = "SELECT " .
                 "idx" .
                ",kode_kelurahan" .
                ",idkecamatan" .
                ",kelurahan" .
                " FROM kelurahan $xSearch order by kelurahan ASC" ;
//        echo $xStr;
        $query = $this->db->query($xStr);
        $xBuffResul[0] = '--kelurahan--';
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->kelurahan;
        }
        return $xBuffResul;
    }
}
