<div class="card main-content">
    <form class="g-3 needs-validation" novalidate method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/couponsellingform/save">
        <div class="card-body">
            <div class="form-group">
                <label for="couponNumber">Nomor Kupon</label>
                <input type="text" class="form-control couponnumber" id="couponNumber" name="couponNumber" placeholder="Tulis nomor pilihan anda" required onkeyup="onkeyupcoupon_number();" maxlength="4" value="1234">
                <small class="d-none text-danger" id="warningCoupon">Kupon sudah dipakai!</small>
            </div>
            <div class="form-group">
                <label for="memberName">Nama</label>
                <input type="text" maxlength="250" class="form-control" id="memberName" name="memberName" placeholder="Nama" required value="jhon doe">
            </div>
            <div class="form-group">
                <label for="memberEmail">Alamat Email</label>
                <input type="email" class="form-control" id="memberEmail" name="memberEmail" placeholder="Enter email" required value="testtingemail@gmail.com">
            </div>
            <div class="form-group">
                <label for="shipperAddress">Alamat Pengiriman Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="shipperAddress" name="shipperAddress" placeholder="Alamat Pengiriman Kupon" required value="testing shipper address">
            </div>
            <div class="form-group">
                <label for="memberPhone">Nomor Telepon</label>
                <input type="tel" pattern="[0-9]{12}" class="form-control" id="memberPhone" name="memberPhone" placeholder="Nomor Telepon" required value="085736251726">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Selanjutnya</button>
        </div>
    </form>
</div>