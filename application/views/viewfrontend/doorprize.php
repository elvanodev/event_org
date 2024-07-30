<div class="card main-content">
    <div class="card-body text-light">
        <div class="row">            
            <?php foreach ($list_doorprize as $row) {
            ?>
            <div class="col-4">
                <div class="p-2 border border-success rounded hoverimage">
                    <img class="img-fluid imageview" style="min-height: 325px;" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->image_art; ?>">
                    <div class="text-center text-light tooltipview" style="min-height: 325px;">
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