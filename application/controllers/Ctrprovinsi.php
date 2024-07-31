<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : provinsi   *  By Diar */;

class ctrprovinsi extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xAwal = 0, $xSearch = '') {
        //  $this->load->view('provinsi.php');
        $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
            redirect(site_url(), '');
        }
        if ($xAwal <= -1) {
            $xAwal = 0;
        } $this->session->set_userdata('awal', $xAwal);
        $this->createformprovinsi('0', $xAwal);
    }

    function createformprovinsi($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                link_tag('resource/css/admin/upload/css/upload.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.knob.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.iframe-transport.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxprovinsi.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormprovinsi($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormprovinsi($xidx) {
        $this->load->helper('form');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>provinsi</h3><div class="garis"></div>' . form_open_multipart('ctrprovinsi/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

        $xBufResult .= setForm('edkode_provinsi', 'kode_provinsi', form_input(getArrayObj('edkode_provinsi', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= setForm('edprovinsi', 'provinsi', form_input(getArrayObj('edprovinsi', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpanprovinsi();"') . form_button('btNew', 'Baru', 'onclick="doClearprovinsi();"') . '<div class="spacer"></div><div id="tabledataprovinsi">' . $this->getlistprovinsi(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistprovinsi($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=10%') .
                tbaddcellhead('kode_provinsi', '', 'width=10%') .
                tbaddcellhead('provinsi', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelprovinsi');
        $xQuery = $this->modelprovinsi->getListprovinsi($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = $xAwal + 1;
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditprovinsi(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapusprovinsi(\'' . $row->idx . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditprovinsi(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapusprovinsi(\'' . $row->idx . '\');" style="border:none;">';
            $xbufResult .= tbaddrow(tbaddcell($no++) .
                    tbaddcell($row->kode_provinsi) .
                    tbaddcell($row->provinsi) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchprovinsi(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchprovinsi(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchprovinsi(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchprovinsi(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
        // $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchprovinsi(' . ($xAwal - $xLimit) . ');"/>';
        // $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchprovinsi(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function getlistprovinsiAndroid() {
        $this->load->helper('json');
        $xSearch = $_POST['search'];
        $xAwal = $_POST['start'];
        $xLimit = $_POST['limit'];
        $this->load->helper('form');
        $this->load->helper('common');
        $this->json_data['idx'] = "";
        $this->json_data['kode_provinsi'] = "";
        $this->json_data['provinsi'] = "";

        $response = array();
        $this->load->model('modelprovinsi');
        $xQuery = $this->modelprovinsi->getListprovinsi($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $this->json_data['idx'] = $row->idx;
            $this->json_data['kode_provinsi'] = $row->kode_provinsi;
            $this->json_data['provinsi'] = $row->provinsi;

            array_push($response, $this->json_data);
        }
        if (empty($response)) {
            array_push($response, $this->json_data);
        }
        echo json_encode($response);
    }

    function simpanprovinsiAndroid() {
        $xidx = $_POST['edidx'];
        $xkode_provinsi = $_POST['edkode_provinsi'];
        $xprovinsi = $_POST['edprovinsi'];

        $this->load->helper('json');
        $this->load->model('modelprovinsi');
        $response = array();
        if ($xidx != '0') {
            $this->modelprovinsi->setUpdateprovinsi($xidx, $kode_provinsi, $provinsi);
        } else {
            $this->modelprovinsi->setInsertprovinsi($xidx, $kode_provinsi, $provinsi);
        }
        $row = $this->modelprovinsi->getLastIndexprovinsi();
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_provinsi'] = $row->kode_provinsi;
        $this->json_data['provinsi'] = $row->provinsi;

        $response = array();
        array_push($response, $this->json_data);

        echo json_encode($response);
    }

    function editrecprovinsi() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelprovinsi');
        $row = $this->modelprovinsi->getDetailprovinsi($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_provinsi'] = $row->kode_provinsi;
        $this->json_data['provinsi'] = $row->provinsi;

        echo json_encode($this->json_data);
    }

    function deletetableprovinsi() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelprovinsi');
        $this->modelprovinsi->setDeleteprovinsi($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchprovinsi() {
        $xAwal = $_POST['xAwal'];
        $xSearch = $_POST['xSearch'];
        $this->load->helper('json');
        if (($xAwal + 0) == -99) {
            $xAwal = $this->session->userdata('awal', $xAwal);
        }
        if ($xAwal + 0 <= -1) {
            $xAwal = 0;
            $this->session->set_userdata('awal', $xAwal);
        } else {
            $this->session->set_userdata('awal', $xAwal);
        }
        $this->json_data['tabledataprovinsi'] = $this->getlistprovinsi($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpanprovinsi() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xkode_provinsi = $_POST['edkode_provinsi'];
        $xprovinsi = $_POST['edprovinsi'];

        $this->load->model('modelprovinsi');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelprovinsi->setUpdateprovinsi($xidx, $xkode_provinsi, $xprovinsi);
            } else {
                $xStr = $this->modelprovinsi->setInsertprovinsi($xidx, $xkode_provinsi, $xprovinsi);
            }
        }
        echo json_encode(null);
    }

}
