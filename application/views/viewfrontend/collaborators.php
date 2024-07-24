<div class="card main-content bg-transparent">
    <div class="card-body">
        <div class="row">
            <?php foreach ($list_collaborators as $row) {
            ?>
                <div class="col-4">
                    <div class="p-2 border border-success rounded collaboratorPoster" onclick="onclickcollaborators(<?php echo $row->idx; ?>)">
                        <img class="img-fluid imgPoster" style="min-height: 325px;" src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->poster_img; ?>">
                        <div class="d-none text-center text-light quoteArtist" style="min-height: 325px;">
                            <h3><?php echo $row->artist_name; ?></h3>
                            <img src="<?php echo base_url(); ?>resource/uploaded/img/<?php echo $row->event_icon; ?>" class="img-fuild" />
                            <p class="align-bottom"><?php echo $row->quote; ?></p>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<!-- Modal Collaborator -->
<div class="modal fade" id="modalCollaborators" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-primary text-light">
            <div class="modal-header">
                <div class="text-light w-100 d-flex justify-content-between">
                    <p>
                        <span>Share Artist Profile</span>
                        <br>
                        <a href="#" target="_blank" class="text-light" id="waLink"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" target="_blank" class="text-light"  id="instagramLink"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" target="_blank" class="text-light"  id="twitterLink"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" target="_blank" class="text-light"  id="mailLink"><i class="fa-solid fa-envelope"></i></a>
                    </p>
                    <button type="button" class="close btn text-light" onclick="onclickclose()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" id="artistPhoto">
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <h3 id="artistName"></h3>
                            </div>
                            <div class="col-12">
                                <p id="bornPlaceDate" class="text-light"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-12 text-light p-3">
                <p class="justify" id="artistBio"></p>
            </div>
        </div>
    </div>
</div>