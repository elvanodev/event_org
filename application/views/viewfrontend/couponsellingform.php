<div class="card main-content">
    <form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/couponsellingfromsave">
        <div class="card-body">
            <div class="form-group">
                <label for="couponNumber">Pilih Coupon</label>
                <input type="text" class="form-control" id="couponNumber" aria-describedby="couponNumberHelp" placeholder="Pilih Coupon">
                <small id="couponNumberHelp" class="form-text text-muted">Tulis nomor pilihan anda</small>
            </div>
            <div class="form-group">
                <label for="memberName">Nama</label>
                <input type="text" maxlength="250" class="form-control" id="memberName" placeholder="Nama">
            </div>
            <div class="form-group">
                <label for="memberEmail">Alamat Email</label>
                <input type="email" class="form-control" id="memberEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="shipperAddress">Alamat Pengiriman Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="shipperAddress" placeholder="Alamat Pengiriman Kupon">
            </div>
            <div class="form-group">
                <label for="memberPhone">Nomor Telepon</label>
                <input type="tel"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" id="memberPhone" placeholder="Nomor Telepon">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-light">Selanjutnya</button>
        </div>
    </form>
</div>