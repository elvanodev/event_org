<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : testimonials   *  By Diar */

      class Ctrtestimonials extends CI_Controller { 
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
        $this->createformtestimonials('0',$xAwal);
 } 
    
function createformtestimonials($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxtestimonials.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormtestimonials($xidx), '', '', $xAddJs,'','testimonials' ); 

}
 
function setDetailFormtestimonials($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrtestimonials/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('coupon_id','coupon_id',form_input_(getArrayObj('edcoupon_id','','200'),'',' placeholder="coupon_id" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('coupon_number','coupon_number',form_input_(getArrayObj('edcoupon_number','','200'),'',' placeholder="coupon_number" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('event_name','event_name',form_input_(getArrayObj('edevent_name','','200'),'',' placeholder="event_name" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('member_name','member_name',form_input_(getArrayObj('edmember_name','','200'),'',' placeholder="member_name" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('testimoni_text','testimoni_text',form_input_(getArrayObj('edtestimoni_text','','200'),'',' placeholder="testimoni_text" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','new','onclick="doCleartestimonials();"').form_button('btSimpan','Simpan','onclick="dosimpantestimonials();"').form_button('btTabel','Tabel','onclick="dosearchtestimonials(0);"').'<div class="spacer"></div></div><div id="tabledatatestimonials">'.$this->getlisttestimonials(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlisttestimonials($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('idx','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('coupon_id','','data-field="coupon_id" data-sortable="true" width=10%').
tbaddcellhead('coupon_number','','data-field="coupon_number" data-sortable="true" width=10%').
tbaddcellhead('event_name','','data-field="event_name" data-sortable="true" width=10%').
tbaddcellhead('member_name','','data-field="member_name" data-sortable="true" width=10%').
tbaddcellhead('testimoni_text','','data-field="testimoni_text" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modeltestimonials');
         $xQuery = $this->modeltestimonials->getListtestimonials($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doedittestimonials(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapustestimonials(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($row->idx).
tbaddcell($row->coupon_id).
tbaddcell($row->coupon_number).
tbaddcell($row->event_name).
tbaddcell($row->member_name).
tbaddcell($row->testimoni_text).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchtestimonials(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchtestimonials('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchtestimonials('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editrectestimonials(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modeltestimonials');  
         $row = $this->modeltestimonials->getDetailtestimonials($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['coupon_id'] = $row->coupon_id;
$this->json_data['coupon_number'] = $row->coupon_number;
$this->json_data['event_name'] = $row->event_name;
$this->json_data['member_name'] = $row->member_name;
$this->json_data['testimoni_text'] = $row->testimoni_text;

            echo json_encode($this->json_data);
   }
function deletetabletestimonials(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modeltestimonials'); 
    $this->modeltestimonials->setDeletetestimonials($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchtestimonials(){ 
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
        $this->json_data['tabledatatestimonials'] = $this->getlisttestimonials($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpantestimonials(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xcoupon_id = $_POST['edcoupon_id'];
$xcoupon_number = $_POST['edcoupon_number'];
$xevent_name = $_POST['edevent_name'];
$xmember_name = $_POST['edmember_name'];
$xtestimoni_text = $_POST['edtestimoni_text'];
          
             $this->load->model('modeltestimonials'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modeltestimonials->setUpdatetestimonials($xidx,$xcoupon_id,$xcoupon_number,$xevent_name,$xmember_name,$xtestimoni_text); 
         } else 
         { 
           $xStr =  $this->modeltestimonials->setInserttestimonials($xidx,$xcoupon_id,$xcoupon_number,$xevent_name,$xmember_name,$xtestimoni_text); 
         }} 
               echo json_encode(null);
    } }