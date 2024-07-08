<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : content
 * di Buat oleh Diar PHP Generator
 * Update List untuk grid karena program generatorku lom sempurna ya hehehehehe */

class modelcontent extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getArrayListcontent() { /* spertinya perlu lock table */
        $xBuffResul = array();
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl, " .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content   order by idx ASC ";
        $query = $this->db->query($xStr);
        foreach ($query->result() as $row) {
            $xBuffResul[$row->idx] = $row->judul;
        }
        return $xBuffResul;
    }

    function getListcontent($xAwal, $xLimit, $xSearch = '',$xidmenu='') {
        if (!empty($xSearch)) {
            $xSearch = "Where ((judul like '%" . $xSearch . "%') or
                               (isi like '%" . $xSearch . "%') or 
                               (isiawal like '%" . $xSearch . "%') )
                        and (idmenu = '" . $xidmenu . "')";
        } else {
            $xSearch = "Where idmenu = '" . $xidmenu . "'";
        }
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content $xSearch order by urut ASC, idx DESC limit " . $xAwal . "," . $xLimit;
        //echo $xStr;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getListcontentdetail($xAwal, $xLimit,  $xSearch = '',$xidmenu='') {
        if (!empty($xSearch)) {
            $xSearch = "Where idx ='" . $xSearch . "' and (idmenu = '" . $xidmenu . "')";
        } else {
            $xSearch = "Where idmenu = '" . $xidmenu . "'";
        }
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content $xSearch order by urut ASC, idx DESC limit " . $xAwal . "," . $xLimit;
        //echo $xStr;
        $query = $this->db->query($xStr);
        return $query;
    }

    function getcountrowbyidmenu($xidmenu) {
      $xStr = "SELECT count(idx) jml " .
      " FROM content  WHERE idmenu = '" . $xidmenu . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row->jml;  
    }

    function getDetailcontent($xidx) {
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content  WHERE idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexcontent() { /* spertinya perlu lock table */
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    function getLastIndexcontentbyidmenu($xidmenu) {
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content Where idmenu = '" . $xidmenu . "' order by idx DESC limit 1 ";
        $query = $this->db->query($xStr);
        $row = $query->row();
        return $row;
    }

    Function setInsertcontent($xidx, $xjudul, $xisiawal, $xisi, $xidbahasa, $xidmenu, $xidkomponen, $xtanggal, $xjam, $xidadmin, $xurut, $ximage1, $ximage2, $ximage3) {
        $xStr = " INSERT INTO content( " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3) VALUES('" . $xidx . "','" . $xjudul . "','" . $xisiawal . "','" . $xisi . "','" . $xidbahasa .
                "','" . $xidmenu . "','" . $xidkomponen . "',current_date,current_time,'" . $xidadmin .
                "','" . $xurut . "','" . $ximage1 . "','" . $ximage2 . "','" . $ximage3 . "')";
        $query = $this->db->query($xStr);
        return $xidx;
    }

    Function setUpdatecontent($xidx, $xjudul, $xisiawal, $xisi, $xidbahasa, $xidmenu, $xidkomponen, $xtanggal, $xjam, $xidadmin, $xurut, $ximage1, $ximage2, $ximage3) {
        $xStr = " UPDATE content SET " .
                "idx='" . $xidx . "'," .
                "judul='" . $xjudul . "'," .
                "isiawal='" . $xisiawal . "'," .
                "isi='" . $xisi . "'," .
                "idbahasa='" . $xidbahasa . "'," .
                "idmenu='" . $xidmenu . "'," .
                "idkomponen='" . $xidkomponen . "'," .
                "tanggal=current_date," .
                "jam=current_time," .
                "idadmin='" . $xidadmin . "'," .
                "urut='" . $xurut . "'," .
                "image1='" . $ximage1 . "'," .
                "image2='" . $ximage2 . "'," .
                "image3='" . $ximage3 . "' WHERE idx = '" . $xidx . "'";
        $query = $this->db->query($xStr);
    }

    function setDeletecontent($xidx) {
        $xStr = " DELETE FROM content WHERE content.idx = '" . $xidx . "'";

        $query = $this->db->query($xStr);
    }
    
    function getlistTahun($xsearch=''){
       $xwhere =''; 
       if(!empty($xsearch)) 
       $xwhere  = ' WHERE judul like "%'.$xsearch.'%" or isi like "%'.$xsearch.'%"';
       
       $xStr = "SELECT Distinct year(tanggal) tahun " .
               " FROM content $xwhere order by tahun DESC";
       $query = $this->db->query($xStr);
     return $query;   
    }
    
    function getlistmenubytahun($tahun,$xsearch=''){
      $xwhere ='';  
      if(!empty($xsearch)) 
       $xwhere  = ' and (judul like "%'.$xsearch.'%" or isi like "%'.$xsearch.'%")';  
      
      $xStr = "SELECT Distinct idmenu " .
               " FROM content WHERE year(tanggal) ='".$tahun."' and idmenu in(24,25,28,29,30) $xwhere order by idmenu";  
       $query = $this->db->query($xStr);
     return $query;   
    }
   
    function getlistcontentbytahunidmenu($tahun,$idmenu,$xsearch=''){
       $xwhere ='';
        if(!empty($xsearch)) 
       $xwhere  = ' and (judul like "%'.$xsearch.'%" or isi like "%'.$xsearch.'%")';  
        
        $xStr = "SELECT " .
                "idx," .
                "judul," .
                "isiawal," .
                "isi," .
                "idbahasa," .
                "idmenu," .
                "idkomponen," .
                "tanggal,dayofweek(tanggal) harike,LPAD(month(tanggal),2,'0') bulanke,year(tanggal) tahun, year(tanggal) tahun, LPAD(day(tanggal),2,'0') tgl," .
                "jam," .
                "idadmin," .
                "urut," .
                "image1," .
                "image2," .
                "image3" .
                " FROM content Where idmenu = '" . $idmenu . "' and year(tanggal) ='".$tahun."' $xwhere order by idx DESC ";
        $query = $this->db->query($xStr);
        return $query;  
    }

}

?>