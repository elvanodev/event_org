<!-- page content -->
<main role="main" class="container daftar p-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h3>Form Data Siswa </h3>
            <p class="text-muted">Silahkan isi formulir Pendaftaran Siswa berikut ini:</p>
            <hr>
        </div>
    </div>
    <!--    Start Form Data Diri Calon Siswa-->
    <form>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Peserta Didik <br><i><small> Sesuai Ijazah SD & SMP</small></i> </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednama" name="ednama" placeholder="Nama Lengkap" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Panggilan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednamapanggilan" name="ednamapanggilan" placeholder="Nama Panggilan" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edjeniskelamin1" name="edjeniskelamin" value="L" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edjeniskelamin1">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edjeniskelamin2" name="edjeniskelamin" value="P" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edjeniskelamin2">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">No KK</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednokk" name="ednokk" placeholder="No KK" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">NIK (No Induk Kependudukan)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednik" name="ednik" placeholder="No Induk Kependudukan" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Punya PIP</label>
            <div class="col-sm-8">
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edpip1" name="edpip" value="Y" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edpip1">Punya</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edpip2" name="edpip" value="N" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edpip2">Tidak Punya</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">No PIP</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednopip" name="ednopip" placeholder="No PIP"  >
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Tempat/Tanggal Lahir</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="edtempatlahir" name="edtempatlahir" placeholder="Tempat Lahir" required="required">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control tanggal" name="edtanggallahir" id="edtanggallahir"  placeholder="tanggallahir" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Agama</label>
            <div class="col-sm-3">
                <!--<input type="text" class="form-control" id="ednopip" name="ednopip" placeholder="No PIP">-->
                <select class="form-control" id="edagama" name="edagama" required="required">
                    <option value="">-Pilih-</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Islam">Islam</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Hindu">Hindu </option>
                    <option value="Budha">Budha </option>
                </select>
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="ednamagereja" id="ednamagereja"  placeholder="Nama Gereja" >
                <input type="text" class="form-control" name="ednamabaptis" id="ednamabaptis"  placeholder="Nama Baptis (bagi katolik)" >
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Golongan Darah</label>
            <div class="col-sm-8">
                <!--<input type="text" class="form-control" id="ednopip" name="ednopip" placeholder="No PIP">-->
                <select class="form-control" id="edgolongandarah" name="edgolongandarah">
                    <option value="">-Pilih golongan darah-</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Kewarganegaraan</label>
            <div class="col-sm-8">
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edkewaganegaraan1" name="edkewaganegaraan" value="WNI" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edkewaganegaraan1">Warga Negara Indonesia (WNI)</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edkewaganegaraan2" name="edkewaganegaraan" value="WNA" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edkewaganegaraan2">Warga Negara Asing (WNA)</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Alamat sesuai KK</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edalamatkk" name="edalamatkk" placeholder="Alamat sesuai KK" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Alamat Domisili</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edalamatdomisli" name="edalamatdomisli" placeholder="Alamat Domisili" required="required">
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Provinsi</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidprovinisi" name="edidprovinisi" required="required">
                            <option value="">-Pilih Provinsi-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Kabupaten</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidkabupaten" name="edidkabupaten" required="required">
                            <option value="">-Pilih Kabupaten-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Kecamatan</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidkecamatan" name="edidkecamatan" required="required">
                            <option value="">-Pilih Kecamatan-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Kelurahan</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidkelurahan" name="edidkelurahan" required="required">
                            <option value="">-Pilih Kelurahan-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Kode Pos</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="edkodepos" name="edkodepos" required="required">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Status Calon</label>
            <div class="col-sm-8">
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"> <small>Anak Ke</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edanakke" name="edanakke" required="required">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Jum Sdr Kandung</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edjumlahsaudarakandung" name="edjumlahsaudarakandung" >
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Jum Sdr Angkat</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edjumlahsaudaraangkat" name="edjumlahsaudaraangkat">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Jum Sdr Tiri</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edjumlahsaudaratiri" name="edjumlahsaudaratiri">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Calon adl Anak</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edcalonadalahanak" name="edcalonadalahanak" required="required">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Jarak Tempat Tinggal <small> Ke SMA Regina Pacis</small></label>
            <div class="col-sm-8">
                <select class="form-control" id="edjaraktempattinggalkesma" name="edjaraktempattinggalkesma">
                    <option value="">-Pilih-</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Tinggi Badan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edtinggibadan" name="edtinggibadan" placeholder="Tinggi Badan (Cm)" >
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Berat Badan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edberatbadan" name="edberatbadan" placeholder="Berat Badan (Kg)" >
            </div>
        </div>
        <div class="form-group row mt-5">
            <div class="col text-center">
                <button type="submit" class="btn btn-lg btn-ursuline px-5" onclick="">Daftar</button>
            </div>
        </div>

    </form>
    <!--    End Form Data Diri Calon Siswa-->

    <!--    Start Form Data Diri Ayah Calon Siswa-->
    <form>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Ayah </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ednamalengkapayah" name="ednamalengkapayah" placeholder="Nama Lengkap Ayah" required="required">
                <input type="hidden" class="form-control" id="edidsiswa" name="edidsiswa" value="">
            </div>
        </div>
        <!--        <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Panggilan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ednamapanggilan" name="ednamapanggilan" placeholder="Nama Panggilan" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <div class="custom-control custom-radio custom-control-inline align-items-center">
                            <input type="radio" id="edjeniskelamin1" name="edjeniskelamin" value="L" class="custom-control-input" required="required">
                            <label class="custom-control-label" for="edjeniskelamin1">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline align-items-center">
                            <input type="radio" id="edjeniskelamin2" name="edjeniskelamin" value="P" class="custom-control-input" required="required">
                            <label class="custom-control-label" for="edjeniskelamin2">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">No KK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ednokk" name="ednokk" placeholder="No KK" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">NIK (No Induk Kependudukan)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ednik" name="ednik" placeholder="No Induk Kependudukan" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Punya PIP</label>
                    <div class="col-sm-8">
                        <div class="custom-control custom-radio custom-control-inline align-items-center">
                            <input type="radio" id="edpip1" name="edpip" value="Y" class="custom-control-input" required="required">
                            <label class="custom-control-label" for="edpip1">Punya</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline align-items-center">
                            <input type="radio" id="edpip2" name="edpip" value="N" class="custom-control-input" required="required">
                            <label class="custom-control-label" for="edpip2">Tidak Punya</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">No PIP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ednopip" name="ednopip" placeholder="No PIP"  >
                    </div>
                </div>-->
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Tempat/Tanggal Lahir</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="edtempatlahirayah" name="edtempatlahirayah" placeholder="Tempat Lahir" required="required">
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control tanggal" name="edtanggallahirayah" id="edtanggallahirayah"  placeholder="tanggal lahir" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Agama</label>
            <div class="col-sm-3">
                <select class="form-control" id="edagamaayah" name="edagamaayah" required="required">
                    <option value="">-Pilih-</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Islam">Islam</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Hindu">Hindu </option>
                    <option value="Budha">Budha </option>
                </select>
            </div>
            <!--            <div class="col-sm-5">
                            <input type="text" class="form-control" name="ednamagereja" id="ednamagereja"  placeholder="Nama Gereja" >
                            <input type="text" class="form-control" name="ednamabaptis" id="ednamabaptis"  placeholder="Nama Baptis (bagi katolik)" >
                        </div>-->
        </div>
        <!--        <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Golongan Darah</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ednopip" name="ednopip" placeholder="No PIP">
                        <select class="form-control" id="edgolongandarah" name="edgolongandarah">
                            <option value="">-Pilih golongan darah-</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </div>-->
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Kewarganegaraan</label>
            <div class="col-sm-8">
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edkewarganegaraanayah1" name="edkewarganegaraanayah" value="WNI" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edkewarganegaraanayah1">Warga Negara Indonesia (WNI)</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline align-items-center">
                    <input type="radio" id="edkewarganegaraanayah2" name="edkewarganegaraanayah" value="WNA" class="custom-control-input" required="required">
                    <label class="custom-control-label" for="edkewarganegaraanayah2">Warga Negara Asing (WNA)</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Pendidikan Terakhir</label>
            <div class="col-sm-3">
                <select class="form-control" id="edpendidikanterakhirayah" name="edpendidikanterakhirayah" required="required">
                    <option value="">-Pilih-</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="D1-D2">D1-D2</option>
                    <option value="D3">D3 </option>
                    <option value="S1">S1 </option>
                    <option value="S2">S2 </option>
                    <option value="S3">S3 </option>
                    <option value="Lainnya">Lainnya </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Pekerjaan</label>
            <div class="col-sm-3">
                <select class="form-control" id="edpekerjaanayah" name="edpekerjaanayah" required="required">
                    <option value="">-Pilih-</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="PNS">PNS</option>
                    <option value="TNI">TNI</option>
                    <option value="PLORI">POLRI </option>
                    <option value="Lainnya">Lainnya </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Pangkat/Jabatab</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edpangkatjabatanayah" name="edpangkatjabatanayah" placeholder="pangkat jabatan ayah" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Penghasilan Perbulan</label>
            <div class="col-sm-3">
                <select class="form-control" id="edpenghasilanperbulanayah" name="edpenghasilanperbulanayah" required="required">
                    <option value="">-Pilih-</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                    <option value="PNS">PNS</option>
                    <option value="TNI">TNI</option>
                    <option value="PLORI">POLRI </option>
                    <option value="Lainnya">Lainnya </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Alamat sesuai KK</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edalamatkk" name="edalamatkk" placeholder="Alamat sesuai KK" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Alamat Domisili</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edalamatdomisli" name="edalamatdomisli" placeholder="Alamat Domisili" required="required">
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Provinsi</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidprovinisi" name="edidprovinisi" required="required">
                            <option value="">-Pilih Provinsi-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Kabupaten</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidkabupaten" name="edidkabupaten" required="required">
                            <option value="">-Pilih Kabupaten-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Kecamatan</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidkecamatan" name="edidkecamatan" required="required">
                            <option value="">-Pilih Kecamatan-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Kelurahan</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edidkelurahan" name="edidkelurahan" required="required">
                            <option value="">-Pilih Kelurahan-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Kode Pos</label>
                    <div class="col-sm-8">
                        <input class="form-control" id="edkodepos" name="edkodepos" required="required">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Status Calon</label>
            <div class="col-sm-8">
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"> <small>Anak Ke</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edanakke" name="edanakke" required="required">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Jum Sdr Kandung</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edjumlahsaudarakandung" name="edjumlahsaudarakandung" required="required">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Jum Sdr Angkat</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edjumlahsaudaraangkat" name="edjumlahsaudaraangkat">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Jum Sdr Tiri</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edjumlahsaudaratiri" name="edjumlahsaudaratiri">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label"><small>Calon adl Anak</small></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="edcalonadalahanak" name="edcalonadalahanak" required="required">
                            <option value="">-Pilih-</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Jarak Tempat Tinggal <small> Ke SMA Regina Pacis</small></label>
            <div class="col-sm-8">
                <select class="form-control" id="edjaraktempattinggalkesma" name="edjaraktempattinggalkesma">
                    <option value="">-Pilih-</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Tinggi Badan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edtinggibadan" name="edtinggibadan" placeholder="Tinggi Badan (Cm)" >
            </div>
        </div>
        <div class="form-group row">
            <label for="nama" class="col-sm-4 col-form-label">Berat Badan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="edberatbadan" name="edberatbadan" placeholder="Berat Badan (Kg)" >
            </div>
        </div>
        <div class="form-group row mt-5">
            <div class="col text-center">
                <button type="submit" class="btn btn-lg btn-ursuline px-5" onclick="">Daftar</button>
            </div>
        </div>

    </form>
    <!--    End Form Data Diri Ayah Calon Siswa-->
</main>