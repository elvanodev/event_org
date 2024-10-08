<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : payment_statuses
 * di Buat oleh Diar PHP Generator*/

class Modelpayment_statuses extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListpayment_statuses()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",name" .
         ",descriptions" .

         " FROM payment_statuses   order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->name;
      }
      return $xBuffResul;
   }

   function getListpayment_statuses($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where idx like '%" . $xSearch . "%'";
      }
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",descriptions" .
         " FROM payment_statuses $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailpayment_statuses($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",descriptions" .

         " FROM payment_statuses  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexpayment_statuses()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",descriptions" .

         " FROM payment_statuses order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertpayment_statuses($xidx, $xname, $xdescriptions)
   {
      $xStr =  " INSERT INTO payment_statuses( " .
         "idx" .
         ",name" .
         ",descriptions" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xname . "','" . $xdescriptions . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdatepayment_statuses($xidx, $xname, $xdescriptions)
   {
      $xStr =  " UPDATE payment_statuses SET " .
         "idx='" . $xidx . "'" .
         ",name='" . $xname . "'" .
         ",descriptions='" . $xdescriptions . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeletepayment_statuses($xidx)
   {
      $xStr =  " DELETE FROM payment_statuses WHERE payment_statuses.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletepayment_statuses($xidx);
   }

   function setInsertLogDeletepayment_statuses($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'payment_statuses',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
