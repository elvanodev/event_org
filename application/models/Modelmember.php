<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : member
 * di Buat oleh Diar PHP Generator*/

  class Modelmember extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListmember(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",nama".
",email".
",gender".
",nilaiupah".
",idsubsektor".
",subsektorname".
",jenisprofesi".
",idpendidikan".
",namapendidikan".
",idprovinsi".
",idkabupaten".
",tanggungan".
",tanggunganpasangan".
",tanggungananak1".
",tanggungananak2".
",tanggungananak3".
",tanggungananak4".
",tanggungansaudara".
",tanggungankeluarga".
",isanggotaserikatpekerja".
",namaserikat".
",formuniqueid".

" FROM member   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListmember($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",nama".
",email".
",gender".
",nilaiupah".
",idsubsektor".
",subsektorname".
",jenisprofesi".
",idpendidikan".
",namapendidikan".
",idprovinsi".
",idkabupaten".
",tanggungan".
",tanggunganpasangan".
",tanggungananak1".
",tanggungananak2".
",tanggungananak3".
",tanggungananak4".
",tanggungansaudara".
",tanggungankeluarga".
",isanggotaserikatpekerja".
",namaserikat".
",formuniqueid".
" FROM member $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailmember($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",nama".
",email".
",gender".
",nilaiupah".
",idsubsektor".
",subsektorname".
",jenisprofesi".
",idpendidikan".
",namapendidikan".
",idprovinsi".
",idkabupaten".
",tanggungan".
",tanggunganpasangan".
",tanggungananak1".
",tanggungananak2".
",tanggungananak3".
",tanggungananak4".
",tanggungansaudara".
",tanggungankeluarga".
",isanggotaserikatpekerja".
",namaserikat".
",formuniqueid".

" FROM member  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexmember(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",nama".
",email".
",gender".
",nilaiupah".
",idsubsektor".
",subsektorname".
",jenisprofesi".
",idpendidikan".
",namapendidikan".
",idprovinsi".
",idkabupaten".
",tanggungan".
",tanggunganpasangan".
",tanggungananak1".
",tanggungananak2".
",tanggungananak3".
",tanggungananak4".
",tanggungansaudara".
",tanggungankeluarga".
",isanggotaserikatpekerja".
",namaserikat".
",formuniqueid".

" FROM member order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertmember($xidx,$xnama,$xemail,$xgender,$xnilaiupah,$xidsubsektor,$xsubsektorname,$xjenisprofesi,$xidpendidikan,$xnamapendidikan,$xidprovinsi,$xidkabupaten,$xtanggungan,$xtanggunganpasangan,$xtanggungananak1,$xtanggungananak2,$xtanggungananak3,$xtanggungananak4,$xtanggungansaudara,$xtanggungankeluarga,$xisanggotaserikatpekerja,$xnamaserikat,$xformuniqueid)
{
  $xStr =  " INSERT INTO member( ".
              "idx".
              ",nama".
",email".
",gender".
",nilaiupah".
",idsubsektor".
",subsektorname".
",jenisprofesi".
",idpendidikan".
",namapendidikan".
",idprovinsi".
",idkabupaten".
",tanggungan".
",tanggunganpasangan".
",tanggungananak1".
",tanggungananak2".
",tanggungananak3".
",tanggungananak4".
",tanggungansaudara".
",tanggungankeluarga".
",isanggotaserikatpekerja".
",namaserikat".
",formuniqueid".
") VALUES('".$xidx."','".$xnama."','".$xemail."','".$xgender."','".$xnilaiupah."','".$xidsubsektor."','".$xsubsektorname."','".$xjenisprofesi."','".$xidpendidikan."','".$xnamapendidikan."','".$xidprovinsi."','".$xidkabupaten."','".$xtanggungan."','".$xtanggunganpasangan."','".$xtanggungananak1."','".$xtanggungananak2."','".$xtanggungananak3."','".$xtanggungananak4."','".$xtanggungansaudara."','".$xtanggungankeluarga."','".$xisanggotaserikatpekerja."','".$xnamaserikat."','".$xformuniqueid."')";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdatemember($xidx,$xnama,$xemail,$xgender,$xnilaiupah,$xidsubsektor,$xsubsektorname,$xjenisprofesi,$xidpendidikan,$xnamapendidikan,$xidprovinsi,$xidkabupaten,$xtanggungan,$xtanggunganpasangan,$xtanggungananak1,$xtanggungananak2,$xtanggungananak3,$xtanggungananak4,$xtanggungansaudara,$xtanggungankeluarga,$xisanggotaserikatpekerja,$xnamaserikat,$xformuniqueid)
{
  $xStr =  " UPDATE member SET ".
             "idx='".$xidx."'".
              ",nama='".$xnama."'".
 ",email='".$xemail."'".
 ",gender='".$xgender."'".
 ",nilaiupah='".$xnilaiupah."'".
 ",idsubsektor='".$xidsubsektor."'".
 ",subsektorname='".$xsubsektorname."'".
 ",jenisprofesi='".$xjenisprofesi."'".
 ",idpendidikan='".$xidpendidikan."'".
 ",namapendidikan='".$xnamapendidikan."'".
 ",idprovinsi='".$xidprovinsi."'".
 ",idkabupaten='".$xidkabupaten."'".
 ",tanggungan='".$xtanggungan."'".
 ",tanggunganpasangan='".$xtanggunganpasangan."'".
 ",tanggungananak1='".$xtanggungananak1."'".
 ",tanggungananak2='".$xtanggungananak2."'".
 ",tanggungananak3='".$xtanggungananak3."'".
 ",tanggungananak4='".$xtanggungananak4."'".
 ",tanggungansaudara='".$xtanggungansaudara."'".
 ",tanggungankeluarga='".$xtanggungankeluarga."'".
 ",isanggotaserikatpekerja='".$xisanggotaserikatpekerja."'".
 ",namaserikat='".$xnamaserikat."'".
 ",formuniqueid='".$xformuniqueid."'".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeletemember($xidx)
{
 $xStr =  " DELETE FROM member WHERE member.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeletemember($xidx);
}

function setInsertLogDeletemember($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'member',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
