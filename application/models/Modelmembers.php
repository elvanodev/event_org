<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Model : members
 * di Buat oleh Diar PHP Generator*/

class Modelmembers extends CI_Model
{
   function __construct()
   {
      parent::__construct();
   }



   function getArrayListmembers()
   { /* spertinya perlu lock table*/
      $xBuffResul = array();
      $xStr =  "SELECT " .
         "idx" . ",name" .
         ",email" .
         ",password" .
         ",address" .

         " FROM members   order by idx ASC ";
      $query = $this->db->query($xStr);
      foreach ($query->result() as $row) {
         $xBuffResul[$row->idx] = $row->name . " | " . $row->email;
      }
      return $xBuffResul;
   }

   function getListmembers($xAwal, $xLimit, $xSearch = '')
   {
      if (!empty($xSearch)) {
         $xSearch = "Where idx like '%" . $xSearch . "%'";
      }
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",email" .
         ",password" .
         ",address" .
         " FROM members $xSearch order by idx DESC limit " . $xAwal . "," . $xLimit;
      $query = $this->db->query($xStr);
      return $query;
   }


   function getDetailmembers($xidx)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",email" .
         ",password" .
         ",address" .

         " FROM members  WHERE idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }

   function getDetailmembersbyemail($xemail)
   {
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",email" .
         ",password" .
         ",address" .

         " FROM members  WHERE email = '" . $xemail . "'";

      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }


   function getLastIndexmembers()
   { /* spertinya perlu lock table*/
      $xStr =   "SELECT " .
         "idx" .
         ",name" .
         ",email" .
         ",password" .
         ",address" .

         " FROM members order by idx DESC limit 1 ";
      $query = $this->db->query($xStr);
      $row = $query->row();
      return $row;
   }



   function setInsertmembers($xname, $xemail, $xpassword, $xaddress)
   {
      $post_data = [
         "name" => $xname,
         "email" => $xemail,
         "password" => $xpassword,
         "address" => $xaddress
      ];
      $insert = $this->db->insert('members', $post_data);
      if ( !$insert ) {
         echo json_encode($this->db->error());
      }
      $insert_id = $this->db->insert_id();
   
      return  $insert_id;
   }

   function setUpdatemembers($xidx, $xname, $xemail, $xpassword, $xaddress)
   {
      $xStr =  " UPDATE members SET " .
         "idx='" . $xidx . "'" .
         ",name='" . $xname . "'" .
         ",email='" . $xemail . "'" .
         ",password='" . $xpassword . "'" .
         ",address='" . $xaddress . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }
   function setUpdatemembers1($xidx, $xname, $xemail, $xaddress)
   {
      $xStr =  " UPDATE members SET " .
         "idx='" . $xidx . "'" .
         ",name='" . $xname . "'" .
         ",email='" . $xemail . "'" .
         ",address='" . $xaddress . "'" .
         ",updated_at=NOW()" .
         " WHERE idx = '" . $xidx . "'";
      $query = $this->db->query($xStr);
      return $xidx;
   }


   function setDeletemembers($xidx)
   {
      $xStr =  " DELETE FROM members WHERE members.idx = '" . $xidx . "'";

      $query = $this->db->query($xStr);
      $this->setInsertLogDeletemembers($xidx);
   }

   function setInsertLogDeletemembers($xidx)
   {
      $xidpegawai = $this->session->userdata('idpegawai');
      $xStr = "insert into logdelrecord(idxhapus,nmtable,tgllog,ideksekusi) values($xidx,'members',now(),$xidpegawai)";
      $query = $this->db->query($xStr);
   }
}
