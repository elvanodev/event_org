<form class="g-3 needs-validation" novalidate method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/couponsellingform">
    <div class="card main-content bg-transparent border-0">
        <div class="card-body earth-2073">
            <?php
            if ($message != '') {
            ?>
                <small class="text-danger"><?php echo $message; ?></small>
            <?php
            }
            ?>
            <div class="form-group">
                <label for="couponNumber" class="text-white">Nomor Kupon</label>
                <input type="text" class="form-control couponnumber" id="couponNumber" name="couponNumber" placeholder="Tulis nomor pilihan anda" required onkeyup="onkeyupcoupon_number();" maxlength="4" value="<?php echo $formdata['couponNumber']; ?>">
            </div>
            <div class="form-group">
                <label for="memberName" class="text-white">Nama</label>
                <input type="text" maxlength="250" class="form-control" id="memberName" name="memberName" placeholder="Nama" required value="<?php echo $formdata['memberName']; ?>">
            </div>
            <div class="form-group">
                <label for="memberEmail" class="text-white">Alamat Email</label>
                <input type="email" class="form-control" id="memberEmail" name="memberEmail" placeholder="Enter email" required value="<?php echo $formdata['memberEmail']; ?>">
            </div>
            <div class="form-group">
                <label for="shipperAddress" class="text-white">Alamat Pengiriman Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="shipperAddress" name="shipperAddress" placeholder="Alamat Pengiriman Kupon" required value="<?php echo $formdata['shipperAddress']; ?>">
            </div>
            <div class="form-group">
                <label for="memberPhone" class="text-white">Nomor Telepon</label>
                <input type="tel" pattern="[0-9]{10,12}" class="form-control" id="memberPhone" name="memberPhone" placeholder="Nomor Telepon" required value="<?php echo $formdata['memberPhone']; ?>">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3 mb-4">
        <button type="submit" class="btn btn-secondary earth-2073 p-2 default-bg-color" name="submit" id="submit" value="submit">Selanjutnya</button>
    </div>
</form>