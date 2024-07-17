<!-- left menu -->
<?php if ($showmainmenu) { ?>
<div class="left-menu">

<?php if ($showback) { ?>
    <div>
        <button class="btn" id="back">Kembali<br><i class="fas fa-long-arrow-alt-left"></i></button>
    </div>
    <?php } else { ?>
        
    <div class="vertical-button">
        <div class="d-flex justify-content-between">
            <a href="#" type="button" class="btn btn-light text-nowrap">Beranda</a>
            <a href="#" type="button" class="btn btn-light text-nowrap">Info</a>
            <a href="#" type="button" class="btn btn-light text-nowrap">Kolaborator</a>
        </div>
    </div>
    <?php if ($showadditionalmenu) { ?>
    <a href="#" type="button" class="btn btn-light text-nowrap mt-2">Jadi Dermawan Seni</a>
    <a href="#" type="button" class="btn btn-light text-nowrap mt-2">Beli Kupon Online</a>
    <?php } ?>
    <?php } ?>
</div>
<?php } ?>