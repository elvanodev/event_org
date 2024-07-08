<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : jenisupload   *  By Diar */

      class Ctrjenisupload extends CI_Controller { 
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
        $this->createformjenisupload('0',$xAwal);
 } 
    
function createformjenisupload($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxjenisupload.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormjenisupload($xidx), '', '', $xAddJs,'','jenisupload' ); 

}
 
function setDetailFormjenisupload($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrjenisupload/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('jenisupload','jenisupload',form_input_(getArrayObj('edjenisupload','','200'),'',' placeholder="jenisupload" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div>'.form_button('btSimpan','simpan','onclick="dosimpanjenisupload();"').form_button('btNew','New','onclick="doClearjenisupload();"').'<div class="spacer"></div><div id="tabledatajenisupload">'.$this->getlistjenisupload(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistjenisupload($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('idx','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('jenisupload','','data-field="jenisupload" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;','width:10%;text-align:center;'),'',TRUE);
         $this->load->model('modeljenisupload');
         $xQuery = $this->modeljenisupload->getListjenisupload($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
              foreach ($xQuery->result() as $row)
            { 
              $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditjenisupload(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
              $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapusjenisupload(\'' . $row->idx . '\');"><i class="fas fa-trash" ></i></a>';
            //        $xButtonEdit = '<i class="fa fa-pencil-square-o btn" aria-hidden="true"  onclick = "doeditjenisupload(\''.$row->idx.'\');" ></i>';
            // $xButtonHapus = '<i class="fa fa-trash btn" aria-hidden="true" onclick = "dohapusjenisupload(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($row->idx).
tbaddcell($row->jenisupload).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','',' ')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchjenisupload(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchjenisupload(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchjenisupload(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
// $xButtonPrev = '<img src="'.base_url().'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchjenisupload('.($xAwal-$xLimit).');"/>';
          $xButtonhalaman = '<button id="edHalaman" class="btn btn-default" disabled>'.$xAwal.' to '.$xLimit.'</button>';
        // $xButtonNext = '<img src="'.base_url().'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchjenisupload('.($xAwal+$xLimit).');" />';
       $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">'.setForm('','',$xInput . $xButtonSearch,'','').'</div>'.
                '<div class="col-md-6 text-right">'.$xButtonPrev . $xButtonhalaman . $xButtonNext.'</div></div>';
        
      $xbufResult = tablegrid($xbufResult . '</tbody>','','id="table" data-toggle="table" data-url="" data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-query-params="queryParams" data-pagination="true"') . $xbuffoottable;
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

  
function getlistjenisuploadAndroid(){ 
    $this->load->helper('json');
     $xSearch  = $_POST['search'];
      $xAwal  = $_POST['start'];
      $xLimit = $_POST['limit'];
    $this->load->helper('form');
    $this->load->helper('common');
       $this->json_data['idx'] = "";
$this->json_data['jenisupload'] = "";

            $response = array();
     $this->load->model('modeljenisupload');
     $xQuery = $this->modeljenisupload->getListjenisupload($xAwal,$xLimit,$xSearch);
      foreach ($xQuery->result() as $row){
                $this->json_data['idx']=$row->idx;
$this->json_data['jenisupload']=$row->jenisupload;

            array_push($response, $this->json_data);
        }
      if(empty($response)){        array_push($response, $this->json_data);       }
      echo json_encode($response);

}

function  simpanjenisuploadAndroid(){ 
    $xidx = $_POST['edidx'];
$xjenisupload = $_POST['edjenisupload'];

            $this->load->helper('json');
     $this->load->model('modeljenisupload');
     $response = array();if($xidx!='0'){$this->modeljenisupload->setUpdatejenisupload($xidx,$xjenisupload);
      } else 
     { 
        $this->modeljenisupload->setInsertjenisupload($xidx,$xjenisupload);
     }
    $row = $this->modeljenisupload->getLastIndexjenisupload();
    $this->json_data['idx'] = $row->idx;
$this->json_data['jenisupload'] = $row->jenisupload;

            $response = array();        
                array_push($response, $this->json_data);          

                echo json_encode($response); }

 function editrecjenisupload(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modeljenisupload');  
         $row = $this->modeljenisupload->getDetailjenisupload($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['jenisupload'] = $row->jenisupload;

            echo json_encode($this->json_data);
   }
function deletetablejenisupload(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modeljenisupload'); 
    $this->modeljenisupload->setDeletejenisupload($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchjenisupload(){ 
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
        $this->json_data['tabledatajenisupload'] = $this->getlistjenisupload($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpanjenisupload(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xjenisupload = $_POST['edjenisupload'];
          
             $this->load->model('modeljenisupload'); 
        $idpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($idpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modeljenisupload->setUpdatejenisupload($xidx,$xjenisupload); 
         } else 
         { 
           $xStr =  $this->modeljenisupload->setInsertjenisupload($xidx,$xjenisupload); 
         }} 
               echo json_encode(null);
    } }