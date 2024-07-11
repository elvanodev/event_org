<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : coupons   *  By Diar */

class Ctrcoupons extends CI_Controller
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
    $this->createformcoupons('0', $xAwal);
  }

  function createformcoupons($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxcoupons.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormcoupons($xidx), '', '', $xAddJs, '', 'coupons');
  }

  function setDetailFormcoupons($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrcoupons/inserttable', array('id' => 'form', 'name' => 'form'));
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
    $xBufResult .= setForm('edition_id', 'Edition', form_dropdown_($selected_edition, [], '', 'id="ededition_id" class="require" style="width:200px;" placeholder="Edition" onchange="onchangeeditionid()"')) . '<div class="spacer"></div>';

    $this->load->model('modelregistrations');
    $registration = $this->modelregistrations->getLastIndexregistrations();
    $selected_registration = array();
    $selected_registration['selected'] = $registration->idx;
    $xBufResult .= setForm('registration_id', 'Registration Member', form_dropdown_($selected_registration, [], '', 'id="edregistration_id" class="require" style="width:200px;" placeholder="Registration Member"')) . '<div class="spacer"></div>';

    $xBufResult .= '<input type="hidden" name="edcoupon_price" id="edcoupon_price" value="0" />';
    $xBufResult .= setForm('coupon_price', 'Coupon Price', form_input_(getArrayObj('edcoupon_price_v', '', '200'), '', ' placeholder="Coupon Price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" disabled')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('coupon_number', 'Coupon Number', form_input_(getArrayObj('edcoupon_number', '', '200'), '', ' placeholder="Coupon Number" onkeyup="onkeyupcoupon_number();" maxlength="4"')) . '<div class="spacer"></div>';

    $this->load->model('modelshippers');
    $shipper = $this->modelshippers->getLastIndexshippers();
    $selected_shipper = array();
    $selected_shipper['selected'] = $shipper->idx;
    $xBufResult .= setForm('shipper_id', 'Shipper', form_dropdown_($selected_shipper, $this->modelshippers->getArrayListshippers(), '', 'id="edshipper_id" class="require" style="width:200px;" placeholder="Shipper" onchange="onchangeshipperid()"')) . '<div class="spacer"></div>';

    $xBufResult .= '<input type="hidden" name="edshipper_price" id="edshipper_price" value="0" />';
    $xBufResult .= setForm('shipper_price', 'Shipper Price', form_input_(getArrayObj('edshipper_price_v', '', '200'), '', ' placeholder="Shipper Price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" disabled')) . '<div class="spacer"></div>';

    $xBufResult .= '<input type="hidden" name="edtotal_price" id="edtotal_price" value="0" />';
    $xBufResult .= setForm('total_price', 'Total Price', form_input_(getArrayObj('edtotal_price_v', '', '200'), '', ' placeholder="Total Price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$"  data-type="currency" disabled')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('is_winner', 'Is Winner', form_dropdown_('edis_winner', array(1 => 'Yes', 0 => 'No'), '', ' id="edis_winner" placeholder="Is Winner" ')) . '<div class="spacer"></div>';

    $this->load->model('modelpayment_statuses');
    $payment_status = $this->modelpayment_statuses->getLastIndexpayment_statuses();
    $selected_payment_status = array();
    $selected_payment_status['selected'] = $payment_status->idx;
    $xBufResult .= setForm('payment_status_id', 'Payment Status', form_dropdown_($selected_payment_status, $this->modelpayment_statuses->getArrayListpayment_statuses(), '', 'id="edpayment_status_id" class="require" style="width:200px;" placeholder="Payment Status"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('payment_confirm_receipt', 'Payment Confirmation', '<div id="uploadpayment_confirm_receipt" style="width:150px;">' . form_input_(getArrayObj('edpayment_confirm_receipt', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';

    $xBufResult .= setForm('valid_until', 'Valid Until', form_input_(getArrayObj('edvalid_until', '', '200'), '', ' placeholder="Valid Until" class="datetimepicker"')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'new', 'onclick="doClearcoupons();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpancoupons();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchcoupons(0);"') . '<div class="spacer"></div></div><div id="tabledatacoupons">' . $this->getlistcoupons(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistcoupons($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Event', '', 'data-field="event_id" data-sortable="true" width=10%') .
      tbaddcellhead('Edition', '', 'data-field="edition_id" data-sortable="true" width=10%') .
      tbaddcellhead('Member', '', 'data-field="edition_id" data-sortable="true" width=10%') .
      tbaddcellhead('Coupon Number', '', 'data-field="coupon_number" data-sortable="true" width=10%') .
      tbaddcellhead('QR Code', '', 'data-field="qr_code" data-sortable="true" width=10%') .
      tbaddcellhead('Coupon Price', '', 'data-field="coupon_price" data-sortable="true" width=10%') .
      tbaddcellhead('Shipper Price', '', 'data-field="shipper_price" data-sortable="true" width=10%') .
      tbaddcellhead('Total Price', '', 'data-field="total_price" data-sortable="true" width=10%') .
      tbaddcellhead('Is Winner', '', 'data-field="is_winner" data-sortable="true" width=10%') .
      tbaddcellhead('Payment Status', '', 'data-field="payment_status_id" data-sortable="true" width=10%') .
      tbaddcellhead('Payment Confirmation', '', 'data-field="payment_confirm_receipt" data-sortable="true" width=10%') .
      tbaddcellhead('Valid Until', '', 'data-field="valid_until" data-sortable="true" width=10%') .
      tbaddcellhead('Payment Unique Id', '', 'data-field="payment_unique_id" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelcoupons');
    $xQuery = $this->modelcoupons->getListcoupons($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditcoupons(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapuscoupons(\'' . $row->idx . '\');"></i>';
      if (!empty($row->qr_code)) {
        $qr_code = '<img src="' . base_url() . 'resource/uploaded/qrcodes/' . $row->qr_code . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      if (!empty($row->payment_confirm_receipt)) {
        $payment_confirm_receipt = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->payment_confirm_receipt . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->event_name) .
        tbaddcell($row->edition_name) .
        tbaddcell($row->member_name) .
        tbaddcell($row->coupon_number) .
        tbaddcell($qr_code) .
        tbaddcell("Rp" . number_format($row->coupon_price), ' class="curency" ') .
        tbaddcell("Rp" . number_format($row->shipper_price), ' class="curency" ') .
        tbaddcell("Rp" . number_format($row->total_price), ' class="curency" ') .
        tbaddcell($row->is_winner == 1 ? 'Yes' : 'No') .
        tbaddcell($row->payment_status_name) .
        tbaddcell($payment_confirm_receipt) .
        tbaddcell($row->valid_until) .
        tbaddcell($row->payment_unique_id) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchcoupons(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchcoupons(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchcoupons(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editreccoupons()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelcoupons');
    $row = $this->modelcoupons->getDetailcoupons($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['event_id'] = $row->event_id;
    $this->json_data['edition_id'] = $row->edition_id;
    $this->json_data['coupon_number'] = $row->coupon_number;
    $this->json_data['qr_code'] = $row->qr_code;
    $this->json_data['coupon_price'] = $row->coupon_price;
    $this->json_data['shipper_price'] = $row->shipper_price;
    $this->json_data['total_price'] = $row->total_price;
    $this->json_data['is_winner'] = $row->is_winner;
    $this->json_data['payment_status_id'] = $row->payment_status_id;
    $this->json_data['payment_confirm_receipt'] = $row->payment_confirm_receipt;
    $this->json_data['valid_until'] = $row->valid_until;
    $this->json_data['registration_id'] = $row->registration_id;
    $this->json_data['payment_unique_id'] = $row->payment_unique_id;

    echo json_encode($this->json_data);
  }
  function deletetablecoupons()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelcoupons');
    $this->modelcoupons->setDeletecoupons($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchcoupons()
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
    $this->json_data['tabledatacoupons'] = $this->getlistcoupons($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpancoupons()
  {
    $this->load->helper('qrcode');
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xedition_id = $_POST['ededition_id'];
    $xcoupon_number = $_POST['edcoupon_number'];
    $xqr_code = $_POST['edqr_code'];
    $xcoupon_price = $_POST['edcoupon_price'];
    $xshipper_price = $_POST['edshipper_price'];
    $xtotal_price = $_POST['edtotal_price'];
    $xis_winner = $_POST['edis_winner'];
    $xpayment_status_id = $_POST['edpayment_status_id'];
    $xpayment_confirm_receipt = $_POST['edpayment_confirm_receipt'];
    $xvalid_until = $_POST['edvalid_until'];
    $xregistration_id = $_POST['edregistration_id'];

    $this->load->model('modelcoupons');

    /**
     * start of validation
     */
    $isallvalid = 1;
    $message = '';

    //validate coupon number existing
    $iscouponnumberexist = $this->modelcoupons->iscouponnumberexist($xedition_id, $xcoupon_number);
    if ($iscouponnumberexist) {
      $isallvalid = 0;
      $message .= 'Coupon number already exists!';
    }

    /**
     * end of validation
     */
    if($isallvalid === 1){
      $xidpegawai = $this->session->userdata('idpegawai');
      if (!empty($xidpegawai)) {        
        $prefix = "ED".$xedition_id."_"."RG".$xregistration_id;
        $length = strlen($xcoupon_number);
        $xqr_code = generate_qrcode($prefix, $length);

        if ($xidx != '0') {
          $xStr =  $this->modelcoupons->setUpdatecoupons($xidx, $xedition_id, $xcoupon_number, $xqr_code, $xcoupon_price, $xshipper_price, $xtotal_price, $xis_winner, $xpayment_status_id, $xpayment_confirm_receipt, $xvalid_until, $xregistration_id);
        } else {
          $xStr =  $this->modelcoupons->setInsertcoupons($xidx, $xedition_id, $xcoupon_number, $xqr_code, $xcoupon_price, $xshipper_price, $xtotal_price, $xis_winner, $xpayment_status_id, $xpayment_confirm_receipt, $xvalid_until, $xregistration_id);
        }
      }
    }
    $this->json_data['success'] = $isallvalid;
    $this->json_data['message'] = $message;
    echo json_encode($this->json_data);
  }
}
