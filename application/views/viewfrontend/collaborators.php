<div class="card main-content">
    <div class="card-body">
        <div class="row">
            <?php foreach ($list_collaborators as $row) {
            ?>
                <div class="col-4">
                    <div class="btn p-2 border border-success rounded collaboratorPoster" onclick="onclickartist(<?php echo $row->artist_id; ?>)">
                        <img class="img-fluid imgPoster" style="min-height: 325px;" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->poster_img; ?>">
                        <div class="d-none text-center text-light quoteArtist" style="min-height: 325px;">
                            <h3><?php echo $row->artist_name; ?></h3>
                            <img src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->event_icon; ?>" class="img-fuild" />
                            <p class="align-bottom"><?php echo $row->quote; ?></p>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>