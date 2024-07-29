<!-- right menu -->
    </div>
    <div class="col-2">
    <?php if ($showmainmenu) { ?> 
        <div class="d-flex justify-content-end">
            <a href="<?php echo base_url();?>frontend/doorprize" type="button" class="btn btn-light text-nowrap">Hadiah Utama</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="<?php echo base_url();?>frontend/about" type="button" class="btn btn-light mt-2 text-nowrap">Tentang Kami</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="<?php echo base_url();?>frontend/gallery" type="button" class="btn btn-light mt-2">Galeri</a>
        </div>
        </div>
    <?php } ?>
    </div>
</div>