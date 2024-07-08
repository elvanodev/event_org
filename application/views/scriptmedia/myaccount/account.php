<div class="entry-list">
<h1> Profile </h1>
 <form method="POST" action="<?php echo base_url().'index.php/ctrmyaccount/changepassword';?>">  
     <?php 
     if ($siswa['save']!=2){
     if($siswa['save']==TRUE){ ?>
    <div class="alert alert-success" role="alert">Password anda berasil disimpan</div>

    <?php }
    if($siswa['save']==FALSE){ ?>
    
    <div class="alert alert-warning" role="alert">Maaf penulisan password anda salah</div>

    <?php }
     } ?>
    <div class="row">
        <label class="col-sm-4 control-label">NIK </label>
        <div class="col-sm-8">: <?php echo $siswa['NIK'];?></div>
     </div>   
<div class="row">
        <label class="col-sm-4 control-label">NIKFO </label>
        <div class="col-sm-8">: <?php echo $siswa['NIKFO'];?></div>
     </div>
    <div class="row">
        <label class="col-sm-4 control-label">Nama Member </label>
        <div class="col-sm-8">: <?php echo $siswa['Nama'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Alamat </label>
        <div class="col-sm-8">: <?php echo $siswa['Alamat'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">No Telepon </label>
        <div class="col-sm-8">: <?php echo $siswa['NoTelpon'];?></div>
     </div>   
    
    <div class="row">
        <label class="col-sm-4 control-label">Email </label>
        <div class="col-sm-8">: <?php echo $siswa['Email'];?></div>
     </div>   
    <div class="row">
        <label class="col-sm-4 control-label">Password </label>
        <div class="col-sm-4">
        
         <input type="password" id="passwordsiswa" name="passwordsiswa" class="form-control" value="<?php echo $siswa['password'];?>">
                 </div>
     </div>
<br />
<input type="submit" class="btn btn-info  col-sm-offset-4" value="Save"/>  
</form>    
</div>
