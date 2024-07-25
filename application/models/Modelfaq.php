<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : faq
 * di Buat oleh Diar PHP Generator*/

class Modelfaq extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT 
   faq.idx 
   ,faq.event_id
,faq.faq_title
,faq.faq_detail
,ev.name event_name
 FROM faq faq
 JOIN events ev ON ev.idx = faq.event_id";

   function getArrayListfaq()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query."  order by faq.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->faq_title;
      }
      return $xBuffResul;
   }
   function getArrayListfaqbyevent_id($event_id)
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query." where faq.event_id = '".$event_id."' order by faq.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->faq_title;
      }
      return $xBuffResul;
   }

   function getListfaq($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where faq.faq_title like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query .
         $xSearch . " order by faq.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListfaqByEvent($xevent_id)
   {
      $xStr = $this->default_query . " WHERE faq.event_id = '".$xevent_id."' order by faq.idx ASC";
      $query = $this->db->query($xStr);
      $list_faq = $query->result();
      return $list_faq;
   }

   function getDetailfaq($xidx)
   {
      $xStr = $this->default_query." WHERE faq.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexfaq()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query." order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertfaq($xidx, $xevent_id, $xfaq_title, $xfaq_detail)
   {
      $xStr =  " INSERT INTO faq( " .
         "idx" .
         ",event_id" .
         ",faq_title" .
         ",faq_detail" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xevent_id . "','" . $xfaq_title . "','" . $xfaq_detail . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdatefaq($xidx, $xevent_id, $xfaq_title, $xfaq_detail)
   {
      $xStr =  " UPDATE faq SET " .
         "idx='" . $xidx . "'" .
         ",event_id='" . $xevent_id . "'" .
         ",faq_title='" . $xfaq_title . "'" .
         ",faq_detail='" . $xfaq_detail . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeletefaq($xidx)
   {
      $xStr =  " DELETE FROM faq WHERE faq.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletefaq($xidx);
   }

   function setInsertLogDeletefaq($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'faq',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
