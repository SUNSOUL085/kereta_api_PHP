<title>Pemesanan Kereta</title>
<?php
extract($_GET);
$query = "SELECT jadwal.*, kereta.nama_kereta,gerbong.*
FROM jadwal join gerbong ON jadwal.id_gerbong = gerbong.id_gerbong JOIN kereta ON gerbong.id_kereta = kereta.id_kereta WHERE id_jadwal = '$id_jadwal'";
$result = mysqli_query($koneksi, $query);
$rs = mysqli_fetch_array($result);

$gerbong = mysqli_query($koneksi, "SELECT * FROM gerbong ORDER BY kelas_gerbong ASC");
get_id_penumpang();
function randomString()
{
    $characters = '0123456789ab';
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

function id_otomatis()
{
    $id_rsv = "RSV" . randomString();
    return $id_rsv;
}

// function id_penumpang_otomatis()
// {
//     $id_penumpang = 'USER' . randomString();
//     return $id_penumpang;
// }
function get_id_penumpang(){
    global $koneksi;
    $query = "SELECT * FROM penumpang";
    $result = mysqli_query($koneksi, $query);
    $rs = mysqli_fetch_array($result);
    return $rs['id_penumpang'];
}
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pesan Kereta</h1>

</div>

<div class="row mb-4">
    
    
    <div class="col-md-12 col-sm-12">
                <div class="card shadow">        
                    <div class="card border-left-success shadow h-100 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 'Rp ' . number_format($rs['harga_tiket'], 0, ',', '.') ?></div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="body-column border border-success p-2 border-top-0">
                            <div class="date depature_date">Rabu, 24 Agustus 2022</div>
                            <div class="train"><?= $rs['nama_kereta'] ?> (<?= $rs['id_kereta'] ?>)</div>
                            <div class="class"><?= $rs['kelas_gerbong'] ?> - <?= $rs['kode_gerbong'] ?></div>
                            <div class="passenger">
                                1 Dewasa     
                            </div>

                            <div class="destionation-wrapper mt-3">
                                <div class="row">
                                    <div class="col-md-5 col-sm-4 col-xs-4">
                                        <div class="city"><?= $rs['stasiun_awal'] ?></div>
                                        <div class="time text-muted"><?= $rs['keberangkatan'] ?></div>
                                        <div class="time text-muted">24 Agus 2022</div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <div class="arrow"><i class="fas fa-angle-double-right"></i></div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-xs-4">
                                        <div class="city"><?= $rs['stasiun_tujuan'] ?></div>
                                        <div class="time text-muted"><?= $rs['kedatangan'] ?></div>
                                        <div class="time text-muted">24 Agus 2022</div>
                                    </div>
                                </div>
                            </div>          
                    </div>
                </div>
    </div>
</div>
<!-- Content Row -->
<div class="row">
<div class=" col-md-12 col-sm-12 card" >
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Data Penumpang</h6>
                    </div>
                    <div class="card-body">
                        <!-- <form action="cek.php" method="post"> -->
                        <form action="proses_pesan.php?option=simpanpesanan" method="post">

                            <input type="hidden" name="id_user" id="" value="<?= $_SESSION['id_user']; ?>">
                            <input type="hidden" class="form-control" id="id_reservasi" name="id_reservasi" autocomplete="off" value="<?= id_otomatis(); ?>" required readonly>
                            <input type="hidden" class="form-control" id="tgl_pesan" name="tgl_pesan" autocomplete="off" value="<?= date('Y-m-d') ?>"  readonly>
                            <input type="hidden" class="form-control" id="id_jadwal" name="id_jadwal" autocomplete="off" value="<?=$rs['id_jadwal']?>"  readonly>
                            <input type="hidden" class="form-control" id="tgl_berangkat" name="tgl_berangkat" autocomplete="off" value="<?= date('Y-m-d') ?>" required >
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label for="gender">Title</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                            </div>
                                            <select class="form-control" id="gender" name="gender"><option value="MR">Tuan</option><option value="MRS.">Nyonya</option></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pemesan_tandapengenal">Tipe Identitas</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">

                                                <span class="input-group-text"><i class="fa fa-id-card fa" aria-hidden="true"></i></span>
                                            </div>
                    
                                            
                                            
                                            <select name="pemesan_tandapengenal" class="form-control" id="pemesan_tandapengenal" required="" value="">
                                                <option value="ktp">NIK</option>
                                                <option value="paspor">Paspor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                    <label for="no_hp">No. HP Pemesan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
                                            </div>
                                            
                                            <input class="form-control number" placeholder="08xxxxx" id="no_hp" data-error="Mohon isi No HP" required="" data-minlength="1" maxlength="14" name="no_hp" type="text">
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
                                        </div>
                                            <input class="form-control" placeholder="Nama Daerah" id="alamat" data-error="Mohon diisi Alamat" required="" name="alamat" type="text">
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">

                                    <div class="form-group ">
                                        <label for="nama_penumpang">Nama Pemesan</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        </div>
                                            <input class="form-control genInfo letter" placeholder="Nama sesuai NIK / Paspor" id="nama_penumpang" data-error="Mohon isi Nama" required="" name="nama_penumpang" type="text">
                                        </div>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="id_penumpang">Nomor Identitas</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-id-card fa" aria-hidden="true"></i></span>
                                            </div>
                                            <input class="form-control genInfo" placeholder="No Identitas sesuai NIK / Paspor" id="id_penumpang" data-error="Mohon isi Nomor Identitas" minlength="1" maxlength="16" required="" name="id_penumpang" type="text">
                                        </div>
                                        <span class="tooltiptext">
                                            Untuk penumpang usia mulai 3 s.d 17 tahun tipe identitas 'Lainnya', kolom nomor identitas di isi nomor kartu identitas
                                            anak/kartu pelajar atau kartu anak lainnya sedangkan untuk yang belum memiliki bukti identitas dapat di isi nomor identitas
                                            orangtua_tanggal bulan tahun lahir anak (ddmmyyyy) sebagai identitas anak,contoh:332909xxxxxxxxxx_13072013
                                        </span>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                        </div>
                                            <input class="form-control" placeholder="me@contoh.co.id" id="email" data-error="Mohon diisi Email" required="" name="email" type="email">
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="pemesan_kota">Kota</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
                                            <input type="text" name="origination" value="GAMBIR" id="passenger-city" class="form-control letter" placeholder="Kota/Provinsi"
                                                data-data="https://booking.kai.id/api/city-name"
                                                data-search-in='["name"]'
                                                data-min-length="1"
                                                data-value-property="name"
                                                data-text-property="name"
                                                data-visible-properties='["name"]'
                                                data-selection-require="true">
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div> -->
                                </div>
                            </div>

                            <div class="modal-footer">
                                <!-- <input type="button" name="cek" class="btn btn-secondary" data-dismiss="modal" value="cek" onClick="cek()"> -->
                                <button type="submit" class="btn btn-primary">PESAN</button>
                        </form>
                    </div>                                                          
            </div>
</div>


<!-- Content Row -->