<!-- left menu -->
<?php if ($showmainmenu) { ?>
<div class="left-menu">

<?php if ($showback) { ?>
    <div>
        <button class="btn" id="back">Kembali<br><i class="fas fa-long-arrow-alt-left"></i></button>
    </div>
    <?php } else { ?>
    <ul class="list-group bg-transparent">
        <li class="list-group-item borderless bg-transparent"><a href="#" type="button" class="btn btn-light">Kolaborator</a></li>
        <li class="list-group-item borderless bg-transparent"><a href="#" type="button" class="btn btn-light">Info</a></li>
        <li class="list-group-item borderless bg-transparent"><a href="#" type="button" class="btn btn-light">Beranda</a></li>
        <?php if ($showadditionalmenu) { ?>
        <li class="list-group-item borderless bg-transparent"><a href="#" type="button" class="btn btn-light">Jadi Dermawan Seni</a></li>
        <li class="list-group-item borderless bg-transparent"><a href="#" type="button" class="btn btn-light">Beli Kupon Online</a></li>
        <?php } ?>
        <?php } ?>
    </ul>
</div>
<?php } ?>