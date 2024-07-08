<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of basemodel
 *
 * @author scriptmedia
 */
if (!defined('BASEPATH'))
    exit('Tidak Diperkenankan mengakses langsung');

use Midtrans\Config;
use Midtrans\Snap;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
class basemodel extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function header($isi = '', $active = 0) {
        $xtanggal = date('Y-m-d'); // Hasil: 20-01-2017 05:32:15

        $this->load->helper('common');
        $this->load->helper('form');
        $this->load->model('modelgelombang');
        $this->load->model('modeltanggalpengumuman');
        $data['pengumuman'] = '';
        if ($this->modeltanggalpengumuman->gettanggalpengumumannow())
            $data['pengumuman'] = TRUE;
        $script['headerscript'] = $isi;
        $data['headscript'] = $this->load->view('scriptmedia/scriptheader', $script, TRUE);
        $data['logo'] = '' . base_url() . 'resource/scriptmedia/logo.png';
        $data['linklogo'] = base_url();
        $data['active' . $active] = 'active';
        $this->load->model('modelmenu');
        $this->load->model('modelsiswa');
        $idsiswa = $this->session->userdata('idsiswa');
        $pendaftaran = $this->modelgelombang->getpendaftaranbuka($xtanggal);
        $pengumuman = $this->modeltanggalpengumuman->gettanggalpengumumannow();
        $nama = '';
        $idgel = '';
        if (!empty($idsiswa)) {
            $datasiswa = $this->modelsiswa->getDetailsiswa($idsiswa);
            $nama = $datasiswa->namalenkap;
            $idgel = $datasiswa->idgelombang;
        }


        $data['menu'] = $this->menu(TRUE);
        $data['nama'] = $nama;
        $data['gelombang'] = $idgel;
        $data['pendaftaran'] = ($pendaftaran) ? True : false;
        $data['pengumuman'] = ($pengumuman) ? True : false;

        return $this->load->view('scriptmedia/header', $data, true);
    }

    public function footer($isi = '') {
        $script['footerscript'] = "
            <script>
            </script>" . $isi;
        $data['script_foot'] = $this->load->view('scriptmedia/scriptfooter', $script, TRUE);
        $data['copyright'] = '<center><label class="fontKaki"><h4>@ Copyright 2017 SCRIPTMEDIA - All right reserved</h4></label></center>';
        return $this->load->view('scriptmedia/footer', $data, true);
    }

    function GetChild($xQuery, $komponen) {
        $this->load->model('modelmenu');
        $data = NULL;
        if (!empty($xQuery)) {

            foreach ($xQuery->result() as $row) {

                $xRowUrl = $row->urlci;

                if (empty($xRowUrl)) {
                    $xRowUrl = 'ctrcontent/index/' . $row->idmenu;
                }

                $xChild = $this->GetChild($this->modelmenu->getlistmenubyparent($row->idmenu, $komponen), $komponen);

                if ($komponen == 1)
                    $data[] = array(
                        'namamenu' => $row->nmmenu, //setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                        'urlmenu' => site_url($xRowUrl), //setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                        'childmenu' => $xChild, //setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                    );
            }

//            if (!empty($xBufResult))
//                $xBufResult = setul('', $xBufResult);
        }

        return $data;
    }

    function menu($xIsView = false) {
        //$xBufResult = "";
        $this->load->helper('menu');
        $this->load->helper('url');
        $this->load->model('modelmenu');
        if ($xIsView == true)
            $komponen = 1;
        else
            $komponen = 2;
        $xQuery = $this->modelmenu->getlistmenubyparent("0", $komponen);
        //print_r($xQuery);
        $data = NULL;
        foreach ($xQuery->result() as $row) {
            $xRowUrl = $row->urlci;
            //if ($row->iduser == '0') {
            if (empty($xRowUrl)) {

                $xRowUrl = '#';
            }
            // }
            $xChild = $this->GetChild($this->modelmenu->getlistmenubyparent($row->idmenu, $komponen), $komponen);
            if ($komponen == 1) {

                $data['menu'][] = array(
                    'namamenu' => $row->nmmenu, //setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                    'urlmenu' => site_url($xRowUrl), //setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                    'childmenu' => $xChild, //setli(site_url($xRowUrl), $row->nmmenu, $xChild);
                );
            }
        }
//        if (!empty($xBufResult))
//        $xBufResult = setul('', $xBufResult);
        return $this->load->view('scriptmedia/mainmenu', $data, true);
    }

    function pagination($xAwal, $queryjum, $perpage = 0, $ajax_onclick = '', $search = '') {
        $this->load->library('pagination');
        if (($xAwal + 0) == -99) {
            $xAwal = $this->session->userdata('awal', $xAwal);
        }
        if ($xAwal + 0 <= -1) {
            $xAwal = 0;
            $this->session->set_userdata('awal', $xAwal);
        } else {
            $this->session->set_userdata('awal', $xAwal);
        }
        $config = array();
        $config["base_url"] = '#';
        $config["awal"] = $this->session->userdata('awal');
        $total_row = $queryjum;
        $config["total_rows"] = $total_row;
        $config["first_link"] = TRUE;
        $config["per_page"] = $perpage;
//        $config['first_url'] = '1';
        $config['use_page_numbers'] = TRUE;
//        $config['uri_segment'] = $uri_segment;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '';
        $config['cur_tag_close'] = '';
        $config['next_link'] = '';
//        $xsearchmulai = $awal+$perpage;
        $config['anchor_class'] = ' class="btn" ';
        $config['prev_link'] = '';
        $config['ajax_onclick'] = $ajax_onclick;
        $config['search'] = $search;

        $this->pagination->initialize($config);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);

// View data according to array.
        return $this->load->view("scriptmedia/pagination_view", $data, TRUE);
    }

    function modulelist($args = array()) {
//        if (empty($args['table']))
//            exit();
//        $this->load->model('model' . $args['table']);
//        $model = 'model' . $args['table'];
//        $list = 'getList' . $args['table'];
        $this->load->model('modelcontent');
        $model = 'modelcontent';
        $list = 'getListcontent';
        $xawal = (isset($args['xawal'])) ? $args['xawal'] : 0;
        $xlimit = (isset($args['xlimit'])) ? $args['xlimit'] : 5;
        $xsearch = (isset($args['xsearch'])) ? $args['xsearch'] : '';
        $xidkategori = (isset($args['idkategori'])) ? $args['idkategori'] : '';
        $urldetail = (isset($args['ctrdetail'])) ? $args['ctrdetail'] : '';
        $query = $this->$model->$list($xawal, $xlimit, $xsearch, $xidkategori);
        $queryjum = $this->$model->$list($xawal, 100000, $xsearch, $xidkategori);
        $data['modules'] = $query;
        $data['index'] = (isset($args['index'])) ? $args['index'] : '';
        //explode $fielddetail
        $showfield = null;
        if (isset($args['fieldsshow'])) {
            for ($i = 0; $i < count($args['fieldsshow']); $i++) {
                $showfield[] = $args['fieldsshow'][$i] . '/';
            }
            $fieldshow = (!empty($showfield)) ? implode('', $showfield) : '';
            $data['fieldshow'] = $fieldshow;
        } else {
            $data['fieldshow'] = '';
        }
        $data['href'] = base_url() . $urldetail;
        if (isset($args['fields'])) {
            if (count($args['fields']) == 1) {
                $data['fieldmuncul'] = array($args['fields']);
            } else {
                $data['fieldmuncul'] = $args['fields'];
            }
        } else {
            $data['fieldmuncul'] = '';
        }
        if (isset($args['pagination'])) {
            if ($args['pagination'] == TRUE) {
                $urlpaging = (!empty($args['paginationurl'])) ? $args['paginationurl'] : base_url('index.php/ctrview');
                $data['pagination'] = $this->pagination($urlpaging, $queryjum->num_rows, $args['xlimit']);
            } else {
                $data['pagination'] = '';
            }
        } else {
            $data['pagination'] = '';
        }
        if (isset($args['theme'])) {
            $theme = $args['theme'];
        } else {
            $theme = "scriptmedia/module";
        }
        if (isset($args['sidebartitle'])) {
            $data['sidebartitle'] = $args['sidebartitle'];
        } else {
            $data['sidebartitle'] = "";
        }
        foreach ($query->result() as $row) {
            $thumb1 = explode('.', $this->showimage($row->image1, 'thumb'));
            $thumb2 = explode('.', $this->showimage($row->image2, 'thumb'));
            $thumb3 = explode('.', $this->showimage($row->image3, 'thumb'));
            $small1 = explode('.', $this->showimage($row->image1, 'small'));
            $small2 = explode('.', $this->showimage($row->image2, 'small'));
            $small3 = explode('.', $this->showimage($row->image3, 'small'));
            $data['thumbimage1'][] = $thumb1[0] . '.' . $thumb1[1];
            $data['thumbimage2'][] = $thumb2[0] . '.' . $thumb2[1];
            $data['thumbimage3'][] = $thumb3[0] . '.' . $thumb3[1];
            $data['small1'][] = $small1[0] . '.' . $small1[1];
            $data['small2'][] = $small2[0] . '.' . $small2[1];
            $data['small3'][] = $small3[0] . '.' . $small3[1];
        }
        return $this->load->view($theme, $data, TRUE);
    }

    function moduledetail($id = '', $model = '', $theme = '') {
        if (empty($model))
            $model = 'modelcontent';
        if (empty($theme))
            $theme = 'moduledetail';
        $this->load->model($model);
        $table = substr($model, '5');
        $detailtable = 'getDetail' . $table;
        $row = $this->$model->$detailtable($id);
        $fields = null;
        for ($n = 4; $n <= $this->uri->total_segments(); $n++) {
            $fields[] = $this->uri->segments[$n];
        }
        if ($fields == NULL) {
            foreach ($this->db->list_fields($table) as $field) {
                $fields[] = $field;
            }
        }
        $data['fields'] = $fields;
        $data['row'] = $row;
        $this->load->model('basemodel');
        $data['image1'] = $this->showimage(@$row->image1);
        $data['image2'] = $this->showimage(@$row->image2);
        $data['image3'] = $this->showimage(@$row->image3);

        //$data['footer'] = $this->basemodel->footer();
        return $this->load->view('scriptmedia/' . $theme, $data, TRUE);
    }

    public function imageresize($width, $height, $source) {
        if ($source != NULL) {
            $this->load->library('image_lib');
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'resource/uploaded/img/' . $source;
            $config['dest_image'] = base_url('resource/uploaded/img/') . $source;
            $config['height'] = $height;
            $config['width'] = $width;
            $config['quality'] = '100%';
            $config['maintain_ratio'] = TRUE;
            $config['create_thumb'] = TRUE;
            $this->image_lib->clear();
//$this->load->library('image_lib');
            //$this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors() . base_url() . $config['source_image'];
            }
            $axfilegambar = explode('.', $source);
            $ext = end($axfilegambar);
            /*
             * Pindah dir
             */
            copy('resource/uploaded/img/' . $axfilegambar[0] . '_thumb.' . $ext, 'resource/uploaded/img/thumb/' . $axfilegambar[0] . '_thumb.' . $ext);
            // Menghapus file thumb di dir awal
            unlink('resource/uploaded/img/' . $axfilegambar[0] . '_thumb.' . $ext);
//            move_uploaded_file($source, base_url('resource/uploaded/img/thumb/'));
//            //$this->image_lib->clear();
//            if (!empty($source)) {
//                $axfilegambar = explode('.', $source);
//                if (count($axfilegambar) > 2) {
//                    $file = '';
//                    $fileaslithumb = '';
//                    $jumlahtitik = count($axfilegambar) - 1;
//                    for ($i = 0; $i < $jumlahtitik; $i++) {
//                        $file .= $axfilegambar[$i];
//                        $fileaslithumb .= $axfilegambar[$i] . '_thumb.' . $axfilegambar[$jumlahtitik];
//                    }
//                    $filebaru = $file . '.' . $axfilegambar[$jumlahtitik];
//                    $thumbbaru = @str_replace('.', '', $file) . '_' . $width . 'x' . $height . '_thumb' . $axfilegambar[$jumlahtitik];
////                    $rename = @rename('resource/uploaded/img/' . $source, 'resource/uploaded/img/' . $filebaru);
////                    $rename = @rename('resource/uploaded/img/' . $fileaslithumb, 'resource/uploaded/img/' . $thumbbaru);
//                    $axfilegambar = explode('.', $filebaru);
////                var_dump($axfilegambar);
//                } else {
//                    $filegambar = str_replace('.', '', $axfilegambar[0]) . '_' . $width . 'x' . $height . '_thumb.' . $axfilegambar[1];
//                    $source = @rename('resource/uploaded/img/' . $axfilegambar[0] . '_thumb.' . $axfilegambar[1], 'resource/uploaded/img/' . $filegambar);
////            echo $filegambar;
////            $this->imagecrop($width, $height, $source);
//                }
//            }
        }
        return null;
    }

    public function imagecrop($width, $height, $source) {
        if ($source != NULL) {
            $size = getimagesize('resource/uploaded/img/' . $source);
            $w_orig = $size[0];
            $h_orig = $size[1];
            $w_thumb = $width;
            $h_thumb = ($width / $w_orig ) * $h_orig;
            //var_dump($h_thumb);
            $y_thumb = 0;
            $x_thumb = 0;
            //  var_dump($height.' - '.$h_orig);
            if ($h_orig < $height) {

//                $h_thumb = $height;
                //$y_thumb = ($height-$h_orig) / 2;
                $y_thumb = ($h_thumb - $height) / 4;
                $w_thumb = ($height / $h_orig) * $w_orig;
                $x_thumb = ($w_thumb - $width) / 4;
                //var_dump($y_thumb.' - '.$x_thumb);
            }
            $this->load->library('image_lib');
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'resource/uploaded/img/' . $source;
            $config['dest_image'] = base_url('resource/uploaded/img/') . $source;
            $config['height'] = $height;
            $config['width'] = $width;
            $config['y_axis'] = $y_thumb;
            $config['x_axis'] = $x_thumb;
            $config['quality'] = '100%';
            $config['maintain_ratio'] = FALSE;
            $config['create_thumb'] = TRUE;
            $this->image_lib->clear();
            //$this->load->library('image_lib');
            //$this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->crop();

            if (!$this->image_lib->crop()) {
                echo $this->image_lib->display_errors() . base_url() . $config['source_image'];
            }

            //$this->image_lib->clear();
            $axfilegambar = explode('.', $source);
            //echo count($axfilegambar);
            $filegambar = $axfilegambar[0] . '_' . $width . 'x' . $height . '_thumb.' . $axfilegambar[1];
            $source = rename('resource/uploaded/img/' . $axfilegambar[0] . '_thumb.' . $axfilegambar[1], 'resource/uploaded/img/' . $axfilegambar[0] . '_' . $width . 'x' . $height . '_thumb.' . $axfilegambar[1]);
            //     $this->imagecrop($width, $height, $config['source_image']);
        }
        return $filegambar;
    }

    public function imagecropthumb($width, $height, $source) {
        $filegambar = '';
        if ($source != NULL) {
            $size = getimagesize('resource/uploaded/img/' . $source);
            $w_orig = $size[0];
            $h_orig = $size[1];
            $w_thumb = $width;
            $h_thumb = ($width / $w_orig ) * $h_orig;
            //var_dump($h_thumb);
            $y_thumb = 0;
            $x_thumb = 0;
            //  var_dump($height.' - '.$h_orig);
            if ($h_orig < $height) {

//                $h_thumb = $height;
                //$y_thumb = ($height-$h_orig) / 2;
                $y_thumb = ($height - $h_orig) / 2;
                $w_thumb = ($height / $h_orig) * $w_orig;
                //$x_thumb = ($w_thumb - $width) / 4;
                //var_dump($y_thumb.' - '.$x_thumb);
            } else {
                $y_thumb = ($h_orig - $height) / 2;
                $x_thumb = ($w_orig - $width) / 2;
            }
            $this->load->library('image_lib');
            $this->image_lib->clear();
//            $source= $this->imageresize($width, $height, $source);
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'resource/uploaded/img/' . $source;
            $config['dest_image'] = base_url('resource/uploaded/img/') . $source;
            $config['height'] = $height;
            $config['width'] = $width;
            $config['y_axis'] = $y_thumb;
            $config['x_axis'] = $x_thumb;
            $config['quality'] = '100%';
            $config['maintain_ratio'] = FALSE;
            $config['create_thumb'] = TRUE;

            //$this->load->library('image_lib');
            //$this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->crop();

            if (!$this->image_lib->crop()) {
                echo $this->image_lib->display_errors() . base_url() . $config['source_image'];
            }

            //$this->image_lib->clear();
            $axfilegambar = explode('.', $source);
            $file = substr($axfilegambar[0], 0, -14);
            $filegambar = $file . '_' . $width . 'x' . $height . '_thumb.' . $axfilegambar[1];
//           rename('resource/uploaded/img/' . $axfilegambar[0].'_thumb.'.$axfilegambar[1], 'resource/uploaded/img/' . $filegambar);
            //     $this->imagecrop($width, $height, $config['source_image']);
        }
        return $filegambar;
    }

    function imagesize($source = '', $extimage = '') {
        $size = getimagesize('resource/uploaded/img/' . $source);
        $w_orig = $size[0];
        $h_orig = $size[1];
        $thumb = $this->imageresize(300, 300, $source);

//
//        if ($extimage == 'thumb') {
//            $this->imagecrop(150, 150, $source);
//        }
        if ($extimage == 'small') {
            $this->imageresize(250, 250, $source);
        }
        if ($extimage == 'medium') {
            $this->imageresize(350, 350, $source);
        }
        if ($extimage == 'high') {
            $this->imageresize(650, 350, $source);
        }
        if ($extimage == 'large') {
            $this->imageresize(800, 600, $source);
        }
        if ($extimage == 'slide') {
            $this->imageresize(650, 250, $source);
        }
        if ($extimage == 'galeri') {
            $this->imageresize(215, 215, $source);
        }
        if ($h_orig < 150) {
            $this->imagecrop(150, 150, $source);
        } else {
            $this->imagecropthumb(150, 150, $thumb);
        }
        return $source;
    }

    function showimage($source, $extimage = '') {
        $axfilegambar = explode('.', $source);
        @$filegambar = $axfilegambar[0] . '.' . $axfilegambar[1];
        if ($extimage == 'thumb') {
            @$filegambar = $axfilegambar[0] . '_150x150_thumb.' . $axfilegambar[1];
        }
        if ($extimage == 'small') {
            @$filegambar = $axfilegambar[0] . '_250x250_thumb.' . $axfilegambar[1];
        }
        if ($extimage == 'medium') {
            @$filegambar = $axfilegambar[0] . '_350x350_thumb.' . $axfilegambar[1];
        }
        if ($extimage == 'high') {
            @$filegambar = $axfilegambar[0] . '_650x350_thumb.' . $axfilegambar[1];
        }
        if ($extimage == 'large') {
            @$filegambar = $axfilegambar[0] . '_800x600_thumb.' . $axfilegambar[1];
        }
        if ($extimage == 'slide') {
            @$filegambar = $axfilegambar[0] . '_650x250_thumb.' . $axfilegambar[1];
        }
        if ($extimage == 'galeri') {
            @$filegambar = $axfilegambar[0] . '_215x215_thumb.' . $axfilegambar[1];
        }
        $image = $filegambar;

        return $image;
    }

    function delimage($source) {
        $file = explode('.', $source);
        $path = array();
        $path[] = FCPATH . 'resource\uploaded\img\\' . $file[0] . '_300x300_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_250x250_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_350x350_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_650x350_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_800x600_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_650x250_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_215x215_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $file[0] . '_150x150_thumb.' . $file[1];
        $path[] = FCPATH . 'resource/uploaded/img\\' . $source;

        foreach ($path as $del) {
            @unlink($del);
        }
        //if(unlink($path))
        return TRUE;
    }

    function sendmail($xemail, $subject, $mailContent, $path = '', $file_name = '', $type = '') {
        
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'mail.smareginapacis-solo.sch.id';
        $mail->SMTPAuth = true;
        $mail->Username = 'ppdb@smareginapacis-solo.sch.id';
        $mail->Password = 'QF[bgpd35wrJ';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('adminsma@ppdbreginapacissolo.org', 'Panitia PPDB SMA Regina Pacis Solo');
        $mail->addReplyTo('adminsma@ppdbreginapacissolo.org', 'Panitia PPDB SMA Regina Pacis Solo');

        // Add a recipient
        $mail->addAddress($xemail);

        // Add cc or bcc
        //$mail->addCC('adminsma@ppdbreginapacissolo.org');
        $mail->addBCC('adminsma@ppdbreginapacissolo.org');

        // Email subject
        $mail->Subject = $subject;
        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Body = $mailContent;
        if ($path != '') {
           $mail->addStringAttachment(file_get_contents($path . $file_name . '.pdf'), $file_name . $type);
        }
        // Send email
        if (!$mail->send()) {
//            return 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
            die();
        } else {
            return true;
        }
    }

    function newsendmail($xemail, $subject, $mailContent, $path = '', $file_name = '', $type = '') {
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'kalkulator.scriptmedia.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-repaly@kalkulator.scriptmedia.net';
        $mail->Password = 'y^i8J74)C=L@';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('no-repaly@kalkulator.scriptmedia.net', 'Kalkulator Upah SINDIKASI');
        $mail->addReplyTo('no-repaly@kalkulator.scriptmedia.net', 'Kalkulator Upah SINDIKASI');

        // Add a recipient
        $mail->addAddress($xemail);

        // Add cc or bcc
        //$mail->addCC('adminsma@ppdbreginapacissolo.org');
        // $mail->addBCC('adminsma@ppdbreginapacissolo.org');

        // Email subject
        $mail->Subject = $subject;
        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Body = $mailContent;
        if ($path != '') {
            $mail->addStringAttachment(file_get_contents($path . $file_name . '.pdf'), $file_name . $type);
        }
        // Send email
        if (!$mail->send()) {
//            return 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
            die();
        } else {
            return true;
        }
    }
function APImidtranstoken($param){

    $config = new Config;   
    $snap = new Snap;   
    
    $transaction = array(
        'transaction_details' =>  is_array($param[0])?$param[0]:array(),
        'item_details' =>  is_array($param[1])?$param[1]:array(),
        'customer_details' => is_array($param[2])?$param[2]:array(),
    );
    // var_dump($transaction);
    $snap_token = '';
    try {
        $snap_token = Snap::getSnapToken($transaction);
    }
    catch (\Exception $e) {
        echo $e->getMessage();
    }
        
    return $snap_token; 
}

function notificationhandler(){    
    try {
        $notif = new \Midtrans\Notification();
    }
    catch (\Exception $e) {
        exit($e->getMessage());
    }
    return $notif->getResponse(); 
}

function cekmidtransbayar($xidsiswa){
    // header('Accept: application/json');
    // header('Content-Type: application/json');
    // header('Authorization: Basic TWlkLXNlcnZlci0xb19EN0JMU0NzMkhBcm5DS3pHdERqNks6');
     $this->load->helper('json');
        $this->load->helper('form');
        $this->load->helper('common');
        $this->load->model('modelverifikasipembayaran');
        $this->load->model('modelitembayar');
        $this->load->model('basemodel');
        $this->load->model('modelsiswa');
         $status ='';
        $itembayar = $this->modelverifikasipembayaran->getDetailverifikasipembayaranbyitembayar($xidsiswa,1);
        if ($itembayar){
            $xidorder = $itembayar->kodependaftaran;
            // $status = get_curl('https://api.midtrans.com/v2/'. $xidorder.'/status');
            $ch = curl_init();
             $target_url = 'https://api.midtrans.com/v2/'. $xidorder.'/status';
            
             curl_setopt_array($ch, array(
               CURLOPT_URL => $target_url,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "GET",
               CURLOPT_POSTFIELDS =>"\n\n",
               CURLOPT_HTTPHEADER => array(
                 "Accept: application/json",
                 "Content-Type: application/json",
                 "Authorization: Basic TWlkLXNlcnZlci0xb19EN0JMU0NzMkhBcm5DS3pHdERqNks6"
               ),
             ));
             
             $status = curl_exec($ch);
             
             
          
           curl_close($ch);
         
        }
         return $status;
}
}

?>
