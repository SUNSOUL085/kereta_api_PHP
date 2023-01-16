    <title>Edit Data Kereta</title>
    <?php
    $id = $_GET['id'];
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM kereta WHERE id_kereta='$id'");
    $data = mysqli_fetch_array($ambil_data);
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Kereta</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Kereta</h6>
            </div>
            <div class="card-body">
                <form action="proses_pesan.php?option=editkereta" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Id Kereta</label>
                            <input type="hidden" name="id_kereta_lama" id="" class="form-control" value="<?= $data['id_kereta']; ?>">
                            <input type="text" name="id_kereta_baru" id="" class="form-control" value="<?= $data['id_kereta']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kereta</label>
                            <input type="text" name="nama_kereta" id="" class="form-control" value="<?= $data['nama_kereta']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Gerbong</label>
                            <input type="number" name="gerbong" id="" class="form-control" value="<?= $data['gerbong']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="admin.php?menu=kereta" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>