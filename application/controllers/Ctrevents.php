<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : events   *  By Diar */

class Ctrevents extends CI_Controller
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
    $this->createformevents('0', $xAwal);
  }

  function createformevents($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxevents.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormevents($xidx), '', '', $xAddJs, '', 'events');
  }

  function setDetailFormevents($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrevents/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $xBufResult .= setForm('name', 'Name', form_input_(getArrayObj('edname', '', '200'), '', ' placeholder="Name" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('long_name', 'Long Name', form_input_(getArrayObj('edlong_name', '', '200'), '', ' placeholder="Long Name" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= '<span>Only one active event, other active event will set to inactive if you set new or edit event to active</span>';
    $xBufResult .= setForm('is_active', 'Is Active', form_dropdown_('edis_active', array(1 => 'Yes', 0 => 'No'), '', ' id="edis_active" placeholder="Is Active" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('descriptions', 'Descriptions', form_textarea_(getArrayObj('eddescriptions', '', '200'), '', ' placeholder="Descriptions" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('poster_image', 'Poster Image', '<div id="uploadposter_image" style="width:150px;">' . form_input_(getArrayObj('edposter_image', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';

    $xBufResult .= setForm('contact_phone', 'Contact Phone', form_input_(getArrayObj('edcontact_phone', '', '200'), '', ' placeholder="Contact Phone" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('contact_email', 'Contact Email', form_input_(getArrayObj('edcontact_email', '', '200'), '', ' placeholder="Contact Email" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('agent_open_date', 'Agent Open Date', form_input_(getArrayObj('edagent_open_date', '', '200'), '', ' placeholder="Agent Open Date" class="tanggal"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('agent_close_date', 'Agent Close Date', form_input_(getArrayObj('edagent_close_date', '', '200'), '', ' placeholder="Agent Close Date" class="tanggal"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('agent_open_time', 'Agent Open Time', form_input_(getArrayObj('edagent_open_time', '', '200'), '', ' placeholder="Agent Open Time" class="timepicker"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('agent_close_time', 'Agent Close Time', form_input_(getArrayObj('edagent_close_time', '', '200'), '', ' placeholder="Agent Close Time" class="timepicker"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('agent_address', 'Agent Address', form_textarea_(getArrayObj('edagent_address', '', '200'), '', ' placeholder="Agent Address" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('agent_gmap', 'Agent Gmap', form_textarea_(getArrayObj('edagent_gmap', '', '200'), '', ' placeholder="Agent Gmap" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doClearevents();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanevents();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchevents(0);"') . '<div class="spacer"></div></div><div id="tabledataevents">' . $this->getlistevents(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistevents($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Name', '', 'data-field="name" data-sortable="true" width=10%') .
      tbaddcellhead('Long Name', '', 'data-field="long_name" data-sortable="true" width=10%') .
      tbaddcellhead('Is Active', '', 'data-field="is_active" data-sortable="true" width=10%') .
      tbaddcellhead('Descriptions', '', 'data-field="descriptions" data-sortable="true" width=10%') .
      tbaddcellhead('Poster Image', '', 'data-field="poster_image" data-sortable="true" width=10%') .
      tbaddcellhead('Contact Phone', '', 'data-field="contact_phone" data-sortable="true" width=10%') .
      tbaddcellhead('Contact Email', '', 'data-field="contact_email" data-sortable="true" width=10%') .
      tbaddcellhead('Agent Open Date', '', 'data-field="agent_open_date" data-sortable="true" width=10%') .
      tbaddcellhead('Agent Close Date', '', 'data-field="agent_close_date" data-sortable="true" width=10%') .
      tbaddcellhead('Agent Open Time', '', 'data-field="agent_open_time" data-sortable="true" width=10%') .
      tbaddcellhead('Agent Close Time', '', 'data-field="agent_close_time" data-sortable="true" width=10%') .
      tbaddcellhead('Agent Address', '', 'data-field="agent_address" data-sortable="true" width=10%') .
      tbaddcellhead('Agent Gmap', '', 'data-field="agent_gmap" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelevents');
    $xQuery = $this->modelevents->getListevents($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditevents(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusevents(\'' . $row->idx . '\');"></i>';
      $poster_image = 'Image is not available!';
      if (!empty($row->poster_image)) {
        $poster_image = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->poster_image . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->name) .
        tbaddcell($row->long_name) .
        tbaddcell($row->is_active == 1 ? 'Yes' : 'No') .
        tbaddcell($row->descriptions) .
        tbaddcell($poster_image) .
        tbaddcell($row->contact_phone) .
        tbaddcell($row->contact_email) .
        tbaddcell(mysqltodate($row->agent_open_date)) .
        tbaddcell(mysqltodate($row->agent_close_date)) .
        tbaddcell($row->agent_open_time) .
        tbaddcell($row->agent_close_time) .
        tbaddcell($row->agent_address) .
        tbaddcell($row->agent_gmap) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchevents(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchevents(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchevents(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecevents()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelevents');
    $row = $this->modelevents->getDetailevents($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['name'] = $row->name;
    $this->json_data['long_name'] = $row->long_name;
    $this->json_data['is_active'] = $row->is_active;
    $this->json_data['descriptions'] = $row->descriptions;
    $this->json_data['poster_image'] = $row->poster_image;
    $this->json_data['contact_phone'] = $row->contact_phone;
    $this->json_data['contact_email'] = $row->contact_email;
    $this->json_data['agent_open_date'] = $row->agent_open_date;
    $this->json_data['agent_close_date'] = $row->agent_close_date;
    $this->json_data['agent_open_time'] = $row->agent_open_time;
    $this->json_data['agent_close_time'] = $row->agent_close_time;
    $this->json_data['agent_address'] = $row->agent_address;
    $this->json_data['agent_gmap'] = $row->agent_gmap;

    echo json_encode($this->json_data);
  }
  function deletetableevents()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelevents');
    $this->modelevents->setDeleteevents($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchevents()
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
    $this->json_data['tabledataevents'] = $this->getlistevents($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpanevents()
  {
    $this->load->helper('json');
    $this->load->helper('common');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xname = $_POST['edname'];
    $xlong_name = $_POST['edlong_name'];
    $xis_active = $_POST['edis_active'];
    $xdescriptions = $_POST['eddescriptions'];
    $xposter_image = $_POST['edposter_image'];
    $xcontact_phone = $_POST['edcontact_phone'];
    $xcontact_email = $_POST['edcontact_email'];
    $xagent_open_date = datetomysql($_POST['edagent_open_date']);
    $xagent_close_date = datetomysql($_POST['edagent_close_date']);
    $xagent_open_time = $_POST['edagent_open_time'];
    $xagent_close_time = $_POST['edagent_close_time'];
    $xagent_address = $_POST['edagent_address'];
    $xagent_gmap = $_POST['edagent_gmap'];

    $this->load->model('modelevents');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelevents->setUpdateevents($xidx, $xname, $xlong_name, $xis_active, $xdescriptions, $xposter_image, $xcontact_phone, $xcontact_email,   
        $xagent_open_date,
        $xagent_close_date,
        $xagent_open_time,
        $xagent_close_time,
        $xagent_address,
        $xagent_gmap);
      } else {
        $xStr =  $this->modelevents->setInsertevents($xidx, $xname, $xlong_name, $xis_active, $xdescriptions, $xposter_image, $xcontact_phone, $xcontact_email,   
        $xagent_open_date,
        $xagent_close_date,
        $xagent_open_time,
        $xagent_close_time,
        $xagent_address,
        $xagent_gmap);
      }
    }
    echo json_encode(null);
  }
}
