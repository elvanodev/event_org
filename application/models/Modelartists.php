<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : artists
 * di Buat oleh Diar PHP Generator*/

class Modelartists extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }

   private $default_query = "SELECT " .
         "idx" . ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",profile_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .

         " FROM artists ";


   function getArrayListartists()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  $this->default_query."  order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->name;
      }
      return $xBuffResul;
   }

   function getListartists($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where name like '%" . $xSearch . "%'";
      }
      $xStr = $this->default_query . " $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailartists($xidx)
   {
      $xStr = $this->default_query . " WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexartists()
   { /* spertinya perlu lock table*/
      $xStr = $this->default_query . " order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertartists($xidx, $xname, $xbirth_date, $xbirth_place, $xbio, $xquote, $xposter_img, $xprofile_img, $xphone, $xinstagram_link, $xtwitter_link, $xemail)
   {
      $xStr =  " INSERT INTO artists( " .
         "idx" .
         ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",profile_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xname . "','" . $xbirth_date . "','" . $xbirth_place . "','" . $xbio . "','" . $xquote . "','" . $xposter_img . "','" . $xprofile_img . "','" . $xphone . "','" . $xinstagram_link . "','" . $xtwitter_link . "','" . $xemail . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdateartists($xidx, $xname, $xbirth_date, $xbirth_place, $xbio, $xquote, $xposter_img, $xprofile_img, $xphone, $xinstagram_link, $xtwitter_link, $xemail)
   {
      $xStr =  " UPDATE artists SET " .
         "idx='" . $xidx . "'" .
         ",name='" . $xname . "'" .
         ",birth_date='" . $xbirth_date . "'" .
         ",birth_place='" . $xbirth_place . "'" .
         ",bio='" . $xbio . "'" .
         ",quote='" . $xquote . "'" .
         ",poster_img='" . $xposter_img . "'" .
         ",profile_img='" . $xprofile_img . "'" .
         ",phone='" . $xphone . "'" .
         ",instagram_link='" . $xinstagram_link . "'" .
         ",twitter_link='" . $xtwitter_link . "'" .
         ",email='" . $xemail . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setDeleteartists($xidx)
   {
      $xStr =  " DELETE FROM artists WHERE artists.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeleteartists($xidx);
   }

   function setInsertLogDeleteartists($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'artists',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
