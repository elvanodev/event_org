<!-- left menu -->
<div class="left-menu-section">
    <?php if ($showback) { ?>
    <button class="btn text-light text-nowrap earth-2073" onclick="history.back()">Kembali<br><i class="fas fa-long-arrow-alt-left"></i></button><br>
    <?php } else { ?>  
        <?php if ($showmainmenu) { ?>      
    <a href="<?php echo base_url();?>frontend/collaborators" type="button" class="btn btn-light left-menu earth-2073 custom-border ml-2 <?php echo isset($active_collaborator) ? $active_collaborator : '';?>">Kolaborator</a><br>
    <a href="<?php echo base_url();?>frontend/eventinfo" type="button" class="btn btn-light mt-2 left-menu earth-2073 custom-border <?php echo isset($active_info) ? $active_info : '';?>">Info</a><br>
    <a href="<?php echo base_url();?>" type="button" class="btn btn-light mt-2 left-menu earth-2073 custom-border <?php echo isset($active_home) ? $active_home : '';?>">Beranda</a><br>
        <?php } ?>
        <?php if ($showadditionalmenu) { ?>
    <a href="https://saweria.co/dermawanseni"  type="button" class="btn btn-light mt-2 text-nowrap highlight-button animated-1" target="_blank">Jadi Dermawan Seni</a><br>
    <a href="<?php echo base_url();?>frontend/couponselling" type="button" class="btn btn-light mt-2 text-nowrap highlight-button animated-2">Beli Kupon Online</a>
        <?php } ?>
    <?php } ?>  
</div>