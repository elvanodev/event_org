<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : editions
 * di Buat oleh Diar PHP Generator*/

  class Modeleditions extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListeditions(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",event_id".
",name".
",started_at".
",ended_at".
",venue_address".
",venue_city".
",descriptions".
",quota".
",coupon_price".

" FROM editions   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListeditions($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",event_id".
",name".
",started_at".
",ended_at".
",venue_address".
",venue_city".
",descriptions".
",quota".
",coupon_price".
" FROM editions $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetaileditions($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",event_id".
",name".
",started_at".
",ended_at".
",venue_address".
",venue_city".
",descriptions".
",quota".
",coupon_price".

" FROM editions  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexeditions(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",event_id".
",name".
",started_at".
",ended_at".
",venue_address".
",venue_city".
",descriptions".
",quota".
",coupon_price".

" FROM editions order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInserteditions($xidx,$xevent_id,$xname,$xstarted_at,$xended_at,$xvenue_address,$xvenue_city,$xdescriptions,$xquota,$xcoupon_price)
{
  $xStr =  " INSERT INTO editions( ".
              "idx".
              ",event_id".
",name".
",started_at".
",ended_at".
",venue_address".
",venue_city".
",descriptions".
",quota".
",coupon_price".
",created_at".
") VALUES('".$xidx."','".$xevent_id."','".$xname."','".$xstarted_at."','".$xended_at."','".$xvenue_address."','".$xvenue_city."','".$xdescriptions."','".$xquota."','".$xcoupon_price."',NOW())";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdateeditions($xidx,$xevent_id,$xname,$xstarted_at,$xended_at,$xvenue_address,$xvenue_city,$xdescriptions,$xquota,$xcoupon_price)
{
  $xStr =  " UPDATE editions SET ".
             "idx='".$xidx."'".
              ",event_id='".$xevent_id."'".
 ",name='".$xname."'".
 ",started_at='".$xstarted_at."'".
 ",ended_at='".$xended_at."'".
 ",venue_address='".$xvenue_address."'".
 ",venue_city='".$xvenue_city."'".
 ",descriptions='".$xdescriptions."'".
 ",quota='".$xquota."'".
 ",coupon_price='".$xcoupon_price."'".
 ",updated_at=NOW()".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeleteeditions($xidx)
{
 $xStr =  " DELETE FROM editions WHERE editions.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeleteeditions($xidx);
}

function setInsertLogDeleteeditions($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'editions',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
