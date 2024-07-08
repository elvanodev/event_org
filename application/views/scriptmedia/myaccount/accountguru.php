<div class="detailwidget">
<?php /*if (isset($row->judul)&&$row->judul!='undefined'){ ?><h3 class="heading"><?php echo $row->judul; ?></h3><?php } ?>
<?php if (isset($row->tanggal)&&$row->tanggal!='undefined'){ ?><i class="date"><?php $date=new DateTime($row->tanggal);echo $date->format('l \of F Y ');?></i><?php }*/ ?>
<div class="entry-list">
<h1> Profile </h1>
 <form method="POST" action="<?php echo base_url().'index.php/ctrmyaccountguru/changepassword';?>">  
     <?php 
     if ($guru['save']!=2){
     if($guru['save']==TRUE){ ?>
    <div class="alert alert-success" role="alert">Password anda berasil disimpan</div>

    <?php }
    if($guru['save']==FALSE){ ?>
    
    <div class="alert alert-warning" role="alert">Maaf penulisan password anda salah</div>

    <?php }
     } ?>
    <div class="row">
        <label class="col-sm-4 control-label">No Induk </label>
        <div class="col-sm-8">: <?php echo $guru['NIP'];?></div>
     </div>   

    <div class="row">
        <label class="col-sm-4 control-label">Nama Siswa </label>
        <div class="col-sm-8">: <?php echo $guru['NamaGuru'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Alamat </label>
        <div class="col-sm-8">: <?php echo $guru['Alamat'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">No Telephon </label>
        <div class="col-sm-8">: <?php echo $guru['NoTelephon'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Email </label>
        <div class="col-sm-8">: <?php echo $guru['Email'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Jabatan </label>
        <div class="col-sm-8">: <?php echo $guru['jabatan'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Profile</label>
        <div class="col-sm-8">: <?php echo $guru['profile'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">User </label>
        <div class="col-sm-8">: <?php echo $guru['user'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Password </label>
        <div class="col-sm-4">
        
         <input type="password" id="passwordguru" name="passwordguru" class="form-control" value="<?php echo $guru['password'];?>">
                 </div>
     </div>
<br />
<input type="submit" class="btn btn-info  col-sm-offset-4" value="Save"/>  
</form>    
</div>
</div>