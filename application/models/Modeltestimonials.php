<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : testimonials
 * di Buat oleh Diar PHP Generator*/

class Modeltestimonials extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $detaultquery = "select
	t.idx,
	t.coupon_id,
	t.coupon_number,
	t.event_name,
	t.member_name,
	t.testimoni_text,
	t.created_at,
	c.edition_id,
	ed.event_id 
from
	testimonials t
	join coupons c on c.idx = t.coupon_id 
	join editions ed on ed.idx = c.edition_id ";


   function getArrayListtestimonials()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->detaultquery." order by t.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListtestimonials($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where t.coupon_number like '%" . $xSearch . "%'
          or t.coupon_number like '%" . $xSearch . "%'
          or t.event_name like '%" . $xSearch . "%'
          or t.member_name like '%" . $xSearch . "%'
          or t.testimoni_text like '%" . $xSearch . "%'";
      }
      $xStr = $this->detaultquery." $xSearch order by t.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListtestimonialsByEvent($xevent_id, $limit)
   {
      $xStr = $this->detaultquery . " WHERE ed.event_id = '".$xevent_id."' order by t.idx DESC limit 0," . $limit;
      $query = $this->db->query($xStr);
      $list_testimonials = $query->result();
      return $list_testimonials;
   }



   function getDetailtestimonials($xidx)
   {
      $xStr = $this->detaultquery." WHERE t.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndextestimonials()
   { /* spertinya perlu lock table*/
      $xStr = $this->detaultquery." order by t.idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInserttestimonials($xidx, $xcoupon_id, $xcoupon_number, $xevent_name, $xmember_name, $xtestimoni_text)
   {
      // $xStr =  " INSERT INTO testimonials( " .
      //    "idx" .
      //    ",coupon_id" .
      //    ",coupon_number" .
      //    ",event_name" .
      //    ",member_name" .
      //    ",testimoni_text" .
      //    ",created_at" .
      //    ") VALUES('" . $xidx . "','" . $xcoupon_id . "','" . $xcoupon_number . "','" . $xevent_name . "','" . $xmember_name . "','" . $xtestimoni_text . "',NOW()) returning idx";
      $post_data = [
         "coupon_id" => $xcoupon_id,
         "coupon_number" => $xcoupon_number,
         "event_name" => $xevent_name,
         "member_name" => $xmember_name,
         "testimoni_text" => $xtestimoni_text
      ];
      $insert = $this->db->insert('testimonials', $post_data);
      if ( !$insert ) {
         return ['error' => true, 'message'=>json_encode($this->db->error())];
      }
      $insert_id = $this->db->insert_id();
   
      return  $insert_id;
   }

   function setUpdatetestimonials($xidx, $xcoupon_id, $xcoupon_number, $xevent_name, $xmember_name, $xtestimoni_text)
   {
      $xStr =  " UPDATE testimonials SET " .
         "idx='" . $xidx . "'" .
         ",coupon_id='" . $xcoupon_id . "'" .
         ",coupon_number='" . $xcoupon_number . "'" .
         ",event_name='" . $xevent_name . "'" .
         ",member_name='" . $xmember_name . "'" .
         ",testimoni_text='" . $xtestimoni_text . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeletetestimonials($xidx)
   {
      $xStr =  " DELETE FROM testimonials WHERE testimonials.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletetestimonials($xidx);
   }

   function setInsertLogDeletetestimonials($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'testimonials',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
