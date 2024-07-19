<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : coupons
 * di Buat oleh Diar PHP Generator*/

class Modelcoupons extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "select
	c.idx,
	ed.event_id,
	c.edition_id,
	c.coupon_number,
	c.qr_code,
	c.coupon_price,
	c.shipper_price,
	c.total_price,
	c.is_winner,
	c.payment_status_id,
	c.payment_confirm_receipt,
	c.valid_until,
	c.registration_id,
	c.payment_unique_id,
	ev.name event_name,
	ed.name edition_name,
	ps.name payment_status_name,
	m.name member_name	
from
	coupons c
	join editions ed on ed.idx = c.edition_id 
	join events ev on ev.idx = ed.event_id 
	join payment_statuses ps on ps.idx = c.payment_status_id 
	join registrations r on r.idx = c.registration_id 
	join members m on m.idx = r.member_id ";

   function getArrayListcoupons()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query . " order by c.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListcoupons($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where ev.name like '%" . $xSearch . "%'
          or ed.name like '%" . $xSearch . "%'
          or ps.name like '%" . $xSearch . "%'
          or m.name like '%" . $xSearch . "%'
          or c.coupon_number like '%" . $xSearch . "%'
          or c.payment_unique_id like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query . "
    $xSearch order by c.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getDetailcoupons($xidx)
   {
      $xStr = $this->default_query . " WHERE c.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getDetailcouponBycoupon_number($xcoupon_number, $xedition_id)
   {
      $xStr = $this->default_query . " WHERE c.coupon_number = '" . $xcoupon_number . "' and c.edition_id = '" . $xedition_id . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getDetailcouponByregistrationandedition($xregistration_id, $xedition_id)
   {
      $xStr = $this->default_query . " WHERE c.registration_id = '" . $xregistration_id . "' and c.edition_id = '" . $xedition_id . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getLastIndexcoupons()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query . " order by c.idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function setInsertcoupons($xidx, $xedition_id, $xcoupon_number, $xqr_code, $xcoupon_price, $xshipper_price, $xtotal_price, $xis_winner, $xpayment_status_id, $xpayment_confirm_receipt, $xvalid_until, $xregistration_id)
   {
      $xStr =  " INSERT INTO coupons( " .
         "idx" .
         ",edition_id" .
         ",coupon_number" .
         ",qr_code" .
         ",coupon_price" .
         ",shipper_price" .
         ",total_price" .
         ",is_winner" .
         ",payment_status_id" .
         ",payment_confirm_receipt" .
         ",valid_until" .
         ",registration_id" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xedition_id . "','" . $xcoupon_number . "','" . $xqr_code . "','" . $xcoupon_price . "','" . $xshipper_price . "','" . $xtotal_price . "','" . $xis_winner . "','" . $xpayment_status_id . "','" . $xpayment_confirm_receipt . "','" . $xvalid_until . "','" . $xregistration_id . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdatecoupons($xidx, $xedition_id, $xcoupon_number, $xqr_code, $xcoupon_price, $xshipper_price, $xtotal_price, $xis_winner, $xpayment_status_id, $xpayment_confirm_receipt, $xvalid_until, $xregistration_id)
   {
      $xStr =  " UPDATE coupons SET " .
         "idx='" . $xidx . "'" .
         ",edition_id='" . $xedition_id . "'" .
         ",coupon_number='" . $xcoupon_number . "'" .
         ",qr_code='" . $xqr_code . "'" .
         ",coupon_price='" . $xcoupon_price . "'" .
         ",shipper_price='" . $xshipper_price . "'" .
         ",total_price='" . $xtotal_price . "'" .
         ",is_winner='" . $xis_winner . "'" .
         ",payment_status_id='" . $xpayment_status_id . "'" .
         ",payment_confirm_receipt='" . $xpayment_confirm_receipt . "'" .
         ",valid_until='" . $xvalid_until . "'" .
         ",registration_id='" . $xregistration_id . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeletecoupons($xidx)
   {
      $xStr =  " DELETE FROM coupons WHERE coupons.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletecoupons($xidx);
   }

   function setInsertLogDeletecoupons($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'coupons',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }

   function iscouponnumberexist($xedition_id, $xcoupon_number) {
      $xStr = "select 
	count(idx) count
from
	coupons c 
where 
	c.edition_id = '$xedition_id'
	and c.coupon_number = '$xcoupon_number';";
   
   $query = $this->db->query($xStr);
   $row = $query->row();
   if ($row->count > 0) {
      return true;
   } else {
      return false;
   }
   }
}
