<div class="main-content bg-transparent border-0">        
    <div class="text-light">
        <div class="row">            
            <?php foreach ($list_doorprize_artists as $row) {
            ?>
            <div class="col-6 d-flex justify-content-center">
                <div class="btn p-2 border-0 rounded" onclick="onclickartist(<?php echo $row->artist_id; ?>)">
                    <img class="btn img-fluid img-circle d-flex justify-content-center artist-image" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->profile_img; ?>">
                    <div class="text-center text-light">
                        <p><?php echo $row->artist_name; ?></p>
                    </div>
                </div>
            </div>
            <?php
            } ?>
        </div>
        <div class="card border-0 popup-detail w-50 d-none" id="artDetail">
            <div class="card-body text-light modal-content">
                <div class="btn w-100 text-light text-end mr-2" id="artDetailClose"><i class="fa-solid fa-xmark"></i></div>
                <h4><?php echo $row_doorprize->title; ?></h4>
                <p><strong><?php echo $row_doorprize->year; ?></strong></p>                        
                <p><strong><?php echo $row_doorprize->dimension; ?></strong></p>
                <p><strong><?php echo $row_doorprize->media; ?></strong></p>
                <p><?php echo $row_doorprize->description; ?></p>
            </div>
        </div>
        <div class="row">       
            <div class="col-12 d-flex justify-content-center">
                <div class="p-2 background-mask mask-surround">
                    <img class="img-fluid d-flex justify-content-center w-100" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row_doorprize->image_art; ?>">
                </div>
            </div>
        </div>
    </div>
</div>