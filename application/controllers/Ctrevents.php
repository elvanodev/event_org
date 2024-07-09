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
    $xBufResult .= '<span>Only one active event, other active event will set to inactive if you set new or edit event to active</span>';
    $xBufResult .= setForm('is_active', 'Is Active', form_dropdown_('edis_active', array(1 => 'Yes', 0 => 'No'), '', ' id="edis_active" placeholder="Is Active" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('descriptions', 'Descriptions', form_textarea_(getArrayObj('eddescriptions', '', '200'), '', ' placeholder="Descriptions" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('about_event', 'About', form_textarea_(getArrayObj('edabout_event', '', '200'), '', ' placeholder="About" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('about1_event', 'About 1', form_textarea_(getArrayObj('edabout1_event', '', '200'), '', ' placeholder="About 1" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('about2_event', 'About 2', form_textarea_(getArrayObj('edabout2_event', '', '200'), '', ' placeholder="About 2" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('about3_event', 'About 3', form_textarea_(getArrayObj('edabout3_event', '', '200'), '', ' placeholder="About 3" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('poster_image', 'Poster Image', '<div id="uploadposter_image" style="width:150px;">' . form_input_(getArrayObj('edposter_image', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'new', 'onclick="doClearevents();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanevents();"') . form_button('btTabel', 'Tabel', 'onclick="dosearchevents(0);"') . '<div class="spacer"></div></div><div id="tabledataevents">' . $this->getlistevents(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistevents($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Name', '', 'data-field="name" data-sortable="true" width=10%') .
      tbaddcellhead('Is Active', '', 'data-field="is_active" data-sortable="true" width=10%') .
      tbaddcellhead('Descriptions', '', 'data-field="descriptions" data-sortable="true" width=10%') .
      tbaddcellhead('About', '', 'data-field="about_event" data-sortable="true" width=10%') .
      tbaddcellhead('About 1', '', 'data-field="about1_event" data-sortable="true" width=10%') .
      tbaddcellhead('About 2', '', 'data-field="about2_event" data-sortable="true" width=10%') .
      tbaddcellhead('About 3', '', 'data-field="about3_event" data-sortable="true" width=10%') .
      tbaddcellhead('Poster Image', '', 'data-field="poster_image" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelevents');
    $xQuery = $this->modelevents->getListevents($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditevents(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusevents(\'' . $row->idx . '\');"></i>';
      if (!empty($row->poster_image)) {
        $poster_image = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->poster_image . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->name) .
        tbaddcell($row->is_active) .
        tbaddcell($row->descriptions) .
        tbaddcell(substr($row->about_event,0,20)) .
        tbaddcell(substr($row->about1_event,0,20)) .
        tbaddcell(substr($row->about2_event,0,20)) .
        tbaddcell(substr($row->about3_event,0,20)) .
        tbaddcell($poster_image) .

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
    $this->json_data['is_active'] = $row->is_active;
    $this->json_data['descriptions'] = $row->descriptions;
    $this->json_data['about_event'] = $row->about_event;
    $this->json_data['about1_event'] = $row->about1_event;
    $this->json_data['about2_event'] = $row->about2_event;
    $this->json_data['about3_event'] = $row->about3_event;
    $this->json_data['poster_image'] = $row->poster_image;

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
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xname = $_POST['edname'];
    $xis_active = $_POST['edis_active'];
    $xdescriptions = $_POST['eddescriptions'];
    $xabout_event = $_POST['edabout_event'];
    $xabout1_event = $_POST['edabout1_event'];
    $xabout2_event = $_POST['edabout2_event'];
    $xabout3_event = $_POST['edabout3_event'];
    $xposter_image = $_POST['edposter_image'];

    $this->load->model('modelevents');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelevents->setUpdateevents($xidx, $xname, $xis_active, $xdescriptions, $xabout_event, $xabout1_event, $xabout2_event, $xabout3_event, $xposter_image);
      } else {
        $xStr =  $this->modelevents->setInsertevents($xidx, $xname, $xis_active, $xdescriptions, $xabout_event, $xabout1_event, $xabout2_event, $xabout3_event, $xposter_image);
      }
    }
    echo json_encode(null);
  }
}
