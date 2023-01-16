<title>Riwayat Pemesanan</title>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Pemesanan</h1>
</div>
<?php
$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM reservasi2 
inner join penumpang on reservasi2.id_penumpang=penumpang.id_penumpang 
inner join jadwal on reservasi2.id_jadwal=jadwal.id_jadwal 
where reservasi2.id_penumpang='$id_user'");
?>
<div class="card">
    <div class="card-body">
        <div class="card-header">
            Riwayat Pemesanan
        </div>
        <table class="table w-100">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reservasi</th>
                    <th>No Penumpang</th>
                    <th>Nama</th>
                    <th>Harga Tiket</th>
                    <th class="text-center">Status Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($query as $q) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $q['id_reservasi']; ?></td>
                        <td><?= $q['id_penumpang']; ?></td>
                        <td><?= $q['nama_penumpang']; ?></td>
                        <td><?= 'Rp ' . number_format($q['harga_tiket'], 0, ',' . '.'); ?></td>
                        <td class="text-center">
                            <?php if ($q['status_bayar'] == 'belum') { ?>
                                <a href="index.php?menu=bayar&id_reservasi=<?= $q['id_reservasi']; ?>" class="btn btn-sm btn-danger">Belum</a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-sm btn-success">Sudah</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>