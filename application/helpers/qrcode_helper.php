<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH.'libraries/phpqrcode/qrlib.php');
/**
 * Summary of generate_qrcode
 * @param mixed $prefix use this to define prefix of qr code
 * @return string
 */
function generate_qrcode($prefix) : string {    
    date_default_timezone_set('Asia/Jakarta');
    $unique_key = date('YmdHis').hrtime(true);
    $qrcode = $prefix . "_" . $unique_key;
    $dir = "resource/uploaded/qrcodes/";
    if (!file_exists($dir))
        mkdir($dir);
    $filename = $qrcode.".png";
    QRcode::png($qrcode, $dir.$filename);
    return $filename;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}