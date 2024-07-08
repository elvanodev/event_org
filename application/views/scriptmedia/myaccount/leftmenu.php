<?php if ($this->session->userdata('statuslogin')=='member'){?>
<h3>Account Login </h3> <h4><?php echo $this->session->userdata('nama') ?></h4>
<ul class="nav nav-pills nav-stacked">
    <li class="account-menu"><a href="<?php echo base_url() . 'index.php/ctrmyaccount/' ?>">Profile Saya</a></li>
    <li class="account-menu"><a href="<?php echo base_url() . 'index.php/ctrmytransaksi/' ?>">Transaksi</a></li>
    <li class="account-menu"><a href="<?php echo base_url() . 'index.php/ctrmykomisimember/' ?>">Komisi</a></li>
    <li class="account-menu"><a href="<?php echo base_url() . 'index.php/ctrmypencairan/' ?>">Pencairan</a></li>
    <li class="account-menu"><a href="<?php echo base_url() . 'index.php/ctrmyaccount/' ?>">Promo Agen</a></li>

    <li class="account-menu"><a href="<?php echo base_url() . 'index.php/ctrview/logout/' ?>">Logout</a></li>
</ul>
<?php } ?>
