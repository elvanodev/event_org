<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : imgslide  * di Buat oleh Diar PHP Generator  *  By Diar */

class ctrimgslide extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xAwal = 0, $xSearch = '') {
//  $this->load->view('test.php');
        $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
            redirect(site_url(), '');
        }
        if ($xAwal <= -1) {
            $xAwal = 0;
        } $this->session->set_userdata('awal', $xAwal);
        $this->createformimgslide('0', $xAwal);
    }

    function createformimgslide($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = link_tag('resource/css/admin/upload/css/upload.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/tiny_mce_src.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce2.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.knob.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.iframe-transport.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaximgslide.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormimgslide($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormimgslide($xidx) {
        $this->load->helper('form');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>Upload Img Slide</h3><div class="garis"></div>' . form_open_multipart('ctrimgslide/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
        //$xBufResult .= setForm('edurl', 'UPLOAD SLIDE', form_input(getArrayObj('edurl', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edurl', '', '<div id="uploadarea" style="width:150px;height:150px"><br />' . form_input(getArrayObj('edurl', '', '100'), '', 'alt="Upload GBR Slide"') . '</div>') . '<div class="spacer"></div> ';
        $xBufResult .= setForm('edketerangan', 'Keterangan', form_textarea(getArrayObj('edketerangan', '', '600'), '', 'class="tinymce"')) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edtglinsert', 'tglinsert', form_input(getArrayObj('edtglinsert', '', '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edtglupdate', 'tglupdate', form_input(getArrayObj('edtglupdate', '', '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edidpegawai', 'idpegawai', form_input(getArrayObj('edidpegawai', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edlink', 'Link', form_input(getArrayObj('edlink', '', '600'))) . '<div class="spacer"></div> ';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpanimgslide();"') . form_button('btNew', 'new', 'onclick="doClearimgslide();"') . '<div class="spacer"></div><div id="tabledataimgslide">' . $this->getlistimgslide(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistimgslide($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult = tbaddrow(tbaddcell('idx', '', 'width=5%') .
                tbaddcell('Link Gambar', '', 'width=35%') .
                tbaddcell('Keterangan', '', 'width=35%') .
//                tbaddcell('tglinsert', '', 'width=10%') .
//                tbaddcell('tglupdate', '', 'width=10%') .
//                tbaddcell('idpegawai', '', 'width=10%') .
                tbaddcell('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelimgslide');
        $xQuery = $this->modelimgslide->getListimgslide($xAwal, $xLimit, $xSearch);
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditimgslide(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapusimgslide(\'' . $row->idx . '\',\'' . substr($row->url, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= tbaddrow(tbaddcell($row->idx) .
                    tbaddcell($row->url) .
                    tbaddcell($row->keterangan) .
//                    tbaddcell($row->tglinsert) .
//                    tbaddcell($row->tglupdate) .
//                    tbaddcell($row->idpegawai) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchimgslide(0);" style="border:none;width:30px;height:30px;" />';
        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchimgslide(' . ($xAwal - $xLimit) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchimgslide(' . ($xAwal + $xLimit) . ');" />';
        $xbufResult .= tbaddrow(tbaddcell($xInput . $xButtonSearch, '', 'width=10% colspan=2') .
                tbaddcell($xButtonPrev . '&nbsp&nbsp' . $xButtonNext, '', 'width=40% colspan =10'), '', TRUE);
        $xbufResult = tablegrid($xbufResult);
        return '<div class="tabledata"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function editrecimgslide() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelimgslide');
        $row = $this->modelimgslide->getDetailimgslide($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['url'] = $row->url;
        $this->json_data['keterangan'] = $row->keterangan;
        $this->json_data['tglinsert'] = $row->tglinsert;
        $this->json_data['tglupdate'] = $row->tglupdate;
        $this->json_data['idpegawai'] = $row->idpegawai;
        $this->json_data['link'] = $row->link;
        echo json_encode($this->json_data);
    }

    function deletetableimgslide() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelimgslide');
        $this->modelimgslide->setDeleteimgslide($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchimgslide() {
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
        $this->json_data['tabledataimgslide'] = $this->getlistimgslide($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpanimgslide() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xurl = $_POST['edurl'];
        $xketerangan = $_POST['edketerangan'];
        $xtglinsert = $_POST['edtglinsert'];
        $xtglupdate = $_POST['edtglupdate'];
        $xidpegawai = $_POST['edidpegawai'];
        $xlink = $_POST['edlink'];
        $this->load->model('modelimgslide');
        $this->load->model('basemodel');
        $idpegawai = $this->session->userdata('idpegawai');

//        $slide = $this->basemodel->imagesize($xurl, 'slide');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelimgslide->setUpdateimgslide($xidx, $xurl, $xketerangan, $xtglinsert, $xtglupdate, $idpegawai, $xlink);
            } else {
                $xStr = $this->modelimgslide->setInsertimgslide($xidx, $xurl, $xketerangan, $xtglinsert, $xtglupdate, $idpegawai, $xlink);
            }
        }
        echo json_encode(null);
    }

}

?>