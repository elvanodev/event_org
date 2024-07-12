<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH.'libraries/phpqrcode/qrlib.php');
/**
 * Summary of generate_qrcode
 * @param mixed $prefix
 * @param mixed $is_random
 * @param mixed $length can be 0 when not random
 * @param mixed $generate_number must be not null when not random
 * @return string
 */
function generate_qrcode($prefix, $is_random, $length = 0, $generate_number = '') : string {
    if ($is_random) {
        $i = '9';
        $loop = 0;
        while ($loop < $length) {
            $i .= '9';
            $loop++;
        }
        $random_number = rand(0,(int)$i);
        $generate_number = $random_number;
    }
    $qrcode = $prefix . "_" . $generate_number;
    $dir = "resource/uploaded/qrcodes/";
    if (!file_exists($dir))
        mkdir($dir);
    $filename = $qrcode.".png";
    QRcode::png($qrcode, $dir.$filename);
    return $filename;
}