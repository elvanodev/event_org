<div class="card main-content">
    <div class="card-body text-light">
        <div class="row">
            <div class="col-5">
                <h3>Info</h3>
                <p><strong>Contact</strong></p>
                <p><?php echo $event->contact_phone; ?><br>
                    <?php echo $event->contact_email; ?></p>
                <a href="http://wa.me/<?php echo $event->contact_phone; ?>" target="_blank" type="button" class="btn btn-secondary">Hubungi Kami</a>
            </div>
            <div class="col-7">
                <p><strong>Lokasi Agen</strong></p>
                <p>
                    <?php echo $event->agent_open_date; ?> - <?php echo $event->agent_close_date; ?>
                    <br>
                    <?php echo $event->agent_open_time; ?> - <?php echo $event->agent_close_time; ?>
                </p>
                <p>
                    <?php echo $event->agent_address; ?>
                </p>
                <div class="iframe-rwd">
                    <?php echo $event->agent_gmap; ?>
                </div>
            </div>
        </div>
        <h3>FAQs</h3>
        <div class="accordion" id="accordionFaqs">            
            <?php foreach ($list_faqs as $row) {
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row->idx; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row->idx; ?>">
                        <?php echo $row->faq_title; ?>
                    </button>
                </h2>
                <div id="collapse<?php echo $row->idx; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFaqs">
                    <div class="accordion-body">
                        <?php echo $row->faq_detail; ?>
                    </div>
                </div>
            </div>
            <?php
            } ?>
        </div>
    </div>
</div>