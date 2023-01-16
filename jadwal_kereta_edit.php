    <!-- gabungkan dengan bagian header dan sidebar -->
    <title>Edit Jadwal Kereta</title>
    <?php
    $id = $_GET['id'];
    $query = "  SELECT jadwal.*, kereta.nama_kereta 
                FROM jadwal join kereta ON jadwal.id_kereta = kereta.id_kereta WHERE id_jadwal='$id'";

    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Jadwal Kereta</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Jadwal Kereta</h6>
            </div>
            <div class="card-body">
                <Form action="proses_pesan.php?option=editjadwal" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_jadwal" id="" value="<?= $data['id_jadwal']; ?>">
                        <div class="form-group">
                            <label for="">Pilih Kereta</label>
                            <select name="id_kereta" id="" class="form-control">
                                <?php
                                $kereta = mysqli_query($koneksi, "SELECT * FROM kereta ORDER BY id_kereta ASC");
                                foreach ($kereta as $kereta) :
                                ?>
                                    <option value="<?= $kereta['id_kereta']; ?>" <?= ($kereta['id_kereta'] == $data['id_kereta']) ? 'selected' : ''; ?>><?= $kereta['nama_kereta']; ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Stasiun Awal</label>
                            <input type="text" name="stasiun_awal" id="" class="form-control" value="<?= $data['stasiun_awal']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Stasiun Tujuan</label>
                            <input type="text" name="stasiun_tujuan" id="" class="form-control" value="<?= $data['stasiun_tujuan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Keberangkatan</label>
                            <input type="time" name="keberangkatan" id="" class="form-control" value="<?= $data['keberangkatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Kedatangan</label>
                            <input type="time" name="kedatangan" id="" class="form-control" value="<?= $data['kedatangan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Berangkat</label>
                            <input type="date" name="tgl_berangkat" id="" class="form-control" value="<?= $data['tgl_berangkat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Tarif</label>
                            <input type="number" name="tarif" id="" class="form-control" value="<?= $data['harga_tiket']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>