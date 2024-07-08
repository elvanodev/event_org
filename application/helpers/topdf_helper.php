<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_createA4lnd($html, $filename, $stream=FALSE)
{
    require_once("dompdf/dompdf_config.inc.php");
    spl_autoload_register('DOMPDF_autoload');

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    //$dompdf->set_paper("A4");
    $dompdf->set_paper("A4",'landscape');
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        $CI =& get_instance();
        $CI->load->helper('file');
        write_file("./././resource/pdf/$filename.pdf", $dompdf->output());
    }
}
?>
