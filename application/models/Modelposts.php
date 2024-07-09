<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : posts
 * di Buat oleh Diar PHP Generator*/

  class Modelposts extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListposts(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",event_id".
",name".
",uploaded_at".
",post_text".
",created_at".
",updated_at".

" FROM posts   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListposts($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",event_id".
",name".
",uploaded_at".
",post_text".
",created_at".
",updated_at".
" FROM posts $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailposts($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",event_id".
",name".
",uploaded_at".
",post_text".
",created_at".
",updated_at".

" FROM posts  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexposts(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",event_id".
",name".
",uploaded_at".
",post_text".
",created_at".
",updated_at".

" FROM posts order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertposts($xidx,$xevent_id,$xname,$xuploaded_at,$xpost_text,$xcreated_at,$xupdated_at)
{
  $xStr =  " INSERT INTO posts( ".
              "idx".
              ",event_id".
",name".
",uploaded_at".
",post_text".
",created_at".
",updated_at".
") VALUES('".$xidx."','".$xevent_id."','".$xname."','".$xuploaded_at."','".$xpost_text."','".$xcreated_at."','".$xupdated_at."')";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdateposts($xidx,$xevent_id,$xname,$xuploaded_at,$xpost_text,$xcreated_at,$xupdated_at)
{
  $xStr =  " UPDATE posts SET ".
             "idx='".$xidx."'".
              ",event_id='".$xevent_id."'".
 ",name='".$xname."'".
 ",uploaded_at='".$xuploaded_at."'".
 ",post_text='".$xpost_text."'".
 ",created_at='".$xcreated_at."'".
 ",updated_at='".$xupdated_at."'".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeleteposts($xidx)
{
 $xStr =  " DELETE FROM posts WHERE posts.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeleteposts($xidx);
}

function setInsertLogDeleteposts($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'posts',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
