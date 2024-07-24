<div class="card main-content bg-transparent">
    <div class="card-body text-light">
        <div class="row">
            <div class="col-5">
                <h3>Info</h3>
                <p><strong>Contact</strong></p>
                <p><?php echo $event->contact_phone;?><br>
                <?php echo $event->contact_email;?></p>
                <a href="http://wa.me/<?php echo $event->contact_phone;?>" target="_blank" type="button" class="btn btn-secondary">Hubungi Kami</a>
            </div>
            <div class="col-7">
                <p><strong>Lokasi Agen</strong></p>
                <p>
                    <?php echo $event->agent_open_date;?> - <?php echo $event->agent_close_date;?>
                    <br>
                    <?php echo $event->agent_open_time;?> - <?php echo $event->agent_close_time;?>
                </p>
                <p>
                    <?php echo $event->agent_address;?>
                </p>
                <div class="iframe-rwd">
                    <?php echo $event->agent_gmap;?>
                </div>
            </div>
        </div>
    </div>
</div>