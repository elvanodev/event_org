<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : posts
 * di Buat oleh Diar PHP Generator*/

class Modelposts extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT " .
      "p.idx" .
      ",p.event_id" .
      ",p.name" .
      ",p.uploaded_at" .
      ",p.post_text" .
      ",ev.name event_name" .
      " FROM posts p" .
      " JOIN events ev ON ev.idx = p.event_id";

   function getArrayListposts()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr = $this->default_query . " order by p.idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->idx;
      }
      return $xBuffResul;
   }

   function getListposts($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = " Where p.name like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query . " $xSearch order by p.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }

   function getListpostsByEvent($xevent_id)
   {
      $xStr = $this->default_query . " Where p.event_id = '" . $xevent_id . "' order by p.idx DESC";
      $query = $this->db->query($xStr);
      $list_posts = $query->result();
      return $list_posts;
   }

   function getDetailposts($xidx)
   {
      $xStr = $this->default_query . " WHERE p.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getLastIndexposts()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query . " order by p.idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function setInsertposts($xidx, $xevent_id, $xname, $xuploaded_at, $xpost_text)
   {
      $xStr =  " INSERT INTO posts( " .
         "idx" .
         ",event_id" .
         ",name" .
         ",uploaded_at" .
         ",post_text" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xevent_id . "','" . $xname . "','" . $xuploaded_at . "','" . $xpost_text . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdateposts($xidx, $xevent_id, $xname, $xuploaded_at, $xpost_text)
   {
      $xStr =  " UPDATE posts SET " .
         "idx='" . $xidx . "'" .
         ",event_id='" . $xevent_id . "'" .
         ",name='" . $xname . "'" .
         ",uploaded_at='" . $xuploaded_at . "'" .
         ",post_text='" . $xpost_text . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeleteposts($xidx)
   {
      $xStr =  " DELETE FROM posts WHERE posts.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeleteposts($xidx);
   }

   function setInsertLogDeleteposts($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'posts',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
