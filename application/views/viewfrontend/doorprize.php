<div class="main-content default-bg-color bg-transparent border-0">
    <div class="text-light">
        <?php
        $shaw_primary_dp = false;
        $shaw_other_dp = false;
        foreach ($list_doorprize as $row_doorprize) {
        ?>
            <?php
            if ($row_doorprize->is_primary_doorprize == 1) {
                if (!$shaw_primary_dp) {
            ?>
                    <h3 class="earth-2073 text-center">Hadiah Utama</h3>
                    <p class="earth-2073 text-center">Persembahan Dari</p>
                <?php
                }
                $shaw_primary_dp = true;
                ?>
                <div class="row">
                    <?php foreach ($row_doorprize->list_doorprize_artists as $row_artist) {
                    ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                            <div class="btn p-2 border-0 rounded" onclick="onclickartist(<?php echo $row_artist->artist_id; ?>)">
                                <img class="btn img-fluid img-circle d-flex justify-content-center artist-image" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row_artist->profile_img; ?>">
                                <div class="text-center text-light">
                                    <p><?php echo $row_artist->artist_name; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
                <div class="card border-0 popup-detail w-50 d-none" id="artDetail_<?php echo $row_doorprize->idx; ?>">
                    <div class="card-body text-light modal-content default-bg-color">
                        <div class="btn w-100 text-light text-end mr-2" id="artDetailClose_<?php echo $row_doorprize->idx; ?>" onclick="onclickartdetailclose(<?php echo $row_doorprize->idx; ?>)"><i class="fa-solid fa-xmark"></i></div>
                        <h4><?php echo $row_doorprize->title; ?></h4>
                        <p><strong><?php echo $row_doorprize->year; ?></strong></p>
                        <p><strong><?php echo $row_doorprize->dimension; ?></strong></p>
                        <p><strong><?php echo $row_doorprize->media; ?></strong></p>
                        <p><?php echo $row_doorprize->description; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center rounded border">
                        <div class="p-2 background-mask mask-surround" data-id="<?php echo $row_doorprize->idx; ?>" id="artMask_<?php echo $row_doorprize->idx; ?>">
                            <img class="img-fluid d-flex justify-content-center w-100" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row_doorprize->image_art; ?>">
                        </div>
                    </div>
                </div>
                <?php
            } else {
                if (!$shaw_other_dp) {
                ?>
                    <h3 class="earth-2073 text-center">Hadiah Lainnya</h3>
                <?php
                }
                $shaw_other_dp = true;
                ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="p-2">
                            <img class="img-fluid" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row_doorprize->image_art; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="p-2">
                            <div class="card border-0 bg-transparent">
                                <div class="card-body text-light modal-content">
                                    <h4><?php echo $row_doorprize->title; ?></h4>
                                    <p><strong><?php echo $row_doorprize->year; ?></strong></p>
                                    <p><strong><?php echo $row_doorprize->dimension; ?></strong></p>
                                    <p><strong><?php echo $row_doorprize->media; ?></strong></p>
                                    <p><?php echo $row_doorprize->description; ?></p>
                                    <p>Oleh: </p>
                                    <?php foreach ($row_doorprize->list_doorprize_artists as $row_artist) {
                                    ?><div class="text-light">
                                            <p> - <?php echo $row_artist->artist_name; ?></p>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        <?php
        } ?>
    </div>
</div>