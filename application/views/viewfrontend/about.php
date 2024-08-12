<div class="main-content-tab default-bg-color-tab">
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
            <button class="nav-link earth-2073 <?php echo $active; ?>" id="pills-<?php echo $row->idx; ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $row->idx; ?>" type="button" role="tab" aria-controls="pills-<?php echo $row->idx; ?>" aria-selected="<?php echo $selected; ?>"><?php echo $row->about_title; ?></button>
        </li>            
        <?php
        } 
        if (sizeof($list_dermawan) > 0) {   
        ?>                       
        <li class="nav-item" role="presentation">
            <button class="nav-link earth-2073" id="pills-dermawan-tab" data-bs-toggle="pill" data-bs-target="#pills-dermawan" type="button" role="tab" aria-controls="pills-dermawan" aria-selected="false">Dermawan</button>
        </li>     
        <?php
        }
        ?>

    </ul>
</div>
<div class="card main-content default-bg-color">
    <div class="card-body text-light">
        
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
            <div class="tab-pane fade <?php echo $active; ?>" id="pills-<?php echo $row->idx; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $row->idx; ?>-tab" tabindex="0">                            
                <?php echo $row->about_detail; ?>
            </div>          
            <?php
            } 
            if (sizeof($list_dermawan) > 0) {   
            ?>        
            <div class="tab-pane fade" id="pills-dermawan" role="tabpanel" aria-labelledby="pills-dermawan-tab" tabindex="0">                            
                <div class="row">
                    <?php foreach ($list_dermawan as $row) {
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                         <div class="text-white text-center">
                            <p class="earth-2073"><strong><?php echo $row->name;?></strong></p>
                            <p class="text-justify"><?php echo $row->quote;?></p>
                         </div>
                        </div>
                        <?php
                    }?>
                </div>
            </div>       
            <?php
            }?>
        </div>
    </div>
</div>