<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : registrations
 * di Buat oleh Diar PHP Generator*/

class Modelregistrations extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListregistrations()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",edition_id" .
         ",member_id" .
         ",registered_at" .
         ",qr_code" .

         " FROM registrations   order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }
   function getArrayListregistrationsbyedition_id($edition_id)
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "r.idx" . ",r.edition_id" .
         ",r.member_id" .
         ",r.registered_at" .
         ",r.qr_code" .
         ",m.name member_name" .
         ",m.email member_email" .
         " FROM registrations r
          JOIN members m ON m.idx = r.member_id
          where r.edition_id = '".$edition_id."' order by r.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->member_name . " - " . $row->member_email;
      }
      return $xBuffResul;
   }

   function getListregistrations($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where ev.name like '%" . $xSearch . "%' or ar.name like '%" . $xSearch . "%'";
      }
      $xStr =   "SELECT " .
         "rg.idx" .
         ",rg.edition_id" .
         ",rg.member_id" .
         ",rg.registered_at" .
         ",rg.qr_code" .
         ",ed.name as edition_name" .
         ",ev.name as event_name" .
         ",mb.name as member_name" .
         " FROM registrations rg".
         " JOIN editions ed on ed.idx = rg.edition_id".
         " JOIN events ev on ev.idx = ed.event_id".
         " JOIN members mb on mb.idx = rg.member_id".
         " ". $xSearch ." order by rg.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailregistrations($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",edition_id" .
         ",member_id" .
         ",registered_at" .
         ",qr_code" .

         " FROM registrations  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexregistrations()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",edition_id" .
         ",member_id" .
         ",registered_at" .
         ",qr_code" .

         " FROM registrations order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertregistrations($xedition_id, $xmember_id, $xregistered_at, $xqr_code)
   {
      $post_data = [
         "edition_id" => $xedition_id,
         "member_id" => $xmember_id,
         "qr_code" => $xqr_code,
         "registered_at" => $xregistered_at
      ];
      $insert = $this->db->insert('registrations', $post_data);
      if ( !$insert ) {
         echo json_encode($this->db->error());
      }
      $insert_id = $this->db->insert_id();
   
      return  $insert_id;
   }

   function setUpdateregistrations($xidx, $xedition_id, $xmember_id, $xregistered_at)
   {
      $xStr =  " UPDATE registrations SET " .
         "idx='" . $xidx . "'" .
         ",edition_id='" . $xedition_id . "'" .
         ",member_id='" . $xmember_id . "'" .
         ",registered_at='" . $xregistered_at . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeleteregistrations($xidx)
   {
      $xStr =  " DELETE FROM registrations WHERE registrations.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeleteregistrations($xidx);
   }
   function setDeleteregistrationsbymemberandedition($edition_id, $member_id)
   {
      $xStr =  " DELETE FROM registrations WHERE registrations.edition_id = '" . $edition_id . "' and registrations.member_id = '" . $member_id . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeleteregistrations($xidx);
   }

   function setInsertLogDeleteregistrations($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'registrations',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
