<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : usersistem  * di Buat oleh Diar PHP Generator  *  By Diar */

class ctrusersistem extends CI_Controller {

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
        $this->createformusersistem('0', $xAwal);
    }

    function createformusersistem($xidx, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxusersistem.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormusersistem($xidx), '', '', $xAddJs, '');
    }

    function setDetailFormusersistem($xidx) {
        $this->load->helper('form');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>Isi/Edit User Sistem</h3><div class="garis"></div>' . form_open_multipart('ctrusersistem/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $this->load->model('modelusergroup');
        $this->load->model('modelprovinsi');
        $this->load->model('modelkabupaten');
        $xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
        //$xBufResult .= setForm('ednpp', 'NPP', form_input(getArrayObj('ednpp', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNama', 'Nama', form_input(getArrayObj('edNama', '', '400'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edalamat', 'Alamat', form_textarea(getArrayObj('edalamat', '', '500'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edNoTelpon', 'No Telpon', form_input(getArrayObj('edNoTelpon', '', '150'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('eduser', 'User', form_input(getArrayObj('eduser', '', '150')));
        $xBufResult .= setForm('edpassword', 'password', form_input(getArrayObj('edpassword', '', '150'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidpropinsi', 'Propinsi', form_dropdown('edidpropinsi', $this->modelprovinsi->getArrayListprovinsi(), '', 'id="edidpropinsi" class="require" style="width:200px;" onchange="settablekabupaten();"')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidkabupaten', 'Kabupaten', form_dropdown('edidkabupaten', $this->modelkabupaten->getArrayListkabupaten(), '', 'id="edidkabupaten" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edym', 'Kode Device HP', form_input(getArrayObj('edimehp', '', '300'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edemail', 'Email', form_input(getArrayObj('edemail', '', '300'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edym', 'YM ', form_input(getArrayObj('edym', '', '300'))) . '<div class="spacer"></div>';

//        $xBufResult .= setForm('edisaktif', 'isaktif', form_input(getArrayObj('edisaktif', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidusergroup', 'User Group', form_dropdown('edidusergroup', $this->modelusergroup->getArrayListusergroup(), '', 'id="edidusergroup" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div></div></div>' . form_button('btNew', 'Baru', 'onclick="doClearusersistem();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanusersistem();"') . form_button('btTabel', 'Tabel', 'onclick="dosearchusersistem(0);"') . '<div id="tabledatausersistem">' . $this->getlistusersistem(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistusersistem($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=5%') .
                tbaddcellhead('Nama', '', 'width=30%') .
                tbaddcellhead('alamat', '', 'width=30%') .
                tbaddcellhead('NoTelpon', '', 'width=10%') .
                tbaddcellhead('user group', '', 'width=10%') .
                tbaddcellhead('IME HP', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelusersistem');
        $this->load->model('modelusergroup');
        $xQuery = $this->modelusersistem->getListusersistem($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = 1;
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditusersistem(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapususersistem(\'' . $row->idx . '\',\'' . substr($row->npp, 0, 20) . '\');"><i class="fas fa-trash" ></i></a>';
            $rowusergroup = $this->modelusergroup->getDetailusergroup($row->idusergroup);
            $xbufResult .= tbaddrow(tbaddcell($no++) .
                    tbaddcell($row->Nama) .
                    tbaddcell($row->alamat) .
                    tbaddcell($row->NoTelpon) .
                    tbaddcell($rowusergroup->NmUserGroup) .
                    tbaddcell($row->imehp) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchusersistem(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchusersistem(0);" style="border:none;width:30px;height:30px;" />';
        $xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchusersistem(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
        $xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchusersistem(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function editrecusersistem() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelusersistem');
        $row = $this->modelusersistem->getDetailusersistem($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = $row->idx;
        $this->json_data['npp'] = $row->npp;
        $this->json_data['Nama'] = $row->Nama;
        $this->json_data['alamat'] = $row->alamat;
        $this->json_data['NoTelpon'] = $row->NoTelpon;
        $this->json_data['user'] = $row->user;
        $this->json_data['password'] = $row->password;
        $this->json_data['statuspeg'] = $row->statuspeg;
        $this->json_data['photo'] = $row->photo;
        $this->json_data['email'] = $row->email;
        $this->json_data['ym'] = $row->ym;
        $this->json_data['imehp'] = $row->imehp;
        $this->json_data['isaktif'] = $row->isaktif;
        $this->json_data['idusergroup'] = $row->idusergroup;
        $this->json_data['idkabupaten'] = $row->idkabupaten;
        $this->json_data['idpropinsi'] = $row->idpropinsi;
        echo json_encode($this->json_data);
    }

    function deletetableusersistem() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelusersistem');
        $this->modelusersistem->setDeleteusersistem($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchusersistem() {
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
        $this->json_data['tabledatausersistem'] = $this->getlistusersistem($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpanusersistem() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xnpp = $_POST['ednpp'];
        $xNama = $_POST['edNama'];
        $xalamat = $_POST['edalamat'];
        $xNoTelpon = $_POST['edNoTelpon'];
        $xuser = $_POST['eduser'];
        $xpassword = $_POST['edpassword'];
        $xstatuspeg = $_POST['edstatuspeg'];
        $xphoto = $_POST['edphoto'];
        $xemail = $_POST['edemail'];
        $xym = $_POST['edym'];
        $xisaktif = $_POST['edisaktif'];
        $xidusergroup = $_POST['edidusergroup'];
        $xidkabupaten = $_POST['edidkabupaten'];
        $xidpropinsi = $_POST['edidpropinsi'];
        $ximehp = $_POST['edimehp'];
        $this->load->model('modelusersistem');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidx != '0') {
                $xStr = $this->modelusersistem->setUpdateusersistem($xidx, $xnpp, $xNama, $xalamat, $xNoTelpon, $xuser, $xpassword, $xstatuspeg, $xphoto, $xemail, $xym, $xisaktif, $xidusergroup, $xidkabupaten, $xidpropinsi, $ximehp);
            } else {
                $xStr = $this->modelusersistem->setInsertusersistem($xidx, $xnpp, $xNama, $xalamat, $xNoTelpon, $xuser, $xpassword, $xstatuspeg, $xphoto, $xemail, $xym, $xisaktif, $xidusergroup, $xidkabupaten, $xidpropinsi, $ximehp);
            }
        }

        echo json_encode(null);
    }

}

?>