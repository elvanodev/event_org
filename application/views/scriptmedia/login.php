<div class="row">
    <div class="col text-center px-0 mb-5 mb-md-0">
        <form class="form-signin">
            <h1 class="h3 mb-3">Silahkan Masuk</h1>
            <p class="mt-3 mb-4 small text-muted">Gunakan Email &amp; Password yang Anda dapat dari Email konfirmasi</p>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="edUser" class="form-control" placeholder="Email" pattern="^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="edPassword" class="form-control mb-3" placeholder="Password" required>
           <div class="custom-control custom-checkbox float-left w-100 text-left">
                <input type="checkbox" class="custom-control-input" id="show">
                <label class="custom-control-label text-muted float-left" for="show">Show Password</label>
            </div>
            <div class="custom-control custom-checkbox float-left">
                <input type="checkbox" class="custom-control-input" id="ingat">
                <label class="custom-control-label text-muted" for="ingat">Ingat Saya</label>
            </div>
            <div class="float-right text-left">
                <span class="small text-muted">Belum punya akun? <a href='<?php base_url() . '/index.php/show/pendaftaran'; ?>pendaftaran'>Daftar</a><br>
                    Lupa Password? <a href='Forgotpassword'>Kirim ulang</a></span>
            </div>
            <div class="clearfix"></div>
            <button class="btn btn-lg btn-ursuline px-5 mt-4" type="button" onclick="dologin();">Masuk</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#show').click(function () {
            if ($(this).is(':checked')) {
                $('#edPassword').attr('type', 'text');
            } else {
                $('#edPassword').attr('type', 'password');
            }
        });
    });
</script>