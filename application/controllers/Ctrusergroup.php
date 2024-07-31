<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : usergroup  * di Buat oleh Diar PHP Generator  *  By Diar */

class ctrusergroup extends CI_Controller {

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
        $this->createformusergroup('0', $xAwal);
    }

    function createformusergroup($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxusergroup.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormusergroup($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormusergroup($xidx) {
        $this->load->helper('form');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>usergroup</h3><div class="garis"></div>' . form_open_multipart('ctrusergroup/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
        $xBufResult .= setForm('edNmUserGroup', 'NmUserGroup', form_input(getArrayObj('edNmUserGroup', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div>' . form_button('btSimpan', 'Simpan', 'onclick="dosimpanusergroup();"') . form_button('btNew', 'Baru', 'onclick="doClearusergroup();"') . '<div class="spacer"></div><div id="tabledatausergroup">' . $this->getlistusergroup(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistusergroup($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=10%') .
                tbaddcellhead('NmUserGroup', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelusergroup');
        $xQuery = $this->modelusergroup->getListusergroup($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = $xAwal + 1;
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditusergroup(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapususergroup(\'' . $row->idx . '\',\'' . substr($row->NmUserGroup, 0, 20) . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditusergroup(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapususergroup(\'' . $row->idx . '\',\'' . substr($row->NmUserGroup, 0, 20) . '\');" style="border:none;">';
            $xbufResult .= tbaddrow(tbaddcell($no++) .
                    tbaddcell($row->NmUserGroup) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchusergroup(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchusergroup(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchusergroup(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchusergroup(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
        // $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchusergroup(' . ($xAwal - $xLimit) . ');"/>';
        // $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchusergroup(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function editrecusergroup() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelusergroup');
        $row = $this->modelusergroup->getDetailusergroup($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['NmUserGroup'] = $row->NmUserGroup;
        echo json_encode($this->json_data);
    }

    function deletetableusergroup() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelusergroup');
        $this->modelusergroup->setDeleteusergroup($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchusergroup() {
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
        $this->json_data['tabledatausergroup'] = $this->getlistusergroup($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpanusergroup() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xNmUserGroup = $_POST['edNmUserGroup'];
        $this->load->model('modelusergroup');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelusergroup->setUpdateusergroup($xidx, $xNmUserGroup);
            } else {
                $xStr = $this->modelusergroup->setInsertusergroup($xidx, $xNmUserGroup);
            }
        }

        echo json_encode(null);
    }

}

?>