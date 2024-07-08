<div class="detailwidget">
<div class="entry-list">

    <h1> Pengumuman Kelulusan </h1>
    <?php if(!empty($dinyatakan)){ ?>
    <div id="viewpengumuman">
    <div class="headerkeputusan col-sm-12"><?php echo $headerkeputusan ?></div>
<!--    <div><b><?php echo $headerNokeputusan ?></b></div>
    -->
    <div class="row">
        <label class="col-sm-3 col-sm-offset-2 control-label">Nama Siswa </label>
        <div class="col-sm-7 ">: <?php echo (isset($siswakeputusan['NamaSiswa']))?$siswakeputusan['NamaSiswa']:''; ?></div>
    </div>
    <div class="row">
        <label class="col-sm-3 col-sm-offset-2 control-label">No Peserta Ujian </label>
        <div class="col-sm-7">: <?php echo (isset($siswakeputusan['NoUjian']))?$siswakeputusan['NoUjian']:''; ?></div>
     </div>

<!--    <div class="row">
        <label class="col-sm-2 control-label">Tempat / Tgl Lahir </label>
        <div class="col-sm-10">: <?php echo (isset($siswakeputusan['TglLahir']))?$siswakeputusan['TglLahir']:''; ?></div>
    </div>        -->
<div class="col-sm-3 col-sm-offset-4 text-center" style="margin-bottom:10px;"><strong>dinyatakan :</strong></div>
    <div class="alert alert-info col-sm-3 col-sm-offset-4 text-center bottom-margin"><?php echo $dinyatakan ?></div>
    <div class="col-sm-12" style="margin-bottom:10px;">dalam menempuh Ujian Sekolah SMA Negeri 1 Wates tahun pelajaran 2014/2015  dengan</div>
    <div class="alert alert-info col-sm-3 col-sm-offset-4 text-center bottom-margin" onclick="dopopdaftarnilaikelulusan('14');">Rata-rata Nilai Sekolah<br /><?php echo $siswakeputusan['Nilaitotal'] ?></div>
    <div class="alert alert-info col-sm-3 col-sm-offset-4 text-center bottom-margin"  onclick="dopopdaftarnilaikelulusan('15');">Rata-rata Nilai Ujian Nasional<br /><?php echo $siswakeputusan['Nilaiun'] ?></div>

    <div class="col-sm-12 footerkeputusan"><?php echo $footerkeputusan ?></div>
    </div>
    <div class="col-sm-12 clearfix">
    <button id="btnPrint" width="250" alt=""  class="btn btn-info" />Print</button>
    <button  width="250" alt=""  class="btn btn-danger" onclick="dopopdaftarnilaikelulusan('15');"/>Daftar Nilai UN</button>

    <button  width="250" alt=""  class="btn btn-danger" onclick="dopopdaftarnilaikelulusan('14');" />Daftar Nilai Sekolah</button>
    </div>
        <?php } else {?>
        <div><b><?php echo $headerNokeputusan ?></b></div>
    <?php }?>
    <div>

    </div>

</div>
</div>

<div id="popupnilai"></div>
<script>
 $(document).ready(function () {
    $("#popupnilai").dialog({
        autoOpen: false,
        top: 150,
        height: 600,
        width: 900,
        modal: true
    });
  });

 function dopopdaftarnilaikelulusan(xinkode){
   $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrnilai/daftarnilaikelulusan/",
            data: "xinkode=" + xinkode,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
               $("#popupnilai").html(json.tabledatanilai);
                $("#popupnilai").dialog("open")
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}
$(document).ready(function () {
   $("#btnPrint").click(function () {
            var divContents = $("#viewpengumuman").html();
            var styleheader = '<link href="<?php echo base_url(); ?>resource/scriptmedia/css/bootstrap.min.css" rel="stylesheet">'+
        '<link href="<?php echo base_url(); ?>resource/scriptmedia/css/style.css" rel="stylesheet">'+
        '<style>body{background:none;width:800px;margin:auto;}hr{border-color:#000;}</style>';
            var printWindow = window.open('', '', 'height=3508,width=2480');
            printWindow.document.write('<html><head><title>Pengumuman Kelulusan SMA N 1 Wates Kulonprogo</title>');
            printWindow.document.write(styleheader);
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
});
</script>
