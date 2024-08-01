<div class="card main-content bg-transparent border-0">
    <div class="card-body text-light">
        <div class="row">            
            <?php foreach ($list_doorprize as $row) {
            ?>
            <div class="col-12 d-flex justify-content-center">
                <div class="p-2 border-0 rounded">
                    <img class="img-fluid d-flex justify-content-center" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->image_art; ?>">
                    <div class="text-center text-light tooltipview">
                        <h4><?php echo $row->title; ?></h4>
                        <p><strong><?php echo $row->year; ?></strong></p>                        
                        <p><strong><?php echo $row->dimension; ?></strong></p>
                        <p><strong><?php echo $row->media; ?></strong></p>
                        <p><?php echo $row->description; ?></p>
                        <small>By. <?php echo $row->artist_name; ?></small>
                    </div>
                </div>
            </div>
            <?php
            } ?>
        </div>
    </div>
</div>