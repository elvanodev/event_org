<!-- right menu -->
<section class="right-menu-section">
<?php if ($showmainmenu) { ?> 
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url();?>frontend/doorprize" type="button" class="btn btn-light text-nowrap right-menu">Hadiah Utama</a>
    </div>
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url();?>frontend/about" type="button" class="btn btn-light mt-2 text-nowrap right-menu">Tentang Kami</a>
    </div>
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url();?>frontend/gallery" type="button" class="btn btn-light right-menu mt-2">Galeri</a>
    </div>
<?php } ?>
</section>