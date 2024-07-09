<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : members
 * di Buat oleh Diar PHP Generator*/

  class Modelmembers extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListmembers(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",name".
",email".
",password".
",address".

" FROM members   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListmembers($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",name".
",email".
",password".
",address".
" FROM members $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailmembers($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",name".
",email".
",password".
",address".

" FROM members  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexmembers(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",name".
",email".
",password".
",address".

" FROM members order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertmembers($xidx,$xname,$xemail,$xpassword,$xaddress)
{
  $xStr =  " INSERT INTO members( ".
              "idx".
              ",name".
",email".
",password".
",address".
",created_at".
") VALUES('".$xidx."','".$xname."','".$xemail."','".$xpassword."','".$xaddress."',NOW())";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdatemembers($xidx,$xname,$xemail,$xpassword,$xaddress)
{
  $xStr =  " UPDATE members SET ".
             "idx='".$xidx."'".
              ",name='".$xname."'".
 ",email='".$xemail."'".
 ",password='".$xpassword."'".
 ",address='".$xaddress."'".
 ",updated_at=NOW()".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeletemembers($xidx)
{
 $xStr =  " DELETE FROM members WHERE members.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeletemembers($xidx);
}

function setInsertLogDeletemembers($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'members',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
