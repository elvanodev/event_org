<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');
/* Class  Control : content  * di Buat oleh Diar PHP Generator  *  By Diar */

class ctrcontent extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xidmenu) {
//  $this->load->view('test.php');
        $idpegawai = $this->session->userdata('idpegawai');
        if (empty($idpegawai)) {
            redirect(site_url(), '');
        }

        $this->session->set_userdata('awal', '0');
        $this->createformcontent($xidmenu);
    }

    function createformcontent($xidmenu) {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('modelgetmenu');
        $xAddJs = link_tag('resource/js/jquery/themes/base/jquery.ui.all.css') . "\n" .
                link_tag('resource/css/admin/upload/css/upload.css') . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/tiny_mce_src.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce2.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/jquery/ui/jquery-ui.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.knob.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.ui.widget.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.iframe-transport.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/jquery.fileupload.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/common/fileupload/myupload.js"></script>' . "\n" .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxcontent.js"></script>' . "\n";
        echo $this->modelgetmenu->SetViewAdmin($this->setDetailFormcontent($xidmenu), '', '', $xAddJs, '');
    }

    function prepareFrom($xidmenu) {
        $this->load->helper('form');
        $this->load->helper('common');
        //  $this->load->model('modelbahasa');
        $this->load->model('modelmenu');
        $this->load->model('modelcontent');
        $rowmenu = $this->modelmenu->getDetailmenu($xidmenu);
        //$xsettingform = "xbahasa:Bahasa,;xjudul:Judul,;xisi:Isi / Keterangan,kontent;xisiawal:Isi Awal,Isikan Jika Diperlukan;xurut:urutan,urutan saat ditampilkan diweb;xgb1:,Upload Gambar 1;xgb2:,Upload Gambar 2;xgb3:,Upload Gambar 3;";
        $xarrayfield = array();
        $xarrayawalcomponen = explode(";", $rowmenu->settingform);
        $xBufResult = '';
        $xgambar = '';
        for ($irowcomponen = 0; $irowcomponen < count($xarrayawalcomponen); $irowcomponen++) {
            $xcomponenarr = $xarrayawalcomponen[$irowcomponen];
            $xcompdetailarr = explode(":", $xcomponenarr);
            if (!empty($xcompdetailarr[1]))
                $xcompcaption = explode(',', $xcompdetailarr[1]); //caption alt

            $xkomponen = $xcompdetailarr[0];
            $xcaption = '';
            if (!empty($xcompcaption[0]))
                $xcaption = $xcompcaption[0];
            $xalt = '';
            if (!empty($xcompcaption[1]))
                $xalt = $xcompcaption[1];
            switch ($xkomponen) {
                case 'xbahasa' :
                    // $xBufResult .= setForm('edidbahasa', $xcaption, form_dropdown('edidagama', $this->modelbahasa->getArrayListbahasa(), '', 'id="edidbahasa" class="require" style="width:200px;" '), @$xalt) . '<div class="spacer"></div>';
                    $xarrayfield[] = array('idbahasa', $xcaption);
                    break;
                case 'xjudul' :
                    if ($rowmenu->tipemenu == 2) {
                        $xBufResult .= setForm('edjudul', $xcaption, form_input(getArrayObj('edjudul', '', '500')), @$xalt) . '<div class="spacer"></div>';
                        $xarrayfield[] = array('judul', $xcaption);
                    }
                    break;
                case 'xisiawal' :
                    $xBufResult .= setForm('edisiawal', $xcaption, form_textarea(getArrayObj('edisiawal', '', '500'), '', ''), @$xalt) . '<div class="spacer"></div>';
                    $xarrayfield[] = array('isiawal', $xcaption);
                    break;
                case 'xisi' :
                    $xBufResult .= setForm('edisi', $xcaption, form_textarea(getArrayObj('edisi', '', '500'), '', 'class="tinymce"'), $xalt) . '<div class="spacer"></div>';
                    $xarrayfield[] = array('isi', $xcaption);
                    break;
                case 'xurut' :
                    if ($rowmenu->tipemenu == 2) {
                        $xBufResult .= setForm('edurut', $xcaption, form_input(getArrayObj('edurut', '', '100')), @$xalt) . '<div class="spacer"></div>';
                        $xarrayfield[] = array('urut', $xcaption);
                    }
                    break;
                case 'xgb1' :
                    if ($rowmenu->jmlgambar >= 1) {
                        $xgambar .= '<input type="input" name="edimage1" id="edimage1" alt="' . @$xalt . '"/>';
                        $xarrayfield[] = array('image1', $xalt);
                    }
                    break;
                case 'xgb2' :
                    if ($rowmenu->jmlgambar >= 2) {
                        $xgambar .= '<input type="input" name="edimage2" id="edimage2" alt="' . @$xalt . '"/>';
                        $xarrayfield[] = array('image2', $xalt);
                    }
                    break;
                case 'xgb3' :
                    if ($rowmenu->jmlgambar >= 3) {
                        $xgambar .= '<input type="input" name="edimage3" id="edimage3" alt="' . @$xalt . '"/>';
                        $xarrayfield[] = array('image3', $xalt);
                    }
                    break;
            }
        }
        $xarrresult = array();
        $xarrresult['content'] = $xBufResult;
        $xarrresult['gambar'] = $xgambar;
        //print_r($xarrayfield);
        $xarrresult['xfield'] = $xarrayfield;

        return $xarrresult;
    }

    function setDetailFormcontent($xidmenu) {
        $this->load->helper('form');
        $xBufResult = '';

        $this->load->helper('common');
        //$this->load->model('modelbahasa');
        $this->load->model('modelmenu');
        $this->load->model('modelcontent');
        $xarraycontent = $this->prepareFrom($xidmenu);
        $rowmenu = $this->modelmenu->getDetailmenu($xidmenu);
        $rowcontent = $this->modelcontent->getLastIndexcontentbyidmenu($xidmenu);
        ///echo "in index".$rowcontent->idx;
        if (!empty($rowcontent->idx)) {
            $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="' . $rowcontent->idx . '" />';
            // echo "in index".$rowcontent->idx;
        } else {
            $xBufResult .= '<input type="hidden" name="edidx" id="edidx" value="0" />';
        }
        $xBufResult .= '<input type="hidden" name="edidmenu" id="edidmenu" value="' . $xidmenu . '" />';
        $xBufResult .= '<input type="hidden" name="edidkomponen" id="edidkomponen" value="' . $rowmenu->idkomponen . '" />';
        $xBufResult .= '<div id="stylized" class="myform"><h3>Isi /edit Content : ' . $rowmenu->nmmenu . ' </h3>';
        $xBufResult .= ' <div id="tabs">
                                 <ul>
                                   <li><a href="#dataumum"><span>Data Detail </span></a></li>
                                   <li><a href="#gambar"><span>Gambar </span></a></li>
                                  </ul>';

        $xBufResult .= '<div id="dataumum"><form>';
        $xBufResult .= 'Id content : ' . @$rowcontent->idx . '<div class="spacer"></div>';

        $xBufResult .= $xarraycontent['content'];
        //$xBufResult .= setForm('edidbahasa', 'Bahasa', form_dropdown('edidagama', $this->modelbahasa->getArrayListbahasa(), '', 'id="edidbahasa" class="require" style="width:200px;" ')) . '<div class="spacer"></div>';
//        if ($rowmenu->tipemenu == 2) {
//            $xBufResult .= setForm('edjudul', 'Judul', form_input(getArrayObj('edjudul', '', '500'))) . '<div class="spacer"></div>';
//        }
//        $xBufResult .= setForm('edisi', 'Isi / Keterangan', form_textarea(getArrayObj('edisi', '', '500'), '', 'class="tinymce"')) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edisiawal', 'Isi Awal', form_textarea(getArrayObj('edisiawal', '', '500'), '', ''), 'Isikan Jika Diperlukan') . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edidmenu', 'idmenu', form_input(getArrayObj('edidmenu', '', '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edidkomponen', 'idkomponen', form_input(getArrayObj('edidkomponen', '', '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edtanggal', 'tanggal', form_input(getArrayObj('edtanggal', '', '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edjam', 'jam', form_input(getArrayObj('edjam', '', '100'))) . '<div class="spacer"></div>';
//        $xBufResult .= setForm('edidadmin', 'idadmin', form_input(getArrayObj('edidadmin', '', '100'))) . '<div class="spacer"></div>';
//        if ($rowmenu->tipemenu == 2) {
//            $xBufResult .= setForm('edurut', 'urutan ', form_input(getArrayObj('edurut', '', '100'))) . '<div class="spacer"></div>';
//        }

        $xBufResult .= '</form></div>
                         <div id="gambar">';
        $xBufResult .= $xarraycontent['gambar'];
//        if ($rowmenu->jmlgambar >= 1) {
//            $xBufResult .= '<input type="input" name="edimage1" id="edimage1" alt="upload image 1"/>
//                              ';
//        }
//        if ($rowmenu->jmlgambar >= 2) {
//            $xBufResult .= '<input type="input" name="edimage2" id="edimage2" alt="upload image 2"/>
//                              ';
//        }
//        if ($rowmenu->jmlgambar >= 3) {
//            $xBufResult .= '<input type="input" name="edimage3" id="edimage3" alt="upload image 3"/>
//                              ';
//        }


        $xBufResult .= '</div>' . '<div class="spacer"></div>' .
                form_button('btSimpan', 'Simpan', 'onclick="dosimpancontent();"');
        $xfield = $xarraycontent['xfield'];
        if ($rowmenu->tipemenu == 2) {
            $xBufResult .= form_button('btNew', 'Baru', 'onclick="doClearcontent();"') .
                    ' <div class="spacer"></div>
                      <div id="tabledatacontent">' . $this->getlistcontent(0, $xidmenu, $xfield, '') . '</div>';
        }
        $xBufResult .= '<div class="spacer"></div>';
        return $xBufResult;
    }

    function getlistcontent($xAwal, $xidmenu, $xfield, $xSearch) {
        $xLimit = 10;
        $this->load->helper('form');
        $this->load->helper('common');
        ///SET Field caption
        $xarrbulan = getArrayBulan();
        $xarrhari = getArrayHari();
        $xtablecaption = '';
        for ($i = 0; $i < count($xfield); $i++) {
            $xfieldcaption = $xfield[$i];
            $xtablecaption .= tbaddcell($xfieldcaption[1], '', 'width=20%');
        }

        ///
        $xbufResult1 = tbaddrow(tbaddcellhead('No', '', 'width=3%') .
                $xtablecaption .
//                tbaddcellhead('Bahasa', '', 'width=10%') .
//                tbaddcellhead('Judul', '', 'width=20%') .
//                tbaddcellhead('Isi', '', 'width=40%') .
//                tbaddcellhead('Urut', '', 'width=10%') .
                tbaddcellhead('Tanggal, Jam', '', 'width=10%') .
                tbaddcellhead('Edit/Hapus', 'padding:5px;', 'width:5%;text-align:center;'), '', TRUE);
        $this->load->model('modelcontent');

        $xQuery = $this->modelcontent->getListcontent($xAwal, $xLimit, $xSearch, $xidmenu);
        //$this->load->model('modelbahasa');
        $xbufResult = '<thead>' . $xbufResult1 . '</thead>';
        $xbufResult .= '<tbody>';
$no = 1;
        foreach ($xQuery->result() as $row) {

            $xButtonEdit = '<a href="javascript:void(0);" onclick = "doeditcontent(\'' . $row->idx . '\');"><i class="fas fa-edit"></i></a>';
              $xButtonHapus = '<a href="javascript:void(0);" onclick = "dohapuscontent(\'' . $row->idx . '\');"><i class="fas fa-trash" ></i></a>';
            // $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doeditcontent(\'' . $row->idx . '\');" style="border:none;width:20px"/>';
            // $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapuscontent(\'' . $row->idx . '\',\'' . substr($row->judul, 0, 20) . '\');" style="border:none;">';
            //  $xrowbahasa = $this->modelbahasa->getDetailbahasa($row->idbahasa);

            $xfielddata = '';
            for ($i = 0; $i < count($xfield); $i++) {
                $xdata = $xfield[$i];
                $xfieldname = $xdata[0];
                // echo 'filed : '.$xfieldname.'--';
                if ($xfieldname === 'isi') {
                    $xfielddata .= tbaddcell(substr(strip_tags($row->isi), 0, 300), 'font-size:11px;');
                } elseif (strpos($xfieldname, 'image') !== FALSE) {
                    $ximage = '<img src="' . base_url() . 'resource/uploaded/img/' . $row->$xfieldname . '"/ width="200px" height="100px" style="cursor:default;">';
                    $xfielddata .= tbaddcell($ximage);
                } else {
                    $xfielddata .= tbaddcell($row->$xfieldname, 'font-size:11px;');
                }
            }
            $hari = $xarrhari[$row->harike];
            $bulan = $xarrbulan[$row->bulanke];
            $tgl = $hari . ', ' . $row->tgl . ' ' . $bulan . ' ' . $row->tahun;

            $xbufResult .= tbaddrow(
                    tbaddcell($no++) . $xfielddata .
//                           tbaddcell(@$xrowbahasa->bahasa) .
//                           tbaddcell($row->judul) .
//                           tbaddcell(substr(strip_tags($row->isi), 0, 300), 'font-size:11px;') .
//                           tbaddcell($row->urut) .
                    tbaddcell($tgl . ' / ' . $row->jam) .
                    tbaddcell($xButtonEdit . '&nbsp/&nbsp' . $xButtonHapus));
        }
        $xInput = form_input(getArrayObj('edSearch', '', '200'));
        $xButtonSearch = '<span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick = "dosearchcontent(0);"><i class="fa fa-search"></i>
                                                </button>
                                            </span>';
//$xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearchcontent(0);" style="border:none;width:30px;height:30px;" />';
$xButtonPrev = '<a href="javascript:void(0)" onclick = "dosearchcontent(' . ($xAwal - $xLimit) . ');"><i class="fas fa-chevron-circle-left"></i></a>';
$xButtonNext = '<a href="javascript:void(0)" onclick = "dosearchcontent(' . ($xAwal + $xLimit) . ');"><i class="fas fa-chevron-circle-right"></i></a>';
// $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearchcontent(' . ($xAwal - $xLimit) . ');"/>';
//         $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearchcontent(' . ($xAwal + $xLimit) . ');" />';
        $xbuffoottable = '<div class="foottable row text-lg"><div class="col-md-6">' . setForm('', '', $xInput . $xButtonSearch, '', '') . '</div>' .
                '<div class="col-md-6 text-right">' . $xButtonPrev . '&nbsp&nbsp' . $xButtonNext . '</div></div>';
        $xbufResult = tablegrid($xbufResult . '</tbody>') . $xbuffoottable;
        return '<div class="tabledata table-responsive"  style="width:100%;left:-12px;">' . $xbufResult . '</div>';
    }

    function editreccontent() {
        $xIdEdit = $_POST['edidx'];
        $this->load->model('modelcontent');
        $row = $this->modelcontent->getDetailcontent($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idx'] = @$row->idx;
        $this->json_data['judul'] = stripslashes(@$row->judul);
        $this->json_data['isiawal'] = stripslashes(@$row->isiawal);
        $this->json_data['isi'] = stripslashes(@$row->isi);
        $this->json_data['idbahasa'] = @$row->idbahasa;
        $this->json_data['idmenu'] = @$row->idmenu;
        $this->json_data['idkomponen'] = @$row->idkomponen;
        $this->json_data['tanggal'] = @ $row->tanggal;
        $this->json_data['jam'] = @$row->jam;
        $this->json_data['idadmin'] = @$row->idadmin;
        $this->json_data['urut'] = @$row->urut;
        $this->json_data['image1'] = @$row->image1 . "";
        $this->json_data['image2'] = @$row->image2 . "";
        $this->json_data['image3'] = @$row->image3 . "";
        echo json_encode($this->json_data);
    }

    function deletetablecontent() {
        $edidx = $_POST['edidx'];
        $this->load->model('modelcontent');
        $this->load->model('basemodel');
        $row = $this->modelcontent->getDetailcontent($edidx);
        $this->basemodel->delimage($row->image1);
        @$this->basemodel->delimage(@$row->image2);
        @$this->basemodel->delimage(@$row->image3);
        $this->modelcontent->setDeletecontent($edidx);
        $this->load->helper('json');
        echo json_encode(null);
    }

    function searchcontent() {
        $xAwal = $_POST['xAwal'];
        $xSearch = $_POST['xSearch'];
        $xidmenu = $_POST['idmenu'];
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
        $xarraycontent = $this->prepareFrom($xidmenu);
        $xfield = $xarraycontent['xfield'];
        $this->json_data['tabledatacontent'] = $this->getlistcontent($xAwal, $xidmenu, $xfield, $xSearch);
        echo json_encode($this->json_data);
    }

    function simpancontent() {
        $this->load->helper('json');
        if (!empty($_POST['edidx'])) {
            $xidx = $_POST['edidx'];
        } else {
            $xidx = '0';
        }
        $xjudul = $_POST['edjudul'];
        $xisiawal = $_POST['edisiawal'];
        $xisi = $_POST['edisi'];
        $xidbahasa = $_POST['edidbahasa'];
        $xidmenu = $_POST['edidmenu'];
        $xidkomponen = $_POST['edidkomponen'];
        $xtanggal = $_POST['edtanggal'];
        $xjam = $_POST['edjam'];
        $xidadmin = $_POST['edidadmin'];
        $xurut = $_POST['edurut'];
        $ximage1 = (!isset($_POST['edimage1'])) ? 'logo.png' : $_POST['edimage1'];
        $ximage2 = (!isset($_POST['edimage2'])) ? 'logo.png' : $_POST['edimage2'];
        $ximage3 = (!isset($_POST['edimage3'])) ? 'logo.png' : $_POST['edimage3'];

        $this->load->model('basemodel');
        if (isset($_POST['edimage1']) && $_POST['edimage1'] != 'undefined') {
            $ximage1 = @$this->basemodel->imagesize($ximage1, 'large');
            $small1 = @$this->basemodel->imagesize($ximage1, 'small');
            $medium1 = @$this->basemodel->imagesize($ximage1, 'medium');
            $galeri1 = @$this->basemodel->imagesize($ximage1, 'galeri');
            $thumb1 = @$this->basemodel->imagesize($ximage1, 'thumb');
        }
        if (isset($_POST['edimage2']) && $_POST['edimage2'] != 'undefined') {
            $ximage2 = @$this->basemodel->imagesize($ximage2, 'large');
            $small2 = @$this->basemodel->imagesize($ximage2, 'small');
            $medium2 = @$this->basemodel->imagesize($ximage2, 'medium');
            $galeri2 = @$this->basemodel->imagesize($ximage2, 'galeri');
            $thumb2 = @$this->basemodel->imagesize($ximage2, 'thumb');
        }
        if (isset($_POST['edimage3']) && $_POST['edimage3'] != 'undefined') {
            $ximage3 = @$this->basemodel->imagesize($ximage3, 'large');
            $small3 = @$this->basemodel->imagesize($ximage3, 'small');
            $medium3 = @$this->basemodel->imagesize($ximage3, 'medium');
            $galeri3 = @$this->basemodel->imagesize($ximage3, 'galeri');
            $thumb3 = @$this->basemodel->imagesize($ximage3, 'thumb');
        }

        $this->load->model('modelcontent');
        $idpegawai = $this->session->userdata('idpegawai');
        if (!empty($idpegawai)) {
            $xidadmin = $idpegawai;
            if ($xidx != '0') {
                $xStr = @$this->modelcontent->setUpdatecontent($xidx, addslashes($xjudul), addslashes($xisiawal), addslashes($xisi), $xidbahasa, $xidmenu, $xidkomponen, $xtanggal, $xjam, $xidadmin, $xurut, $ximage1, $ximage2, $ximage3);
            } else {
                $xStr = @$this->modelcontent->setInsertcontent($xidx, addslashes($xjudul), addslashes($xisiawal), addslashes($xisi), $xidbahasa, $xidmenu, $xidkomponen, $xtanggal, $xjam, $xidadmin, $xurut, $ximage1, $ximage2, $ximage3);
            }
        }
        echo json_encode(null);
    }

}

?>