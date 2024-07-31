<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : kelurahan   *  By Diar */;

class Ctrkelurahan extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xAwal = 0, $xSearch = '') {
        // $this->load->view('kelurahan.php');
        $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
            redirect(site_url(), '');
        }
        if ($xAwal <= -1) {
            $xAwal = 0;
        } $this->session->set_userdata('awal', $xAwal);
        $this->createformkelurahan('0', $xAwal);
    }

    function createformkelurahan($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                link_tag('resource/css/admin/upload/css/upload.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.knob.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.iframe-transport.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxkelurahan.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormkelurahan($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormkelurahan($xidx) {
        $this->load->helper('form');
        $this->load->model('modelprovinsi');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>kelurahan</h3><div class="garis"></div>' . form_open_multipart('ctrkelurahan/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';

        $xBufResult .= setForm('edidprovinsi', 'idprovinsi', form_dropdown('edidprovinsi', $this->modelprovinsi->getArraylistprovinsi(), '', 'id="edidprovinsi" onchange="provinsiselect()"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div id="kabupaten"></div>';
//        $xBufResult .= '<div id="kota"></div>';
        $xBufResult .= '<div id="kecamatan"></div>';

        $xBufResult .= setForm('edkode_kelurahan', 'kode kelurahan', form_input(getArrayObj('edkode_kelurahan', '', '200'))) . '<div class="spacer"></div>';

//        $xBufResult .= setForm('edidkecamatan', 'idkecamatan', form_input(getArrayObj('edidkecamatan', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= setForm('edkelurahan', 'kelurahan', form_input(getArrayObj('edkelurahan', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpankelurahan();"') . form_button('btNew', 'Baru', 'onclick="doClearkelurahan();"') . '<div class="spacer"></div><div id="tabledatakelurahan">' . $this->getlistkelurahan(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistkelurahan($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=10%') .
                tbaddcellhead('kode kelurahan', '', 'width=10%') .
                tbaddcellhead('kecamatan', '', 'width=10%') .
                tbaddcellhead('kelurahan', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelkelurahan');
        $this->load->model('modelkecamatan');
        $xQuery = $this->modelkelurahan->getListkelurahan($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = $xAwal + 1;
        foreach ($xQuery->result() as $row) {
            $kec = $this->modelkecamatan->getDetailkecamatan($row->idkecamatan);
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditkelurahan(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapuskelurahan(\'' . $row->idx . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditkelurahan(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapuskelurahan(\'' . $row->idx . '\');" style="border:none;">';
            $xbufResult .= tbaddrow(tbaddcell($no++) .
                    tbaddcell($row->kode_kelurahan) .
                    tbaddcell(@$kec->kecamatan) .
                    tbaddcell($row->kelurahan) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchkelurahan(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchkelurahan(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchkelurahan(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchkelurahan(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
// $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchkelurahan(' . ($xAwal - $xLimit) . ');"/>';
//         $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchkelurahan(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '0', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function getlistkelurahanAndroid() {
        $this->load->helper('json');
        $xSearch = $_POST['search'];
        $xAwal = $_POST['start'];
        $xLimit = $_POST['limit'];
        $this->load->helper('form');
        $this->load->helper('common');
        $this->json_data['idx'] = "";
        $this->json_data['kode_kelurahan'] = "";
        $this->json_data['idkecamatan'] = "";
        $this->json_data['kelurahan'] = "";

        $response = array();
        $this->load->model('modelkelurahan');
        $xQuery = $this->modelkelurahan->getListkelurahan($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $this->json_data['idx'] = $row->idx;
            $this->json_data['kode_kelurahan'] = $row->kode_kelurahan;
            $this->json_data['idkecamatan'] = $row->idkecamatan;
            $this->json_data['kelurahan'] = $row->kelurahan;

            array_push($response, $this->json_data);
        }
        if (empty($response)) {
            array_push($response, $this->json_data);
        }
        echo json_encode($response);
    }

    function simpankelurahanAndroid() {
        $xidx = $_POST['edidx'];
        $xkode_kelurahan = $_POST['edkode_kelurahan'];
        $xidkecamatan = $_POST['edidkecamatan'];
        $xkelurahan = $_POST['edkelurahan'];

        $this->load->helper('json');
        $this->load->model('modelkelurahan');
        $response = array();
        if ($xidx != '0') {
            $this->modelkelurahan->setUpdatekelurahan($xidx, $kode_kelurahan, $idkecamatan, $kelurahan);
        } else {
            $this->modelkelurahan->setInsertkelurahan($xidx, $kode_kelurahan, $idkecamatan, $kelurahan);
        }
        $row = $this->modelkelurahan->getLastIndexkelurahan();
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_kelurahan'] = $row->kode_kelurahan;
        $this->json_data['idkecamatan'] = $row->idkecamatan;
        $this->json_data['kelurahan'] = $row->kelurahan;

        $response = array();
        array_push($response, $this->json_data);

        echo json_encode($response);
    }

    function editreckelurahan() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelkelurahan');
        $row = $this->modelkelurahan->getDetailkelurahan($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_kelurahan'] = $row->kode_kelurahan;
        $this->json_data['idkecamatan'] = $row->idkecamatan;
        $this->json_data['kelurahan'] = $row->kelurahan;

        echo json_encode($this->json_data);
    }

    function deletetablekelurahan() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelkelurahan');
        $this->modelkelurahan->setDeletekelurahan($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchkelurahan() {
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
        $this->json_data['tabledatakelurahan'] = $this->getlistkelurahan($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpankelurahan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xkode_kelurahan = $_POST['edkode_kelurahan'];
        $xidkecamatan = $_POST['edidkecamatan'];
        $xkelurahan = $_POST['edkelurahan'];

        $this->load->model('modelkelurahan');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelkelurahan->setUpdatekelurahan($xidx, $xkode_kelurahan, $xidkecamatan, $xkelurahan);
            } else {
                $xStr = $this->modelkelurahan->setInsertkelurahan($xidx, $xkode_kelurahan, $xidkecamatan, $xkelurahan);
            }
        }
        echo json_encode(null);
    }

    function kelurahanbykecamatan() {
        $this->load->helper('json');
        $this->load->helper('common');
        $this->load->helper('form');
        $xidkecamatan = $_POST['edidkecamatan'];
        $this->load->model('modelkelurahan');
//        $this->load->model('modelkota');
        $query = $this->modelkelurahan->getListkelurahanbykecamatan((int) $xidkecamatan);
        $xBufResult = '';
        $xBufResult = setForm('edidkelurahan', 'kelurahan', form_dropdown('edidkelurahan', $query, '', 'id="edidkelurahan" ')) . '<div class="spacer"></div>';

        $this->json_data['combokelurahan'] = $xBufResult;
        echo json_encode($this->json_data);
    }

}
