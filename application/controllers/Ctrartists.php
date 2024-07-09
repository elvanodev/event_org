<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : artists   *  By Diar */

      class Ctrartists extends CI_Controller { 
     function __construct()
     {
        parent::__construct();
     }

    
function index($xAwal=0,$xSearch=''){
       $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
           redirect(site_url(), '');
       }
       if($xAwal <= -1){
           $xAwal = 0;
        }    
        $this->session->set_userdata('awal',$xAwal);
        $this->session->set_userdata('limit', 100); 
        $this->createformartists('0',$xAwal);
 } 
    
function createformartists($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxartists.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormartists($xidx), '', '', $xAddJs,'','artists' ); 

}
 
function setDetailFormartists($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrartists/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('name','name',form_input_(getArrayObj('edname','','200'),'',' placeholder="name" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('birth_date','birth_date',form_input_(getArrayObj('edbirth_date','','200'),'',' placeholder="birth_date" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('birth_place','birth_place',form_input_(getArrayObj('edbirth_place','','200'),'',' placeholder="birth_place" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('bio','bio',form_input_(getArrayObj('edbio','','200'),'',' placeholder="bio" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('quote','quote',form_input_(getArrayObj('edquote','','200'),'',' placeholder="quote" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('poster_img','poster_img',form_input_(getArrayObj('edposter_img','','200'),'',' placeholder="poster_img" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('phone','phone',form_input_(getArrayObj('edphone','','200'),'',' placeholder="phone" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('instagram_link','instagram_link',form_input_(getArrayObj('edinstagram_link','','200'),'',' placeholder="instagram_link" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('twitter_link','twitter_link',form_input_(getArrayObj('edtwitter_link','','200'),'',' placeholder="twitter_link" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('email','email',form_input_(getArrayObj('edemail','','200'),'',' placeholder="email" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','new','onclick="doClearartists();"').form_button('btSimpan','Simpan','onclick="dosimpanartists();"').form_button('btTabel','Tabel','onclick="dosearchartists(0);"').'<div class="spacer"></div></div><div id="tabledataartists">'.$this->getlistartists(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistartists($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('idx','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('name','','data-field="name" data-sortable="true" width=10%').
tbaddcellhead('birth_date','','data-field="birth_date" data-sortable="true" width=10%').
tbaddcellhead('birth_place','','data-field="birth_place" data-sortable="true" width=10%').
tbaddcellhead('bio','','data-field="bio" data-sortable="true" width=10%').
tbaddcellhead('quote','','data-field="quote" data-sortable="true" width=10%').
tbaddcellhead('poster_img','','data-field="poster_img" data-sortable="true" width=10%').
tbaddcellhead('phone','','data-field="phone" data-sortable="true" width=10%').
tbaddcellhead('instagram_link','','data-field="instagram_link" data-sortable="true" width=10%').
tbaddcellhead('twitter_link','','data-field="twitter_link" data-sortable="true" width=10%').
tbaddcellhead('email','','data-field="email" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modelartists');
         $xQuery = $this->modelartists->getListartists($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditartists(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusartists(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($row->idx).
tbaddcell($row->name).
tbaddcell($row->birth_date).
tbaddcell($row->birth_place).
tbaddcell($row->bio).
tbaddcell($row->quote).
tbaddcell($row->poster_img).
tbaddcell($row->phone).
tbaddcell($row->instagram_link).
tbaddcell($row->twitter_link).
tbaddcell($row->email).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchartists(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchartists('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchartists('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
        $xButtonhalaman = '<button id="edHalaman" class="btn btn-default" disabled>'.$xAwal.' to '.$xLimit.'</button>';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">'.setForm('','',$xInput . $xButtonSearch,'','').'</div>'.
                '<div class="col-md-6 text-right">'.$xButtonPrev . $xButtonhalaman . $xButtonNext.'</div></div>';
        
      $xbufResult = tablegrid($xbufResult . '</tbody>','','id="table" data-toggle="table" data-url="" data-query-params="queryParams" data-pagination="true"') . $xbuffoottable;
        $xbufResult .= '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/bootstrap-table/bootstrap-table.js"></script>';
        
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>' .
                '<div id="showmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div   class="modal-content">
                    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="dialogtitle">Title Dialog</h4>
      </div>
      <div id="dialogdata" class="modal-body">Dialog Data</div></div></div></div>';

  }

  
         function editrecartists(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modelartists');  
         $row = $this->modelartists->getDetailartists($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['name'] = $row->name;
$this->json_data['birth_date'] = $row->birth_date;
$this->json_data['birth_place'] = $row->birth_place;
$this->json_data['bio'] = $row->bio;
$this->json_data['quote'] = $row->quote;
$this->json_data['poster_img'] = $row->poster_img;
$this->json_data['phone'] = $row->phone;
$this->json_data['instagram_link'] = $row->instagram_link;
$this->json_data['twitter_link'] = $row->twitter_link;
$this->json_data['email'] = $row->email;

            echo json_encode($this->json_data);
   }
function deletetableartists(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modelartists'); 
    $this->modelartists->setDeleteartists($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchartists(){ 
    $xAwal = $_POST['xAwal']; 
    $xSearch = $_POST['xSearch']; 
    $this->load->helper('json'); 
    $xhalaman=0;
    if($xAwal!=0){
    $xhalaman = @ceil($xAwal/($xAwal-$this->session->userdata('awal', $xAwal)));
    }
    $xlimit = $this->session->userdata('limit');
        $xHal=1;
        if($xAwal <= 0){
              $xHal = 1;
        }else{
            $xHal = ($xhalaman+1);
        }
        if($xhalaman < 0){
              $xHal = (($xhalaman-1)*-1);
        }
        if (($xAwal + 0) == -99) {
            $xAwal = $this->session->userdata('awal', $xAwal);
            $xHal = $this->session->userdata('halaman', $xHal);
        }
        if ($xAwal + 0 <= -1) {
            $xAwal = 0;
            $this->session->set_userdata('awal', $xAwal);
        } else {
            $this->session->set_userdata('awal', $xAwal);
        }
        $this->json_data['tabledataartists'] = $this->getlistartists($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpanartists(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xname = $_POST['edname'];
$xbirth_date = $_POST['edbirth_date'];
$xbirth_place = $_POST['edbirth_place'];
$xbio = $_POST['edbio'];
$xquote = $_POST['edquote'];
$xposter_img = $_POST['edposter_img'];
$xphone = $_POST['edphone'];
$xinstagram_link = $_POST['edinstagram_link'];
$xtwitter_link = $_POST['edtwitter_link'];
$xemail = $_POST['edemail'];
          
             $this->load->model('modelartists'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modelartists->setUpdateartists($xidx,$xname,$xbirth_date,$xbirth_place,$xbio,$xquote,$xposter_img,$xphone,$xinstagram_link,$xtwitter_link,$xemail); 
         } else 
         { 
           $xStr =  $this->modelartists->setInsertartists($xidx,$xname,$xbirth_date,$xbirth_place,$xbio,$xquote,$xposter_img,$xphone,$xinstagram_link,$xtwitter_link,$xemail); 
         }} 
               echo json_encode(null);
    } }