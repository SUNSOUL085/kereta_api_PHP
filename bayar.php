<title>Pembayaran</title>
<?php
extract($_GET);
$query = mysqli_query($koneksi, "SELECT reservasi2.id_reservasi,penumpang.*,jadwal.*, kereta.nama_kereta,gerbong.*
FROM reservasi2 JOIN penumpang ON reservasi2.id_penumpang = penumpang.id_penumpang JOIN jadwal ON reservasi2.id_jadwal = jadwal.id_jadwal join gerbong ON jadwal.id_gerbong = gerbong.id_gerbong JOIN kereta ON gerbong.id_kereta = kereta.id_kereta 
        where id_reservasi='$id_reservasi'");
$trx = mysqli_fetch_array($query);
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

function id_trx_otomatis()
{
    $id_trx = "TRX" . randomString();
    return $id_trx;
}
function id_tkt_otomatis(){
    return "TKT". randomString();
}
function pilih_kursi_otomatis(){
    // $query = "SELECT no_kursi FROM tiket ASC";

    $kelas = $trx['kelas_gerbong'];
    $kode = $trx['kode_gerbong'];
    $kapasitas = $trx['kapasitas'];
    $a;$b;$c;
    if($kelas == "EKSEKUTIF" ){
        $a = "EKS";
    }else if($kelas == "BISNIS"){
        $a = "BIS";
    }else if($kelas == "EKONOMI"){
        $a = "EKO";
    }

    if($kapasitas > 30){
        $b = "A";

    }

}
?>
<div class="row mb-4">
    
    
    <div class="col-md-12 col-sm-12">
                <div class="card shadow">        
                    <div class="card border-left-success shadow h-100 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center text-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800" onclick="alert('<?= date('Y-m-d') ?>')"><?= 'Rp ' . number_format($trx['harga_tiket'], 0, ',', '.') ?></div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="body-column border border-success p-2 border-top-0">
                            <div class="date depature_date">Rabu, 24 Agustus 2022</div>
                            <div class="train"><?= $trx['nama_kereta'] ?> (<?= $trx['id_kereta'] ?>)</div>
                            <div class="class"><?= $trx['kelas_gerbong'] ?> - <?= $trx['kode_gerbong'] ?></div>
                            <div class="passenger">
                                1 Dewasa     
                            </div>

                            <div class="destionation-wrapper mt-3">
                                <div class="row">
                                    <div class="col-md-5 col-sm-4 col-xs-4">
                                        <div class="city"><?= $trx['stasiun_awal'] ?></div>
                                        <div class="time text-muted"><?= $trx['keberangkatan'] ?></div>
                                        <div class="time text-muted">24 Agus 2022</div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-4">
                                        <div class="arrow"><i class="fas fa-angle-double-right"></i></div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-xs-4">
                                        <div class="city"><?= $trx['stasiun_tujuan'] ?></div>
                                        <div class="time text-muted"><?= $trx['kedatangan'] ?></div>
                                        <div class="time text-muted">24 Agus 2022</div>
                                    </div>
                                </div>
                            </div>          
                    </div>
                </div>
    </div>
</div>
<div class="card shadow col-12">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Penumpang</h6>
    </div>
    <form action="proses_pesan.php?option=pembayaran" method="post">
        <input type="hidden" name="id_transaksi" id="" value="<?= id_trx_otomatis(); ?>">
        <input type="hidden" name="tgl_bayar" value="<?= date('Y-m-d') ?>">
        <input type="hidden" name="total" value="<?=$trx['harga_tiket']?>">
        <input type="hidden" name="id_jadwal" value="<?=$trx['id_jadwal']?>">
        <input type="hidden" name="id_tiket" value="<?= id_tkt_otomatis()?>">
        <input type="hidden" class="form-control" id="id_reservasi" name="id_reservasi" autocomplete="off" required readonly value="<?= $trx['id_reservasi']; ?>">

        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="id_reservasi">ID PENUMPANG</label>
                        <input type="text" class="form-control" id="id_penumpang" name="id_penumpang" autocomplete="off" required readonly value="<?= $trx['id_penumpang']; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="id_reservasi">NAMA PENUMPANG</label>
                        <input type="text" class="form-control" id="nama_penumpang" name="nama_penumpang" autocomplete="off" required readonly value="<?= $trx['nama_penumpang']; ?>">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="id_reservasi">NOMOR KURSI</label>
                        <input type="text" class="form-control" id="no_kursi" name="no_kursi" autocomplete="off" required readonly value="EKS2 : A2">
                    </div>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
        </div>
    </form>
</div>