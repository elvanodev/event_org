<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : events
 * di Buat oleh Diar PHP Generator*/

  class Modelevents extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListevents(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",name".
",is_active".
",descriptions".
",about_event".
",about1_event".
",about2_event".
",about3_event".
",poster_image".

" FROM events   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListevents($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",name".
",is_active".
",descriptions".
",about_event".
",about1_event".
",about2_event".
",about3_event".
",poster_image".
" FROM events $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailevents($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",name".
",is_active".
",descriptions".
",about_event".
",about1_event".
",about2_event".
",about3_event".
",poster_image".

" FROM events  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexevents(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",name".
",is_active".
",descriptions".
",about_event".
",about1_event".
",about2_event".
",about3_event".
",poster_image".

" FROM events order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertevents($xidx,$xname,$xis_active,$xdescriptions,$xabout_event,$xabout1_event,$xabout2_event,$xabout3_event,$xposter_image)
{
  $xStr =  " INSERT INTO events( ".
              "idx".
              ",name".
",is_active".
",descriptions".
",about_event".
",about1_event".
",about2_event".
",about3_event".
",poster_image".
",created_at".
") VALUES('".$xidx."','".$xname."','".$xis_active."','".$xdescriptions."','".$xabout_event."','".$xabout1_event."','".$xabout2_event."','".$xabout3_event."','".$xposter_image."',NOW())";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdateevents($xidx,$xname,$xis_active,$xdescriptions,$xabout_event,$xabout1_event,$xabout2_event,$xabout3_event,$xposter_image)
{
  $xStr =  " UPDATE events SET ".
             "idx='".$xidx."'".
              ",name='".$xname."'".
 ",is_active='".$xis_active."'".
 ",descriptions='".$xdescriptions."'".
 ",about_event='".$xabout_event."'".
 ",about1_event='".$xabout1_event."'".
 ",about2_event='".$xabout2_event."'".
 ",about3_event='".$xabout3_event."'".
 ",poster_image='".$xposter_image."'".
 ",updated_at=NOW()".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeleteevents($xidx)
{
 $xStr =  " DELETE FROM events WHERE events.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeleteevents($xidx);
}

function setInsertLogDeleteevents($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'events',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
