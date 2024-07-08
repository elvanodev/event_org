<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function pdf_create($html, $filename,$size='',$orient='', $stream = FALSE) {
    require_once("dompdf/dompdf_config.inc.php");
    try {
        spl_autoload_register('DOMPDF_autoload');

        $dompdf = new DOMPDF();

        $dompdf->load_html($html);


//    $dompdf->set_paper("A4");
        if($size!='' && $orient!=''){
              $dompdf->set_paper($size, $orient);
        }else{
              $dompdf->set_paper("A4", 'portrait');
        }
      
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf");
        } else {
            $CI = & get_instance();
            $CI->load->helper('file');

            write_file(FCPATH . "resource/pdf/$filename.pdf", $dompdf->output());
        }
    } catch (Exception $e) {
        // Do something here with $e and notify the user of the error in whatever way you see fit
        echo "iki error" . $e;
    }
    // $dompdf->
}

?>
