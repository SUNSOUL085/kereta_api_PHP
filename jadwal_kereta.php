    <title>Jadwal Kereta</title>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Kereta</h1>
    </div>

    <?php if ($_SESSION['level'] == 'ADMIN') :  ?>
        <?php $query = "SELECT jadwal.*, kereta.nama_kereta,gerbong.*
                        FROM jadwal join gerbong ON jadwal.id_gerbong = gerbong.id_gerbong 
                        JOIN kereta ON gerbong.id_kereta = kereta.id_kereta";

                $result = mysqli_query($koneksi, $query); ?>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-jadwal">Tambah</button>
        <div class="row">
        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Kereta</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Kereta</th>
                                <th>Nama Kereta</th>
                                <th>kelas gerbong</th>
                                <th>Stasiun Awal</th>
                                <th>Stasiun Tujuan</th>
                                <th>Kedatangan</th>
                                <th>Keberangkatan</th>
                                <th>Tarif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            
                            foreach ($result as $rs) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $rs['id_kereta'] ?></td>
                                    <td><?= $rs['nama_kereta'] ?></td>
                                    <td><?= $rs['kelas_gerbong'] ?></td>
                                    <td><?= $rs['stasiun_awal'] ?></td>
                                    <td><?= $rs['stasiun_tujuan'] ?></td>
                                    <td><?= $rs['kedatangan'] ?></td>
                                    <td><?= $rs['keberangkatan'] ?></td>
                                    <td><?= 'Rp ' . number_format($rs['harga_tiket'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <!-- Jika level yang masuk adalah admin, maka tombol edit dan delete ditampilkan 
                                            tetapi jika akun user yang masuk maka tombol pesan yang akan ditampilkan
                                        -->
                                        <?php if ($_SESSION['level'] == 'ADMIN') { ?>
                                            <a href="admin.php?menu=edit_jadwal&id=<?= $rs['id_jadwal']; ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                                            <a href="proses_pesan.php?option=hapusjadwal&id=<?= $rs['id_jadwal']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin akan menghapus data ini ?')">Delete</a>
                                        <?php } else { ?>
                                            <a href="index.php?menu=pesan&id_kereta=<?= $rs['id_kereta'] ?>&id_jadwal=<?= $rs['id_jadwal'] ?>" class="btn btn-success">pesan</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>
    <?php if ($_SESSION['level'] == 'USER') :  ?>
        <div class="row mb-5">

            <div class="card shadow col-12">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cari Jadwal</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                    <h5 class="card-title">Pemesanan Tiket Kereta Api</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= date('l, d M Y'); ?> </h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                    <h3 class="text-primary" for="stasiun_awal">Stasiun Awal</h3>
                                    <input type="text" class="form-control" id="stasiun_awal" name="stasiun_awal" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                    <h3 class="text-primary" for="stasiun_tujuan">Stasiun Tujuan</h3>
                                    <input type="text" class="form-control" id="stasiun_tujuan" name="stasiun_tujuan" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group ">
                                    <h4 class="text-primary" for="tgl_berangkat">Tanggal Keberangkatan</h4>
                                    <input type="Date" class="form-control" id="tgl_berangkat" name="tgl_berangkat" autocomplete="off" value="<?= date('d/m/y')?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                    <h4 class="text-primary" for="Penumpang">Dewasa</h4>
                                    <input type="number" class="form-control" id="Penumpang" name="Penumpang" autocomplete="off" value="1" min="1">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                    <h4 class="text-primary" for="bayi">Bayi</h4>
                                    <input type="number" class="form-control" id="bayi" name="bayi" autocomplete="off" value="0" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                        <button type="submit" name="cari" class="btn btn-primary">Cari Kereta</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php 
       
        if(isset($_POST['cari'])){
            $sa = $_POST['stasiun_awal'];
            $st = $_POST['stasiun_tujuan'];
            if($sa == null || $st == null){
                echo '<div class="alert alert-danger" role="alert">
                Stasiun Tidak Boleh kosong
                </div>';
                
            } else{
                $query = "SELECT jadwal.*, kereta.nama_kereta,gerbong.*
                        FROM jadwal join gerbong ON jadwal.id_gerbong = gerbong.id_gerbong 
                        JOIN kereta ON gerbong.id_kereta = kereta.id_kereta 
                        WHERE stasiun_awal = '$sa' AND
                        stasiun_tujuan = '$st'";

                $result = mysqli_query($koneksi, $query);
                if(mysqli_affected_rows($koneksi) > 0){
                    // membuat session agar data pencarian tidak hilang saat tombol cari di
                    // $_SESSION['st'] = $st;
                    // $_SESSION['sa'] = $sa;
                    
            
            
    ?>
    <!-- Content Row -->
    <div class="data-wrapper">
        <div class="row bg-primary text-white p-3 my-3">
        
        <div class="col-md-3 col-sm-3">Kereta</div>
        <div class="col-md-2 col-sm-3">
                <div class="padding-left-15">Berangkat</div>
        </div>
        <div class="col-md-2 col-sm-3"><div class="md-padding-left-30">Durasi</div></div>
        <div class="col-md-2 col-sm-1">Tiba</div>
        <div class="col-md-3 col-sm-5 center">Harga</div>

        </div>
    </div>
    <?php foreach ($result as $rs) : ?>
    <div class="row bg-primary text-white p-3 my-3">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="col-one">
                    <div class="name"><?= $rs['nama_kereta'] ?> <span>(<?= $rs['id_kereta'] ?>)</span></div>
                    <div class="{kelas kereta}"><?= $rs['kelas_gerbong'] ?> (<?= $rs['kode_gerbong'] ?>)</div>
                </div>
            </div>
        <div class="col-md-6 col-sm-4 col-xs-12">
            <div class="col-two">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="station station-start"><?= $rs['stasiun_awal'] ?></div>
                        <div class="times time-start"><?= $rs['keberangkatan'] ?></div>
                        <div class="station date-start">24 Agustus 2022</div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-2">
                        <div class="arrow"><i class="fas fa-arrow-circle-right"></i></div>
                        <div class="long-time">2j 52m</div>
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-4 card-arrival">
                        <div class="station station-end"><?= $rs['stasiun_tujuan'] ?></div>
                        <div class="times time-end"><?= $rs['kedatangan'] ?></div>
                        <div class="station station-end">24 Agustus 2022</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-5 col-price col-xs-12 padding-right-5 center">
            <div class="col-four">
                <div class="price"><?= 'Rp ' . number_format($rs['harga_tiket'], 0, ',', '.') ?></div>
                    <div class="order-wrapper force-center">
                    <a href="index.php?menu=pesan&id_kereta=<?= $rs['id_kereta'] ?>&id_jadwal=<?= $rs['id_jadwal'] ?>" class="btn btn-success">pesan</a>
                    </div>
                    
                 <small class="form-text sisa-kursi">Tersisa 2 kursi</small>
                                                                                    
                </div>
            </div>
        </div>
        <?php //endforeach; ?>
   
    <?php endforeach;      }
            else  echo '<div class="alert alert-danger" role="alert">
                Stasiun Tidak Ada
                </div>';
            }
        }
    ?>


    <!-- Sturktur Tambah Jadwal -->
    <div class="modal fade" id="tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form action="proses_pesan.php?option=tambahjadwal" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">

                                <div class="form-group">
                                    <label for="">Pilih Kereta</label>
                                    <select name="id_kereta" id="" class="form-control">
                                        <?php
                                        $kereta = mysqli_query($koneksi, "SELECT * FROM kereta ORDER BY id_kereta ASC");
                                        foreach ($kereta as $data) :
                                        ?>
                                            <option value="<?= $data['id_kereta']; ?>"><?= $data['nama_kereta']; ?></option>
        
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Stasiun Awal</label>
                                    <input type="text" name="stasiun_awal" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Keberangkatan</label>
                                    <input type="time" name="keberangkatan" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Berangkat</label>
                                    <input type="date" name="tgl_berangkat" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                    <label for="">Pilih gerbong</label>
                                    <select name="id_gerbong" id="" class="form-control">
                                        <?php
                                        $gerbong = mysqli_query($koneksi, "SELECT * FROM gerbong ORDER BY id_gerbong ASC");
                                        foreach ($gerbong as $data) :
                                        ?>
                                            <option value="<?= $data['id_gerbong']; ?>"><?= $data['kelas_gerbong']; ?>(<?= $data['id_kereta']; ?>)</option>
        
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Stasiun Tujuan</label>
                                    <input type="text" name="stasiun_tujuan" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kedatangan</label>
                                    <input type="time" name="kedatangan" id="" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Tarif</label>
                                    <input type="number" name="tarif" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>