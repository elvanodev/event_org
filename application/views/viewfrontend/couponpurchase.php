<div class="main-content text-center">
    <div class="rotate-10 text-center">
        <h3 class="la-belle-aurore-regular">
            Anda telah behasil memilih nomor, <br>selanjutnya anda akan membeli kupon
        </h3>
    </div>
    <img class="img-fluid img-event" src="<?php echo base_url(); ?>/resource/uploaded/img/<?php echo $header['event']->poster_image; ?>" />
    <div class="text-center">
        <h3 class="earth-2073"><?php echo $formdata['selected_coupon_number']; ?></h3>
    </div>
</div>
<form class="g-3 needs-validation" novalidate method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/couponpurchase">
    <div class="card main-content bg-transparent border-0">
        <div class="card-body earth-2073">
            <?php
            if ($message != '') {
            ?>
                <small class="text-danger"><?php echo $message; ?></small>
            <?php
            }
            ?>
            <div class="form-group mt-2">
                <label for="coupon_price" class="text-white">Harga Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="coupon_price" name="coupon_price" placeholder="Harga Kupon" required value="<?php echo $formdata['coupon_price']; ?>" readonly>
            </div>
            <div class="form-group mt-2">
                <label for="shipper_id" class="text-white">Ongkir</label>
                <select class="form-select" id="shipper_id" name="shipper_id" aria-label="Ongkir" onchange="onchangeshipper_id()" required>
                    <?php foreach ($formdata['arrayongkir'] as $key => $value) {
                        if ($key == $form['shipper_id']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                    ?>
                        <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                    } ?>
                </select>
            </div>
            <small class="text-white">Kupon akan dikirim ke alamat anda setelah dikonfirmasi oleh admin, biaya ongkir ditanggung oleh pembeli, silahkan pilih kategoti alamat anda</small>
            <div class="form-group mt-2">
                <label for="total_price" class="text-white">Total Biaya</label>
                <input type="text" maxlength="250" class="form-control" id="total_price" name="total_price" placeholder="Total Biaya" required value="<?php echo $formdata['total_price']; ?>" readonly>
            </div>
            <small class="text-white">Silahkan melakukan pembayaran dengan klik link dibawah
                 <br><span><a href="http://saweria.co/dermawanseni" target="_blank" class="text-white default-bg-color btn">LINK PEMBAYARAN</a></span>
                 <br>lalu upload bukti pembayaran
            </small>
            <div class="mt-3 text-white">
                <div id="uploadpayment_confirm_receipt" style="width:300px;">
                    <input type="text" class="form-control" alt="Upload Bukti Pembayaran" id="payment_confirm_receipt" name="payment_confirm_receipt" />
                </div>
            </div>
            <small class="text-white">Klik Konfirmasi Pembayaran, jika sudah upload bukti pembayaran</small>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3 mb-4">
        <button type="submit" class="btn btn-secondary earth-2073 p-2 default-bg-color" name="submit" id="submit" value="submit">Konfirmasi Pembayaran</button>
    </div>
</form>