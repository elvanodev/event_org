<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : registrations
 * di Buat oleh Diar PHP Generator*/

  class Modelregistrations extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListregistrations(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",edition_id".
",member_id".
",registered_at".
",qr_code".

" FROM registrations   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListregistrations($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",edition_id".
",member_id".
",registered_at".
",qr_code".
" FROM registrations $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailregistrations($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",edition_id".
",member_id".
",registered_at".
",qr_code".

" FROM registrations  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexregistrations(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",edition_id".
",member_id".
",registered_at".
",qr_code".

" FROM registrations order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertregistrations($xidx,$xedition_id,$xmember_id,$xregistered_at,$xqr_code)
{
  $xStr =  " INSERT INTO registrations( ".
              "idx".
              ",edition_id".
",member_id".
",registered_at".
",qr_code".
",created_at".
") VALUES('".$xidx."','".$xedition_id."','".$xmember_id."','".$xregistered_at."','".$xqr_code."',NOW())";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdateregistrations($xidx,$xedition_id,$xmember_id,$xregistered_at,$xqr_code)
{
  $xStr =  " UPDATE registrations SET ".
             "idx='".$xidx."'".
              ",edition_id='".$xedition_id."'".
 ",member_id='".$xmember_id."'".
 ",registered_at='".$xregistered_at."'".
 ",qr_code='".$xqr_code."'".
 ",updated_at=NOW()".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeleteregistrations($xidx)
{
 $xStr =  " DELETE FROM registrations WHERE registrations.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeleteregistrations($xidx);
}

function setInsertLogDeleteregistrations($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'registrations',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
