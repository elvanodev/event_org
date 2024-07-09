<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : coupons   *  By Diar */

      class Ctrcoupons extends CI_Controller { 
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
        $this->createformcoupons('0',$xAwal);
 } 
    
function createformcoupons($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxcoupons.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormcoupons($xidx), '', '', $xAddJs,'','coupons' ); 

}
 
function setDetailFormcoupons($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrcoupons/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('edition_id','edition_id',form_input_(getArrayObj('ededition_id','','200'),'',' placeholder="edition_id" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('coupon_number','coupon_number',form_input_(getArrayObj('edcoupon_number','','200'),'',' placeholder="coupon_number" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('qr_code','qr_code',form_input_(getArrayObj('edqr_code','','200'),'',' placeholder="qr_code" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('coupon_price','coupon_price',form_input_(getArrayObj('edcoupon_price','','200'),'',' placeholder="coupon_price" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('shipper_price','shipper_price',form_input_(getArrayObj('edshipper_price','','200'),'',' placeholder="shipper_price" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('total_price','total_price',form_input_(getArrayObj('edtotal_price','','200'),'',' placeholder="total_price" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('is_winner','is_winner',form_input_(getArrayObj('edis_winner','','200'),'',' placeholder="is_winner" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('payment_status_id','payment_status_id',form_input_(getArrayObj('edpayment_status_id','','200'),'',' placeholder="payment_status_id" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('payment_confirm_receipt','payment_confirm_receipt',form_input_(getArrayObj('edpayment_confirm_receipt','','200'),'',' placeholder="payment_confirm_receipt" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('valid_until','valid_until',form_input_(getArrayObj('edvalid_until','','200'),'',' placeholder="valid_until" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('registration_id','registration_id',form_input_(getArrayObj('edregistration_id','','200'),'',' placeholder="registration_id" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('member_name','member_name',form_input_(getArrayObj('edmember_name','','200'),'',' placeholder="member_name" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('payment_unique_id','payment_unique_id',form_input_(getArrayObj('edpayment_unique_id','','200'),'',' placeholder="payment_unique_id" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','new','onclick="doClearcoupons();"').form_button('btSimpan','Simpan','onclick="dosimpancoupons();"').form_button('btTabel','Tabel','onclick="dosearchcoupons(0);"').'<div class="spacer"></div></div><div id="tabledatacoupons">'.$this->getlistcoupons(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistcoupons($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('No','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('edition_id','','data-field="edition_id" data-sortable="true" width=10%').
tbaddcellhead('coupon_number','','data-field="coupon_number" data-sortable="true" width=10%').
tbaddcellhead('qr_code','','data-field="qr_code" data-sortable="true" width=10%').
tbaddcellhead('coupon_price','','data-field="coupon_price" data-sortable="true" width=10%').
tbaddcellhead('shipper_price','','data-field="shipper_price" data-sortable="true" width=10%').
tbaddcellhead('total_price','','data-field="total_price" data-sortable="true" width=10%').
tbaddcellhead('is_winner','','data-field="is_winner" data-sortable="true" width=10%').
tbaddcellhead('payment_status_id','','data-field="payment_status_id" data-sortable="true" width=10%').
tbaddcellhead('payment_confirm_receipt','','data-field="payment_confirm_receipt" data-sortable="true" width=10%').
tbaddcellhead('valid_until','','data-field="valid_until" data-sortable="true" width=10%').
tbaddcellhead('registration_id','','data-field="registration_id" data-sortable="true" width=10%').
tbaddcellhead('member_name','','data-field="member_name" data-sortable="true" width=10%').
tbaddcellhead('payment_unique_id','','data-field="payment_unique_id" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modelcoupons');
         $xQuery = $this->modelcoupons->getListcoupons($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
$no = 1;
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditcoupons(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapuscoupons(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($no++).
tbaddcell($row->edition_id).
tbaddcell($row->coupon_number).
tbaddcell($row->qr_code).
tbaddcell($row->coupon_price).
tbaddcell($row->shipper_price).
tbaddcell($row->total_price).
tbaddcell($row->is_winner).
tbaddcell($row->payment_status_id).
tbaddcell($row->payment_confirm_receipt).
tbaddcell($row->valid_until).
tbaddcell($row->registration_id).
tbaddcell($row->member_name).
tbaddcell($row->payment_unique_id).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchcoupons(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchcoupons('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchcoupons('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editreccoupons(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modelcoupons');  
         $row = $this->modelcoupons->getDetailcoupons($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['edition_id'] = $row->edition_id;
$this->json_data['coupon_number'] = $row->coupon_number;
$this->json_data['qr_code'] = $row->qr_code;
$this->json_data['coupon_price'] = $row->coupon_price;
$this->json_data['shipper_price'] = $row->shipper_price;
$this->json_data['total_price'] = $row->total_price;
$this->json_data['is_winner'] = $row->is_winner;
$this->json_data['payment_status_id'] = $row->payment_status_id;
$this->json_data['payment_confirm_receipt'] = $row->payment_confirm_receipt;
$this->json_data['valid_until'] = $row->valid_until;
$this->json_data['registration_id'] = $row->registration_id;
$this->json_data['member_name'] = $row->member_name;
$this->json_data['payment_unique_id'] = $row->payment_unique_id;

            echo json_encode($this->json_data);
   }
function deletetablecoupons(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modelcoupons'); 
    $this->modelcoupons->setDeletecoupons($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchcoupons(){ 
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
        $this->json_data['tabledatacoupons'] = $this->getlistcoupons($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpancoupons(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xedition_id = $_POST['ededition_id'];
$xcoupon_number = $_POST['edcoupon_number'];
$xqr_code = $_POST['edqr_code'];
$xcoupon_price = $_POST['edcoupon_price'];
$xshipper_price = $_POST['edshipper_price'];
$xtotal_price = $_POST['edtotal_price'];
$xis_winner = $_POST['edis_winner'];
$xpayment_status_id = $_POST['edpayment_status_id'];
$xpayment_confirm_receipt = $_POST['edpayment_confirm_receipt'];
$xvalid_until = $_POST['edvalid_until'];
$xregistration_id = $_POST['edregistration_id'];
$xmember_name = $_POST['edmember_name'];
$xpayment_unique_id = $_POST['edpayment_unique_id'];
          
             $this->load->model('modelcoupons'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modelcoupons->setUpdatecoupons($xidx,$xedition_id,$xcoupon_number,$xqr_code,$xcoupon_price,$xshipper_price,$xtotal_price,$xis_winner,$xpayment_status_id,$xpayment_confirm_receipt,$xvalid_until,$xregistration_id,$xmember_name,$xpayment_unique_id); 
         } else 
         { 
           $xStr =  $this->modelcoupons->setInsertcoupons($xidx,$xedition_id,$xcoupon_number,$xqr_code,$xcoupon_price,$xshipper_price,$xtotal_price,$xis_winner,$xpayment_status_id,$xpayment_confirm_receipt,$xvalid_until,$xregistration_id,$xmember_name,$xpayment_unique_id); 
         }} 
               echo json_encode(null);
    } }