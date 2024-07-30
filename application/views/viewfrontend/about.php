<div class="card main-content">
    <div class="card-body text-light">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">                      
            <?php 
            $i = 0;
            $active = 'active';
            $selected = 'true';
            foreach ($list_abouts as $row) {
                if ($i == 0) {
                    $active = 'active';
                    $selected = 'true';
                } else {
                    $active = '';
                    $selected = 'false';
                }
                $i++;
            ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $active; ?>" id="pills-<?php echo $row->idx; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $row->idx; ?>" type="button" role="tab" aria-controls="pills-<?php echo $row->idx; ?>" aria-selected="<?php echo $selected; ?>"><?php echo $row->about_title; ?></button>
            </li>            
            <?php
            } ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">                              
            <?php 
            $i = 0;
            $active = '';
            foreach ($list_abouts as $row) {
                if ($i == 0) {
                    $active = 'show active';
                } else {
                    $active = '';
                }
                $i++;
            ?>
            <div class="tab-pane fade <?php echo $active; ?>" id="pills-<?php echo $row->idx; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $row->idx; ?>-tab" tabindex="0"><?php echo $row->about_detail; ?></div>          
            <?php
            } ?>
        </div>
    </div>
</div>