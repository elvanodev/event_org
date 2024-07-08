<?php if (!empty($qslider)) { ?>
    <div class="featured-slider">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                $i = 0;
                foreach ($qslider as $row) {
                    ?>
                    <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
                        <div class="row">

                            <?php
                            if (!empty($row['image'])) {
                                $show = true;
                                ?>
                                <div class="col <?php echo ($row['keterangan']) ? 'col-md-3' : 'col-md-12'; ?>">
                                    <a href="<?php echo $row['link']; ?>"><img src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row['image']; ?>" alt="" class="img-fluid"></a>
                                </div>
                            <?php } ?>

                            <?php if ($row['keterangan']) { ?>
                                <div class="col <?php echo ($show) ? 'col-lg-9' : 'col-md-12'; ?>">
                                    <div class="carousel-caption">
                                        <h3><a href="<?php echo $row['link']; ?>"><?php echo $row['keterangan']; ?></a></h3>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>


            </div>
            <?php if ($show == true) { ?>
                <!-- Controls -->
                <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            <?php } ?>
        </div>

    </div>
<?php } ?>
