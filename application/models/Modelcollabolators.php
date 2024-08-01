<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : collabolators
 * di Buat oleh Diar PHP Generator*/

class Modelcollabolators extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }
   
   private $default_query = "SELECT 
   c.idx
   ,c.edition_id
   ,c.artist_id
   ,ed.name as edition_name
   ,ev.name as event_name
   ,ev.poster_image as event_icon
   ,ar.name as artist_name 
   ,ar.`quote`
   ,ar.birth_date
   ,ar.birth_place 
   ,ar.bio
   ,ar.poster_img 
   ,ar.profile_img 
   ,ar.phone 
   ,ar.instagram_link 
   ,ar.twitter_link 
   ,ar.email 
   FROM collabolators c 
   JOIN editions ed on ed.idx = c.edition_id 
   JOIN events ev on ev.idx = ed.event_id 
   JOIN artists ar on ar.idx = c.artist_id";

   function getArrayListcollabolators()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query . " order by c.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListcollabolators($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where ev.name like '%" . $xSearch . "%' or ar.name like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query . $xSearch ." order by c.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }
   function getListcollabolatorsbyedition_id($xedition_id)
   {
      $xStr = $this->default_query . " where c.edition_id = '" .$xedition_id."' order by c.idx DESC;";
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailcollabolators($xidx)
   {
      $xStr = $this->default_query . " WHERE c.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getDetailcollabolatorsbyartistid($artistid)
   {
      $xStr = $this->default_query . " WHERE c.artist_id = '" . $artistid . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getLastIndexcollabolators()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query . " order by c.idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertcollabolators($xidx, $xedition_id, $xartist_id)
   {
      $xStr =  " INSERT INTO collabolators( " .
         "idx" .
         ",edition_id" .
         ",artist_id" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xedition_id . "','" . $xartist_id . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdatecollabolators($xidx, $xedition_id, $xartist_id)
   {
      $xStr =  " UPDATE collabolators SET " .
         "idx='" . $xidx . "'" .
         ",edition_id='" . $xedition_id . "'" .
         ",artist_id='" . $xartist_id . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeletecollabolators($xidx)
   {
      $xStr =  " DELETE FROM collabolators WHERE collabolators.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletecollabolators($xidx);
   }

   function setInsertLogDeletecollabolators($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'collabolators',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
