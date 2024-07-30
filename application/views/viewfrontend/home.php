<section class="testimonial-section">
    <div class="card">
        <div class="card-body text-light">   
            <div class="d-flex justify-content-end">
                <button type="button" class="btn text-white close">&times;</button> 
            </div>    
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