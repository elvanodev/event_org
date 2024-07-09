<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : reproduktifmaterial
 * di Buat oleh Diar PHP Generator*/

  class Modelreproduktifmaterial extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListreproduktifmaterial(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",idmember".
",idjenisalatkerja".
",alatkerja".
",penyedia".
",harga".
",durability".

" FROM reproduktifmaterial   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListreproduktifmaterial($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",idmember".
",idjenisalatkerja".
",alatkerja".
",penyedia".
",harga".
",durability".
" FROM reproduktifmaterial $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailreproduktifmaterial($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",idmember".
",idjenisalatkerja".
",alatkerja".
",penyedia".
",harga".
",durability".

" FROM reproduktifmaterial  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexreproduktifmaterial(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",idmember".
",idjenisalatkerja".
",alatkerja".
",penyedia".
",harga".
",durability".

" FROM reproduktifmaterial order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertreproduktifmaterial($xidx,$xidmember,$xidjenisalatkerja,$xalatkerja,$xpenyedia,$xharga,$xdurability)
{
  $xStr =  " INSERT INTO reproduktifmaterial( ".
              "idx".
              ",idmember".
",idjenisalatkerja".
",alatkerja".
",penyedia".
",harga".
",durability".
") VALUES('".$xidx."','".$xidmember."','".$xidjenisalatkerja."','".$xalatkerja."','".$xpenyedia."','".$xharga."','".$xdurability."')";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdatereproduktifmaterial($xidx,$xidmember,$xidjenisalatkerja,$xalatkerja,$xpenyedia,$xharga,$xdurability)
{
  $xStr =  " UPDATE reproduktifmaterial SET ".
             "idx='".$xidx."'".
              ",idmember='".$xidmember."'".
 ",idjenisalatkerja='".$xidjenisalatkerja."'".
 ",alatkerja='".$xalatkerja."'".
 ",penyedia='".$xpenyedia."'".
 ",harga='".$xharga."'".
 ",durability='".$xdurability."'".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeletereproduktifmaterial($xidx)
{
 $xStr =  " DELETE FROM reproduktifmaterial WHERE reproduktifmaterial.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeletereproduktifmaterial($xidx);
}

function setInsertLogDeletereproduktifmaterial($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'reproduktifmaterial',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
