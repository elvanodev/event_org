<?php if(!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung'); 
    /* Class  Control : member   *  By Diar */

      class Ctrmember extends CI_Controller { 
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
        $this->createformmember('0',$xAwal);
 } 
    
function createformmember($xidx, $xAwal = 0, $xSearch = '') {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
	'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
     '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmember.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormmember($xidx), '', '', $xAddJs,'','member' ); 

}
 
function setDetailFormmember($xidx){
        $this->load->helper('form'); 
          $xBufResult = '';
           $xBufResult = '<div id="stylized" class="myform">'.form_open_multipart('ctrmember/inserttable',array('id'=>'form','name'=>'form'));
      $this->load->helper('common');
      	$xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />'; 
        
$xBufResult .= setForm('nama','nama',form_input_(getArrayObj('ednama','','200'),'',' placeholder="nama" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('email','email',form_input_(getArrayObj('edemail','','200'),'',' placeholder="email" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('gender','gender',form_input_(getArrayObj('edgender','','200'),'',' placeholder="gender" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('nilaiupah','nilaiupah',form_input_(getArrayObj('ednilaiupah','','200'),'',' placeholder="nilaiupah" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('idsubsektor','idsubsektor',form_input_(getArrayObj('edidsubsektor','','200'),'',' placeholder="idsubsektor" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('subsektorname','subsektorname',form_input_(getArrayObj('edsubsektorname','','200'),'',' placeholder="subsektorname" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('jenisprofesi','jenisprofesi',form_input_(getArrayObj('edjenisprofesi','','200'),'',' placeholder="jenisprofesi" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('idpendidikan','idpendidikan',form_input_(getArrayObj('edidpendidikan','','200'),'',' placeholder="idpendidikan" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('namapendidikan','namapendidikan',form_input_(getArrayObj('ednamapendidikan','','200'),'',' placeholder="namapendidikan" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('idprovinsi','idprovinsi',form_input_(getArrayObj('edidprovinsi','','200'),'',' placeholder="idprovinsi" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('idkabupaten','idkabupaten',form_input_(getArrayObj('edidkabupaten','','200'),'',' placeholder="idkabupaten" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungan','tanggungan',form_input_(getArrayObj('edtanggungan','','200'),'',' placeholder="tanggungan" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggunganpasangan','tanggunganpasangan',form_input_(getArrayObj('edtanggunganpasangan','','200'),'',' placeholder="tanggunganpasangan" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungananak1','tanggungananak1',form_input_(getArrayObj('edtanggungananak1','','200'),'',' placeholder="tanggungananak1" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungananak2','tanggungananak2',form_input_(getArrayObj('edtanggungananak2','','200'),'',' placeholder="tanggungananak2" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungananak3','tanggungananak3',form_input_(getArrayObj('edtanggungananak3','','200'),'',' placeholder="tanggungananak3" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungananak4','tanggungananak4',form_input_(getArrayObj('edtanggungananak4','','200'),'',' placeholder="tanggungananak4" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungansaudara','tanggungansaudara',form_input_(getArrayObj('edtanggungansaudara','','200'),'',' placeholder="tanggungansaudara" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('tanggungankeluarga','tanggungankeluarga',form_input_(getArrayObj('edtanggungankeluarga','','200'),'',' placeholder="tanggungankeluarga" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('isanggotaserikatpekerja','isanggotaserikatpekerja',form_input_(getArrayObj('edisanggotaserikatpekerja','','200'),'',' placeholder="isanggotaserikatpekerja" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('namaserikat','namaserikat',form_input_(getArrayObj('ednamaserikat','','200'),'',' placeholder="namaserikat" ')).'<div class="spacer"></div>';

$xBufResult .= setForm('formuniqueid','formuniqueid',form_input_(getArrayObj('edformuniqueid','','200'),'',' placeholder="formuniqueid" ')).'<div class="spacer"></div>';

$xBufResult .= '<div class="garis"></div></div></div>'.form_button('btNew','new','onclick="doClearmember();"').form_button('btSimpan','Simpan','onclick="dosimpanmember();"').form_button('btTabel','Tabel','onclick="dosearchmember(0);"').'<div class="spacer"></div></div><div id="tabledatamember">'.$this->getlistmember(0, ''). '</div><div class="spacer"></div>'; 
       return $xBufResult;

  }
  
function getlistmember($xAwal,$xSearch){ 
         $xLimit = $this->session->userdata('limit');
        $this->load->helper('form');
        $this->load->helper('common');
         $xbufResult1 =tbaddrow(         tbaddcellhead('idx','','data-field="idx" data-sortable="true" width=10%').
tbaddcellhead('nama','','data-field="nama" data-sortable="true" width=10%').
tbaddcellhead('email','','data-field="email" data-sortable="true" width=10%').
tbaddcellhead('gender','','data-field="gender" data-sortable="true" width=10%').
tbaddcellhead('nilaiupah','','data-field="nilaiupah" data-sortable="true" width=10%').
tbaddcellhead('idsubsektor','','data-field="idsubsektor" data-sortable="true" width=10%').
tbaddcellhead('subsektorname','','data-field="subsektorname" data-sortable="true" width=10%').
tbaddcellhead('jenisprofesi','','data-field="jenisprofesi" data-sortable="true" width=10%').
tbaddcellhead('idpendidikan','','data-field="idpendidikan" data-sortable="true" width=10%').
tbaddcellhead('namapendidikan','','data-field="namapendidikan" data-sortable="true" width=10%').
tbaddcellhead('idprovinsi','','data-field="idprovinsi" data-sortable="true" width=10%').
tbaddcellhead('idkabupaten','','data-field="idkabupaten" data-sortable="true" width=10%').
tbaddcellhead('tanggungan','','data-field="tanggungan" data-sortable="true" width=10%').
tbaddcellhead('tanggunganpasangan','','data-field="tanggunganpasangan" data-sortable="true" width=10%').
tbaddcellhead('tanggungananak1','','data-field="tanggungananak1" data-sortable="true" width=10%').
tbaddcellhead('tanggungananak2','','data-field="tanggungananak2" data-sortable="true" width=10%').
tbaddcellhead('tanggungananak3','','data-field="tanggungananak3" data-sortable="true" width=10%').
tbaddcellhead('tanggungananak4','','data-field="tanggungananak4" data-sortable="true" width=10%').
tbaddcellhead('tanggungansaudara','','data-field="tanggungansaudara" data-sortable="true" width=10%').
tbaddcellhead('tanggungankeluarga','','data-field="tanggungankeluarga" data-sortable="true" width=10%').
tbaddcellhead('isanggotaserikatpekerja','','data-field="isanggotaserikatpekerja" data-sortable="true" width=10%').
tbaddcellhead('namaserikat','','data-field="namaserikat" data-sortable="true" width=10%').
tbaddcellhead('formuniqueid','','data-field="formuniqueid" data-sortable="true" width=10%').

            tbaddcellhead('Action','padding:5px;width:10%;text-align:center;','col-md-2'),'',TRUE);
         $this->load->model('modelmember');
         $xQuery = $this->modelmember->getListmember($xAwal,$xLimit,$xSearch);
          $xbufResult ='<thead>'.$xbufResult1.'</thead>';
        $xbufResult .='<tbody>';
              foreach ($xQuery->result() as $row)
            { 
                  $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditmember(\''.$row->idx.'\');" ></i>';
            $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusmember(\''.$row->idx.'\');"></i>';
            $xbufResult .= tbaddrow(         tbaddcell($row->idx).
tbaddcell($row->nama).
tbaddcell($row->email).
tbaddcell($row->gender).
tbaddcell($row->nilaiupah).
tbaddcell($row->idsubsektor).
tbaddcell($row->subsektorname).
tbaddcell($row->jenisprofesi).
tbaddcell($row->idpendidikan).
tbaddcell($row->namapendidikan).
tbaddcell($row->idprovinsi).
tbaddcell($row->idkabupaten).
tbaddcell($row->tanggungan).
tbaddcell($row->tanggunganpasangan).
tbaddcell($row->tanggungananak1).
tbaddcell($row->tanggungananak2).
tbaddcell($row->tanggungananak3).
tbaddcell($row->tanggungananak4).
tbaddcell($row->tanggungansaudara).
tbaddcell($row->tanggungankeluarga).
tbaddcell($row->isanggotaserikatpekerja).
tbaddcell($row->namaserikat).
tbaddcell($row->formuniqueid).

            tbaddcell($xButtonEdit.$xButtonHapus));
            }
          $xInput      = form_input_(getArrayObj('edSearch','','200')); 
          $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchmember(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
          $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchmember('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchmember('.($xAwal-$xLimit).');"><i class="fas fa-chevron-circle-right"></i></a>';
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

  
         function editrecmember(){ 
        $xIdEdit  = $_POST['edidx']; 
        $this->load->model('modelmember');  
         $row = $this->modelmember->getDetailmember($xIdEdit); 
        $this->load->helper('json'); 
      $this->json_data['idx'] = $row->idx;
$this->json_data['nama'] = $row->nama;
$this->json_data['email'] = $row->email;
$this->json_data['gender'] = $row->gender;
$this->json_data['nilaiupah'] = $row->nilaiupah;
$this->json_data['idsubsektor'] = $row->idsubsektor;
$this->json_data['subsektorname'] = $row->subsektorname;
$this->json_data['jenisprofesi'] = $row->jenisprofesi;
$this->json_data['idpendidikan'] = $row->idpendidikan;
$this->json_data['namapendidikan'] = $row->namapendidikan;
$this->json_data['idprovinsi'] = $row->idprovinsi;
$this->json_data['idkabupaten'] = $row->idkabupaten;
$this->json_data['tanggungan'] = $row->tanggungan;
$this->json_data['tanggunganpasangan'] = $row->tanggunganpasangan;
$this->json_data['tanggungananak1'] = $row->tanggungananak1;
$this->json_data['tanggungananak2'] = $row->tanggungananak2;
$this->json_data['tanggungananak3'] = $row->tanggungananak3;
$this->json_data['tanggungananak4'] = $row->tanggungananak4;
$this->json_data['tanggungansaudara'] = $row->tanggungansaudara;
$this->json_data['tanggungankeluarga'] = $row->tanggungankeluarga;
$this->json_data['isanggotaserikatpekerja'] = $row->isanggotaserikatpekerja;
$this->json_data['namaserikat'] = $row->namaserikat;
$this->json_data['formuniqueid'] = $row->formuniqueid;

            echo json_encode($this->json_data);
   }
function deletetablemember(){ 
    $edidx = $_POST['edidx']; 
    $this->load->model('modelmember'); 
    $this->modelmember->setDeletemember($edidx); 
    $this->load->helper('json');
    echo json_encode(null);
  }
function searchmember(){ 
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
        $this->json_data['tabledatamember'] = $this->getlistmember($xAwal, $xSearch);
        $this->json_data['halaman'] = $xAwal.' to '.($xlimit*$xHal);
    echo json_encode($this->json_data); 
  } 

 function  simpanmember(){ 
        $this->load->helper('json'); 
          if(!empty($_POST['edidx'])) 
        { 
         $xidx =  $_POST['edidx']; 
          } else{ 
         $xidx = '0'; 
         } 
$xnama = $_POST['ednama'];
$xemail = $_POST['edemail'];
$xgender = $_POST['edgender'];
$xnilaiupah = $_POST['ednilaiupah'];
$xidsubsektor = $_POST['edidsubsektor'];
$xsubsektorname = $_POST['edsubsektorname'];
$xjenisprofesi = $_POST['edjenisprofesi'];
$xidpendidikan = $_POST['edidpendidikan'];
$xnamapendidikan = $_POST['ednamapendidikan'];
$xidprovinsi = $_POST['edidprovinsi'];
$xidkabupaten = $_POST['edidkabupaten'];
$xtanggungan = $_POST['edtanggungan'];
$xtanggunganpasangan = $_POST['edtanggunganpasangan'];
$xtanggungananak1 = $_POST['edtanggungananak1'];
$xtanggungananak2 = $_POST['edtanggungananak2'];
$xtanggungananak3 = $_POST['edtanggungananak3'];
$xtanggungananak4 = $_POST['edtanggungananak4'];
$xtanggungansaudara = $_POST['edtanggungansaudara'];
$xtanggungankeluarga = $_POST['edtanggungankeluarga'];
$xisanggotaserikatpekerja = $_POST['edisanggotaserikatpekerja'];
$xnamaserikat = $_POST['ednamaserikat'];
$xformuniqueid = $_POST['edformuniqueid'];
          
             $this->load->model('modelmember'); 
        $xidpegawai = $this->session->userdata('idpegawai'); 
        if(!empty($xidpegawai)){ 
        if($xidx!='0'){   $xStr =  $this->modelmember->setUpdatemember($xidx,$xnama,$xemail,$xgender,$xnilaiupah,$xidsubsektor,$xsubsektorname,$xjenisprofesi,$xidpendidikan,$xnamapendidikan,$xidprovinsi,$xidkabupaten,$xtanggungan,$xtanggunganpasangan,$xtanggungananak1,$xtanggungananak2,$xtanggungananak3,$xtanggungananak4,$xtanggungansaudara,$xtanggungankeluarga,$xisanggotaserikatpekerja,$xnamaserikat,$xformuniqueid); 
         } else 
         { 
           $xStr =  $this->modelmember->setInsertmember($xidx,$xnama,$xemail,$xgender,$xnilaiupah,$xidsubsektor,$xsubsektorname,$xjenisprofesi,$xidpendidikan,$xnamapendidikan,$xidprovinsi,$xidkabupaten,$xtanggungan,$xtanggunganpasangan,$xtanggungananak1,$xtanggungananak2,$xtanggungananak3,$xtanggungananak4,$xtanggungansaudara,$xtanggungankeluarga,$xisanggotaserikatpekerja,$xnamaserikat,$xformuniqueid); 
         }} 
               echo json_encode(null);
    } }