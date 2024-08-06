<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : testimonials   *  By Diar */

class Ctrtestimonials extends CI_Controller
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
    $this->createformtestimonials('0', $xAwal);
  }

  function createformtestimonials($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxtestimonials.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>' . "\n" .
      '<script src="https://unpkg.com/html5-qrcode" type="text/javascript">';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormtestimonials($xidx), '', '', $xAddJs, '', 'testimonials');
  }

  function setDetailFormtestimonials($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrtestimonials/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
    $xBufResult .= '<input type="hidden" name="edcoupon_id" id="edcoupon_id" value="" />';
    $xBufResult .= '<input type="hidden" name="edevent_name" id="edevent_name" value="" />';
    $xBufResult .= '<input type="hidden" name="edmember_name" id="edmember_name" value="" />';

    $xBufResult .= 'Scan QR disini' . '<div class="spacer"></div>';
    $xBufResult .= '<div id="reader" width="600px"></div>' . '<div class="spacer"></div>';

    $xBufResult .= 'atau input Kode QR disini' . '<div class="spacer"></div>';
    $xBufResult .= setForm('qr_code', 'Kode QR', form_input_(getArrayObj('edqr_code', '', '200'), '', ' placeholder="Kode QR"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('coupon_number', 'Coupon Number', form_input_(getArrayObj('edcoupon_number', '', '200'), '', ' placeholder="Coupon Number" readonly')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('event_name', 'Event Name', form_input_(getArrayObj('edevent_name_v', '', '200'), '', ' placeholder="Event Name" disabled')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('member_name', 'Member Name', form_input_(getArrayObj('edmember_name_v', '', '200'), '', ' placeholder="Member Name" disabled')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('testimoni_text', 'Testimoni Text', form_textarea_(getArrayObj('edtestimoni_text', '', '200'), '', ' placeholder="Testimoni Text" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('testimoni_photo', 'Testimoni Photo', '<div id="uploadtestimoni_photo" style="width:150px;">' . form_input_(getArrayObj('edtestimoni_photo', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doCleartestimonials();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpantestimonials();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchtestimonials(0);"') . '<div class="spacer"></div></div><div id="tabledatatestimonials">' . $this->getlisttestimonials(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlisttestimonials($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Coupon Number', '', 'data-field="coupon_number" data-sortable="true" width=10%') .
      tbaddcellhead('Event Name', '', 'data-field="event_name" data-sortable="true" width=10%') .
      tbaddcellhead('Member Name', '', 'data-field="member_name" data-sortable="true" width=10%') .
      tbaddcellhead('Testimoni Text', '', 'data-field="testimoni_text" data-sortable="true" width=10%') .
      tbaddcellhead('Testimoni Photo', '', 'data-field="testimoni_photo" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modeltestimonials');
    $xQuery = $this->modeltestimonials->getListtestimonials($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = $xAwal + 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doedittestimonials(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapustestimonials(\'' . $row->idx . '\');"></i>';
      $testimoni_photo = 'Image is not available!';
      if (!empty($row->testimoni_photo)) {
        $testimoni_photo = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->testimoni_photo . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->coupon_number) .
        tbaddcell($row->event_name) .
        tbaddcell($row->member_name) .
        tbaddcell($row->testimoni_text) .
        tbaddcell($testimoni_photo) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchtestimonials(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchtestimonials(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchtestimonials(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrectestimonials()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modeltestimonials');
    $row = $this->modeltestimonials->getDetailtestimonials($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['coupon_id'] = $row->coupon_id;
    $this->json_data['coupon_number'] = $row->coupon_number;
    $this->json_data['event_name'] = $row->event_name;
    $this->json_data['member_name'] = $row->member_name;
    $this->json_data['testimoni_text'] = $row->testimoni_text;
    $this->json_data['testimoni_photo'] = $row->testimoni_photo;

    echo json_encode($this->json_data);
  }
  function deletetabletestimonials()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modeltestimonials');
    $this->modeltestimonials->setDeletetestimonials($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchtestimonials()
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
    $this->json_data['tabledatatestimonials'] = $this->getlisttestimonials($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpantestimonials()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xcoupon_id = $_POST['edcoupon_id'];
    $xcoupon_number = $_POST['edcoupon_number'];
    $xevent_name = $_POST['edevent_name'];
    $xmember_name = $_POST['edmember_name'];
    $xtestimoni_text = $_POST['edtestimoni_text'];
    $xtestimoni_photo = $_POST['edtestimoni_photo'];
    $xlink_photo = $xtestimoni_photo;

    $this->load->model('modeltestimonials');
    $this->load->model('modeltestimoni_photos');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modeltestimonials->setUpdatetestimonials($xidx, $xcoupon_id, $xcoupon_number, $xevent_name, $xmember_name, $xtestimoni_text);

        $xStr =  $this->modeltestimoni_photos->setUpdatetestimoni_photosbytestimoni_id($xidx, $xlink_photo);
      } else {
        $insert_id =  $this->modeltestimonials->setInserttestimonials($xidx, $xcoupon_id, $xcoupon_number, $xevent_name, $xmember_name, $xtestimoni_text);

        $xtestimoni_id = $insert_id;
        $xStr =  $this->modeltestimoni_photos->setInserttestimoni_photos($xidx, $xtestimoni_id, $xlink_photo);
      }
    }
    echo json_encode($_POST);
  }
}
