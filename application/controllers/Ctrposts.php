<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : posts   *  By Diar */

      class Ctrposts extends CI_Controller { 
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
        $this->createformposts('0',$xAwal);
 } 
    
function createformposts($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxposts.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormposts($xidx), '', '', $xAddJs,'','posts' ); 

}
 
function setDetailFormposts($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrposts/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('event_id','event_id',form_input_(getArrayObj('edevent_id','','200'),'',' placeholder="event_id" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('name','name',form_input_(getArrayObj('edname','','200'),'',' placeholder="name" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('uploaded_at','uploaded_at',form_input_(getArrayObj('eduploaded_at','','200'),'',' placeholder="uploaded_at" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('post_text','post_text',form_input_(getArrayObj('edpost_text','','200'),'',' placeholder="post_text" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('created_at','created_at',form_input_(getArrayObj('edcreated_at','','200'),'',' placeholder="created_at" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('updated_at','updated_at',form_input_(getArrayObj('edupdated_at','','200'),'',' placeholder="updated_at" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','new','onclick="doClearposts();"').form_button('btSimpan','Simpan','onclick="dosimpanposts();"').form_button('btTabel','Tabel','onclick="dosearchposts(0);"').'<div class="spacer"></div></div><div id="tabledataposts">'.$this->getlistposts(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistposts($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('idx','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('event_id','','data-field="event_id" data-sortable="true" width=10%').
tbaddcellhead('name','','data-field="name" data-sortable="true" width=10%').
tbaddcellhead('uploaded_at','','data-field="uploaded_at" data-sortable="true" width=10%').
tbaddcellhead('post_text','','data-field="post_text" data-sortable="true" width=10%').
tbaddcellhead('created_at','','data-field="created_at" data-sortable="true" width=10%').
tbaddcellhead('updated_at','','data-field="updated_at" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modelposts');
         $xQuery = $this->modelposts->getListposts($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditposts(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusposts(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($row->idx).
tbaddcell($row->event_id).
tbaddcell($row->name).
tbaddcell($row->uploaded_at).
tbaddcell($row->post_text).
tbaddcell($row->created_at).
tbaddcell($row->updated_at).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchposts(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchposts('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchposts('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editrecposts(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modelposts');  
         $row = $this->modelposts->getDetailposts($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['event_id'] = $row->event_id;
$this->json_data['name'] = $row->name;
$this->json_data['uploaded_at'] = $row->uploaded_at;
$this->json_data['post_text'] = $row->post_text;
$this->json_data['created_at'] = $row->created_at;
$this->json_data['updated_at'] = $row->updated_at;

            echo json_encode($this->json_data);
   }
function deletetableposts(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modelposts'); 
    $this->modelposts->setDeleteposts($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchposts(){ 
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
        $this->json_data['tabledataposts'] = $this->getlistposts($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpanposts(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xevent_id = $_POST['edevent_id'];
$xname = $_POST['edname'];
$xuploaded_at = $_POST['eduploaded_at'];
$xpost_text = $_POST['edpost_text'];
$xcreated_at = $_POST['edcreated_at'];
$xupdated_at = $_POST['edupdated_at'];
          
             $this->load->model('modelposts'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modelposts->setUpdateposts($xidx,$xevent_id,$xname,$xuploaded_at,$xpost_text,$xcreated_at,$xupdated_at); 
         } else 
         { 
           $xStr =  $this->modelposts->setInsertposts($xidx,$xevent_id,$xname,$xuploaded_at,$xpost_text,$xcreated_at,$xupdated_at); 
         }} 
               echo json_encode(null);
    } }