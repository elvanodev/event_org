<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : testimoni_photos
 * di Buat oleh Diar PHP Generator*/

class Modeltestimoni_photos extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListtestimoni_photos()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",testimoni_id" .
         ",link_photo" .

         " FROM testimoni_photos   order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListtestimoni_photos($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where idx like '%" . $xSearch . "%'";
      }
      $xStr =   "SELECT " .
         "idx" .
         ",testimoni_id" .
         ",link_photo" .
         " FROM testimoni_photos $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailtestimoni_photos($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",testimoni_id" .
         ",link_photo" .

         " FROM testimoni_photos  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndextestimoni_photos()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",testimoni_id" .
         ",link_photo" .

         " FROM testimoni_photos order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInserttestimoni_photos($xidx, $xtestimoni_id, $xlink_photo)
   {
      $xStr =  " INSERT INTO testimoni_photos( " .
         "idx" .
         ",testimoni_id" .
         ",link_photo" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xtestimoni_id . "','" . $xlink_photo . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdatetestimoni_photos($xidx, $xtestimoni_id, $xlink_photo)
   {
      $xStr =  " UPDATE testimoni_photos SET " .
         "idx='" . $xidx . "'" .
         ",testimoni_id='" . $xtestimoni_id . "'" .
         ",link_photo='" . $xlink_photo . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdatetestimoni_photosbytestimoni_id($xtestimoni_id, $xlink_photo)
   {
      $xStr =  " UPDATE testimoni_photos SET " .
         ",link_photo='" . $xlink_photo . "'" .
         ",updated_at=NOW()" .
         " WHERE testimoni_id = '" . $xtestimoni_id . "'";
      $query = $this->db->query($xStr);
      return $xtestimoni_id;
   }

   function setDeletetestimoni_photos($xidx)
   {
      $xStr =  " DELETE FROM testimoni_photos WHERE testimoni_photos.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletetestimoni_photos($xidx);
   }

   function setInsertLogDeletetestimoni_photos($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'testimoni_photos',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
