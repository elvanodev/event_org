<!-- left menu -->
<div class="left-menu">
    <?php if ($showback) { ?>
    <button class="btn text-nowrap text-light" onclick="history.back()">Kembali<br><i class="fas fa-long-arrow-alt-left"></i></button>
    <?php } else { ?>  
        <?php if ($showmainmenu) { ?>      
    <a href="#" type="button" class="btn btn-light text-nowrap">Kolaborator</a>
    <a href="#" type="button" class="btn btn-light text-nowrap mt-2">Info</a>
    <a href="#" type="button" class="btn btn-light text-nowrap mt-2">Beranda</a>
        <?php } ?>
        <?php if ($showadditionalmenu) { ?>
    <a href="#" type="button" class="btn btn-light text-nowrap mt-2">Jadi Dermawan Seni</a>
    <a href="<?php echo base_url();?>frontend/couponselling" type="button" class="btn btn-light text-nowrap mt-2">Beli Kupon Online</a>
        <?php } ?>
    <?php } ?>
</div>