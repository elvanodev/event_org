<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : galleries
 * di Buat oleh Diar PHP Generator*/

class Modelgalleries extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT " .
         "g.idx" .
         ",g.edition_id" .
         ",g.image_link" .
         ",g.image_title" .
         ",ed.name as edition_name" .
         ",ev.name as event_name" .
         ",ev.idx as event_id" .
         " FROM galleries g".
         " JOIN editions ed on ed.idx = g.edition_id".
         " JOIN events ev on ev.idx = ed.event_id";

   function getArrayListgalleries()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query ." order by g.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListgalleries($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = " Where ev.name like '%" . $xSearch . "%' or g.image_title like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query . $xSearch ." order by g.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListgalleriesByEdition($edition_id)
   {
      $xStr = $this->default_query . " where g.edition_id = '".$edition_id."' order by g.idx DESC";
      $query = $this->db->query($xStr);
      return $query->result();
   }


   function getDetailgalleries($xidx)
   {
      $xStr = $this->default_query ." WHERE g.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getLastIndexgalleries()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query ." order by g.idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function setInsertgalleriesbatch($data)
   {
      $insert = $this->db->insert('galleries', $data);
      if ( !$insert ) {
         echo json_encode($this->db->error());
      }
      $insert_id = $this->db->insert_id();
   
      return  $insert_id;
   }

   function setUpdategalleriesbatch($xidx, $data)
   {
      $update = $this->db->update('galleries', $data, array('idx'=> $xidx));
      if ( !$update ) {
         echo json_encode($this->db->error());
      }
   }

   function setDeletegalleries($xidx)
   {
      $xStr =  " DELETE FROM galleries WHERE galleries.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletegalleries($xidx);
   }
   function setDeletegalleriesbymemberandedition($edition_id, $member_id)
   {
      $xStr =  " DELETE FROM galleries WHERE galleries.edition_id = '" . $edition_id . "' and galleries.member_id = '" . $member_id . "'";

      $query = $this->db->query($xStr);
   }

   function setInsertLogDeletegalleries($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'galleries',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
