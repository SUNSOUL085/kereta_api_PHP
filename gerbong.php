    <!-- gabungkan dengan bagian header dan sidebar -->
    <title>Edit Jadwal Kereta</title>
    <?php
    $id = $_GET['id'];
    $query = "  SELECT * FROM kereta WHERE id_kereta='$id'";

    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
    
    ?>

    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Gerbong</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="card shadow col-12">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Gerbong Kereta</h6>
            </div>
            <div class="card-body">
                <Form action="proses_pesan.php?option=tambahGerbong" method="post">
                    <input type="hidden" name="id_kereta" value="<?=$data['id_kereta']?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Nama Kereta</label>
                                        <input type="text" name="nama_kereta" id="" class="form-control" value="<?=$data['nama_kereta']?>" readonly>
                                    </div>

                            </div>
                            <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Jumlah Gerbong</label>
                                        <input type="number" name="jumlah_gerbong" id="" class="form-control jumlah_gerbong" value="<?=$data['gerbong']?>" onclick="alert('<?=$id_gerbong?>')" readonly>
                                    </div>

                            </div>
                        </div>
                        <?php for($i = 0; $i< $data['gerbong']; $i++) : $id_gerbong = "GB".substr($data['id_kereta'],3).$i;?>
                        <div class="row">
                            <div class="col-4">
                                <input type="hidden" name="id_gerbong<?=$i?>" value="<?=$id_gerbong?>">
                                    <div class="form-group">
                                        <label for="">Kelas Gerbong</label>
                                        <select name="kelas<?=$i?>" id="" class="form-control">
                                            <option value="EKSEKUTIF">EKSEKUTIF</option>
                                            <option value="BISNIS">BISNIS</option>
                                            <option value="EKONOMI">EKONOMI</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Kode Gerbong</label>
                                        <input type="text" name="kode<?=$i?>" id="" class="form-control gerbong_bs" value="">
                                    </div>
                            </div>
                            <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Kapasitas Gerbong</label>
                                        <input type="number" name="kapasitas<?=$i?>" id="" class="form-control gerbong_eko" value="0" >
                                    </div>
                            </div>
                        </div>
                        <?php endfor; ?>
                        
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="tambahGerbong" class="btn btn-primary">Tambah Gerbong</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
   