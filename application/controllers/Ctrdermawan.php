<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : dermawan   *  By Diar */

class Ctrdermawan extends CI_Controller
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
    $this->createformdermawan('0', $xAwal);
  }

  function createformdermawan($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxdermawan.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormdermawan($xidx), '', '', $xAddJs, '', 'dermawan');
  }

  function setDetailFormdermawan($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrdermawan/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $this->load->model('modelevents');
    $event = $this->modelevents->getLastIndexevents();
    $selected_event = array();
    $selected_event['selected'] = $event->idx;
    $xBufResult .= setForm('event_id', 'Event', form_dropdown_($selected_event, $this->modelevents->getArrayListevents(), '', 'id="edevent_id" class="require" style="width:200px;" placeholder="Event"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('name', 'Name', form_textarea_(getArrayObj('edname', '', '200'), '', ' placeholder="Name" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('quote', 'Quote', form_textarea_(getArrayObj('edquote', '', '200'), '', ' placeholder="Quote" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('nominal', 'Nominal', form_input_(getArrayObj('ednominal', '0', '200'), '', ' placeholder="Nominal" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" ')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doCleardermawan();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpandermawan();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchdermawan(0);"') . '<div class="spacer"></div></div><div id="tabledatadermawan">' . $this->getlistdermawan(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistdermawan($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('Name', '', 'data-field="name" data-sortable="true" width=10%') .
      tbaddcellhead('Quote', '', 'data-field="quote" data-sortable="true" width=10%') .
      tbaddcellhead('Nominal', '', 'data-field="nominal" data-sortable="true" width=10%') .
      
      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modeldermawan');
    $xQuery = $this->modeldermawan->getListdermawan($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = $xAwal + 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditdermawan(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusdermawan(\'' . $row->idx . '\');"></i>';
      $nominal = '-';
      if($row->nominal != 0){
        $nominal = 'Rp'.number_format($row->nominal);
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->name) .
        tbaddcell($row->quote) .
        tbaddcell($nominal, ' class="curency" ') .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchdermawan(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchdermawan(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchdermawan(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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
        <h4 class="modal-title" id="dialogtitle">Name Dialog</h4>
      </div>
      <div id="dialogdata" class="modal-body">Dialog Data</div></div></div></div>';
  }


  function editrecdermawan()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modeldermawan');
    $row = $this->modeldermawan->getDetaildermawan($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['event_id'] = $row->event_id;
    $this->json_data['nominal'] = $row->nominal;
    $this->json_data['name'] = $row->name;
    $this->json_data['quote'] = $row->quote;

    echo json_encode($this->json_data);
  }
  function deletetabledermawan()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modeldermawan');
    $this->modeldermawan->setDeletedermawan($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchdermawan()
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
    $this->json_data['tabledatadermawan'] = $this->getlistdermawan($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpandermawan()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xevent_id = $_POST['edevent_id'];
    $xname = $_POST['edname'];
    $xquote = $_POST['edquote'];
    $xnominal = $_POST['ednominal'];

    $data = [      
      'event_id' => $xevent_id,
      'name' => $xname,
      'quote' => $xquote,
      'nominal' => $xnominal,
    ];

    $this->load->model('modeldermawan');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        date_default_timezone_set('Asia/Jakarta');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->modeldermawan->setUpdatedermawanbatch($xidx, $data);
      } else {
        $result = $this->modeldermawan->setInsertdermawanbatch($data);
      }
    }
    echo json_encode($result);
  }
}
