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
group_concat(da.artist_id) as artist_id, 
group_concat(ar.name) as artist_names,
group_concat(ar.profile_img) as artist_profile_imgs,
d.dimension,
d.title,
d.media,
d.`year`,
d.image_art,
d.description,
d.created_at,
d.updated_at,
ev.name event_name
FROM doorprize d
JOIN events ev ON ev.idx = d.event_id
left join doorprize_artists da on da.doorprize_id = d.idx 
left join artists ar on ar.idx = da.artist_id ";

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

   function getListdoorprize_artistBydoorprizeid($xdoorprize_id)
   {
      $xStr = "SELECT 
da.idx,
da.artist_id, 
ar.name as artist_name,
ar.profile_img
FROM doorprize_artists da
join artists ar on ar.idx = da.artist_id WHERE da.doorprize_id = '".$xdoorprize_id."' order by da.idx ASC";
      $query = $this->db->query($xStr);
      $list_doorprize_artists = $query->result();
      return $list_doorprize_artists;
   }

   function getDetaildoorprizeByEvent($event_id)
   {
      $xStr = $this->default_query." WHERE d.event_id = '" . $event_id . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
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
         return ['error'=>true, 'message'=>json_encode($this->db->error())];
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
   
   function setInsertdoorprize_artistsbatch($data)
   {
      $insert = $this->db->insert_batch('doorprize_artists', $data);
      if ( !$insert ) {
         echo json_encode($this->db->error());
      }
      $insert_id = $this->db->insert_id();
   
      return $insert_id;
   }

   function setDeletedoorprize_artistsbatch($doorprize_id)
   {
      $delete = $this->db->delete("doorprize_artists", "doorprize_id = '" .$doorprize_id."'");
      if ( !$delete ) {
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
