<style>
    .error{
        color: red;
    }
</style>
<div class="container daftar py-5 px-0">
    <div class="row mb-4">
        <div class="col text-center">
            <h3>Lupa Password?</h3>
            <p class="text-muted">Silahkan isi formulir berikut dengan data akun sebelumnya.<br>Kami akan mengirim ulang Password ke Email Anda.</p>
            <hr>
        </div>
    </div>
    <div id="hasil"></div>
    <div id="confirm">
        <form id="confirmforgotpassword" method="post" action="javascript:void(0)" enctype="multipart/form-data"> 

            <div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label">Alamat Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="edemail" id="edemail" placeholder="Email akun sebelumnya">
                </div>
            </div>


            <div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control tanggal" name="edtanggallahir" id="edtanggallahir"  placeholder="tanggallahir" >
                </div>
            </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label">Nomor WhatsApp</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="ednohp" id="ednohp" placeholder="Nomor WhatsApp akun sebelumnya">
                </div>
            </div>

            <div class="form-group row mt-5">
                <div class="col text-center ">
                    <!--<button type="button" class="btn btn-lg btn-ursuline px-5" onclick="doforgotpassword();">Kirim</button>-->
                    <button type="button" id="validasiforgotpassword" class="btn btn-lg btn-ursuline px-5" >Kirim</button>
                </div>
            </div>

        </form>
    </div>
</div>