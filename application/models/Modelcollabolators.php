<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : collabolators
 * di Buat oleh Diar PHP Generator*/

class Modelcollabolators extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListcollabolators()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",edition_id" .
         ",artist_id" .

         " FROM collabolators   order by idx ASC ";
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
      $xStr =   "SELECT " .
         "c.idx" .
         ",c.edition_id" .
         ",c.artist_id" .
         ",ed.name as edition_name" .
         ",ev.name as event_name" .
         ",ar.name as artist_name" .
         " FROM collabolators c".
         " JOIN editions ed on ed.idx = c.edition_id".
         " JOIN events ev on ev.idx = ed.event_id".
         " JOIN artists ar on ar.idx = c.artist_id".
         " ". $xSearch ." order by c.idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailcollabolators($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",edition_id" .
         ",artist_id" .

         " FROM collabolators  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexcollabolators()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",edition_id" .
         ",artist_id" .

         " FROM collabolators order by idx DESC limit 1 ";
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
