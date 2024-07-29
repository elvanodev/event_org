<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : doorprize
 * di Buat oleh Diar PHP Generator*/

class Modeldoorprize extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT 
d.idx,
d.event_id,
d.artist_id,
d.dimension,
d.title,
d.media,
d.`year`,
d.image_art,
d.description,
d.created_at,
d.updated_at,
ev.name event_name,
a.name artist_name
FROM doorprize d
JOIN events ev ON ev.idx = d.event_id
JOIN artists a ON a.idx = d.artist_id ";

   function getArrayListdoorprize()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query."  order by d.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->doorprize_title;
      }
      return $xBuffResul;
   }
   function getArrayListdoorprizebyevent_id($event_id)
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query." where d.event_id = '".$event_id."' order by d.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->title;
      }
      return $xBuffResul;
   }

   function getListdoorprize($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where d.title like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query .
         $xSearch . " order by d.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListdoorprizeByEvent($xevent_id)
   {
      $xStr = $this->default_query . " WHERE d.event_id = '".$xevent_id."' order by d.idx ASC";
      $query = $this->db->query($xStr);
      $list_doorprize = $query->result();
      return $list_doorprize;
   }

   function getDetaildoorprize($xidx)
   {
      $xStr = $this->default_query." WHERE d.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexdoorprize()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query." order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function setInsertdoorprizebatch($data)
   {
      $insert = $this->db->insert('doorprize', $data);
      if ( !$insert ) {
         echo json_encode($this->db->error());
      }
      $insert_id = $this->db->insert_id();
   
      return $insert_id;
   }

   function setUpdatedoorprizebatch($idx, $data)
   {
      $update = $this->db->update('doorprize', $data, array('idx'=> $idx));
      if ( !$update ) {
         echo json_encode($this->db->error());
      }
   }

   function setDeletedoorprize($xidx)
   {
      $xStr =  " DELETE FROM doorprize WHERE doorprize.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletedoorprize($xidx);
   }

   function setInsertLogDeletedoorprize($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'doorprize',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
