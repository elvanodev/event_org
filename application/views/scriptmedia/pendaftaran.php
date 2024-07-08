<style>
    .error{
        color:red;
    }
</style>
<div class="container daftar py-5 px-0">
    <div class="row mb-4">
        <div class="col text-center">
            <h3>Registrasi Awal</h3>
            <p class="text-muted">Silahkan isi formulir Registrasi Awal berikut ini:</p>
            <hr>
        </div>
    </div>
    <form id="confirm" method="post" action="javascript:void(0)">

        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Peserta Didik</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednama" name="ednama" onchange="Capital_on_first_letter('ednama')" placeholder="Nama lengkap sesuai ijazah SD &amp; SMP">
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-8">
                <input type="text" class="form-control tanggal" name="edtanggallahir" id="edtanggallahir" placeholder="tanggallahir">
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8 radio">
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edjeniskelamin1" name="edjeniskelamin" value="L" class="custom-control-input">
                    <label class="custom-control-label" for="edjeniskelamin1">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edjeniskelamin2" name="edjeniskelamin" value="P" class="custom-control-input">
                    <label class="custom-control-label" for="edjeniskelamin2">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Alamat Email</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="edemail" id="edemail" placeholder="demo@gmail.com (Email aktif untuk notifikasi pembayaran dll.)" >
            </div>
        </div>
        <div class="form-group row">
            <!--<label for="nama" class="col-sm-4 col-form-label">Nomor WhatsApp</label>-->
            <label for="nama" class="col-sm-4 col-form-label">Nomor Handphone</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="ednohp" id="ednohp" placeholder="(Nomor HP aktif untuk notifikasi pembayaran dll.) Format : 62856xxxxx ">
                <!--<small><b>Format : 6280000000000</b> </small>-->
            </div>
        </div>

        <div class="form-group row mt-5">
            <div class="col text-center ">
                <!--<button type="button" class="btn btn-lg btn-ursuline px-5" onclick="dosimpanpendaftaranawal();">Daftar</button>-->
                <button type="submit" class="btn btn-lg btn-ursuline px-5" >Daftar</button>
            </div>
        </div>

    </form>
</div>
<script>
    if ($("#ednohp").val().trim().length === 0) {
        $("#ednohp").val(62);
    }
</script>
<script>
    /**
     * Comment
     */
    $(document).ready(function () {
        jQuery.validator.addMethod("tahunlahir", function (value, element) {
            var str = value;
            var res = str.split("-", 1);
            return res > 2000;
        }, "Usia anda telah melewati batas maksimum pendaftaran");
        jQuery.validator.addMethod("nama", function (value, element)
        {
            return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
        }, "Silahkan isi dengan huruf");
        jQuery.validator.addMethod("nohp", function (value, element)
        {
            return this.optional(element) || value.substr(0, 2) === '62';
        }, "Silahkan isi dengan format ex:620000000000");

//    if ($("#confirm").length > 0) {
        $("#confirm").validate({

            rules: {
                ednama: {
                    required: true,
                    maxlength: 50,
                    nama: true,
                },
                ednohp: {
                    required: true,
                    nohp: true,
                    digits: true,
                    minlength: 12,
                    maxlength: 16,
                },
                edtanggallahir: {
                    required: true,
                    date: true,
                    tahunlahir: true,
                },
                edemail: {
                    required: true,
                    maxlength: 50,
                    email: true,
                },
                edjeniskelamin: {
                    required: true,
                },
            },
            messages: {

                ednama: {
                    required: "Silahkan isi nama anda",
                    maxlength: "Maksimal karakter 50 karakter"
                },
                edjeniskelamin: {
                    required: "Silahkan pilih salah satu gender",
                },
                ednohp: {
                    required: "Silahkan isi no hp",
                    minlength: "No hp minimal 12 digit",
                    digits: "Silahkan isi nomor",
                    maxlength: "No hp maximal 16 digit",
                },
                edemail: {
                    required: "Silahkan isi email",
                    email: "Silahkan isi email yang <b><em>valid</em><b",
                    maxlength: "Silahkan isi tidak lebih dari atau sama dengan 20",
                },
                edtanggallahir: {
                    required: "silahkan isi tanggal lahir",
                    date: "Silahkan isi tanggal dengan format <b>YYYY-MM-DD</b>",
                },
            }, errorPlacement: function (error, element)
            {
                if (element.is(":radio"))
                {
                    error.appendTo(element.parents('.radio'));
                } else
                {
                    error.insertAfter(element);
                }
            }
            , submitHandler: function (form) {
                dosimpanpendaftaranawal();
//                $('#hasil').html($('#confirm').serialize());
            }
        });
    });



</script>