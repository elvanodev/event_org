<!-- left menu -->
<div class="left-menu-section">
    <?php if ($showback) { ?>
    <button class="btn text-light text-nowrap" onclick="history.back()">Kembali<br><i class="fas fa-long-arrow-alt-left"></i></button><br>
    <?php } else { ?>  
        <?php if ($showmainmenu) { ?>      
    <a href="<?php echo base_url();?>frontend/collaborators" type="button" class="btn btn-light left-menu">Kolaborator</a><br>
    <a href="<?php echo base_url();?>frontend/eventinfo" type="button" class="btn btn-light mt-2 left-menu">Info</a><br>
    <a href="<?php echo base_url();?>" type="button" class="btn btn-light mt-2 left-menu">Beranda</a><br>
        <?php } ?>
        <?php if ($showadditionalmenu) { ?>
    <a href="http://wa.me/<?php echo $header['event']->contact_phone; ?>"  type="button" class="btn btn-light mt-2 text-nowrap" target="_blank">Jadi Dermawan Seni</a><br>
    <a href="<?php echo base_url();?>frontend/couponselling" type="button" class="btn btn-light mt-2 text-nowrap">Beli Kupon Online</a>
        <?php } ?>
    <?php } ?>  
</div>