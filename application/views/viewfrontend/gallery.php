<div class="card main-content">
    <div class="card-body text-light">
        <div class="row">            
            <?php foreach ($list_testimonials as $row) {
            ?>
            <div class="col-4">
                <img class="img-fluid" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->testimoni_photo; ?>"/>
            </div>
            <?php
            } ?>
        </div>
    </div>
</div>