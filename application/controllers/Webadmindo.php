<?php

if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');

class webadmindo extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index($xidmenu = '0') {

        //$this->load->view('indexRv.php');
        if (!empty($xidmenu)) {
            $this->createform($xidmenu, '0', '');
        } else {
            $this->setViewAwal($xidmenu);
        }
    }

    function setCSSPrevimage($xIdx, $plus) {
        $xbufresult = '
             $(document).ready(function(){
                $("#previewg' . $xIdx . '").css({
                    position : "absolute",
                    top :"' . (45 + $plus) . 'px",
                    left:"350px",
                    height: "70px",
                    width : "110px"

                });
            });';
        return $xbufresult;
    }

    function setformupload($xidmenu) {
        $xbufresult = '';
        $this->load->model('modelmenu');
        $rowmenu = $this->modelmenu->getDeatilmenu($xidmenu);
        $xbufresult = '';
        for ($i = 0; $i < $rowmenu->jmlgambar; $i++) {
            $xbufresult .= '<a href ="#" class="thickbox" id="preview' . ($i + 1) . '" class="preview"><img src="" id="previewg' . ($i + 1) . '" class="previewg" /></a>';
            $xbufresult .= '<div class="browsephoto">' . 'Gambar ' . ($i + 1) . form_input(getArrayObj('edgambar' . ($i + 1), '', '100'), '', 'class="edgambar"') . '</div><div class="spacer"></div>' . '<div class="spacer"></div>' . '<div class="garis"></div>';
        }
        return $xbufresult;
    }

    function setfunctionclearimage($xidmenu) {
        $this->load->model('modelmenu');
        $rowmenu = $this->modelmenu->getDeatilmenu($xidmenu);
        //echo ' jumlahhh '.$rowmenu->jmlgambar;
        $xbufresul = '';
        if ($rowmenu->jmlgambar > 0) {
            for ($i = 0; $i < $rowmenu->jmlgambar; $i++) {
                $xbufresul .= '
                       $(\'#previewg' . ($i + 1) . '\').attr({
                    src: getBaseURL()+"resource/uploaded/white.png",
                    alt: ""
                });

                $(\'#preview' . ($i + 1) . '\').attr({
                    href: getBaseURL()+"resource/uploaded/white.png",
                    class : "thickbox",
                    alt: "",
                    title: ""
                });
                     ';
            }
        }

        $xburesult = 'function clearimage(){
                 $(document).ready(function() {

                  ' . $xbufresul . '

                });
                }';
        return $xburesult;
    }

    function setfunctionshowimage($xidmenu) {
        $this->load->model('modelmenu');
        $rowmenu = $this->modelmenu->getDeatilmenu($xidmenu);
        //echo ' jumlahhh '.$rowmenu->jmlgambar;
        $xbufresul = '';
        if ($rowmenu->jmlgambar > 0) {
            for ($i = 0; $i < $rowmenu->jmlgambar; $i++) {
                $xbufresul .= '
                       $(\'#previewg' . ($i + 1) . '\').attr({
                    src: getBaseURL()+"resource/uploaded/project/"+json.gambar' . ($i + 1) . ',
                    alt: ""
                });

                $(\'#preview' . ($i + 1) . '\').attr({
                    href: getBaseURL()+"resource/uploaded/project/"+json.gambar' . ($i + 1) . ',
                    class : "thickbox",
                    alt: "",
                    title: ""
                });
                     ';
            }
        }
        $xburesult = 'function showimage(json){
                 $(document).ready(function() {

                  ' . $xbufresul . '

                });
                }';
        return $xburesult;
    }

    function SetBrowse($xIdx) {
        $xbufresult = " $(document).ready(function() {
        $('#edgambar" . $xIdx . "').uploadify({
            'uploader' : getBaseURL()+'resource/js/uploadify/uploadify.swf',
            'script':getBaseURL()+'resource/js/uploadify/uploadproduk.php',
            'folder': './resource/uploaded/project/',
            'multi' : true,
            'auto'  : true,
            'fileExt' : '*.jpg;*.jpeg;*.png;*.gif',
            'buttonText': 'Browse...',
            'cancelImg': getBaseURL()+'resource/js/uploadify/cancel.png',
            'onError' : function (a, b, c, d) {
                if (d.status == 404)
                    alert('Could not find upload script.');
                else if (d.type === \"HTTP\")
                    alert('error '+d.type+\": \"+d.status);
                else if (d.type ===\"File Size\")
                    alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
                else
                    alert('error '+d.type+\": \"+d.text);
            },
            'onComplete'     : function(event, queueID, fileObj, response, data) {
                $('#previewg" . $xIdx . "').attr({
                    src:  getBaseURL()+\"resource/uploaded/project/\"+fileObj.name,
                    alt: fileObj.name
                });

                $('#preview" . $xIdx . "').attr({
                    href: getBaseURL()+\"resource/uploaded/project/\"+fileObj.name,
                    class : \"thickbox\",
                    alt: fileObj.name,
                    title: fileObj.name
                });

                $('#edgambar" . $xIdx . "').val(fileObj.name);
                dosimpanimage(" . $xIdx . ");

            },
            'onAllComplete'     : function() {


            }

        });
    });";
        return $xbufresult;
    }

    function setscript($xidmenu) {
        $this->load->model('modelmenu');
        $rowmenu = $this->modelmenu->getDeatilmenu($xidmenu);
        //echo ' jumlahhh '.$rowmenu->jmlgambar;
        if ($rowmenu->jmlgambar > 0) {
            $xbufresult = '<script>';
            for ($i = 0; $i < $rowmenu->jmlgambar; $i++) {
                $xbufresult .= $this->setCSSPrevimage($i + 1, $i * 80);
                $xbufresult .= $this->SetBrowse($i + 1);
            }

            return $xbufresult . '
           $(document).ready(function() {
                $(\'.browsephoto\').css({
                    position : "relative",
                    left  :"50px",
                    width :"150px",
                    top :"0px"
                });

              });
           ' . $this->setfunctionclearimage($xidmenu) . $this->setfunctionshowimage($xidmenu) . ' doClear();
           </script>';
        } else {
            return '';
        }
    }

    function createform($xidmenu, $xAwal = '0', $xSearch = '') {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        $this->load->model('modelgetmenu');
        $this->load->model('modelmenu');
        $xBufResult = '';
        $xForm = $this->getformbymenu($xidmenu);
       

        //$xAddJs = '<script language="javascript" type="text/javascript" src="'.base_url().'resource/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>';
        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/thickbox.js"></script>' .
                '<link rel="stylesheet" href="' . base_url() . 'resource/css/thickbox.css" type="text/css" media="screen" />' .
                link_tag('resource/css/screenshot.css') .
                link_tag('resource/js/uploadify/uploadify.css') .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/tiny_mce/jquery.tinymce.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/swfobject.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/baseurl.js"></script>' .
                //'<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/uploadify/jquery.uploadify.v2.1.4.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/js/ui/jquery.ui.tabs.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxmce2.js"></script>' .
                '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxadmin.js"></script>
                  <script>
                   $(document).ready(function() {
                            $("#tabs").tabs();
                          });
                   </script>
                   <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
                    <!--[if lt IE 9]>
                    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                    <![endif]-->
                    ' . $this->setscript($xidmenu);

        $xRowMenu = $this->modelmenu->getDeatilmenu($xidmenu);
        $xShowList = '';
        if (!empty($xRowMenu))
            if ($xRowMenu->tipemenu == '2') {
                $xShowList = $this->getlisttranslete($xAwal, $xSearch, $xidmenu);
            }


        $this->load->model('modelgetmenu');
        $xUser = $this->session->userdata('nama');
        if (!empty($xUser)) {
            //echo $xUser.$this->session->userdata('idpegawai');
            echo $this->modelgetmenu->setviewadmin($xForm, '', $xShowList, $xAddJs, $xidmenu);
            // $this->createformlogin();
        } else {
            $this->createformlogin();
        }
    }

    function setViewAwal($xidmenu) {
        $this->load->model('modelgetmenu');
        $login = $this->session->userdata('login');
        $xUser = $this->session->userdata('nama');
        if (!empty($xUser) && $login != true) {
            //echo $xUser.$this->session->userdata('idpegawai');
            echo $this->modelgetmenu->setviewadmin($this->setawalview(), 'PPDB SMA Reginapacis', '', '', '');
            //     echo $this->modelgetmenu->Setviewbretton($this->setawalview(), '', '', '', '');
            // $this->createformlogin();
        } else {
            $this->createformlogin();
        }

        //echo $this->modelgetmenu->Setviewbretton($this->setawalview(), '', '', '', '');
        //echo $this->modelgetmenu->Setadminbretton($this->setawalview(), '', '', '', '');
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(site_url(), '');
    }

    function createformlogin() {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        //$this->session->sess_destroy();
        $this->load->model('modelgetmenu');
        $this->load->model('modelmenu');

        $xBufResult = '';


        $xForm = '<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>';


        $xForm .= '<div class="form-group"><input class="form-control" type="text" id="edUser" name ="edUser" placeholder="Username"/></div>';
        $xForm .= '<div class="form-group"><input class="form-control" type="password" id="edPassword" name ="edPassword" placeholder="Password"/></div>';
        $xForm .= '<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->';
        $xForm .= form_button('button', 'login', 'onclick="dologin();" class="btn btn-md btn-info btn-block"');
        $xForm .= '</div>
            </div>
        </div>
    </div>
    </fieldset>
                        </form>
                    </div>';
//        $xForm .= setForm('edPassword', 'Password', form_password(getArrayObj('edPassword', '', '100'))) . '<div class="spacer"></div>';
//


        $xAddJs = '<script language="javascript" type="text/javascript" src="' . base_url() . 'resource/ajax/ajaxadmin.js"></script>';

        echo $this->modelgetmenu->setviewadmin('<br />' . $xForm, '', 'login', $xAddJs, '');
    }

    function dologin() {
        $this->load->helper('json');
        $edUser = $_POST['edUser'];
        $edPassword = $_POST['edPassword'];
        $edidlokasi = '0';
        $this->load->model('modelusersistem');

        $rowuser = $this->modelusersistem->getDataLogin($edUser, $edPassword);
        $this->json_data['data'] = false;

        if (!empty($rowuser)) {
            $this->session->set_userdata('user', $rowuser->user);
            $this->session->set_userdata('idpegawai', $rowuser->idx);
            $this->session->set_userdata('nama', $rowuser->Nama);
            $this->session->set_userdata('usergroup', $rowuser->idusergroup);
            $this->session->set_userdata('iddepartemen', '0');
            $this->json_data['data'] = true;
            $this->json_data['location'] = site_url() . "/ctrsettahunajar/";
        }




        echo json_encode($this->json_data);
    }

    function doseacrhfacilities() {
        $this->load->helper('json');
        $awal = $_POST['awal'];
        if ($awal <= 0) {
            $awal = 0;
        }
        $this->load->model('modelgetmenu');
        $this->json_data['data'] = $this->modelgetmenu->getfacilities($awal, 1);
        echo json_encode($this->json_data);
    }

    function setawalview() {
        $this->load->model('modelpendaftaran');
        $this->load->model('modelgelombang');
        $tahun = $this->session->userdata('tahunajar');
        $idgelombang = $this->session->userdata('idgelombang');
        $namagelom = $this->modelgelombang->getDetailgelombang($idgelombang);
        $Total ='';
        $colon = '';
        for($i=1;$i<=12;$i++){
            if ($i>1) $colon = ',';
            $Total .= $colon.$this->modelpendaftaran->getDetailtotal($i)->total;
        }
         $xContentawal= '<div class="viewawal" >
        <div>
        <h3>Pendaftaran PPDB Tahun Ajaran '.$tahun.'/'.($tahun+1).'</h3>
        <canvas id="myChart"></canvas>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
        const ctx = document.getElementById(\'myChart\');
      
        new Chart(ctx, {
          type: \'bar\',
          data: {
            labels: [\'Januari\', \'Februari\', \'Maret\', \'April\', \'Mei\', \'Juni\', \'Juli\', \'Agustus\', \'September\', \'Oktober\', \'November\', \'Desember\'],
            datasets: [{
              label: \'Gel '.$namagelom->gelombang.'\',
              data: ['.$Total.'],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>

             </div>';
        return $xContentawal;
    }

    function getformbymenu($xidMenu) {
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('common');
        $this->load->model('modelmenu');
        $this->load->model('modeltranslete');
        //    $this->load->model('modelimage');
        $row = $this->modelmenu->getDeatilmenu($xidMenu);
        $xRow = $this->modeltranslete->getDeatiltransleteWhere(" Where idmenu = '" . $xidMenu . "'");
        //    $xRowImage = $this->modelimage->getDetailimage($row->idmenu, $row->idkomponen);

        $xidx = '0';
        $xisi = '0';
        $xurut = '1';
        $xJudulItem = '';

        if (!empty($xRow)) {
            $xidx = $xRow->idtranslete;
            //$xisi = str_replace('../../../',base_url(),stripslashes($xRow->isi));
            $xisi = stripslashes($xRow->isi);
            if (empty($xRow->urut)) {
                if (!empty($row->idkomponen))
                    $xurut = $this->modeltranslete->getUrutTranslete($row->idkomponen, $xidMenu);
            }else {
                $xurut = $xRow->urut;
            }
            $xJudulItem = $xRow->judul;
        }


        $xJudul = '';
        if (!empty($row)) {

            $xJudul = $row->nmmenu;


            $xFormAwal = '<div id="stylized" class="myform" ><h1>Isi / Edit ' . $xJudul . '</h1><div class="garis"> </div>';
            $xFormAwal .= '' . form_open_multipart('ctrtranslete/inserttable', array('id' => 'form', 'name' => 'form'));
            $xForm = '<input type="hidden" name="edidtranslete" id="edidtranslete" value="' . $xidx . '" />';
            $xForm .= '<input type="hidden" name="edidmenu" id="edidmenu" value="' . $xidMenu . '" />';
            $xForm .= '<input type="hidden" name="edidkomponen" id="edidkomponen" value="' . $row->idkomponen . '" />';
            if ($row->tipemenu == '2') {
                $xForm .= setForm('edJudul', 'Judul', form_input(getArrayObj('edJudul', $xJudulItem, '300')), 'Isikan Judul Untuk ' . $xJudul) . '<div class="spacer"></div>';
                $xForm .= setForm('edUrut', 'Pengurutan (Bisa Custom)', form_input(getArrayObj('edUrut', $xurut, '100')), 'Saat Ditampilkan akan terurut dari Besar ke Kecil') . '<div class="spacer"></div>';
            } else {
                $xForm .= '<input type="hidden" name="edJudul" id="edJudul" value="" />';
                $xForm .= '<input type="hidden" name="edUrut" id="edUrut" value="" />';
            }
            $xForm .= '<textarea name="content" id="edisi" class="tinymce" rows="20">' . $xisi . '</textarea>';
            //msalah urutan form
            if ($row->jmlgambar > 0) {
                $xBufResult = ' <div id="tabs">
                                 <ul>
                                   <li><a href="#dataumum"><span>Data Detail </span></a></li>
                                   <li><a href="#gambar"><span>Gambar </span></a></li>
                                  </ul>
                                <div id="dataumum">' . $xForm . '</div>
                                <div id="gambar">' . $this->setformupload($xidMenu) . '</div>
                             </div>
                             ';
                $xForm = $xBufResult;
            }
            $xForm = $xFormAwal . $xForm . '<div class="spacer"></div>' . '<div class="garis"></div>' . form_button('btSimpan', 'simpan', 'onclick="dosimpan();"') . form_button('btNew', 'new', 'onclick="             doClear();"') . '<div class="spacer"></div>';
        } else {
            $xForm = '<div id="stylized" class="myform" ><h1>Administrasi Web</h1><div class="garis"> </div>' . form_open_multipart('ctrtranslete/inserttable', array('id' => 'form', 'name' => 'form'));
        }
        return $xForm;
    }

    function getlisttranslete($xAwal, $xSearch, $xIdxMenu) {
        $xLimit = 20;
        $this->load->helper('form');
        $this->load->helper('common');
        $xRowCells = addCell('ID ', 'width:30px;', true) .
                addCell('Judul', 'width:250px;', true) .
                addCell('Isi ', 'width:570px;', true) .
                addCell('Edit/Hapus', 'width:90px;text-align:center;', true);

        $xbufResult = addRow($xRowCells);
        $this->load->model('modeltranslete');
        //Where isi like '%".$xSearch."%'"
        $xWhere = '';
        if (!empty($xSearch)) {
            $xWhere = ' Where (idmenu = ' . $xIdxMenu . ') and (isi like "%' . $xSearch . '%")';
        } else {
            $xWhere = ' Where idmenu = ' . $xIdxMenu . ' ';
        }

        $xQuery = $this->modeltranslete->getListtranslete($xAwal, $xLimit, $xWhere);

        foreach ($xQuery->result() as $row) {
            $xButtonEdit = '<img src="' . base_url() . 'resource/imgbtn/edit.png" alt="Edit Data" onclick = "doedit(\'' . $row->idtranslete . '\');" style="border:none;width:20px"/>';
            $xButtonHapus = '<img src="' . base_url() . 'resource/imgbtn/delete_table.png" alt="Hapus Data" onclick = "dohapus(\'' . $row->idtranslete . '\');" style="border:none;">';

            $xbufResult .= addRow(addCell($row->idtranslete, 'width:30px;') .
                    addCell(substr(strip_tags($row->judul), 0, 60), 'width:250px;') .
                    addCell(substr(strip_tags($row->isi), 0, 150), 'width:570px;') .
                    addCell($xButtonEdit . '&nbsp;/&nbsp;' . $xButtonHapus, 'width:90px;'));

            //$xbufResult .= addRow($xRowCells);
        }
        $xButtonADD = '<img src="' . base_url() . 'resource/imgbtn/document-new.png" onclick = "doClear();" style="border:none;" />';
        $xInput = form_input(getArrayObj('edSearch', '', '310'));
        $xButtonSearch = '<img src="' . base_url() . 'resource/imgbtn/b_view.png" alt="Search Data" onclick = "dosearch(0);" style="border:none;" />';

        $xButtonPrev = '<img src="' . base_url() . 'resource/imgbtn/b_prevpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal - 3) . ');"/>';
        $xButtonNext = '<img src="' . base_url() . 'resource/imgbtn/b_nextpage.png" style="border:none;width:20px;" onclick = "dosearch(' . ($xAwal + 3) . ');" />';

        $xRowCells = addCell($xButtonADD, 'width:30px;', true) .
                addCell($xInput, 'width:223px;border-right:0px;', true) .
                addCell($xButtonSearch, 'width:585px;border-left:0px;border-right:0px;text-align:center;', true) .
                addCell($xButtonPrev, 'width:50px;text-align:center;border-right:0px;border-left:0px;', true) .
                addCell($xButtonNext, 'width:50px;text-align:center;border-left:0px;', true);

        return '<div id="tabledatatranslete" name ="tabledatatranslete" class="tc1" style="width:100%;margin-left :0px;">' . $xbufResult . $xRowCells . '</div>';
    }

    function search() {
        $xAwal = $_POST['xAwal'];
        $xSearch = $_POST['xSearch'];
        $xIdMenu = $_POST['xIdMenu'];

        $this->load->helper('json');
        $this->json_data['tabledata'] = 'OK';

        if (($xAwal + 0) == -99) {
            $xAwal = $this->session->userdata('awal', $xAwal);
        }
        if ($xAwal + 0 <= -1) {
            $xAwal = 0;
            $this->session->set_userdata('awal', $xAwal);
        } else {
            $this->session->set_userdata('awal', $xAwal);
        }

        $this->load->model('modelmenu');
        $this->load->model('modeltranslete');
        $xRowMenu = $this->modelmenu->getDeatilmenu($xIdMenu);
        $this->json_data['tabledata'] = '';
        if (!empty($xRowMenu))
            if ($xRowMenu->tipemenu == '2') {
                $this->json_data['tabledata'] = $this->getlisttranslete($xAwal, $xSearch, $xIdMenu);
            } else {
                $this->json_data['tabledata'] = '';
            }
        echo json_encode($this->json_data);
    }

    function setjsonimage($xidmenu, $xidtranslete) {
        $xbufresult = '';
        //  $this->load->helper('json');
        $this->load->model('modelmenu');
        $this->load->model('modelimage');
        $rowmenu = $this->modelmenu->getDeatilmenu($xidmenu);
        $xbufresult = '';
        $this->json_data['jmlgambar'] = $rowmenu->jmlgambar;
        for ($i = 0; $i < $rowmenu->jmlgambar; $i++) {
            $rowimage = $this->modelimage->getDetailimagetranslete($xidmenu, ($i + 1), $xidtranslete);
            if (!empty($rowimage->imgurl)) {
                $this->json_data['gambar' . ($i + 1)] = $rowimage->imgurl;
            } else {
                $this->json_data['gambar' . ($i + 1)] = 'white.png';
            }
        }
    }

    function editrec() {
        $xIdEdit = $_POST['edidtranslete'];
        $this->load->model('modeltranslete');
        $this->load->model('modelimage');
        $row = $this->modeltranslete->getDeatiltranslete($xIdEdit);
        $this->load->helper('json');
        $this->json_data['idtranslete'] = $row->idtranslete;
        $xArrayBug = array("â", "Å", "&rdquo;", "&ldquo;", "&amp;", "&nbsp;");
        $xisi = str_replace('../../../', base_url(), str_replace($xArrayBug, ' ', stripslashes($row->isi)));
        $this->json_data['isi'] = $xisi;
        $this->json_data['idbahasa'] = $row->idbahasa;
        $this->json_data['idfield'] = $row->idfield;
        $this->json_data['idmenu'] = $row->idmenu;
        $this->json_data['judul'] = $row->judul;
        $this->json_data['idkomponen'] = $row->idkomponen;
        $this->json_data['urut'] = $row->urut;
        $rowimage = $this->modelimage->getDetailimagetranslete($row->idmenu, '1', $row->idtranslete);

        if (empty($row->urut)) {
            $this->json_data['urut'] = $this->modeltranslete->getUrutTranslete($row->idkomponen, $row->idmenu);
        }

        $this->setjsonimage($row->idmenu, $row->idtranslete);
        echo json_encode($this->json_data);
    }

    function getUrutTranslete() {
        $xIdKomponen = $_POST['edidkomponen'];
        $xIdMenu = $_POST['edidmenu'];
        $this->load->model('modeltranslete');
        $this->load->helper('json');
        $this->json_data['urut'] = $this->modeltranslete->getUrutTranslete($xIdKomponen, $xIdMenu);
        echo json_encode($this->json_data);
    }

    function deletetable() {
        $edidtranslete = $_POST['edidtranslete'];
        $this->load->model('modeltranslete');
        $this->modeltranslete->setDeletetranslete($edidtranslete);
    }

    function utf8_urldecode($str) {
        $str = preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str));
        return html_entity_decode($str, null, 'UTF-8');
        ;
    }

    function simpan() {

        //strip_tags($text);
        $this->load->helper('json');
        if (!isset($_POST['edidtranslete'])) {
            $xidtranslete = '0';
        }

        if (!empty($_POST['edidtranslete'])) {
            $xidtranslete = $_POST['edidtranslete'];
        } else {
            $xidtranslete = '0';
        }

        $xisi = $_POST['edisi'];
        $xisi = $this->utf8_urldecode(addslashes($xisi));
        $xidmenu = $_POST['edidmenu'];
        $xJudul = $_POST['edJudul'];
        //$ximgurl = $_POST['edidgambar'];
        $xidbahasa = '1';
        $xidfield = '1';

        $xidkomponen = $_POST['edidkomponen'];
        $xUrut = $_POST['edUrut'];


        $this->load->model('modeltranslete');
        // $this->load->model('modelimage');


        $xRow = $this->modeltranslete->getDeatiltransleteWhere(" Where idmenu = '" . $xidmenu . "'");
        $xidadmin = $this->session->userdata('idpegawai');

        $xShowList = '';
        $this->load->model('modelmenu');
        $xRowMenu = $this->modelmenu->getDeatilmenu($xidmenu);
        if (!empty($xRowMenu))
            if ($xRowMenu->tipemenu == '2') {
                $xRow = $this->modeltranslete->getDeatiltransleteWhere(" Where (idmenu = '" . $xidmenu . "') and (idtranslete='" . $xidtranslete . "')");
            }
        //update  image jika kosong dan idmenu dan iduser

        if (!empty($xRow)) {
            $xStr = $this->modeltranslete->setUpdatetranslete($xRow->idtranslete, $xisi, $xidbahasa, $xidfield, $xidmenu, $xidkomponen, $xJudul, $xUrut);
            //Function setInsertimage($xidimage,$ximgurl,$xidmenu,$xidField,$xidkomponen)
            $this->json_data['edisi'] = $xStr;
        } else {
            $xStr = $this->modeltranslete->setInserttranslete($xidtranslete, $xisi, $xidbahasa, $xidfield, $xidmenu, $xidkomponen, $xJudul, $xUrut, $xidadmin);
            $this->json_data['edisi'] = $xStr;
            $rowlasttranslete = $this->modeltranslete->getLastIndextranslete2($xidadmin, $xidmenu);
            $this->load->model('modelimage');
            $this->modelimage->setUpdateimagefromtranslete($xidmenu, $rowlasttranslete->idtranslete, $xidadmin);
        }

        //    $this->modelimage->setDeleteimage($xidmenu, $xidkomponen);
        //   $this->modelimage->setInsertimage($xRow->idtranslete, $ximgurl, $xidmenu, '0', $xidkomponen);

        $this->json_data['edisi'] = $xStr;
        echo json_encode($this->json_data);
    }

    function simpanimage() {

        //strip_tags($text);
        $this->load->helper('json');
        if (!isset($_POST['edidtranslete'])) {
            $xidtranslete = '0';
        }

        if (!empty($_POST['edidtranslete'])) {
            $xidtranslete = $_POST['edidtranslete'];
        } else {
            $xidtranslete = '0';
        }
        $ximgurl = $_POST['edgambar'];
        $xidmenu = $_POST['edidmenu'];
        $xidximage = $_POST['idxgambar'];
        $xiduser = $this->session->userdata('idpegawai');

        $this->load->model('modelimage');

        $this->modelimage->setInsertimagefromtranslete($ximgurl, $xidmenu, $xiduser, $xidximage, $xidtranslete);
    }

}

?>
