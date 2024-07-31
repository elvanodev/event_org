<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : testimoni_photos   *  By Diar */

      class Ctrtestimoni_photos extends CI_Controller { 
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
        $this->createformtestimoni_photos('0',$xAwal);
 } 
    
function createformtestimoni_photos($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxtestimoni_photos.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormtestimoni_photos($xidx), '', '', $xAddJs,'','testimoni_photos' ); 

}
 
function setDetailFormtestimoni_photos($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrtestimoni_photos/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('testimoni_id','testimoni_id',form_input_(getArrayObj('edtestimoni_id','','200'),'',' placeholder="testimoni_id" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('link_photo','link_photo',form_input_(getArrayObj('edlink_photo','','200'),'',' placeholder="link_photo" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','New','onclick="doCleartestimoni_photos();"').form_button('btSimpan','Simpan','onclick="dosimpantestimoni_photos();" id="btSimpan"').form_button('btTabel','Tabel','onclick="dosearchtestimoni_photos(0);"').'<div class="spacer"></div></div><div id="tabledatatestimoni_photos">'.$this->getlisttestimoni_photos(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlisttestimoni_photos($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('No','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('testimoni_id','','data-field="testimoni_id" data-sortable="true" width=10%').
tbaddcellhead('link_photo','','data-field="link_photo" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modeltestimoni_photos');
         $xQuery = $this->modeltestimoni_photos->getListtestimoni_photos($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
$no = $xAwal + 1;
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doedittestimoni_photos(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapustestimoni_photos(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($no++).
tbaddcell($row->testimoni_id).
tbaddcell($row->link_photo).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchtestimoni_photos(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchtestimoni_photos('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchtestimoni_photos('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editrectestimoni_photos(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modeltestimoni_photos');  
         $row = $this->modeltestimoni_photos->getDetailtestimoni_photos($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['testimoni_id'] = $row->testimoni_id;
$this->json_data['link_photo'] = $row->link_photo;

            echo json_encode($this->json_data);
   }
function deletetabletestimoni_photos(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modeltestimoni_photos'); 
    $this->modeltestimoni_photos->setDeletetestimoni_photos($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchtestimoni_photos(){ 
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
        $this->json_data['tabledatatestimoni_photos'] = $this->getlisttestimoni_photos($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpantestimoni_photos(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xtestimoni_id = $_POST['edtestimoni_id'];
$xlink_photo = $_POST['edlink_photo'];
          
             $this->load->model('modeltestimoni_photos'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modeltestimoni_photos->setUpdatetestimoni_photos($xidx,$xtestimoni_id,$xlink_photo); 
         } else 
         { 
           $xStr =  $this->modeltestimoni_photos->setInserttestimoni_photos($xidx,$xtestimoni_id,$xlink_photo); 
         }} 
               echo json_encode(null);
    } }