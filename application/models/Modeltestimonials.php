<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : testimonials
 * di Buat oleh Diar PHP Generator*/

class Modeltestimonials extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListtestimonials()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",coupon_id" .
         ",coupon_number" .
         ",event_name" .
         ",member_name" .
         ",testimoni_text" .

         " FROM testimonials   order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListtestimonials($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where idx like '%" . $xSearch . "%'";
      }
      $xStr =   "SELECT " .
         "idx" .
         ",coupon_id" .
         ",coupon_number" .
         ",event_name" .
         ",member_name" .
         ",testimoni_text" .
         " FROM testimonials $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailtestimonials($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",coupon_id" .
         ",coupon_number" .
         ",event_name" .
         ",member_name" .
         ",testimoni_text" .

         " FROM testimonials  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndextestimonials()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",coupon_id" .
         ",coupon_number" .
         ",event_name" .
         ",member_name" .
         ",testimoni_text" .

         " FROM testimonials order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInserttestimonials($xidx, $xcoupon_id, $xcoupon_number, $xevent_name, $xmember_name, $xtestimoni_text)
   {
      $xStr =  " INSERT INTO testimonials( " .
         "idx" .
         ",coupon_id" .
         ",coupon_number" .
         ",event_name" .
         ",member_name" .
         ",testimoni_text" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xcoupon_id . "','" . $xcoupon_number . "','" . $xevent_name . "','" . $xmember_name . "','" . $xtestimoni_text . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
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
