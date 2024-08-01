<div class="card main-content bg-transparent border-0">
    <div class="card-body text-light">
        <div class="row">            
            <?php foreach ($list_doorprize_artists as $row) {
            ?>
            <div class="col-6 d-flex justify-content-center">
                <div class="btn p-2 border-0 rounded" onclick="onclickartist(<?php echo $row->artist_id; ?>)">
                    <img class="img-fluid img-circle d-flex justify-content-center artist-image" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->profile_img; ?>">
                    <div class="text-center text-light">
                        <h3><?php echo $row->artist_name; ?></h3>
                    </div>
                </div>
            </div>
            <?php
            } ?>
        </div>
        <div class="row">       
            <div class="col-12 d-flex justify-content-center">
                <div class="p-2 background-mask">
                    <img class="img-fluid d-flex justify-content-center w-100" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row_doorprize->image_art; ?>">
                </div>
                <div class="text-center text-light d-none">
                    <h4><?php echo $row_doorprize->title; ?></h4>
                    <p><strong><?php echo $row_doorprize->year; ?></strong></p>                        
                    <p><strong><?php echo $row_doorprize->dimension; ?></strong></p>
                    <p><strong><?php echo $row_doorprize->media; ?></strong></p>
                    <p><?php echo $row_doorprize->description; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>