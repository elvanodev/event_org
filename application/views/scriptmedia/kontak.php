              <h3 style="margin-left:8.33333%">Form Kontak</h3>
                <div class="col-md-4 col-md-offset-1">
                    
                    <strong>SMK Negeri 2 Simpang Empat</strong><br />
                    <strong>Office :</strong> Tanah Bumbu Batulicin
Kalimatan Selatan, Indonesia<br />
                    <strong>Phone :</strong> (0518) 74626<br />
                    <strong>Email :</strong> info@smkn2simpangempat.sch.id<br />
                    
                </div>
                <div class="col-md-7">
                <div class="content">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/ctrcontacus/kontaksubmit">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($name); ?>">
                                <?php echo "<p class='text-danger'>$errName</p>"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($email); ?>">
                                <?php echo "<p class='text-danger'>$errEmail</p>"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($message); ?></textarea>
                                <?php echo "<p class='text-danger'>$errMessage</p>"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
                                <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <?php echo $result; ?>    
                            </div>
                        </div>
                    </form>

                </div>
                </div>
           
       