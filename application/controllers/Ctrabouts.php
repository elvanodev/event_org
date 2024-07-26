<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : abouts   *  By Diar */

class Ctrabouts extends CI_Controller
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
    $this->createformabouts('0', $xAwal);
  }

  function createformabouts($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxabouts.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormabouts($xidx), '', '', $xAddJs, '', 'abouts');
  }

  function setDetailFormabouts($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrabouts/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $this->load->model('modelevents');
    $event = $this->modelevents->getLastIndexevents();
    $selected_event = array();
    $selected_event['selected'] = $event->idx;
    $xBufResult .= setForm('event_id', 'Event', form_dropdown_($selected_event, $this->modelevents->getArrayListevents(), '', 'id="edevent_id" class="require" style="width:200px;" placeholder="Event"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('about_title', 'About Title', form_input_(getArrayObj('edabout_title', '', '200'), '', ' placeholder="About Title" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('about_detail', 'Abouts Detail', form_textarea_(getArrayObj('edabout_detail', '', '200'), '', ' placeholder="Abouts Detail" ')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doClearabouts();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanabouts();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchabouts(0);"') . '<div class="spacer"></div></div><div id="tabledataabouts">' . $this->getlistabouts(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistabouts($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('About Title', '', 'data-field="name" data-sortable="true" width=10%') .
      tbaddcellhead('Abouts Detail', '', 'data-field="about_detail" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelabouts');
    $xQuery = $this->modelabouts->getListabouts($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditabouts(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusabouts(\'' . $row->idx . '\');"></i>';
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->about_title) .
        tbaddcell($row->about_detail) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchabouts(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchabouts(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchabouts(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecabouts()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelabouts');
    $row = $this->modelabouts->getDetailabouts($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['event_id'] = $row->event_id;
    $this->json_data['about_title'] = $row->about_title;
    $this->json_data['about_detail'] = $row->about_detail;

    echo json_encode($this->json_data);
  }
  function deletetableabouts()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelabouts');
    $this->modelabouts->setDeleteabouts($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchabouts()
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
    $this->json_data['tabledataabouts'] = $this->getlistabouts($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpanabouts()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xevent_id = $_POST['edevent_id'];
    $xabout_title = $_POST['edabout_title'];
    $xabout_detail = $_POST['edabout_detail'];

    $this->load->model('modelabouts');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelabouts->setUpdateabouts($xidx, $xevent_id, $xabout_title, $xabout_detail);
      } else {
        $xStr =  $this->modelabouts->setInsertabouts($xidx, $xevent_id, $xabout_title, $xabout_detail);
      }
    }
    echo json_encode(null);
  }
  public function getaboutslistbyevent() { 
    $this->load->helper('json');
    $this->load->helper('common');
    $this->load->helper('form');
    $event_id = $_POST['edevent_id'];
    $this->load->model('modelabouts');
    $query = $this->modelabouts->getArrayListaboutsbyevent_id((int) $event_id);
    return $query->result();
  }
}
