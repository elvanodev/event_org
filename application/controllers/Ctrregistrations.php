<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : registrations   *  By Diar */

class Ctrregistrations extends CI_Controller
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
    $this->createformregistrations('0', $xAwal);
  }

  function createformregistrations($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxregistrations.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormregistrations($xidx), '', '', $xAddJs, '', 'registrations');
  }

  function setDetailFormregistrations($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrregistrations/inserttable', array('id' => 'form', 'name' => 'form'));
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

    $this->load->model('modelmembers');
    $member = $this->modelmembers->getLastIndexmembers();
    $selected_member = array();
    if ($member)
      $selected_member['selected'] = $member->idx;
    else
      $selected_member['selected'] = 0;
    $xBufResult .= setForm('member_id', 'Member', form_dropdown_($selected_member, $this->modelmembers->getArrayListmembers(), '', 'id="edmember_id" class="require" style="width:200px;" placeholder="Member"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('registered_at', 'Registered at', form_input_(getArrayObj('edregistered_at', '', '200'), '', ' placeholder="Registered at" class="datetimepicker"')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doClearregistrations();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanregistrations();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchregistrations(0);"') . '<div class="spacer"></div></div><div id="tabledataregistrations">' . $this->getlistregistrations(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistregistrations($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('Edition', '', 'data-field="edition_id" data-sortable="true" width=10%') .
      tbaddcellhead('Member', '', 'data-field="member_id" data-sortable="true" width=10%') .
      tbaddcellhead('Registered at', '', 'data-field="registered_at" data-sortable="true" width=10%') .
      tbaddcellhead('QR Code', '', 'data-field="qr_code" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelregistrations');
    $xQuery = $this->modelregistrations->getListregistrations($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditregistrations(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusregistrations(\'' . $row->idx . '\');"></i>';
      if (!empty($row->qr_code)) {
        $qr_code = '<img src="' . base_url() . 'resource/uploaded/qrcodes/' . $row->qr_code . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->edition_name) .
        tbaddcell($row->member_name) .
        tbaddcell($row->registered_at) .
        tbaddcell($qr_code) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchregistrations(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchregistrations(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchregistrations(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecregistrations()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelregistrations');
    $row = $this->modelregistrations->getDetailregistrations($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['edition_id'] = $row->edition_id;
    $this->json_data['member_id'] = $row->member_id;
    $this->json_data['registered_at'] = $row->registered_at;
    $this->json_data['qr_code'] = $row->qr_code;

    echo json_encode($this->json_data);
  }
  function deletetableregistrations()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelregistrations');
    $this->modelregistrations->setDeleteregistrations($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchregistrations()
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
    $this->json_data['tabledataregistrations'] = $this->getlistregistrations($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpanregistrations()
  {
    $this->load->helper('qrcode');
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xedition_id = $_POST['ededition_id'];
    $xmember_id = $_POST['edmember_id'];
    $xregistered_at = $_POST['edregistered_at'];

    $prefix = "ED".$xedition_id."_"."M".$xmember_id;
    $xqr_code = generate_qrcode($prefix, true, 10);

    $this->load->model('modelregistrations');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelregistrations->setUpdateregistrations($xidx, $xedition_id, $xmember_id, $xregistered_at);
      } else {
        $xStr =  $this->modelregistrations->setInsertregistrations($xidx, $xedition_id, $xmember_id, $xregistered_at, $xqr_code);
      }
    }
    echo json_encode(null);
  }

  public function getregistrationslistbyedition() { 
    $this->load->helper('json');
    $this->load->helper('common');
    $this->load->helper('form');
    $edition_id = $_POST['ededition_id'];
    $this->load->model('modelregistrations');
    $query = $this->modelregistrations->getArrayListregistrationsbyedition_id((int) $edition_id);
    $xBufResult = '';
    if (!empty($query)) {
      $xBufResult = setForm('registration_id', 'Registration Member', form_dropdown_('edregistration_id', $query, '', 'id="edregistration_id" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
    }
    $this->json_data['option'] = $xBufResult;
    echo json_encode($this->json_data);
  }
}
