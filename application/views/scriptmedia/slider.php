<?php if (!empty($qslider)) { ?>
    <div class="featured-slider">
        <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                $i = 0;
                foreach ($qslider as $row) {
                    ?>
                    <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
                        <?php
                        if (!empty($row['image'])) {
                            $show = true;
                            ?>
                            <div onclick="<?php echo $row['link']; ?>" class="d-block w-100 img-fluid" style="background:url(<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row['image']; ?>) no-repeat top center;height:calc(75vh - 123px);background-size:cover"></div>
                        <?php } ?>

                        <?php if ($row['keterangan']) { ?>
                            <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
                                <h2><a href="<?php echo $row['link']; ?>"><?php echo $row['keterangan']; ?></a></h2>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
            <!-- Controls -->
            <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
<?php } ?>