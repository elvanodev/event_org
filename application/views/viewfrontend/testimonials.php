<div class="d-flex justify-content-center mt-3 mb-4">
    <a href="<?php echo base_url(); ?>frontend/addtestimoni" class="btn btn-secondary earth-2073 p-2 default-bg-color">Upload Komentar Anda</a>
</div>
<div class="card main-content default-bg-color">
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
    </div>
</div>