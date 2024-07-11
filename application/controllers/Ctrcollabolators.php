<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : collabolators   *  By Diar */

class Ctrcollabolators extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }


  function index($xAwal = 0, $xSearch = '')
  {
    $idpegawai = $this->session->userdata('idpegawai');
    if (empty($idpegawai)) {
      redirect(site_url(), '');
    }
    if ($xAwal <= -1) {
      $xAwal = 0;
    }
    $this->session->set_userdata('awal', $xAwal);
    $this->session->set_userdata('limit', 100);
    $this->createformcollabolators('0', $xAwal);
  }

  function createformcollabolators($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxcollabolators.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormcollabolators($xidx), '', '', $xAddJs, '', 'collabolators');
  }

  function setDetailFormcollabolators($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrcollabolators/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $this->load->model('modelevents');
    $event = $this->modelevents->getLastIndexevents();
    $selected_event = array();
    $selected_event['selected'] = $event->idx;
    $xBufResult .= setForm('event_id', 'Event', form_dropdown_($selected_event, $this->modelevents->getArrayListevents(), '', 'id="edevent_id" class="require" style="width:200px;" placeholder="Event" onchange="onchangeeventid()"')) . '<div class="spacer"></div>';

    $this->load->model('modeleditions');
    $edition = $this->modeleditions->getLastIndexeditions();
    $selected_edition = array();
    $selected_edition['selected'] = $edition->idx;
    $xBufResult .= setForm('edition_id', 'Edition', form_dropdown_($selected_edition, $this->modeleditions->getArrayListeditionsbyevent_id(1), '', 'id="ededition_id" class="require" style="width:200px;" placeholder="Edition"')) . '<div class="spacer"></div>';

    $this->load->model('modelartists');
    $artist = $this->modelartists->getLastIndexartists();
    $selected_artist = array();
    $selected_artist['selected'] = $artist->idx;
    $xBufResult .= setForm('artist_id', 'Artist', form_dropdown_($selected_artist, $this->modelartists->getArrayListartists(), '', 'id="edartist_id" class="require" style="width:200px;" placeholder="Artist"')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'new', 'onclick="doClearcollabolators();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpancollabolators();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchcollabolators(0);"') . '<div class="spacer"></div></div><div id="tabledatacollabolators">' . $this->getlistcollabolators(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistcollabolators($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('Edition', '', 'data-field="edition_id" data-sortable="true" width=10%') .
      tbaddcellhead('Artist', '', 'data-field="artist_id" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelcollabolators');
    $xQuery = $this->modelcollabolators->getListcollabolators($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditcollabolators(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapuscollabolators(\'' . $row->idx . '\');"></i>';
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->edition_name) .
        tbaddcell($row->artist_name) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchcollabolators(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchcollabolators(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchcollabolators(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
    $xButtonhalaman = '<button id="edHalaman" class="btn btn-default" disabled>' . $xAwal . ' to ' . $xLimit . '</button>';
    $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
      '<div class="col-md-6 text-right">' . $xButtonPrev . $xButtonhalaman . $xButtonNext . '</div></div>';

    $xbufResult = tablegrid($xbufResult . '</tbody>', '', 'id="table" data-toggle="table" data-url="" data-query-params="queryParams" data-pagination="true"') . $xbuffoottable;
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


  function editreccollabolators()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelcollabolators');
    $row = $this->modelcollabolators->getDetailcollabolators($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['edition_id'] = $row->edition_id;
    $this->json_data['artist_id'] = $row->artist_id;

    echo json_encode($this->json_data);
  }
  function deletetablecollabolators()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelcollabolators');
    $this->modelcollabolators->setDeletecollabolators($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchcollabolators()
  {
    $xAwal = $_POST['xAwal'];
    $xSearch = $_POST['xSearch'];
    $this->load->helper('json');
    $xhalaman = 0;
    if ($xAwal != 0) {
      $xhalaman = @ceil($xAwal / ($xAwal - $this->session->userdata('awal', $xAwal)));
    }
    $xlimit = $this->session->userdata('limit');
    $xHal = 1;
    if ($xAwal <= 0) {
      $xHal = 1;
    } else {
      $xHal = ($xhalaman + 1);
    }
    if ($xhalaman < 0) {
      $xHal = (($xhalaman - 1) * -1);
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
    $this->json_data['tabledatacollabolators'] = $this->getlistcollabolators($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpancollabolators()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xedition_id = $_POST['ededition_id'];
    $xartist_id = $_POST['edartist_id'];

    $this->load->model('modelcollabolators');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelcollabolators->setUpdatecollabolators($xidx, $xedition_id, $xartist_id);
      } else {
        $xStr =  $this->modelcollabolators->setInsertcollabolators($xidx, $xedition_id, $xartist_id);
      }
    }
    echo json_encode(null);
  }
}
