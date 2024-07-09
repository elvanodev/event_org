<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : kabupaten   *  By Diar */;

class Ctrkabupaten extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xAwal = 0, $xSearch = '') {
        //$this->load->view('kabupaten.php');
        $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
            redirect(site_url(), '');
        }
        if ($xAwal <= -1) {
            $xAwal = 0;
        } $this->session->set_userdata('awal', $xAwal);
        $this->createformkabupaten('0', $xAwal);
    }

    function createformkabupaten($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                link_tag('resource/css/admin/upload/css/upload.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.knob.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.iframe-transport.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxkabupaten.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormkabupaten($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormkabupaten($xidx) {
        $this->load->helper('form');
        $this->load->model('modelprovinsi');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>kabupaten</h3><div class="garis"></div>' . form_open_multipart('ctrkabupaten/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edidprovinsi', 'idprovinsi', form_dropdown('edidprovinsi', $this->modelprovinsi->getArraylistprovinsi(), '', 'id="edidprovinsi"')) . '<div class="spacer"></div>';

        $xBufResult .= setForm('edkode_kabupaten', 'kode_kabupaten', form_input(getArrayObj('edkode_kabupaten', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= setForm('edkabupaten', 'kabupaten', form_input(getArrayObj('edkabupaten', '', '200'))) . '<div class="spacer"></div>';

//        $xBufResult .= setForm('edidprovinsi', 'idprovinsi', form_input(getArrayObj('edidprovinsi', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpankabupaten();"') . form_button('btNew', 'Baru', 'onclick="doClearkabupaten();"') . '<div class="spacer"></div><div id="tabledatakabupaten">' . $this->getlistkabupaten(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistkabupaten($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=10%') .
                tbaddcellhead('kode_kabupaten', '', 'width=10%') .
                tbaddcellhead('kabupaten', '', 'width=10%') .
                tbaddcellhead('provinsi', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelkabupaten');
        $this->load->model('modelprovinsi');

        $xQuery = $this->modelkabupaten->getListkabupaten($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = 1;
        foreach ($xQuery->result() as $row) {
            $prov = $this->modelprovinsi->getDetailprovinsi($row->idprovinsi);
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditkabupaten(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapuskabupaten(\'' . $row->idx . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditkabupaten(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapuskabupaten(\'' . $row->idx . '\',\'' . substr($row->kabupaten, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= tbaddrow(tbaddcell($no++) .
                    tbaddcell($row->kode_kabupaten) .
                    tbaddcell($row->kabupaten) .
                    tbaddcell(@$prov->provinsi) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchkabupaten(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchkabupaten(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchkabupaten(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchkabupaten(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
// $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchkabupaten(' . ($xAwal - $xLimit) . ');"/>';
//         $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchkabupaten(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function getlistkabupatenAndroid() {
        $this->load->helper('json');
        $xSearch = $_POST['search'];
        $xAwal = $_POST['start'];
        $xLimit = $_POST['limit'];
        $this->load->helper('form');
        $this->load->helper('common');
        $this->json_data['idx'] = "";
        $this->json_data['kode_kabupaten'] = "";
        $this->json_data['kabupaten'] = "";
        $this->json_data['idprovinsi'] = "";

        $response = array();
        $this->load->model('modelkabupaten');
        $xQuery = $this->modelkabupaten->getListkabupaten($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $this->json_data['idx'] = $row->idx;
            $this->json_data['kode_kabupaten'] = $row->kode_kabupaten;
            $this->json_data['kabupaten'] = $row->kabupaten;
            $this->json_data['idprovinsi'] = $row->idprovinsi;

            array_push($response, $this->json_data);
        }
        if (empty($response)) {
            array_push($response, $this->json_data);
        }
        echo json_encode($response);
    }

    function simpankabupatenAndroid() {
        $xidx = $_POST['edidx'];
        $xkode_kabupaten = $_POST['edkode_kabupaten'];
        $xkabupaten = $_POST['edkabupaten'];
        $xidprovinsi = $_POST['edidprovinsi'];

        $this->load->helper('json');
        $this->load->model('modelkabupaten');
        $response = array();
        if ($xidx != '0') {
            $this->modelkabupaten->setUpdatekabupaten($xidx, $kode_kabupaten, $kabupaten, $idprovinsi);
        } else {
            $this->modelkabupaten->setInsertkabupaten($xidx, $kode_kabupaten, $kabupaten, $idprovinsi);
        }
        $row = $this->modelkabupaten->getLastIndexkabupaten();
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_kabupaten'] = $row->kode_kabupaten;
        $this->json_data['kabupaten'] = $row->kabupaten;
        $this->json_data['idprovinsi'] = $row->idprovinsi;

        $response = array();
        array_push($response, $this->json_data);

        echo json_encode($response);
    }

    function editreckabupaten() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelkabupaten');
        $row = $this->modelkabupaten->getDetailkabupaten($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_kabupaten'] = $row->kode_kabupaten;
        $this->json_data['kabupaten'] = $row->kabupaten;
        $this->json_data['idprovinsi'] = $row->idprovinsi;

        echo json_encode($this->json_data);
    }

    function deletetablekabupaten() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelkabupaten');
        $this->modelkabupaten->setDeletekabupaten($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchkabupaten() {
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
        $this->json_data['tabledatakabupaten'] = $this->getlistkabupaten($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpankabupaten() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xkode_kabupaten = $_POST['edkode_kabupaten'];
        $xkabupaten = $_POST['edkabupaten'];
        $xidprovinsi = $_POST['edidprovinsi'];

        $this->load->model('modelkabupaten');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelkabupaten->setUpdatekabupaten($xidx, $xkode_kabupaten, $xkabupaten, $xidprovinsi);
            } else {
                $xStr = $this->modelkabupaten->setInsertkabupaten($xidx, $xkode_kabupaten, $xkabupaten, $xidprovinsi);
            }
        }
        echo json_encode(null);
    }

    function kabupatenbyprovinsi() {
        $this->load->helper('json');
        $this->load->helper('common');
        $this->load->helper('form');
        $xidprovinsi = $_POST['edidprovinsi'];
        $this->load->model('modelkabupaten');
        $this->load->model('modelprovinsi');
//        $querykota = $this->modelprovinsi->getArrayListprovinsi((int)$xidprovinsi);
        $query = $this->modelkabupaten->getListkabupatenbyprovinsi((int) $xidprovinsi);
        $xBufResult = '';
//        $xBufResultkota='';
//        if (!empty($querykota)) {
//            $xBufResultkota = setForm('edidprovinsi', 'edidprovinsi', form_dropdown('edidprovinsi', $querykota, '', 'id="edidprovinsi" onchange="kotaselect()"')) . '<div class="spacer"></div>';
//        }
        if (!empty($query)) {
            $xBufResult = setForm('edkabupaten', 'kabupaten', form_dropdown('edidkabupaten', $query, '', 'id="edidkabupaten" onchange="kabupatenselect()"')) . '<div class="spacer"></div>';
        }
        $this->json_data['combokabupaten'] = $xBufResult;
//        $this->json_data['combokota'] = $xBufResultkota;
        echo json_encode($this->json_data);
    }

}
