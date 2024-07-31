<!-- right menu -->
<section class="right-menu-section">
<?php if ($showmainmenu) { ?> 
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url();?>frontend/doorprize" type="button" class="btn btn-light text-nowrap right-menu earth-2073 custom-border <?php echo isset($active_doorprize) ? $active_doorprize : '';?>">Hadiah Utama</a>
    </div>
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url();?>frontend/about" type="button" class="btn btn-light mt-2 text-nowrap right-menu earth-2073 custom-border <?php echo isset($active_about) ? $active_about : '';?>">Tentang Kami</a>
    </div>
    <div class="d-flex justify-content-end">
        <a href="<?php echo base_url();?>frontend/gallery" type="button" class="btn btn-light right-menu mt-2 earth-2073 custom-border <?php echo isset($active_gallery) ? $active_gallery : '';?>">Galeri</a>
    </div>
<?php } ?>
</section>