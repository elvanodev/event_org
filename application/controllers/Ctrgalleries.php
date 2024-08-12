<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : galleries   *  By Diar */

class Ctrgalleries extends CI_Controller
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
    $this->createformgalleries('0', $xAwal);
  }

  function createformgalleries($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxgalleries.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormgalleries($xidx), '', '', $xAddJs, '', 'galleries');
  }

  function setDetailFormgalleries($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrgalleries/inserttable', array('id' => 'form', 'name' => 'form'));
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

    $xBufResult .= setForm('image_title', 'Title', form_textarea_(getArrayObj('edimage_title', '', '200'), '', ' placeholder="Title" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('image_link', 'Art Image', '<div id="uploadimage_link" style="width:150px;">' . form_input_(getArrayObj('edimage_link', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';
    
    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doCleargalleries();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpangalleries();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchgalleries(0);"') . '<div class="spacer"></div></div><div id="tabledatagalleries">' . $this->getlistgalleries(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistgalleries($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('Edition', '', 'data-field="is_primary_galleries" data-sortable="true" width=10%') .
      tbaddcellhead('Title', '', 'data-field="image_title" data-sortable="true" width=10%') .
      tbaddcellhead('Image', '', 'data-field="image_link" data-sortable="true" width=10%') .
      
      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelgalleries');
    $xQuery = $this->modelgalleries->getListgalleries($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = $xAwal + 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditgalleries(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusgalleries(\'' . $row->idx . '\');"></i>';
      $image_link = 'Image is not available!';
      if (!empty($row->image_link)) {
        $image_link = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->image_link . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->edition_name) .
        tbaddcell($row->image_title) .
        tbaddcell($image_link) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchgalleries(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchgalleries(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchgalleries(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecgalleries()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelgalleries');
    $row = $this->modelgalleries->getDetailgalleries($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['event_id'] = $row->event_id;
    $this->json_data['edition_id'] = $row->edition_id;
    $this->json_data['image_title'] = $row->image_title;
    $this->json_data['image_link'] = $row->image_link;

    echo json_encode($this->json_data);
  }
  function deletetablegalleries()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelgalleries');
    $this->modelgalleries->setDeletegalleries($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchgalleries()
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
    $this->json_data['tabledatagalleries'] = $this->getlistgalleries($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpangalleries()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xedition_id = $_POST['ededition_id'];
    $ximage_title = $_POST['edimage_title'];
    $ximage_link = $_POST['edimage_link'];

    $data = [      
      'edition_id' => $xedition_id,
      'image_title' => $ximage_title,
      'image_link' => $ximage_link
    ];

    $this->load->model('modelgalleries');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        date_default_timezone_set('Asia/Jakarta');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->modelgalleries->setUpdategalleriesbatch($xidx, $data);
      } else {
        $result = $this->modelgalleries->setInsertgalleriesbatch($data);
      }
    }
    echo json_encode($result);
  }
}
