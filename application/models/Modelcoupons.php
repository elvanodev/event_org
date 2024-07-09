<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
/* Class  Model : coupons
 * di Buat oleh Diar PHP Generator*/

  class Modelcoupons extends CI_Model {
  function __construct()
 {
    parent::__construct();
 }


    
function getArrayListcoupons(){ /* spertinya perlu lock table*/ 
 $xBuffResul = array(); 
 $xStr =  "SELECT ".
      "idx".",edition_id".
",coupon_number".
",qr_code".
",coupon_price".
",shipper_price".
",total_price".
",is_winner".
",payment_status_id".
",payment_confirm_receipt".
",valid_until".
",registration_id".
",member_name".
",payment_unique_id".

" FROM coupons   order by idx ASC "; 
 $query = $this->db->query($xStr); 
 foreach ($query->result() as $row) 
 { 
   $xBuffResul[$row->idx] = $row->idx; 
   } 
return $xBuffResul;
}
    
function getListcoupons($xAwal,$xLimit,$xSearch=''){
if(!empty($xSearch)){ 
     $xSearch = "Where idx like '%".$xSearch."%'" ;
 }   
 $xStr =   "SELECT ".
      "idx".
      ",edition_id".
",coupon_number".
",qr_code".
",coupon_price".
",shipper_price".
",total_price".
",is_winner".
",payment_status_id".
",payment_confirm_receipt".
",valid_until".
",registration_id".
",member_name".
",payment_unique_id".
" FROM coupons $xSearch order by idx DESC limit ".$xAwal.",".$xLimit;  
 $query = $this->db->query($xStr);
 return $query ;
}

 
function getDetailcoupons($xidx){
 $xStr =   "SELECT ".
      "idx".
   ",edition_id".
",coupon_number".
",qr_code".
",coupon_price".
",shipper_price".
",total_price".
",is_winner".
",payment_status_id".
",payment_confirm_receipt".
",valid_until".
",registration_id".
",member_name".
",payment_unique_id".

" FROM coupons  WHERE idx = '".$xidx."'";

 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}

  
function getLastIndexcoupons(){ /* spertinya perlu lock table*/ 
 $xStr =   "SELECT ".
      "idx".
      ",edition_id".
",coupon_number".
",qr_code".
",coupon_price".
",shipper_price".
",total_price".
",is_winner".
",payment_status_id".
",payment_confirm_receipt".
",valid_until".
",registration_id".
",member_name".
",payment_unique_id".

" FROM coupons order by idx DESC limit 1 ";
 $query = $this->db->query($xStr);
$row = $query->row();
 return $row;
}


  
 Function setInsertcoupons($xidx,$xedition_id,$xcoupon_number,$xqr_code,$xcoupon_price,$xshipper_price,$xtotal_price,$xis_winner,$xpayment_status_id,$xpayment_confirm_receipt,$xvalid_until,$xregistration_id,$xmember_name,$xpayment_unique_id)
{
  $xStr =  " INSERT INTO coupons( ".
              "idx".
              ",edition_id".
",coupon_number".
",qr_code".
",coupon_price".
",shipper_price".
",total_price".
",is_winner".
",payment_status_id".
",payment_confirm_receipt".
",valid_until".
",registration_id".
",member_name".
",payment_unique_id".
",created_at".
") VALUES('".$xidx."','".$xedition_id."','".$xcoupon_number."','".$xqr_code."','".$xcoupon_price."','".$xshipper_price."','".$xtotal_price."','".$xis_winner."','".$xpayment_status_id."','".$xpayment_confirm_receipt."','".$xvalid_until."','".$xregistration_id."','".$xmember_name."','".$xpayment_unique_id."',NOW())";
$query = $this->db->query($xStr);
 return $xidx;
}

Function setUpdatecoupons($xidx,$xedition_id,$xcoupon_number,$xqr_code,$xcoupon_price,$xshipper_price,$xtotal_price,$xis_winner,$xpayment_status_id,$xpayment_confirm_receipt,$xvalid_until,$xregistration_id,$xmember_name,$xpayment_unique_id)
{
  $xStr =  " UPDATE coupons SET ".
             "idx='".$xidx."'".
              ",edition_id='".$xedition_id."'".
 ",coupon_number='".$xcoupon_number."'".
 ",qr_code='".$xqr_code."'".
 ",coupon_price='".$xcoupon_price."'".
 ",shipper_price='".$xshipper_price."'".
 ",total_price='".$xtotal_price."'".
 ",is_winner='".$xis_winner."'".
 ",payment_status_id='".$xpayment_status_id."'".
 ",payment_confirm_receipt='".$xpayment_confirm_receipt."'".
 ",valid_until='".$xvalid_until."'".
 ",registration_id='".$xregistration_id."'".
 ",member_name='".$xmember_name."'".
 ",payment_unique_id='".$xpayment_unique_id."'".
 ",updated_at=NOW()".
 " WHERE idx = '".$xidx."'";
 $query = $this->db->query($xStr);
 return $xidx;
}

function setDeletecoupons($xidx)
{
 $xStr =  " DELETE FROM coupons WHERE coupons.idx = '".$xidx."'";

 $query = $this->db->query($xStr);
 $this->setInsertLogDeletecoupons($xidx);
}

function setInsertLogDeletecoupons($xidx)
{
 $xidpegawai = $this->session->userdata('idpegawai');    $xStr="insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'coupons',now(),$xidpegawai)"; 
    $query = $this->db->query($xStr);
}

}
