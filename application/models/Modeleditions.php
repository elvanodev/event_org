<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : editions
 * di Buat oleh Diar PHP Generator*/

class Modeleditions extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT 
   ed.idx 
   ,ed.event_id
,ed.name
,ed.started_at
,ed.ended_at
,ed.venue_address
,ed.venue_city
,ed.descriptions
,ed.quota
,ed.coupon_price
,ev.name event_name
 FROM editions ed
 JOIN events ev ON ev.idx = ed.event_id";

   function getArrayListeditions()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query."  order by ed.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->name . " " . $row->started_at. "-" . $row->ended_at;
      }
      return $xBuffResul;
   }
   function getArrayListeditionsbyevent_id($event_id)
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query." where ed.event_id = '".$event_id."' order by ed.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->name . " " . $row->started_at. "-" . $row->ended_at;
      }
      return $xBuffResul;
   }

   function getListeditions($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where ed.name like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query .
         $xSearch . " order by ed.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListeditionsByEvent($xevent_id)
   {
      $xStr = $this->default_query . " WHERE ed.event_id = '".$xevent_id."' order by ed.idx ASC";
      $query = $this->db->query($xStr);
      $list_editions = $query->result();
      return $list_editions;
   }

   function getDetaileditions($xidx)
   {
      $xStr = $this->default_query." WHERE ed.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexeditions()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query." order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInserteditions($xidx, $xevent_id, $xname, $xstarted_at, $xended_at, $xvenue_address, $xvenue_city, $xdescriptions, $xquota, $xcoupon_price)
   {
      $xStr =  " INSERT INTO editions( " .
         "idx" .
         ",event_id" .
         ",name" .
         ",started_at" .
         ",ended_at" .
         ",venue_address" .
         ",venue_city" .
         ",descriptions" .
         ",quota" .
         ",coupon_price" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xevent_id . "','" . $xname . "','" . $xstarted_at . "','" . $xended_at . "','" . $xvenue_address . "','" . $xvenue_city . "','" . $xdescriptions . "','" . $xquota . "','" . $xcoupon_price . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdateeditions($xidx, $xevent_id, $xname, $xstarted_at, $xended_at, $xvenue_address, $xvenue_city, $xdescriptions, $xquota, $xcoupon_price)
   {
      $xStr =  " UPDATE editions SET " .
         "idx='" . $xidx . "'" .
         ",event_id='" . $xevent_id . "'" .
         ",name='" . $xname . "'" .
         ",started_at='" . $xstarted_at . "'" .
         ",ended_at='" . $xended_at . "'" .
         ",venue_address='" . $xvenue_address . "'" .
         ",venue_city='" . $xvenue_city . "'" .
         ",descriptions='" . $xdescriptions . "'" .
         ",quota='" . $xquota . "'" .
         ",coupon_price='" . $xcoupon_price . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeleteeditions($xidx)
   {
      $xStr =  " DELETE FROM editions WHERE editions.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeleteeditions($xidx);
   }

   function setInsertLogDeleteeditions($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'editions',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
