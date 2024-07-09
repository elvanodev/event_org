<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : pegawai   *  By Diar */

      class Ctrpegawai extends CI_Controller { 
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
        $this->createformpegawai('0',$xAwal);
 } 
    
function createformpegawai($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxpegawai.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormpegawai($xidx), '', '', $xAddJs,'','pegawai' ); 

}
 
function setDetailFormpegawai($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrpegawai/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('nama','Nama',form_input_(getArrayObj('ednama','','200'),'',' placeholder="Nama" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('email','Email',form_input_(getArrayObj('edemail','','200'),'',' placeholder="Email" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('nohp','No HP',form_input_(getArrayObj('ednohp','','200'),'',' placeholder="No HP" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('idgroup','Group',form_input_(getArrayObj('edidgroup','','200'),'',' placeholder="Group" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('isaktif','Is Aktif',form_dropdown_('edisaktif', array('Y' => 'Y', 'N' => 'N'),'',' id="edisaktif" placeholder="Is Aktif" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tglmasuk','Tanggal Masuk',form_input_(getArrayObj('edtglmasuk','','200'),'',' placeholder="Tanggal Masuk" class="tanggal"')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','New','onclick="doClearpegawai();"').form_button('btSimpan','Simpan','onclick="dosimpanpegawai();" id="btSimpan"').form_button('btTabel','Tabel','onclick="dosearchpegawai(0);"').'<div class="spacer"></div></div></div><div id="tabledatapegawai">'.$this->getlistpegawai(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistpegawai($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('No','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('Nama','','data-field="nama" data-sortable="true" width=10%').
tbaddcellhead('Email','','data-field="email" data-sortable="true" width=10%').
tbaddcellhead('No HP','','data-field="nohp" data-sortable="true" width=10%').
tbaddcellhead('Group','','data-field="idgroup" data-sortable="true" width=10%').
tbaddcellhead('Aktif','','data-field="isaktif" data-sortable="true" width=10%').
tbaddcellhead('Tanggal Masuk','','data-field="tglmasuk" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modelpegawai');
         $xQuery = $this->modelpegawai->getListpegawai($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
$no = 1;
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditpegawai(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapuspegawai(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($no++).
tbaddcell($row->nama).
tbaddcell($row->email).
tbaddcell($row->nohp).
tbaddcell($row->idgroup).
tbaddcell($row->isaktif).
tbaddcell(mysqltodate($row->tglmasuk)).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchpegawai(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchpegawai('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchpegawai('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editrecpegawai(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modelpegawai');  
         $row = $this->modelpegawai->getDetailpegawai($xIdEdit); 
        $this->load->helper('json'); 
        $this->load->helper('common'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['nama'] = $row->nama;
$this->json_data['email'] = $row->email;
$this->json_data['nohp'] = $row->nohp;
$this->json_data['idgroup'] = $row->idgroup;
$this->json_data['isaktif'] = $row->isaktif;
$this->json_data['tglmasuk'] = mysqltodate($row->tglmasuk);

            echo json_encode($this->json_data);
   }
function deletetablepegawai(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modelpegawai'); 
    $this->modelpegawai->setDeletepegawai($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchpegawai(){ 
    $xAwal = $_POST['xAwal']; 
    $xSearch = $_POST['xSearch']; 
    $this->load->helper('json'); 
    $xhalaman = @ceil($xAwal/($xAwal-$this->session->userdata('awal', $xAwal)));
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
        $this->json_data['tabledatapegawai'] = $this->getlistpegawai($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpanpegawai(){ 
        $this->load->helper('json'); 
        $this->load->helper('common'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xnama = $_POST['ednama'];
$xemail = $_POST['edemail'];
$xnohp = $_POST['ednohp'];
$xidgroup = $_POST['edidgroup'];
$xisaktif = $_POST['edisaktif'];
$xtglmasuk = $_POST['edtglmasuk'];
          
             $this->load->model('modelpegawai'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modelpegawai->setUpdatepegawai($xidx,$xnama,$xemail,$xnohp,$xidgroup,$xisaktif,datetomysql($xtglmasuk)); 
         } else 
         { 
           $xStr =  $this->modelpegawai->setInsertpegawai($xidx,$xnama,$xemail,$xnohp,$xidgroup,$xisaktif,datetomysql($xtglmasuk)); 
         }} 
               echo json_encode(null);
    } }