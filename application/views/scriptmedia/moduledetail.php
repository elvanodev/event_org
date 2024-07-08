
<div class="detailwidget">
    <?php if (isset($row->judul) && $row->judul != 'undefined') { ?><h3 class="heading"><?php echo $row->judul; ?></h3><?php } ?>
    <?php //if (isset($row->tanggal)&&$row->tanggal!='undefined'){ ?><i class="date"><?php //$date = new DateTime($row->tanggal);
    //echo $date->format('l \of F Y ');
    ?></i><?php //}  ?>
    <div class="entry-list">
        <?php if (isset($row->image1) && ($row->image1 != 'undefined')) {
            if (!empty($row->image1)) {
                ?><div class="col img-detail-thumb"><a href="javascript:void(0)" onclick="onpopup();"><img class="img-fluid" src="<?php echo base_url() . 'resource/uploaded/img/' . $image1; ?>"/></a></div><?php }
}
        ?>
        <?php
        //print_r($row);
//     foreach ($fields as $field){
//         echo (isset($row->$field))?$row->$field:'';
//     }
        echo (isset($row->isi) && $row->isi != 'undefined') ? $row->isi : '';
        ?>

    </div>
</div>
<div id="modalform">
    <!-- Creates the bootstrap modal where the image will appear -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <!--<h4 class="modal-title" id="myModalLabel"><?php echo @$row->judul; ?></h4>-->
                </div>
                <div class="modal-body">
                    <img src="<?php echo base_url() . 'resource/uploaded/img/' . $image1; ?>" id="imagepreview" style="width: 100%;display: block;margin:auto;" >
                </div>
                <!--<div class="modal-footer">-->
                <!--    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
<script>

    function onpopup() {
        $('#imagemodal').modal('show');
    }
</script>
