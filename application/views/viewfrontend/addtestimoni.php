<form class="g-3 needs-validation" novalidate method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>frontend/addtestimoni">
    <input type="hidden" name="edcoupon_id" id="edcoupon_id" value="" />
    <input type="hidden" name="edevent_name" id="edevent_name" value="" />
    <div class="card main-content bg-transparent border-0">
        <div class="card-body earth-2073">
            <?php
            if ($message != '') {
            ?>
            <div class="rounded bg-white text-center">
                <p class="text-danger"><?php echo $message; ?></p>
            </div>
            <?php
            }
            ?>
            <br>
            <small class="text-white">
            Terima Kasih telah mendukung Program Sumbangsih Dermawan Seni Berhadiah. anda mempunyai Hak satu (1) kali untuk memberikan komentar (kritik, saran, dan lainnya) berkaitan dengan Seni dan Kebudayaan indonesia.
            </small>
            <br>
            <br>
            <small class="text-white">Scan QR disini untuk memasukan kode QR anda</small>
            <div id="reader" width="600px"></div>
            <small class="text-white">atau input Kode QR disini</small>
            <div class="form-group">
                <label for="edqr_code" class="text-white">Kode QR</label>
                <input type="text" class="form-control" id="edqr_code" name="edqr_code" placeholder="Kode QR" required value="<?php echo $formdata['edqr_code']; ?>">
            </div>
            <div class="form-group">
                <label for="edcoupon_number" class="text-white">Nomor Kupon</label>
                <input type="text" class="form-control couponnumber" id="edcoupon_number" name="edcoupon_number" required readonly value="<?php echo $formdata['edcoupon_number']; ?>">
            </div>
            <div class="form-group">
                <label for="edmember_name" class="text-white">Nama</label>
                <input type="text" maxlength="250" class="form-control" id="edmember_name" name="edmember_name" placeholder="Nama" required readonly value="<?php echo $formdata['edmember_name']; ?>">
            </div>
            <div class="form-group">
                <label for="edusername" class="text-white">Username</label>
                <input type="text" maxlength="250" class="form-control" id="edusername" name="edusername" placeholder="Username" required value="<?php echo $formdata['edusername']; ?>">
                <small class="text-white">Nama yang muncul di kolom komentar hanyalah 
                user name </small>
            </div>
            <div class="form-group">
                <label for="edtestimoni_text" class="text-white">Komentar</label>
                <textarea type="text" maxlength="1000" class="form-control" id="edtestimoni_text" name="edtestimoni_text" placeholder="Tulisakan Komentarmu" required><?php echo $formdata['edtestimoni_text']; ?></textarea>
            </div>
            <!-- <div class="form-group">
                <label for="edtestimoni_photo" class="text-white">Photo</label>
                <div id="uploadtestimoni_photo" style="width:150px;">
                    <input type="text" class="form-control" id="edtestimoni_photo" name="edtestimoni_photo" placeholder="Upload Photo" alt="Unggah Foto" required value="<?php echo $formdata['edtestimoni_photo']; ?>">
                </div>
            </div> -->
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3 mb-4">
        <button type="submit" class="btn btn-secondary earth-2073 p-2 default-bg-color" name="submit" id="submit" value="submit">Upload Komentar</button>
    </div>
</form>