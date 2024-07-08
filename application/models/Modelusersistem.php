<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : usersistem
 * di Buat oleh Diar PHP Generator
 * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelusersistem extends CI_Model {

    function __construct() {
        parent::__construct();
    }
function getDataLogin($xUser, $xPassword) {
     $xStr=   "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp" .
                " FROM usersistem WHERE user = '" . addslashes($xUser) . "' and password = '" . addslashes($xPassword) . "'";
        //echo $xStr;
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }
    
    function getArrayListusersistem() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp" .
                " FROM usersistem   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->npp;
        }
        return $xBuffResul;
    }

    function getListusersistem($xAwal, $xLimit, $xSearch='') {
        if (!empty($xSearch)) {
            $xSearch = "Where npp like '%" . $xSearch . "%'";
        }
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp" .
                " FROM usersistem $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getDetailusersistem($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp" .
                " FROM usersistem  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getDetailusersistembyime($xime) {
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp" .
                " FROM usersistem  WHERE imehp = '" . $xime . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }
    
    function getLastIndexusersistem() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp" .
                " FROM usersistem order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertusersistem($xidx, $xnpp, $xNama, $xalamat, $xNoTelpon, $xuser, 
            $xpassword, $xstatuspeg, $xphoto, $xemail, $xym, 
            $xisaktif, $xidusergroup,$xidkabupaten,$xidpropinsi,$ximehp) {
        $xStr = " INSERT INTO usersistem( " .
                "idx," .
                "npp," .
                "Nama," .
                "alamat," .
                "NoTelpon," .
                "user," .
                "password," .
                "statuspeg," .
                "photo," .
                "email," .
                "ym," .
                "isaktif," .
                "idusergroup,idkabupaten,idpropinsi,imehp) VALUES('" . $xidx . "','" . $xnpp . "','" . $xNama . "','" . $xalamat . "','" . $xNoTelpon . "','" . $xuser . "','" . $xpassword . "','" . 
                                  $xstatuspeg . "','" . $xphoto . "','" . $xemail . "','" . $xym . "','" .
                $xisaktif . "','" . $xidusergroup . "','".$xidkabupaten."','".$xidpropinsi."','".$ximehp."')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdateusersistem($xidx, $xnpp, $xNama, $xalamat, $xNoTelpon, $xuser, $xpassword, 
            $xstatuspeg, $xphoto, $xemail, $xym, $xisaktif, $xidusergroup,$xidkabupaten,$xidpropinsi,$ximehp) {
        $xStr = " UPDATE usersistem SET " .
                "idx='" . $xidx . "'," .
                "npp='" . $xnpp . "'," .
                "Nama='" . $xNama . "'," .
                "alamat='" . $xalamat . "'," .
                "NoTelpon='" . $xNoTelpon . "'," .
                "user='" . $xuser . "'," .
                "password='" . $xpassword . "'," .
                "statuspeg='" . $xstatuspeg . "'," .
                "photo='" . $xphoto . "'," .
                "email='" . $xemail . "'," .
                "ym='" . $xym . "'," .
                "isaktif='" . $xisaktif . "'," .
                "idkabupaten='" . $xidkabupaten . "'," .
                "idpropinsi='" . $xidpropinsi . "'," .
                "imehp='".$ximehp."',".
                "idusergroup='" . $xidusergroup . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    function setDeleteusersistem($xidx) {
        $xStr = " DELETE FROM usersistem WHERE usersistem.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }

}

?>