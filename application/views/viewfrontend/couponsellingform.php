<div class="card main-content">
    <form class="g-3 needs-validation" novalidate method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/couponsellingform">
        <div class="card-body">
            <?php 
            if ($message != '') {
                ?>
            <small class="text-danger"><?php echo $message; ?></small>
                <?php
            }
            ?>
            <div class="form-group">
                <label for="couponNumber">Nomor Kupon</label>
                <input type="text" class="form-control couponnumber" id="couponNumber" name="couponNumber" placeholder="Tulis nomor pilihan anda" required onkeyup="onkeyupcoupon_number();" maxlength="4" value="<?php echo $formdata['couponNumber']; ?>">
                <!-- <small class="d-none text-danger" id="warningCoupon">Kupon sudah dipakai!</small> -->
            </div>
            <div class="form-group">
                <label for="memberName">Nama</label>
                <input type="text" maxlength="250" class="form-control" id="memberName" name="memberName" placeholder="Nama" required value="<?php echo $formdata['memberName'];?>">
            </div>
            <div class="form-group">
                <label for="memberEmail">Alamat Email</label>
                <input type="email" class="form-control" id="memberEmail" name="memberEmail" placeholder="Enter email" required value="<?php echo $formdata['memberEmail'];?>">
            </div>
            <div class="form-group">
                <label for="shipperAddress">Alamat Pengiriman Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="shipperAddress" name="shipperAddress" placeholder="Alamat Pengiriman Kupon" required value="<?php echo $formdata['shipperAddress'];?>">
            </div>
            <div class="form-group">
                <label for="memberPhone">Nomor Telepon</label>
                <input type="tel" pattern="[0-9]{12}" class="form-control" id="memberPhone" name="memberPhone" placeholder="Nomor Telepon" required value="<?php echo $formdata['memberPhone'];?>">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-secondary" name="submit" id="submit" value="submit">Selanjutnya</button>
        </div>
    </form>
</div>