<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : kecamatan   *  By Diar */;

class ctrkecamatan extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xAwal = 0, $xSearch = '') {
        // $this->load->view('kecamatan.php');
        $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
            redirect(site_url(), '');
        }
        if ($xAwal <= -1) {
            $xAwal = 0;
        } $this->session->set_userdata('awal', $xAwal);
        $this->createformkecamatan('0', $xAwal);
    }

    function createformkecamatan($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                link_tag('resource/css/admin/upload/css/upload.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.knob.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.iframe-transport.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxkecamatan.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormkecamatan($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormkecamatan($xidx) {
        $this->load->helper('form');
        $this->load->model('modelprovinsi');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>kecamatan</h3><div class="garis"></div>' . form_open_multipart('ctrkecamatan/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edidprovinsi', 'idprovinsi', form_dropdown('edidprovinsi', $this->modelprovinsi->getArraylistprovinsi(), '', 'id="edidprovinsi" onchange="provinsiselect()"')) . '<div class="spacer"></div>';
        $xBufResult .= '<div id="kabupaten"></div>';
//        $xBufResult .= '<div id="provinsi"></div>';

        $xBufResult .= setForm('edkode_kecamatan', 'kode_kecamatan', form_input(getArrayObj('edkode_kecamatan', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= setForm('edkecamatan', 'kecamatan', form_input(getArrayObj('edkecamatan', '', '200'))) . '<div class="spacer"></div>';

//        $xBufResult .= setForm('edidkabupaten', 'idkabupaten', form_input(getArrayObj('edidkabupaten', '', '200'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edidprovinsi', 'idprovinsi', form_input(getArrayObj('edidprovinsi', '', '200'))) . '<div class="spacer"></div>';

        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpankecamatan();"') . form_button('btNew', 'Baru', 'onclick="doClearkecamatan();"') . '<div class="spacer"></div><div id="tabledatakecamatan">' . $this->getlistkecamatan(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistkecamatan($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=10%') .
                tbaddcellhead('kode Kecamatan', '', 'width=10%') .
                tbaddcellhead('kecamatan', '', 'width=10%') .
                tbaddcellhead('kabupaten', '', 'width=10%') .
                tbaddcellhead('provinsi', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelkecamatan');
        $this->load->model('modelprovinsi');
        $this->load->model('modelkabupaten');
        $xQuery = $this->modelkecamatan->getListkecamatan($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = $xAwal + 1;
        foreach ($xQuery->result() as $row) {
            $prov = $this->modelprovinsi->getDetailprovinsi($row->idprovinsi);
            $kab = $this->modelkabupaten->getDetailkabupaten($row->idkabupaten);
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditkecamatan(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapuskecamatan(\'' . $row->idx . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditkecamatan(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapuskecamatan(\'' . $row->idx . '\');" style="border:none;">';
            $xbufResult .= tbaddrow(tbaddcell($no++) .
                    tbaddcell($row->kode_kecamatan) .
                    tbaddcell($row->kecamatan) .
                    tbaddcell(@$kab->kabupaten) .
                    tbaddcell(@$prov->provinsi) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchkecamatan(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchkecamatan(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchkecamatan(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchkecamatan(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
// $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchkecamatan(' . ($xAwal - $xLimit) . ');"/>';
//         $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchkecamatan(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function getlistkecamatanAndroid() {
        $this->load->helper('json');
        $xSearch = $_POST['search'];
        $xAwal = $_POST['start'];
        $xLimit = $_POST['limit'];
        $this->load->helper('form');
        $this->load->helper('common');
        $this->json_data['idx'] = "";
        $this->json_data['kode_kecamatan'] = "";
        $this->json_data['kecamatan'] = "";
        $this->json_data['idkabupaten'] = "";
        $this->json_data['idprovinsi'] = "";

        $response = array();
        $this->load->model('modelkecamatan');
        $xQuery = $this->modelkecamatan->getListkecamatan($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $this->json_data['idx'] = $row->idx;
            $this->json_data['kode_kecamatan'] = $row->kode_kecamatan;
            $this->json_data['kecamatan'] = $row->kecamatan;
            $this->json_data['idkabupaten'] = $row->idkabupaten;
            $this->json_data['idprovinsi'] = $row->idprovinsi;

            array_push($response, $this->json_data);
        }
        if (empty($response)) {
            array_push($response, $this->json_data);
        }
        echo json_encode($response);
    }

    function simpankecamatanAndroid() {
        $xidx = $_POST['edidx'];
        $xkode_kecamatan = $_POST['edkode_kecamatan'];
        $xkecamatan = $_POST['edkecamatan'];
        $xidkabupaten = $_POST['edidkabupaten'];
        $xidprovinsi = $_POST['edidprovinsi'];

        $this->load->helper('json');
        $this->load->model('modelkecamatan');
        $response = array();
        if ($xidx != '0') {
            $this->modelkecamatan->setUpdatekecamatan($xidx, $kode_kecamatan, $kecamatan, $idkabupaten, $idprovinsi);
        } else {
            $this->modelkecamatan->setInsertkecamatan($xidx, $kode_kecamatan, $kecamatan, $idkabupaten, $idprovinsi);
        }
        $row = $this->modelkecamatan->getLastIndexkecamatan();
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_kecamatan'] = $row->kode_kecamatan;
        $this->json_data['kecamatan'] = $row->kecamatan;
        $this->json_data['idkabupaten'] = $row->idkabupaten;
        $this->json_data['idprovinsi'] = $row->idprovinsi;

        $response = array();
        array_push($response, $this->json_data);

        echo json_encode($response);
    }

    function editreckecamatan() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelkecamatan');
        $row = $this->modelkecamatan->getDetailkecamatan($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['kode_kecamatan'] = $row->kode_kecamatan;
        $this->json_data['kecamatan'] = $row->kecamatan;
        $this->json_data['idkabupaten'] = $row->idkabupaten;
        $this->json_data['idprovinsi'] = $row->idprovinsi;

        echo json_encode($this->json_data);
    }

    function deletetablekecamatan() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelkecamatan');
        $this->modelkecamatan->setDeletekecamatan($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchkecamatan() {
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
        $this->json_data['tabledatakecamatan'] = $this->getlistkecamatan($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpankecamatan() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xkode_kecamatan = $_POST['edkode_kecamatan'];
        $xkecamatan = $_POST['edkecamatan'];
        $xidkabupaten = $_POST['edidkabupaten'];
        $xidprovinsi = $_POST['edidprovinsi'];

        $this->load->model('modelkecamatan');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelkecamatan->setUpdatekecamatan($xidx, $xkode_kecamatan, $xkecamatan, $xidkabupaten, $xidprovinsi);
            } else {
                $xStr = $this->modelkecamatan->setInsertkecamatan($xidx, $xkode_kecamatan, $xkecamatan, $xidkabupaten, $xidprovinsi);
            }
        }
        echo json_encode(null);
    }

    function kecamatanbykabupaten() {
        $this->load->helper('json');
        $this->load->helper('common');
        $this->load->helper('form');
        $xidprovinsi = $_POST['edidprovinsi'];
        $xidkabupaten = $_POST['edidkabupaten'];
        $this->load->model('modelkecamatan');
        if (!($xidkabupaten == 'undefined')) {
            $xidkabupatenprovinsi = $xidkabupaten;
        } else {
            $xidkabupatenprovinsi = $xidprovinsi;
        }

//        $this->load->model('modelprovinsi');
//        $queryprovinsi = $this->modelkecamatan->getListprovinsibyprovinsi((int)$xidprovinsi);
        $query = $this->modelkecamatan->getListkecamatanbykabupaten((int) $xidkabupatenprovinsi);
        $xBufResult = '';
        $xBufResult = setForm('edkecamatan', 'kecamatan', form_dropdown('edidkecamatan', $query, '', 'id="edidkecamatan" onchange="kelurahanselect()"')) . '<div class="spacer"></div>';

        $this->json_data['combokecamatan'] = $xBufResult;

        echo json_encode($this->json_data);
    }

}
