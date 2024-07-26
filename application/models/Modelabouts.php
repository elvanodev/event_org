<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : abouts
 * di Buat oleh Diar PHP Generator*/

class Modelabouts extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT 
   abouts.idx 
   ,abouts.event_id
,abouts.about_title
,abouts.about_detail
,ev.name event_name
 FROM abouts abouts
 JOIN events ev ON ev.idx = abouts.event_id";

   function getArrayListabouts()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query."  order by abouts.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->about_title;
      }
      return $xBuffResul;
   }
   function getArrayListaboutsbyevent_id($event_id)
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query." where abouts.event_id = '".$event_id."' order by abouts.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->about_title;
      }
      return $xBuffResul;
   }

   function getListabouts($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where abouts.about_title like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query .
         $xSearch . " order by abouts.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListaboutsByEvent($xevent_id)
   {
      $xStr = $this->default_query . " WHERE abouts.event_id = '".$xevent_id."' order by abouts.idx ASC";
      $query = $this->db->query($xStr);
      $list_abouts = $query->result();
      return $list_abouts;
   }

   function getDetailabouts($xidx)
   {
      $xStr = $this->default_query." WHERE abouts.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexabouts()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query." order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertabouts($xidx, $xevent_id, $xabout_title, $xabout_detail)
   {
      $xStr =  " INSERT INTO abouts( " .
         "idx" .
         ",event_id" .
         ",about_title" .
         ",about_detail" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xevent_id . "','" . $xabout_title . "','" . $xabout_detail . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdateabouts($xidx, $xevent_id, $xabout_title, $xabout_detail)
   {
      $xStr =  " UPDATE abouts SET " .
         "idx='" . $xidx . "'" .
         ",event_id='" . $xevent_id . "'" .
         ",about_title='" . $xabout_title . "'" .
         ",about_detail='" . $xabout_detail . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeleteabouts($xidx)
   {
      $xStr =  " DELETE FROM abouts WHERE abouts.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeleteabouts($xidx);
   }

   function setInsertLogDeleteabouts($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'abouts',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
