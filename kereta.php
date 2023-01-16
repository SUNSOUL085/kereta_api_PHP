    <!-- gabungkan dengan bagian header dan sidebar -->
    <title>Data Kereta</title>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kereta</h1>
    </div>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah-kereta">Tambah</button>
    <!-- Content Row -->
    <div class="row">
        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Kereta</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Kereta</th>
                                <th>Nama Kereta</th>
                                <th>Jumlah Gerbong</th>
                                <th>kapasitas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM kereta ORDER BY id_kereta ASC";
                            $result = mysqli_query($koneksi, $query);
                            foreach ($result as $rs) :
                                $q = "SELECT sum(kapasitas) AS total FROM `gerbong` WHERE id_kereta = '".$rs['id_kereta']."'";
                                $ka = mysqli_fetch_array(mysqli_query($koneksi,$q));
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $rs['id_kereta'] ?></td>
                                    <td><?= $rs['nama_kereta'] ?></td>
                                    <td><?= $rs['gerbong'] ?></td>'
                                    <td><?= $ka['total'] ?></td>
                                    <td class="text-center">
                                        <a href="admin.php?menu=edit_kereta&id=<?= $rs['id_kereta']; ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
                                        <a href="proses_pesan.php?option=hapuskereta&id=<?= $rs['id_kereta']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin akan menghapus data ini ?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- sturktur untuk tambah data kereta -->
    <div class="modal fade" id="tambah-kereta" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Kereta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="proses_pesan.php?option=tambahkereta" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Id Kereta</label>
                            <input type="text" name="id_kereta" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Kereta</label>
                            <input type="text" name="nama_kereta" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Gerbong</label>
                            <input type="number" name="gerbong" id="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>