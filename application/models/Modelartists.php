<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : artists
 * di Buat oleh Diar PHP Generator*/

class Modelartists extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListartists()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .

         " FROM artists   order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->name;
      }
      return $xBuffResul;
   }

   function getListartists($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where idx like '%" . $xSearch . "%'";
      }
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .
         " FROM artists $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailartists($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .

         " FROM artists  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexartists()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .

         " FROM artists order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertartists($xidx, $xname, $xbirth_date, $xbirth_place, $xbio, $xquote, $xposter_img, $xphone, $xinstagram_link, $xtwitter_link, $xemail)
   {
      $xStr =  " INSERT INTO artists( " .
         "idx" .
         ",name" .
         ",birth_date" .
         ",birth_place" .
         ",bio" .
         ",quote" .
         ",poster_img" .
         ",phone" .
         ",instagram_link" .
         ",twitter_link" .
         ",email" .
         ",created_at" .
         ") VALUES('" . $xidx . "','" . $xname . "','" . $xbirth_date . "','" . $xbirth_place . "','" . $xbio . "','" . $xquote . "','" . $xposter_img . "','" . $xphone . "','" . $xinstagram_link . "','" . $xtwitter_link . "','" . $xemail . "',NOW())";
      $query = $this->db->query($xStr);
      return $xidx;
   }

   function setUpdateartists($xidx, $xname, $xbirth_date, $xbirth_place, $xbio, $xquote, $xposter_img, $xphone, $xinstagram_link, $xtwitter_link, $xemail)
   {
      $xStr =  " UPDATE artists SET " .
         "idx='" . $xidx . "'" .
         ",name='" . $xname . "'" .
         ",birth_date='" . $xbirth_date . "'" .
         ",birth_place='" . $xbirth_place . "'" .
         ",bio='" . $xbio . "'" .
         ",quote='" . $xquote . "'" .
         ",poster_img='" . $xposter_img . "'" .
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
