<!-- footer -->
<?php $tahunajaran = $this->session->userdata('tahunajar'); ?>
<footer class="footer text-center text-sm-left">
    <div class="container-fluid text-white mx-md-5">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center pt-3">
            <div class="col-sm-6 col-md-8 order-2 order-sm-1 my-3 my-sm-0">
                <?php if (!empty($tahunajaran)) { ?>
                    <span class="yayasan align-sm-middle">Tahun Ajaran <?php
                        $tahun = $this->session->userdata('tahunajar');
                        $tahun2 = $tahun + 1;
                        $tahunajaran = $tahun . '/' . $tahun2;
                        echo $tahunajaran;
                        ?></span><br/>
                <?php } ?>
                <span class="yayasan align-sm-middle">&copy; <a target="_blank" href="https://winayabhaktisolo.wordpress.com">Yayasan Winayabhakti Solo</a> 2019</span>
            </div>
            <div class="col-sm-6 col-md-4 pull-none pull-sm-right order-1 order-sm-2">
                <span>
                    <a href="https://wa.me/+6285100934313"><i class="fa fa-whatsapp"></i> 0851-0093-4313</a><br>
                    <a href="http://smareginapacis-solo.sch.id" target="_blank"><i class="fa fa-globe"></i> smareginapacis-solo.sch.id</a><br>
                    <a href="mailto:smareginapacissolo@gmail.com"><i class="fa fa-envelope"></i> smareginapacissolo@gmail.com</a></a>
                </span>
            </div>
        </div>
    </div>
</footer>

<!-- script -->
<?php echo $script_foot; ?>
<script src="<?php echo base_url(); ?>resource/scriptmedia/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>resource/scriptmedia/js/bootstrap.min.js"></script>

</body>
</html>
