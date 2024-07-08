<?php

function gabungpdf($xarrayfile, $folder, $namafile) {
    include_once("pdfconcat.php");

    $pdf = new concat_pdf();
    $xarrbuff = array();
    for ($i = 0; $i < count($xarrayfile); $i++) {

        array_push($xarrbuff, $folder . $xarrayfile[$i]);
    }
	if (ob_get_length() > 0 ) {
ob_end_clean();
}
    
    $pdf->setFiles($xarrbuff);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->concat();

    $pdf->Output($folder . $namafile . ".pdf", "F");


//include 'PDFMerger/PDFMerger.php';
//$pdf = new PDFMerger;
//for($i=0; $i<count($xarrayfile);$i++ ){
// $pdf->addPDF($folder.$xarrayfile[$i] ,'all');
//}
//$pdf->merge('file', $folder.'/'.$raportkelas.'.pdf');
}

//$pdf->addPDF('samplepdfs/one.pdf', '1, 3, 4')
//	->addPDF('samplepdfs/two.pdf', '1-2')
//	->addPDF('samplepdfs/three.pdf', 'all')
//	->merge('file', 'samplepdfs/TEST2.pdf');
//REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
//You do not need to give a file path for browser, string, or download - just the name.
?>