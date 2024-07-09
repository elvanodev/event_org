<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : menu  * di Buat oleh Diar PHP Generator  *  By Diar */

class ctrmenu extends CI_Controller {

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
        $this->createformmenu('0', $xAwal);
    }

    function createformmenu($xidmenu, $xAwal = 0, $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmenu.js"></script>';
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormmenu($xidmenu), '', '', $xAddJs, '');
    }

    function getArrayJmlGambar() {
        $xBuffResul['0'] = '0';
        $xBuffResul['1'] = '1 Gambar';
        $xBuffResul['2'] = '2 Gambar';
        $xBuffResul['3'] = '3 Gambar';

        return $xBuffResul;
    }

    function setDetailFormmenu($xidmenu) {
        $this->load->helper('form');
        $xBufResult = '';
        $xBufResult = '<div id="stylized" class="myform"><h3>Judul Menu</h3><div class="garis"></div>' . form_open_multipart('ctrmenu/inserttable', array('id' => 'form', 'name' => 'form'));
        $this->load->helper('common');
        $this->load->model('modeltipemenu');
        $this->load->model('modelkomponen');
        $xBufResult .= '<div id="form">';
        $xBufResult .= '<input type="hidden" name="edidmenu" id="edidmenu" value="0" />';
        $xBufResult .= setForm('edicon', 'Icon', form_input(getArrayObj('edicon', '', '200'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('ednmmenu', 'Nama  / Judul Menu', form_input(getArrayObj('ednmmenu', '', '300')));
        $xBufResult .= setForm('edtipemenu', 'Tipe Modul', form_dropdown('edidagama', $this->modeltipemenu->getArrayListtipemenu(), '', 'id="edtipemenu" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edidkomponen', 'Komponen', form_dropdown('edidkomponen', $this->modelkomponen->getArrayListkomponen(), '', 'id="edidkomponen" class="require" style="width:300px;" '));
        //$xBufResult .= setForm('ediduser', 'iduser', form_input(getArrayObj('ediduser', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edparentmenu', 'Parent Menu', form_dropdown('edparentmenu', array(null), '', 'id="edparentmenu" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edurlci', 'URL CI', form_input(getArrayObj('edurlci', '', '300')));
        $xBufResult .= setForm('edurut', 'Urutan', form_input(getArrayObj('edurut', '', '100'))) . '<div class="spacer"></div>';
        $xBufResult .= setForm('edjmlgambar', 'Jml Gambar', form_dropdown('edjmlgambar', array($this->getArrayJmlGambar()), '', 'id="edjmlgambar" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
        //role xkomponen:caption,alt;
        $xsettingform = "xbahasa:Bahasa,;xjudul:Judul,;xisi:Isi / Keterangan,kontent;xisiawal:Isi Awal,Isikan Jika Diperlukan;xurut:urutan,urutan saat ditampilkan diweb;xgb1:,Upload Gambar 1;xgb2:,Upload Gambar 2;xgb3:,Upload Gambar 3;";
        $xBufResult .= setForm('edsettingform', 'Setting Form ', form_textarea(getArrayObj('edsettingform', $xsettingform, '600')), 'Jangan Dirubah Bila Tidak Tahu') . '<div class="spacer"></div>';
        $xBufResult .= '<div class="garis"></div></div></div>'  . form_button('btNew', 'Baru', 'onclick="doClearmenu();"') . form_button('btSimpan', 'Simpan', 'onclick="dosimpanmenu();"'). form_button('btTabel', 'Tabel', 'onclick="dosearchmenu(0);"'). '<div class="spacer"></div><div id="tabledatamenu">' . $this->getlistmenu(0, '') . '</div><div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistmenu($xAwal, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        $xbufResult1 = tbaddrow(tbaddcellhead('idmenu', '', 'width=5%') .
                tbaddcellhead('nmmenu', '', 'width=35%') .
                tbaddcellhead('tipemenu', '', 'width=10%') .
                tbaddcellhead('idkomponen', '', 'width=10%') .
                tbaddcellhead('urlci', '', 'width=10%') .
                tbaddcellhead('urut', '', 'width=10%') .
                tbaddcellhead('jmlgambar', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:10%;text-align:center;'), '', TRUE);
        $this->load->model('modelmenu');
        $this->load->model('modeltipemenu');
        $this->load->model('modelkomponen');
        $xQuery = $this->modelmenu->getListmenu($xAwal, $xLimit, $xSearch);
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = 1;
        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditmenu(\'' . $row->idmenu . '\');"><i class="fas fa-edit"></i></a>';
            $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapusmenu(\'' . $row->idmenu . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditmenu(\'' . $row->idmenu . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapusmenu(\'' . $row->idmenu . '\',\'' . substr($row->nmmenu, 0, 20) . '\');" style="border:none;">';
            $rowtipemn = $this->modeltipemenu->getDetailtipemenu($row->tipemenu);
            $rowkelmenu = $this->modelkomponen->getDetailkomponen($row->idkomponen);

            $xbufResult .= tbaddrow(tbaddcell($row->idmenu) .
                    tbaddcell($row->nmmenu) .
                    tbaddcell(@$rowtipemn->NmTipeMenu) .
                    tbaddcell(@$rowkelmenu->NmKomponen) .
                    tbaddcell($row->urlci) .
                    tbaddcell($row->urut) .
                    tbaddcell($row->jmlgambar) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchmenu(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchmenu(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchmenu(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchmenu(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
// $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchmenu(' . ($xAwal - $xLimit) . ');"/>';
//         $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchmenu(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function editrecmenu() {
        $xIdEdit = $_POST['edidmenu'];
        $this->load->model('modelmenu');
        $row = $this->modelmenu->getDetailmenu($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idmenu'] = $row->idmenu;
        $this->json_data['icon'] = $row->icon;
        $this->json_data['nmmenu'] = $row->nmmenu;
        $this->json_data['tipemenu'] = $row->tipemenu;
        $this->json_data['idkomponen'] = $row->idkomponen;
        $this->json_data['iduser'] = $row->iduser;
        $this->json_data['parentmenu'] = $row->parentmenu;
        $this->json_data['urlci'] = $row->urlci;
        $this->json_data['urut'] = $row->urut;
        $this->json_data['jmlgambar'] = $row->jmlgambar;
        $xsettingform = "xbahasa:Bahasa,;xjudul:Judul,;xisi:Isi / Keterangan,kontent;xisiawal:Isi Awal,Isikan Jika Diperlukan;xurut:urutan,urutan saat ditampilkan diweb;xgb1:,Upload Gambar 1;xgb2:,Upload Gambar 2;xgb3:,Upload Gambar 3;";
        if (!empty($row->settingform)) {
            $this->json_data['settingform'] = $row->settingform;
        } else {
            $this->json_data['settingform'] = $xsettingform;
        }
        echo json_encode($this->json_data);
    }

    function deletetablemenu() {
        $edidmenu = $_POST['edidmenu'];
        $this->load->model('modelmenu');
        $this->modelmenu->setDeletemenu($edidmenu);
        echo json_encode(null);
    }

    function searchmenu() {
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
        $this->json_data['tabledatamenu'] = $this->getlistmenu($xAwal, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpanmenu() {
        $this->load->helper('json');
        if (!empty($_POST['edidmenu'])) {
            $xidmenu = $_POST['edidmenu'];
        } else {
            $xidmenu = '0';
        }
        $xicon = $_POST['edicon'];
        $xnmmenu = $_POST['ednmmenu'];
        $xtipemenu = $_POST['edtipemenu'];
        $xidkomponen = $_POST['edidkomponen'];
        $xiduser = $_POST['ediduser'];
        $xparentmenu = $_POST['edparentmenu'];
        $xurlci = $_POST['edurlci'];
        $xurut = $_POST['edurut'];
        $xjmlgambar = $_POST['edjmlgambar'];
        $xsettingform = $_POST['edsettingform'];
        $this->load->model('modelmenu');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            if ($xidmenu != '0') {
                $xStr = $this->modelmenu->setUpdatemenu($xidmenu, $xnmmenu, $xtipemenu, $xidkomponen, $xiduser, $xparentmenu, $xurlci, $xurut, $xjmlgambar, $xsettingform,$xicon);
            } else {
                $xStr = $this->modelmenu->setInsertmenu($xidmenu, $xnmmenu, $xtipemenu, $xidkomponen, $xiduser, $xparentmenu, $xurlci, $xurut, $xjmlgambar, $xsettingform,$xicon);
            }
        }
        echo json_encode(null);
    }

    function islevelterbawah($xidx) {
        $this->load->model('modelmenu');
        $rowparent = $this->modelmenu->getDetailmenubyparent($xidx);
        return empty($rowparent->nmmenu);
    }

    function getLevelkategori($xidx) {
        $xparent = $xidx;
        $level = '0';
        $this->load->model('modelmenu');
        while (!empty($xparent)) {
            $row = $this->modelmenu->getDetailmenubyparent($xparent);
            $xparent = @$row->parentmenu;
            $level++;

            //echo $level."-";
            if ($level == 5) {
                $xparent = null;
            }
        }
        return $level;
    }

    function GetChildMenuKategori($xQuery) {
        $xBufResult = '';
        $this->load->model('modelmenu');
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {
                $fontw = 'font-weight: bold;';
                if ($this->islevelterbawah($row->idmenu))
                    $fontw = '';
                $level = $this->getLevelkategori($row->idmenu);

                $xChild = $this->GetChildMenuKategori($this->modelmenu->getlistmenubyparent($row->idmenu));
                $xBufResult .= '<option value="' . $row->idmenu . '" style="padding-left:  ' . (10 * $level) . 'px; font-size: ' . (14 - $level) . 'px;' . $fontw . '">' . $row->nmmenu . '</option>';
                $xBufResult .= $xChild;
            }
        }
        return $xBufResult;
    }

    function gettreekategori() {
        $xBufResult = '<option value="0">-</option>';
        $this->load->helper('menu');
        $this->load->helper('url');
        $this->load->model('modelmenu');
        $xQuery = $this->modelmenu->getlistmenubyparent("0");
        //   $xRowUrl = 'unitama/produk/';
        foreach ($xQuery->result() as $row) {
            $xChild = $this->GetChildMenuKategori($this->modelmenu->getlistmenubyparent($row->idmenu));
            $xBufResult .= '<option value="' . $row->idmenu . '" style="font-weight: bold;font-size: 16px;">' . $row->nmmenu . '</option>';
            $xBufResult .= $xChild;
        }

        return $xBufResult;
    }

    function setreekategori() {
        $this->load->helper('json');
        $this->json_data['option'] = $this->gettreekategori();
        echo json_encode($this->json_data);
    }

}

?>