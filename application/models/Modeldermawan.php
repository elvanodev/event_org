<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : dermawan
 * di Buat oleh Diar PHP Generator*/

class Modeldermawan extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT " .
         "d.idx" .
         ",d.event_id" .
         ",d.name" .
         ",d.quote" .
         ",d.nominal" .
         ",ev.name as event_name" .
         " FROM dermawan d".
         " JOIN events ev on ev.idx = d.event_id";

   function getArrayListdermawan()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query ." order by d.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListdermawan($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = " Where ev.name like '%" . $xSearch . "%' or d.name like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query . $xSearch ." order by d.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListdermawanByEvent($event_id)
   {
      $xStr = $this->default_query . " where d.event_id = '".$event_id."' order by d.idx DESC";
      $query = $this->db->query($xStr);
      return $query->result();
   }


   function getDetaildermawan($xidx)
   {
      $xStr = $this->default_query ." WHERE d.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getLastIndexdermawan()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query ." order by d.idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function setInsertdermawanbatch($data)
   {
      $insert = $this->db->insert('dermawan', $data);
      if ( !$insert ) {
         echo json_encode($this->db->error());
      }
      $insert_id = $this->db->insert_id();
   
      return  $insert_id;
   }

   function setUpdatedermawanbatch($xidx, $data)
   {
      $update = $this->db->update('dermawan', $data, array('idx'=> $xidx));
      if ( !$update ) {
         echo json_encode($this->db->error());
      }
   }

   function setDeletedermawan($xidx)
   {
      $xStr =  " DELETE FROM dermawan WHERE dermawan.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletedermawan($xidx);
   }
   function setDeletedermawanbymemberandedition($edition_id, $member_id)
   {
      $xStr =  " DELETE FROM dermawan WHERE dermawan.edition_id = '" . $edition_id . "' and dermawan.member_id = '" . $member_id . "'";

      $query = $this->db->query($xStr);
   }

   function setInsertLogDeletedermawan($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'dermawan',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
