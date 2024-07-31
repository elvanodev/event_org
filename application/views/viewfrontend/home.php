<section class="testimonial-section">
    <div class="d-flex justify-content-end" id="testimonialButton">
        <button type="button" id="testimonialCardOpen" class="btn text-light">Lihat Komentar <i class="fa-solid fa-comment"></i></button>
    </div>    
    <div class="card" id="testimonialCard">
        <div class="card-body text-light">   
            <?php 
            date_default_timezone_set('Asia/Jakarta');
            foreach ($list_testimonials as $row) {
                $testimoni_time = $row->created_at;
                $testimoni_time1 = new DateTime($testimoni_time);
                $current_date = new DateTime();
                $diff = $testimoni_time1->diff($current_date);
                $time_left = $diff->format('%h');
            ?>
            <div class="border-bottom">
                <div class="d-flex justify-content-between">
                    <strong><?php echo $row->member_name; ?></strong>
                    <?php echo $time_left; ?>H ago
                </div>
                <br>
                <p><?php echo $row->testimoni_text; ?></p>
            </div>
            <?php
            } ?>
            <a href="<?php echo base_url();?>frontend/testimonials" class="text-white">Komentar Lainnya</a>
        </div>
    </div>
</section>
<section class="countdown-section">
    <div class="countdown-img-rotate">
        <img src="<?php echo base_url(); ?>/resource/images/countdown.png" class="img-fluid"/>
        <div class="cd-day text-center">
            <div class="text-white"><h1 class="earth-2073" id="cdDay">00</h1></div>
            <div class="text-white"><h2 class="la-belle-aurore-regular">Hari</h2></div>
        </div>
        <div class="cd-hour text-center">
            <div class="text-white"><h1 class="earth-2073" id="cdHour">00</h1></div>
            <div class="text-white"><h2 class="la-belle-aurore-regular">Jam</h2></div>
        </div>
        <div class="cd-minute text-center">
            <div class="text-white"><h1 class="earth-2073" id="cdMinute">00</h1></div>
            <div class="text-white"><h2 class="la-belle-aurore-regular">Mnt.</h2></div>
        </div>
        <div class="cd-second text-center">
            <div class="text-white"><h1 class="earth-2073" id="cdSecond">00</h1></div>
            <div class="text-white"><h2 class="la-belle-aurore-regular">Det.</h2></div>
        </div>
    </div>
</section>