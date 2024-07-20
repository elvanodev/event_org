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
            <div class="form-group">
                <label for="coupon_price">Harga Kupon</label>
                <input type="text" maxlength="250" class="form-control" id="coupon_price" name="coupon_price" placeholder="Harga Kupon" required value="<?php echo $formdata['coupon_price'];?>" readonly>
            </div>
            <div class="form-group">
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
            <div class="form-group">
                <label for="total_price">Total Biaya</label>
                <input type="text" maxlength="250" class="form-control" id="total_price" name="total_price" placeholder="Total Biaya" required value="<?php echo $formdata['total_price'];?>" readonly>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-light" name="submit" id="submit" value="submit">Lanjut Pembayaran</button>
        </div>
    </form>
</div>