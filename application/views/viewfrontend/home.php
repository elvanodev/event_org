<div class="card main-content bg-transparent">
    <div class="card-body text-light">        
        <?php 
        date_default_timezone_set('UTC');
        foreach ($list_posts as $row) {
            $uploaded_at = $row->uploaded_at;
            $uploaded_at1 = new DateTime($uploaded_at);
            $current_date = new DateTime();
            $diff = $uploaded_at1->diff($current_date);
            $time_left = $diff->format('%h');
        ?>
        <div class="border-bottom">
            <div class="d-flex justify-content-between">
                <strong><?php echo $row->name; ?></strong>
                <?php echo $time_left; ?>H ago
            </div>
            <br>
            <p><?php echo $row->post_text; ?></p>
        </div>
        <?php
        } ?>
    </div>
</div>