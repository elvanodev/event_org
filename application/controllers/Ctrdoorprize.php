<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : doorprize   *  By Diar */

class Ctrdoorprize extends CI_Controller
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
    $this->createformdoorprize('0', $xAwal);
  }

  function createformdoorprize($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxdoorprize.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormdoorprize($xidx), '', '', $xAddJs, '', 'doorprize');
  }

  function setDetailFormdoorprize($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrdoorprize/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $this->load->model('modelevents');
    $event = $this->modelevents->getLastIndexevents();
    $selected_event = array();
    $selected_event['selected'] = $event->idx;
    $xBufResult .= setForm('event_id', 'Event', form_dropdown_($selected_event, $this->modelevents->getArrayListevents(), '', 'id="edevent_id" class="require" style="width:200px;" placeholder="Event"')) . '<div class="spacer"></div>';

    $this->load->model('modelartists');
    $artist = $this->modelartists->getLastIndexartists();
    $selected_artist = array();
    $selected_artist['selected'] = $artist->idx;
    $xBufResult .= setForm('artist_id', 'Artist', form_dropdown_($selected_artist, $this->modelartists->getArrayListartists(), '', 'id="edartist_id" class="require" style="width:200px;" placeholder="Artist"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('dimension', 'Dimension', form_input_(getArrayObj('eddimension', '', '200'), '', ' placeholder="Dimension" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('title', 'Title', form_input_(getArrayObj('edtitle', '', '200'), '', ' placeholder="Title" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('media', 'Media', form_input_(getArrayObj('edmedia', '', '200'), '', ' placeholder="Media" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('art_year', 'Art Year', form_input_(getArrayObj('edyear', '', '200'), '', ' placeholder="Art Year" ')) . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('image_art', 'Art Image', '<div id="uploadimage_art" style="width:150px;">' . form_input_(getArrayObj('edimage_art', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';
    
    $xBufResult .= setForm('description', 'Description', form_textarea_(getArrayObj('eddescription', '', '200'), '', ' placeholder="Description" ')) . '<div class="spacer"></div>';


    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doCleardoorprize();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpandoorprize();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchdoorprize(0);"') . '<div class="spacer"></div></div><div id="tabledatadoorprize">' . $this->getlistdoorprize(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistdoorprize($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('Artist', '', 'data-field="artist_id" data-sortable="true" width=10%') .
      tbaddcellhead('Dimension', '', 'data-field="dimension" data-sortable="true" width=10%') .
      tbaddcellhead('Title', '', 'data-field="title" data-sortable="true" width=10%') .
      tbaddcellhead('Media', '', 'data-field="media" data-sortable="true" width=10%') .
      tbaddcellhead('Art Year', '', 'data-field="year" data-sortable="true" width=10%') .
      tbaddcellhead('Art Image', '', 'data-field="image_art" data-sortable="true" width=10%') .
      tbaddcellhead('Description', '', 'data-field="description" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modeldoorprize');
    $xQuery = $this->modeldoorprize->getListdoorprize($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = $xAwal + 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditdoorprize(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusdoorprize(\'' . $row->idx . '\');"></i>';
      $image_art = 'Image is not available!';
      if (!empty($row->image_art)) {
        $image_art = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->image_art . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->artist_name) .
        tbaddcell($row->dimension) .
        tbaddcell($row->title) .
        tbaddcell($row->media) .
        tbaddcell($row->year) .
        tbaddcell($image_art) .
        tbaddcell($row->description) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchdoorprize(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchdoorprize(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchdoorprize(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecdoorprize()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modeldoorprize');
    $row = $this->modeldoorprize->getDetaildoorprize($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['event_id'] = $row->event_id;
    $this->json_data['artist_id'] = $row->artist_id;
    $this->json_data['dimension'] = $row->dimension;
    $this->json_data['title'] = $row->title;
    $this->json_data['media'] = $row->media;
    $this->json_data['year'] = $row->year;
    $this->json_data['image_art'] = $row->image_art;
    $this->json_data['description'] = $row->description;

    echo json_encode($this->json_data);
  }
  function deletetabledoorprize()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modeldoorprize');
    $this->modeldoorprize->setDeletedoorprize($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchdoorprize()
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
    $this->json_data['tabledatadoorprize'] = $this->getlistdoorprize($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpandoorprize()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xevent_id = $_POST['edevent_id'];
    $xartist_id = $_POST['edartist_id'];
    $xdimension = $_POST['eddimension'];
    $xtitle = $_POST['edtitle'];
    $xmedia = $_POST['edmedia'];
    $xyear = $_POST['edyear'];
    $ximage_art = $_POST['edimage_art'];
    $xdescription = $_POST['eddescription'];

    $data = [      
      'event_id' => $xevent_id,
      'artist_id' => $xartist_id,
      'dimension' => $xdimension,
      'title' => $xtitle,
      'media' => $xmedia,
      'year' => $xyear,
      'image_art' => $ximage_art,
      'description' => $xdescription
    ];

    $this->load->model('modeldoorprize');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        date_default_timezone_set('Asia/Jakarta');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result =  $this->modeldoorprize->setUpdatedoorprizebatch($xidx, $data);
      } else {
        $result =  $this->modeldoorprize->setInsertdoorprizebatch($data);
      }
    }
    echo json_encode($result);
  }
  public function getdoorprizelistbyevent() { 
    $this->load->helper('json');
    $this->load->helper('common');
    $this->load->helper('form');
    $event_id = $_POST['edevent_id'];
    $this->load->model('modeldoorprize');
    $query = $this->modeldoorprize->getArrayListdoorprizebyevent_id((int) $event_id);
    return $query->result();
  }
}
