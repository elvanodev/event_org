<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//class common extends helpers {
//      function common(){
//       parent::helpers();
//      }
//
//function datetomysql($xtgl) {
//    $array = explode('-', $xtgl);
//    return $array[2] . '-' . $array[1] . '-' . $array[0];
//}

function datetomysql($xtgl) {
    if (!empty($xtgl)) {
        $array = explode('-', $xtgl);
        if (!empty($array[2])) {
            return $array[2] . '-' . $array[1] . '-' . $array[0];
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function mysqltodate($xtgl) {
    $array = explode('-', $xtgl);
    return $array[2] . '-' . $array[1] . '-' . $array[0];
}

function getArrayObj($xNamaObject, $xValue, $xWidth, $rows = 0, $cols = 0) {
    $data = array(
        'name' => $xNamaObject,
        'id' => $xNamaObject,
        'value' => $xValue,
        'style' => 'width:' . $xWidth . 'px;',
        'rows' => $rows,
        'cols' => $cols
    );

    return $data;
}

function getArrayObjv2($xNamaObject, $xValue, $xWidth, $rows = 0, $cols = 0) {
    $data = array(
        'name' => $xNamaObject,
        'id' => $xNamaObject,
        'value' => $xValue,
        'style' => 'width:' . $xWidth . '%;',
        'rows' => $rows,
        'cols' => $cols
    );

    return $data;
}

function getArrayObjCheckBox($xNamaObject, $xValue, $ischecked, $xWidth, $rows = 0, $cols = 0) {
    $data = array(
        'name' => $xNamaObject,
        'id' => $xNamaObject,
        'value' => $xValue,
        'class' => 'chk form-check-input',
        'style' => 'width:' . $xWidth . 'px;margin:5px;',
        'checked' => set_checkbox($xNamaObject, $xValue, $ischecked)
    );

    return $data;
}

function getArrayBulan() {
    $xBuffResul['01'] = 'Januari';
    $xBuffResul['02'] = 'Februari';
    $xBuffResul['03'] = 'Maret';
    $xBuffResul['04'] = 'April';
    $xBuffResul['05'] = 'Mei';
    $xBuffResul['06'] = 'Juni';
    $xBuffResul['07'] = 'Juli';
    $xBuffResul['08'] = 'Agustus';
    $xBuffResul['09'] = 'September';
    $xBuffResul['10'] = 'Oktober';
    $xBuffResul['11'] = 'November';
    $xBuffResul['12'] = 'Desember';
    return $xBuffResul;
}

function getArrayHari() {
    $xBuffResul['1'] = 'Minggu';
    $xBuffResul['2'] = 'Senin';
    $xBuffResul['3'] = 'Selasa';
    $xBuffResul['4'] = 'Rabu';
    $xBuffResul['5'] = 'Kamis';
    $xBuffResul['6'] = 'Jumat';
    $xBuffResul['7'] = 'Sabtu';

    return $xBuffResul;
}

function getkeputusan() {
    $xBuffResul['0'] = '-';
    $xBuffResul['Y'] = 'DITERIMA';
    $xBuffResul['N'] = 'GAGAL';
    return $xBuffResul;
}

function getjenistagihan() {
    $xBuffResul['0'] = '-';
    $xBuffResul['1'] = 'Semua Siswa';
    $xBuffResul['2'] = 'Perkelas';
    $xBuffResul['3'] = 'Persiswa';
    $xBuffResul['4'] = 'Semua Calon Siswa';
    $xBuffResul['5'] = 'Per Calon Siswa';
    return $xBuffResul;
}

function getArrayYaTidak() {
    $xBuffResul[''] = '-';
    $xBuffResul['N'] = 'TIDAK';
    $xBuffResul['Y'] = 'YA';
    return $xBuffResul;
}

function getArrayYaTidaktinggalkelas() {
    $xBuffResul[''] = '-';
    $xBuffResul['N'] = 'TIDAK';
    $xBuffResul['Y'] = 'YA';
    return $xBuffResul;
}

function getArraygender() {
    $xBuffResul[''] = '-';
    $xBuffResul['L'] = 'Laki-laki';
    $xBuffResul['P'] = 'Perempuan';
    return $xBuffResul;
}

function getArrayortu() {
    $xBuffResul[''] = '-';
    $xBuffResul['A'] = 'Ayah';
    $xBuffResul['I'] = 'Ibu';
    return $xBuffResul;
}

function getArrayblood() {
    $xBuffResul[''] = '-';
    $xBuffResul['A'] = 'A';
    $xBuffResul['B'] = 'B';
    $xBuffResul['AB'] = 'AB';
    $xBuffResul['O'] = 'O';
    return $xBuffResul;
}

function getArrayreligion() {
    $xBuffResul[''] = '-';
    $xBuffResul['Islam'] = 'Islam';
    $xBuffResul['Kristen'] = 'Kristen';
    $xBuffResul['Katholik'] = 'Katholik';
    $xBuffResul['Hindu'] = 'Hindu';
    $xBuffResul['Budha'] = 'Budha';
    $xBuffResul['Konghucu'] = 'Konghucu';
    return $xBuffResul;
}

function getArraywn() {
    $xBuffResul['WNI'] = 'WNI';
    $xBuffResul['WNA'] = 'WNA';
    return $xBuffResul;
}

function getArrayanakke() {
    $xBuffResul[''] = '-';
    $xBuffResul['1'] = '1';
    $xBuffResul['2'] = '2';
    $xBuffResul['3'] = '3';
    $xBuffResul['4'] = '4';
    $xBuffResul['5'] = '5';
    $xBuffResul['6'] = '6';
    $xBuffResul['7'] = '7';
    $xBuffResul['8'] = '8';
    $xBuffResul['9'] = '9';
    $xBuffResul['10'] = '10';
    return $xBuffResul;
}

function getArrayjumsdr() {
    $xBuffResul[''] = '-';
    $xBuffResul['1'] = '1';
    $xBuffResul['2'] = '2';
    $xBuffResul['3'] = '3';
    $xBuffResul['4'] = '4';
    $xBuffResul['5'] = '5';
    $xBuffResul['6'] = '6';
    $xBuffResul['7'] = '7';
    $xBuffResul['8'] = '8';
    $xBuffResul['9'] = '9';
    $xBuffResul['10'] = '10';
    return $xBuffResul;
}

function getArraysttsanak() {
    $xBuffResul[''] = '-';
    $xBuffResul['Kandung'] = 'Kandung';
    $xBuffResul['Yatim'] = 'Yatim';
    $xBuffResul['Piatu'] = 'Piatu';
    $xBuffResul['Yatim Piatu'] = 'Yatim Piatu';
    return $xBuffResul;
}

function getArrayschool() {
    $xBuffResul[''] = '-';
    $xBuffResul['SD'] = 'SD';
    $xBuffResul['SMP'] = 'SMP';
    $xBuffResul['SMA'] = 'SMA';
    $xBuffResul['D1 - D2'] = 'D1 - D2';
    $xBuffResul['D3'] = 'D3';
    $xBuffResul['S1'] = 'S1';
    $xBuffResul['S2'] = 'S2';
    $xBuffResul['S3'] = 'S3';
    $xBuffResul['Lain-lain'] = 'Lain-lain';
    return $xBuffResul;
}

function getArrayjob() {
    $xBuffResul[''] = '-';
    $xBuffResul['Wiraswasta'] = 'Wiraswasta';
    $xBuffResul['Karyawan Swasta'] = 'Karyawan Swasta';
    $xBuffResul['PNS'] = 'PNS';
    $xBuffResul['TNI'] = 'TNI';
    $xBuffResul['POLRI'] = 'POLRI';
    $xBuffResul['Lain-lain'] = 'Lain-lain';
    return $xBuffResul;
}

function getArraypenghasilan() {
    $xBuffResul[''] = '-';
    $xBuffResul['< 1,5 jt'] = '< 1,5 jt';
    $xBuffResul['1,5 - 3 jt'] = '1,5 - 3 jt';
    $xBuffResul['3,1 - 5 jt'] = '3,1 - 5 jt';
    $xBuffResul['5,1 - 10 jt'] = '5,1 - 10 jt';
    $xBuffResul['10,1 - 15 jt'] = '10,1 - 15 jt';
    $xBuffResul['15,1 - 20 jt'] = '15,1 - 20 jt';
    $xBuffResul['> 20 jt'] = '> 20 jt';
    return $xBuffResul;
}

function getArraystatusortu() {
    $xBuffResul[''] = '-';
    $xBuffResul['Kandung'] = 'Kandung';
    $xBuffResul['Tiri'] = 'Tiri';
    $xBuffResul['Angkat'] = 'Angkat';
    return $xBuffResul;
}

function getArrayhubwali() {
    $xBuffResul[''] = '-';
    $xBuffResul['Kakek'] = 'Kakek';
    $xBuffResul['Nenek'] = 'Nenek';
    $xBuffResul['Paman'] = 'Paman';
    $xBuffResul['Bibi'] = 'Bibi';
    $xBuffResul['Om'] = 'Om';
    $xBuffResul['Tante'] = 'Tante';
    $xBuffResul['Lain-lain'] = 'Lain-lain';
    return $xBuffResul;
}

function getArraystatusnikah() {
    $xBuffResul[''] = '-';
    $xBuffResul['Nikah'] = 'Nikah';
    $xBuffResul['Belum Nikah'] = 'Belum Nikah';
    $xBuffResul['Duda'] = 'Duda';
    $xBuffResul['Janda'] = 'Janda';
    return $xBuffResul;
}

function getArrayperkawinan() {
    $xBuffResul['Tidak Cerai'] = 'Tidak Cerai';
    $xBuffResul['Cerai'] = 'Cerai';
    return $xBuffResul;
}

function getArraystatus() {
    $xBuffResul['Hidup'] = 'Hidup';
    $xBuffResul['Meninggal'] = 'Meninggal';
    return $xBuffResul;
}

function getArrayjarakkessma() {
    $xBuffResul[''] = '-';
    $xBuffResul['1 - 3 Km'] = '1 - 3 Km';
    $xBuffResul['4 - 6 Km'] = '4 - 6 Km';
    $xBuffResul['7 - 9 Km'] = '7 - 9 Km';
    $xBuffResul['10 - 15 Km'] = '10 - 15 Km';
    $xBuffResul['16 - 20 Km'] = '16 - 20 Km';
    $xBuffResul['> 20 Km'] = '> 20 Km';
    return $xBuffResul;
}

function SetTglToIndo($xTgl) {
    $xArray = explode('-', $xTgl);
    $xTahun = $xArray[0];
    $xBulan = $xArray[1];
    $xHari = $xArray[2];
    $xArrBulan = getArrayBulan();

    return $xHari . '&nbsp;' . $xArrBulan[$xBulan] . '&nbsp;' . $xTahun;
}

function setForm($xName, $xCaption, $xForm, $xAtrib = '', $class = '') {
    if (!empty($xCaption)) {
        $label = '<label class="hidden-xs" for="' . $xName . '">' . $xCaption . '<span class="small text-muted blockquote-footer" style="display:block;white-space:normal"><cite>' . $xAtrib . '</cite></span>' . '</label> ';
    } else
        $label = $xName;
    $xBufResult = '<div ' . $class . ' class="form-group input-group " >  ' . $label . $xForm . '</div>';
    return $xBufResult;
}

function setFormfrontend($xName, $xCaption, $xForm, $xAtrib = '', $class = '', $xket = '') {
    if (!empty($xCaption)) {
        $label = '<label class="col-sm-4 col-form-label" for="' . $xName . '">' . $xCaption . ' <br><i><small>' . $xAtrib . '</small></i>' . $xket . '</label>';
    } else
        $label = $xName;
    $xBufResult = '<div ' . $class . 'class="form-group row">' . $label . '<div class="col-sm-8">' . $xForm . '</div></div>';
    return $xBufResult;
}

function setForm2($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<div ' . $xAtrib . '><label class="col-md-2" for="' . $xName . '">' . $xCaption . '</label> ' . $xForm . '</div>';
    return $xBufResult;
}

function setFormNF($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<dl> <dt> <label for="' . $xName . '">' . $xCaption . '</label></dt> <dd>' . $xForm . '</dd> </dl> ';
    return $xBufResult;
}

function setNFRadio($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = $xForm . ' <label for="' . $xName . '" class ="opt">' . $xCaption . '</label>  ';
    return $xBufResult;
}

function setFormNFRadio($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<dl> <dt> <label for="' . $xName . '" >' . $xCaption . '</label></dt>  <dd> ' . $xForm . '</dd></dl> ';
    return $xBufResult;
}

function setFormNoP($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<label for="' . $xName . '">' . $xCaption . '<span class="small">' . $xAtrib . '</span>' . '</label> ' . $xForm . '';
    return $xBufResult;
}

function setFormChechList($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<p>' . $xForm . '<div id=check> <label for="' . $xName . '">' . $xCaption . '<span class="small">' . $xAtrib . '</span>' . '</label></div> </p>';
    return $xBufResult;
}

function setFormChechList2($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<p style="margin-left:145px;">' . $xForm . '<div id=check> <label for="' . $xName . '" >' . $xCaption . '<span class="small">' . $xAtrib . '</span>' . '</label></div> </p>';
    return $xBufResult;
}

function setFormChechList3($xName, $xCaption, $xForm, $xAtrib = '') {
    $xBufResult = '<p>' . $xForm . '<div id=check> <label for="' . $xName . '" style="width:390px;">' . $xCaption . '<span class="small">' . $xAtrib . '</span>' . '</label></div> </p>';
    return $xBufResult;
}

/* helper input modification */

function form_input_($data = '', $value = '', $extra = '') {
    $defaults = array(
        'type' => 'text',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return '<input ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . " class='form-control' " . " />\n";
}

function form_input_frontend_($data = '', $value = '    ', $extra = '') {
    $defaults = array(
        'type' => 'text',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return ' <input ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . ' class="form-control" ' . ' />';
}

function form_input_frontpassword_($data = '', $value = '    ', $extra = '') {
    $defaults = array(
        'type' => 'password',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return ' <input ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . ' class="form-control" ' . ' />';
}

function form_input_number_($data = '', $value = '', $min = 0, $max = 0, $extra = '') {
    $defaults = array(
        'type' => 'number',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return '<input ' . _parse_form_attributes($data, $defaults) . ' min="'.$min.' " max="'.$max.'" '._attributes_to_string($extra) . " class='form-control' " . " />\n";
}

function form_textarea_($data = '', $value = '', $extra = '') {
    $defaults = array(
        'name' => is_array($data) ? '' : $data,
        'cols' => '40',
        'rows' => '10'
    );

    if (!is_array($data) OR ! isset($data['value'])) {
        $val = $value;
    } else {
        $val = $data['value'];
        unset($data['value']); // textareas don't use the value attribute
    }

    return '<textarea  class="form-control" ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . '>'
            . html_escape($val)
            . "</textarea>\n";
}

function form_dropdown_($data = '', $options = array(), $selected = array(), $extra = '') {
    $defaults = array();

    if (is_array($data)) {
        if (isset($data['selected'])) {
            $selected = $data['selected'];
            unset($data['selected']); // select tags don't have a selected attribute
        }

        if (isset($data['options'])) {
            $options = $data['options'];
            unset($data['options']); // select tags don't use an options attribute
        }
    } else {
        $defaults = array('name' => $data);
    }

    is_array($selected) OR $selected = array($selected);
    is_array($options) OR $options = array($options);

    // If no selected state was submitted we will attempt to set it automatically
    if (empty($selected)) {
        if (is_array($data)) {
            if (isset($data['name'], $_POST[$data['name']])) {
                $selected = array($_POST[$data['name']]);
            }
        } elseif (isset($_POST[$data])) {
            $selected = array($_POST[$data]);
        }
    }

    $extra = _attributes_to_string($extra);

    $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

    $form = '<select class="form-control" ' . rtrim(_parse_form_attributes($data, $defaults)) . $extra . $multiple . ">\n";

    foreach ($options as $key => $val) {
        $key = (string) $key;

        if (is_array($val)) {
            if (empty($val)) {
                continue;
            }

            $form .= '<optgroup label="' . $key . "\">\n";

            foreach ($val as $optgroup_key => $optgroup_val) {
                $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                $form .= '<option value="' . html_escape($optgroup_key) . '"' . $sel . '>'
                        . (string) $optgroup_val . "</option>\n";
            }

            $form .= "</optgroup>\n";
        } else {
            $form .= '<option value="' . html_escape($key) . '"'
                    . (in_array($key, $selected) ? ' selected="selected"' : '') . '>'
                    . (string) $val . "</option>\n";
        }
    }

    return $form . "</select>\n";
}

function form_button_($data = '', $content = '', $extra = '') {
    $defaults = array(
        'name' => is_array($data) ? '' : $data,
        'type' => 'button'
    );

    if (is_array($data) && isset($data['content'])) {
        $content = $data['content'];
        unset($data['content']); // content is not an attribute
    }

    return '<button ' . _parse_form_attributes($data, $defaults) . _attributes_to_string($extra) . ' class="btn btn-info" >'
            . $content
            . "</button>\n";
}

/* end helper */

function addRow($Cells, $xisheader = false) {
    //  return '<span class="row">'.$Cells.'</div>';
    //return $Cells;
    $xClassCell = '';
    if ($xisheader == true) {
        $xClassCell = 'class="rowsreportheader"';
    } else {
        $xClassCell = 'class="rowsreporttabledata"';
    }
    return '<div ' . $xClassCell . '>' . $Cells . '</div>';
}

function addCell($xContent, $xStyle, $xisheader = false) {
    //width: 150px;
    $xClassCell = '';
    if ($xisheader == true) {
        $xClassCell = 'class="headertabledata"';
    } else {
        $xClassCell = 'class="detailtabledata"';
    }

//    return   '<div class="'.$xClassCell.'" style="'.$xStyle.'">'.$xContent.'</div>';
    return '<div ' . $xClassCell . ' style="' . $xStyle . '"><div style="padding:2px; width:100%; height:100%;">' . $xContent . '</div></div>';
}

function tbaddrow($cells, $style = '', $ishead = false) {
    if ($ishead) {
        return '<tr class="border head padded" style="' . $style . '">' . $cells . '</tr>';
    } else {
        return '<tr class="border" ' . $style . '>' . $cells . '</tr>';
    }
}

function tbaddrowpdf($cells, $style = '', $ishead = false) {
    if ($ishead) {
        return '<tr class="border head padded" style="background-color: gray;">' . $cells . '</tr>';
    } else {
        return '<tr class="border" style="' . $style . '" align="center">' . $cells . '</tr>';
    }
}

function tbaddcell($xContent, $xStyle = "", $propother = "") {
    return '<td ' . $propother . ' style="' . $xStyle . '">' . $xContent . '</td>';
}

function tbaddcellhead($xContent, $xStyle = "", $propother = "") {
    return '<th ' . $propother . ' style="' . $xStyle . '">' . $xContent . '</th>';
}

function tbaddcellheadpdf($xContent, $xStyle = "", $propother = "") {
    return '<th ' . $propother . ' style=" style="background-color:#A9A9A9;">' . $xContent . '</th>';
}

function tablegrid($xContent, $xStyle = "", $propother = "") {
    return '<table ' . $propother . ' class="table table-striped table-hover fixed-table-container table-no-bordered" width="100%" cellspacing="0" cellpadding="0" class="tableborder" style="' . $xStyle . '">' . $xContent . '</table>';
}

function tablegridborderpdf($xContent, $xStyle = "", $propother = "") {
    return '<table ' . $propother . ' class="table table-striped table-hover fixed-table-container table-bordered" border="1" width="100%" cellspacing="0" cellpadding="0" class="tableborder" style="' . $xStyle . '">' . $xContent . '</table>';
}

function tablegridnobroder($xContent, $xStyle = "", $propother = "") {
    return '<table ' . $propother . ' width="100%" cellspacing="0" cellpadding="0"  style="' . $xStyle . '">' . $xContent . '</table>';
}

function addCellDiv($xContent, $xStyle, $xClassCell = '', $xisheader = false) {
    //width: 150px;
    ;
    if ($xisheader == true)
        $xClassCell = 'class="header"';
    return '<div ' . $xClassCell . ' style="' . $xStyle . '">' . $xContent . '</div>';
}

function addRowDiv($Cells) {
    return '<div class="rowsreport">' . $Cells . '</div>';
    //return $Cells;
}

function addRowDivDetail($Cells) {
    return '<div class="rowsreportdetail">' . $Cells . '</div>';
    //return $Cells;
}

function GetGrid($xRowsCells, $xWidth, $xHeight) {
    //return   '<div id="tabledata" name ="tabledata" class="tc1" style="width:'.$xWidth.'px;height:'.$xHeight.'px;">'.$xRowsCells.'<div style="clear:both;"></div></div>';
    return $xRowsCells;
}

function addJS($xUrl) {
    //alert("http://<?php echo base_url();index.php?/csearch/setviewsearch/"+document.getElementById('edSearch').value+"/0");
    //csearch/setviewsearch/"+document.getElementById("edSearch").value+"/0"
    $xBufResult = '';
    $xBufResult .= ' <script type="text/javascript">' .
            '   function edit(idrec){' .
            '     document.location="index.php?/' . $xUrl . '/"+idrec+"/edit";' .
            '    }' .
            '   function search(idrec){' .
            ' if(document.getElementById(\'edSearch\').value!=""){' .
            '     document.location="index.php?/' . $xUrl . '/"+document.getElementById(\'edSearch\').value+"/search";' .
            '    }' .
            '    }' .
            '   function hapus(idrec,ket){' .
            ' if (confirm("Anda yakin Akan menghapus data "+ket+"?")) {' .
            '      document.location="index.php?/' . $xUrl . '/"+idrec+"/hapus";' .
            '     }' .
            '  }' .
            '</script>     ';
    return $xBufResult;
}

function getListItem($xArray) {
    $xBufResult = '';
    for ($i = 1; $i < count($xArray); $i++) {
        $xBufResult .= $xArray[$i];
    }

    return $xBufResult;
}
function get_curl($url) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "scriptmedia", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    curl_close($ch);

    return $content;
}
function setview($xArrayObject) {
    $Menu = $xArrayObject[0];
    $xContent = $xArrayObject[2];
    return ' <div id="container">' .
            '           <div id="menu">
                ' . $Menu . '
                </div>

                <div id="content">
                   ' . $xContent . '
                </div>

            <div id="footer"> </div>' .
            '</div>';
}

function setviewadmin($xArrayObject) {
    //$Menu = $xArrayObject[0];
    $MenuAdmin = $xArrayObject[1];
    $xContent = $xArrayObject[2];
    $xlogo = $xArrayObject[3];
    $xnama = $xArrayObject[4];
    $xtopheader = $xArrayObject[6];
    $xjudul = (!empty($xArrayObject[5])) ? '<div class="panel-heading"><h4>' . $xArrayObject[5] . '</h4></div>' : '';
    if (!empty($xArrayObject[1]))
        return '  <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="top-header">
<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1 class="navbar-brand"><a  href="' . base_url() . 'index.php/webadmindo">' . $xtopheader . '</a></h1>
            </div>
            <!-- /.navbar-header -->
             <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="' . base_url() . 'index.php/ctrusersistem' . '"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="' . base_url() . 'index.php/ctrmenu' . '"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="' . base_url() . 'index.php/webadmindo/logout' . '"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                  </ul>
                  </div>
            <!-- /.navbar-top-links -->
                <!-- /.dropdown -->
                 <div class="navbar-default sidebar" role="navigation">
                 <a class="logo-admin" href="' . base_url() . 'index.php/webadmindo"><img src="' . $xlogo . '" /></a>
                <div class="sidebar-nav navbar-collapse">
                    ' . $MenuAdmin . '
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">DASHBOARD</h1>
                            <!--<div class="alert alert-info">
                             <strong>Welcome ' . strtoupper($xnama) . ' ! </strong> You Have No pending Task For Today.
                        </div>-->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        ' . $xjudul . '
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <div id="content-content">
                                     ' . $xContent . '

                                     </div>
                                       </div>
                                <!-- /.col-lg-12 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
        <div id="loading" class="loading"><img class="loading-image center-block" src=' . base_url() . 'resource/scriptmedia/images/loading.gif /></div>
';
    else
        return '
                ' . $xContent . '

              ';
//<div id="footer"><div id="myslidemenu"  class="jqmenuatas">' . $MenuAdmin[1] . '</div> </div>' .
}

function set_search($xSearch, $xFilter, $searchcolumn = [])
{
    $searchquery = "";
    $iswherealready = false;
    if (!empty($xSearch) || !empty($xFilter)) {
        $searchquery = "Where ";
    }
    if (!empty($xSearch) && !empty($searchcolumn)) {
        foreach ($searchcolumn as $col) {
            if ($iswherealready) {
                $searchquery .= " or $col like '%" . $xSearch . "%'";
            } else {
                $iswherealready = true;
                $searchquery .= "($col like '%" . $xSearch . "%'";
            }
        }
        $searchquery .= ")";
        
    }
    if (!empty($xFilter)) {
        foreach ($xFilter as $val) {
            $column = $val["column"];
            $value = $val["value"];
            $type = $val["type"];
            if ($iswherealready) {
                $and = " and ";
            } else {
                $iswherealready = true;
                $and = "";
            }
            switch ($type) {
                case 'in'://not ready
                    $searchquery .= $and."$column = '" . $value . "'";
                    break;
                
                default:
                    $searchquery .= $and."$column = '" . $value . "'";
                    break;
            }
        }
    }
    return $searchquery;
}

function removecurrency($currencyvalue){    
    preg_match_all('![0-9.]+!', $currencyvalue, $matches);
    $matches = $matches[0];
    $combine = "";
    foreach ($matches as $key => $value) {
      $combine .= $value;
    }
    return $combine;
}

//Status Properti Constant
const statusCategory_RAB = "RAB";
const statusCategory_SPK = "SPK";
const statusCategory_PENJUALAN = "PENJUALAN";
const statusCategory_ADENDUM = "ADENDUM";

const statusId_SiapBangun = 1;
const statusId_SiapJual = 2;
const statusId_PengajuanRAB = 101;
const statusId_RABDitolak = 102;
const statusId_PengajuanSPK = 201;
const statusId_SPKDitolak = 203;
const statusId_ProcessPembangunan = 204;
const statusId_Dibooking = 302;
const statusId_Terjual = 303;
const statusId_PengajuanAdendum = 401;
const statusId_AdendumDitolak = 402;
