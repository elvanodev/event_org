<div class="card main-content">
    <form class="g-3 needs-validation" novalidate method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/couponpurchase">
        <div class="card-body">
            <?php 
            if ($message != '') {
                ?>
            <small class="text-danger"><?php echo $message; ?></small>
                <?php
            }
            ?>
            <small class="text-success">Nomor kupon yang dipilih : <?php echo $formdata['selected_coupon_number']; ?></small>
            <div class="form-group mt-2">
                <label for="coupon_price">Harga Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="coupon_price" name="coupon_price" placeholder="Harga Kupon" required value="<?php echo $formdata['coupon_price'];?>" readonly>
            </div>
            <div class="form-group mt-2">
                <label for="shipper_id">Ongkir</label>
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
            <small>Kupon akan dikirim ke alamat anda setelah dikonfirmasi oleh admin, biaya ongkir ditanggung oleh pembeli, silahkan pilih kategoti alamat anda</small>
            <div class="form-group mt-2">
                <label for="total_price">Total Biaya</label>
                <input type="text" maxlength="250" class="form-control" id="total_price" name="total_price" placeholder="Total Biaya" required value="<?php echo $formdata['total_price'];?>" readonly>
            </div>
            <a href="https://ipaymu.com/id/link-payment/" target="_blank" rel="noopener noreferrer" class="btn btn-secondary mt-2">Link Pembayaran</a>
            <br>
            <small>Gunakan link di atas untuk melakukan transaksi beli kupon</small>
            <div class="mt-3">
                <div id="uploadpayment_confirm_receipt" style="width:300px;">
                    <input type="text" class="form-control" alt="Upload Bukti Pembayaran" id="payment_confirm_receipt" name="payment_confirm_receipt"/>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-secondary" name="submit" id="submit" value="submit">Konfirmasi Pembayaran</button>
            <br>
        </div>
    </form>
</div>