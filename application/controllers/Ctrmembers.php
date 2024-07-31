<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : members   *  By Diar */

class Ctrmembers extends CI_Controller
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
    $this->createformmembers('0', $xAwal);
  }

  function createformmembers($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmembers.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormmembers($xidx), '', '', $xAddJs, '', 'members');
  }

  function setDetailFormmembers($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrmembers/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $xBufResult .= setForm('name', 'Name', form_input_(getArrayObj('edname', '', '200'), '', ' placeholder="Name" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('email', 'Email', form_input_(getArrayObj('edemail', '', '200'), '', ' placeholder="Email" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('password', 'Password', form_input_(getArrayObj('edpassword', '', '200'), '', ' placeholder="Password" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('address', 'Address', form_textarea_(getArrayObj('edaddress', '', '200'), '', ' placeholder="Address" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('phone', 'Phone', form_input_(getArrayObj('edphone', '', '200'), '', ' placeholder="Phone" ')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'New', 'onclick="doClearmembers();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanmembers();" id="btSimpan"') . form_button('btTabel', 'Tabel', 'onclick="dosearchmembers(0);"') . '<div class="spacer"></div></div><div id="tabledatamembers">' . $this->getlistmembers(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistmembers($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Name', '', 'data-field="name" data-sortable="true" width=10%') .
      tbaddcellhead('Email', '', 'data-field="email" data-sortable="true" width=10%') .
      tbaddcellhead('Password', '', 'data-field="password" data-sortable="true" width=10%') .
      tbaddcellhead('Address', '', 'data-field="address" data-sortable="true" width=10%') .
      tbaddcellhead('Phone', '', 'data-field="phone" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelmembers');
    $xQuery = $this->modelmembers->getListmembers($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    $no = $xAwal + 1;
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditmembers(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusmembers(\'' . $row->idx . '\');"></i>';
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->name) .
        tbaddcell($row->email) .
        tbaddcell($row->password) .
        tbaddcell($row->address) .
        tbaddcell($row->phone) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchmembers(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchmembers(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchmembers(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecmembers()
  {
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelmembers');
    $row = $this->modelmembers->getDetailmembers($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['name'] = $row->name;
    $this->json_data['email'] = $row->email;
    $this->json_data['password'] = $row->password;
    $this->json_data['address'] = $row->address;
    $this->json_data['phone'] = $row->phone;

    echo json_encode($this->json_data);
  }
  function deletetablemembers()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelmembers');
    $this->modelmembers->setDeletemembers($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchmembers()
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
    $this->json_data['tabledatamembers'] = $this->getlistmembers($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpanmembers()
  {
    $this->load->helper('json');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xname = $_POST['edname'];
    $xemail = $_POST['edemail'];
    $xpassword = $_POST['edpassword'];
    $xaddress = $_POST['edaddress'];
    $xphone = $_POST['edphone'];

    $this->load->model('modelmembers');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelmembers->setUpdatemembers($xidx, $xname, $xemail, $xpassword, $xaddress, $xphone);
      } else {
        $xStr =  $this->modelmembers->setInsertmembers($xname, $xemail, $xpassword, $xaddress, $xphone);
      }
    }
    echo json_encode(null);
  }
}
