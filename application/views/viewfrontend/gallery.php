<div class="card main-content default-bg-color">
    <div class="card-body text-light">
        <?php foreach ($list_galleries_edition as $row1) {
            if (sizeof($row1->list_galleries) > 0) {
        ?>
                <h3 class="text-center earth-2073"><?php echo $row1->name; ?></h3>
                <div class="row">
                    <?php foreach ($row1->list_galleries as $row2) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <p class="text-center earth-2073"><?php echo $row2->image_title; ?></p>
                            <img class="img-fluid" title="<?php echo $row2->image_title; ?>" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row2->image_link; ?>" />
                        </div>
                    <?php
                    } ?>
                </div>
        <?php
            }
        } ?>
    </div>
</div>