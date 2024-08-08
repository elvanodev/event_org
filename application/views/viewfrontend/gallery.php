<div class="card main-content default-bg-color">
    <div class="card-body text-light">
        <div class="row">            
            <?php foreach ($list_testimonials as $row) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <img class="img-fluid" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->testimoni_photo; ?>"/>
            </div>
            <?php
            } ?>
        </div>
    </div>
</div>