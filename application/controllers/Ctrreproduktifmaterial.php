<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : reproduktifmaterial   *  By Diar */

      class Ctrreproduktifmaterial extends CI_Controller { 
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
        $this->createformreproduktifmaterial('0',$xAwal);
 } 
    
function createformreproduktifmaterial($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxreproduktifmaterial.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormreproduktifmaterial($xidx), '', '', $xAddJs,'','reproduktifmaterial' ); 

}
 
function setDetailFormreproduktifmaterial($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrreproduktifmaterial/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('idmember','idmember',form_input_(getArrayObj('edidmember','','200'),'',' placeholder="idmember" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('idjenisalatkerja','idjenisalatkerja',form_input_(getArrayObj('edidjenisalatkerja','','200'),'',' placeholder="idjenisalatkerja" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('alatkerja','alatkerja',form_input_(getArrayObj('edalatkerja','','200'),'',' placeholder="alatkerja" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('penyedia','penyedia',form_input_(getArrayObj('edpenyedia','','200'),'',' placeholder="penyedia" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('harga','harga',form_input_(getArrayObj('edharga','','200'),'',' placeholder="harga" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('durability','durability',form_input_(getArrayObj('eddurability','','200'),'',' placeholder="durability" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','new','onclick="doClearreproduktifmaterial();"').form_button('btSimpan','Simpan','onclick="dosimpanreproduktifmaterial();"').form_button('btTabel','Tabel','onclick="dosearchreproduktifmaterial(0);"').'<div class="spacer"></div></div><div id="tabledatareproduktifmaterial">'.$this->getlistreproduktifmaterial(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistreproduktifmaterial($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('idx','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('idmember','','data-field="idmember" data-sortable="true" width=10%').
tbaddcellhead('idjenisalatkerja','','data-field="idjenisalatkerja" data-sortable="true" width=10%').
tbaddcellhead('alatkerja','','data-field="alatkerja" data-sortable="true" width=10%').
tbaddcellhead('penyedia','','data-field="penyedia" data-sortable="true" width=10%').
tbaddcellhead('harga','','data-field="harga" data-sortable="true" width=10%').
tbaddcellhead('durability','','data-field="durability" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modelreproduktifmaterial');
         $xQuery = $this->modelreproduktifmaterial->getListreproduktifmaterial($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditreproduktifmaterial(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusreproduktifmaterial(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($row->idx).
tbaddcell($row->idmember).
tbaddcell($row->idjenisalatkerja).
tbaddcell($row->alatkerja).
tbaddcell($row->penyedia).
tbaddcell($row->harga).
tbaddcell($row->durability).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchreproduktifmaterial(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchreproduktifmaterial('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchreproduktifmaterial('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editrecreproduktifmaterial(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modelreproduktifmaterial');  
         $row = $this->modelreproduktifmaterial->getDetailreproduktifmaterial($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['idmember'] = $row->idmember;
$this->json_data['idjenisalatkerja'] = $row->idjenisalatkerja;
$this->json_data['alatkerja'] = $row->alatkerja;
$this->json_data['penyedia'] = $row->penyedia;
$this->json_data['harga'] = $row->harga;
$this->json_data['durability'] = $row->durability;

            echo json_encode($this->json_data);
   }
function deletetablereproduktifmaterial(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modelreproduktifmaterial'); 
    $this->modelreproduktifmaterial->setDeletereproduktifmaterial($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchreproduktifmaterial(){ 
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
        $this->json_data['tabledatareproduktifmaterial'] = $this->getlistreproduktifmaterial($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpanreproduktifmaterial(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xidmember = $_POST['edidmember'];
$xidjenisalatkerja = $_POST['edidjenisalatkerja'];
$xalatkerja = $_POST['edalatkerja'];
$xpenyedia = $_POST['edpenyedia'];
$xharga = $_POST['edharga'];
$xdurability = $_POST['eddurability'];
          
             $this->load->model('modelreproduktifmaterial'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modelreproduktifmaterial->setUpdatereproduktifmaterial($xidx,$xidmember,$xidjenisalatkerja,$xalatkerja,$xpenyedia,$xharga,$xdurability); 
         } else 
         { 
           $xStr =  $this->modelreproduktifmaterial->setInsertreproduktifmaterial($xidx,$xidmember,$xidjenisalatkerja,$xalatkerja,$xpenyedia,$xharga,$xdurability); 
         }} 
               echo json_encode(null);
    } }