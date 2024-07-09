<?php if (!defined('BASEPATH')) exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : artists   *  By Diar */

class Ctrartists extends CI_Controller
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
    $this->createformartists('0', $xAwal);
  }

  function createformartists($xidx, $xAwal = 0, $xSearch = '')
  {
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->model('modelgetmenu');
    $xAddJs = link_tag('resource/admin/vendor/toaster/toastr.css') . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/admin/vendor/toaster/toastr.min.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxartists.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
      '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>';
    echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormartists($xidx), '', '', $xAddJs, '', 'artists');
  }

  function setDetailFormartists($xidx)
  {
    $this->load->helper('form');
    $xBufResult = '';
    $xBufResult = '<div id="stylized" class="myform">' . form_open_multipart('ctrartists/inserttable', array('id' => 'form', 'name' => 'form'));
    $this->load->helper('common');
    $xBufResult .= '<div id="form">';
    $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

    $xBufResult .= setForm('name', 'Name', form_input_(getArrayObj('edname', '', '200'), '', ' placeholder="Name" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('birth_date', 'Birth Date', form_input_(getArrayObj('edbirth_date', '', '200'), '', ' placeholder="Birth Date" class="tanggal"')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('birth_place', 'Birth Place', form_input_(getArrayObj('edbirth_place', '', '200'), '', ' placeholder="Birth Place" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('bio', 'Bio', form_textarea_(getArrayObj('edbio', '', '200'), '', ' placeholder="Bio" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('quote', 'Quote', form_input_(getArrayObj('edquote', '', '200'), '', ' placeholder="Quote" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('poster_img', 'Poster Image', '<div id="uploadposter_img" style="width:150px;">' . form_input_(getArrayObj('edposter_img', '', '100'), '', 'alt="Unggah"') . '</div>') . '<div class="spacer"></div>';

    $xBufResult .= setForm('phone', 'Phone', form_input_(getArrayObj('edphone', '', '200'), '', ' placeholder="Phone" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('instagram_link', 'Instagram Link', form_input_(getArrayObj('edinstagram_link', '', '200'), '', ' placeholder="Instagram Link" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('twitter_link', 'Twitter Link', form_input_(getArrayObj('edtwitter_link', '', '200'), '', ' placeholder="twitter Link" ')) . '<div class="spacer"></div>';

    $xBufResult .= setForm('email', 'Email', form_input_(getArrayObj('edemail', '', '200'), '', ' placeholder="Email" ')) . '<div class="spacer"></div>';

    $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'new', 'onclick="doClearartists();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanartists();"') . form_button('btTabel', 'Tabel', 'onclick="dosearchartists(0);"') . '<div class="spacer"></div></div><div id="tabledataartists">' . $this->getlistartists(0, '') . '</div><div class="spacer"></div>';
    return $xBufResult;
  }

  function getlistartists($xAwal, $xSearch)
  {
    $xLimit = $this->session->userdata('limit');
    $this->load->helper('form');
    $this->load->helper('common');
    $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'data-field="idx" data-sortable="true" width=10%') .
      tbaddcellhead('Name', '', 'data-field="name" data-sortable="true" width=10%') .
      tbaddcellhead('Birth Date', '', 'data-field="birth_date" data-sortable="true" width=10%') .
      tbaddcellhead('Birth Place', '', 'data-field="birth_place" data-sortable="true" width=10%') .
      tbaddcellhead('Bio', '', 'data-field="bio" data-sortable="true" width=10%') .
      tbaddcellhead('Quote', '', 'data-field="quote" data-sortable="true" width=10%') .
      tbaddcellhead('Poster Img', '', 'data-field="poster_img" data-sortable="true" width=10%') .
      tbaddcellhead('Phone', '', 'data-field="phone" data-sortable="true" width=10%') .
      tbaddcellhead('Instagram Link', '', 'data-field="instagram_link" data-sortable="true" width=10%') .
      tbaddcellhead('Twitter Link', '', 'data-field="twitter_link" data-sortable="true" width=10%') .
      tbaddcellhead('Email', '', 'data-field="email" data-sortable="true" width=10%') .

      tbaddcellhead('Action', 'padding:5px;width:10%;text-align:center;', 'col-md-2'), '', TRUE);
    $this->load->model('modelartists');
    $xQuery = $this->modelartists->getListartists($xAwal, $xLimit, $xSearch);
    $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
    $xbufResult .= '<tbody>';
    foreach ($xQuery->result() as $row) {
      $xButtonEdit = '<i class="fas fa-edit btn" aria-hidden="true"  onclick = "doeditartists(\'' . $row->idx . '\');" ></i>';
      $xButtonHapus = '<i class="fas fa-trash-alt btn" aria-hidden="true" onclick = "dohapusartists(\'' . $row->idx . '\');"></i>';
      if (!empty($row->poster_img)) {
        $poster_img = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->poster_img . '" onclick="previewimage(this.src);" style="border: solid;width: 70px; height: 80px; align:center;">';
      }
      $xbufResult .= tbaddrow(tbaddcell($no++) .
        tbaddcell($row->name) .
        tbaddcell(mysqltodate($row->birth_date)) .
        tbaddcell($row->birth_place) .
        tbaddcell(substr($row->bio, 0, 20) . "...") .
        tbaddcell($row->quote) .
        tbaddcell($poster_img) .
        tbaddcell($row->phone) .
        tbaddcell($row->instagram_link) .
        tbaddcell($row->twitter_link) .
        tbaddcell($row->email) .

        tbaddcell($xButtonEdit . $xButtonHapus));
    }
    $xInput      = form_input_(getArrayObj('edSearch', '', '200'));
    $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchartists(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
    $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchartists(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
    $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchartists(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
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


  function editrecartists()
  {
    $this->load->helper('common');
    $xIdEdit  = $_POST['edidx'];
    $this->load->model('modelartists');
    $row = $this->modelartists->getDetailartists($xIdEdit);
    $this->load->helper('json');
    $this->json_data['idx'] = $row->idx;
    $this->json_data['name'] = $row->name;
    $this->json_data['birth_date'] = mysqltodate($row->birth_date);
    $this->json_data['birth_place'] = $row->birth_place;
    $this->json_data['bio'] = $row->bio;
    $this->json_data['quote'] = $row->quote;
    $this->json_data['poster_img'] = $row->poster_img;
    $this->json_data['phone'] = $row->phone;
    $this->json_data['instagram_link'] = $row->instagram_link;
    $this->json_data['twitter_link'] = $row->twitter_link;
    $this->json_data['email'] = $row->email;

    echo json_encode($this->json_data);
  }
  function deletetableartists()
  {
    $edidx = $_POST['edidx'];
    $this->load->model('modelartists');
    $this->modelartists->setDeleteartists($edidx);
    $this->load->helper('json');
    echo json_encode(null);
  }
  function searchartists()
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
    $this->json_data['tabledataartists'] = $this->getlistartists($xAwal, $xSearch);
    $this->json_data['halaman'] = $xAwal . ' to ' . ($xlimit * $xHal);
    echo json_encode($this->json_data);
  }

  function  simpanartists()
  {
    $this->load->helper('json');
    $this->load->helper('common');
    if (!empty($_POST['edidx'])) {
      $xidx =  $_POST['edidx'];
    } else {
      $xidx = '0';
    }
    $xname = $_POST['edname'];
    $xbirth_date = datetomysql($_POST['edbirth_date']);
    $xbirth_place = $_POST['edbirth_place'];
    $xbio = $_POST['edbio'];
    $xquote = $_POST['edquote'];
    $xposter_img = $_POST['edposter_img'];
    $xphone = $_POST['edphone'];
    $xinstagram_link = $_POST['edinstagram_link'];
    $xtwitter_link = $_POST['edtwitter_link'];
    $xemail = $_POST['edemail'];

    $this->load->model('modelartists');
    $xidpegawai = $this->session->userdata('idpegawai');
    if (!empty($xidpegawai)) {
      if ($xidx != '0') {
        $xStr =  $this->modelartists->setUpdateartists($xidx, $xname, $xbirth_date, $xbirth_place, $xbio, $xquote, $xposter_img, $xphone, $xinstagram_link, $xtwitter_link, $xemail);
      } else {
        $xStr =  $this->modelartists->setInsertartists($xidx, $xname, $xbirth_date, $xbirth_place, $xbio, $xquote, $xposter_img, $xphone, $xinstagram_link, $xtwitter_link, $xemail);
      }
    }
    echo json_encode(null);
  }
}
