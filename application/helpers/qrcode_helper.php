<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH.'libraries/phpqrcode/qrlib.php');

function generate_qrcode($prefix, $length) : string {
    $i = '9';
    $loop = 0;
    while ($loop < $length) {
        $i .= '9';
        $loop++;
    }
    $random_number = rand(0,(int)$i);
    $qrcode = $prefix . "_" . $random_number;
    $dir = "resource/uploaded/qrcodes/";
    if (!file_exists($dir))
        mkdir($dir);
    $filename = $qrcode.".png";
    QRcode::png($qrcode, $dir.$filename);
    return $filename;
}