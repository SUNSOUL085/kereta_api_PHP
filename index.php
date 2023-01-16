<?php
include 'koneksi.php';
$query = "SELECT jadwal.id_jadwal,jadwal.id_kereta,kereta.nama_kereta,jadwal.stasiun_awal,
    jadwal.stasiun_tujuan,jadwal.kedatangan,jadwal.keberangkatan,jadwal.harga_tiket 
    FROM jadwal join kereta ON jadwal.id_kereta = kereta.id_kereta";
?>

<?php include 'header_sidebar.php'; ?>

<?php
extract($_GET);
if (isset($menu)) {
    if ($menu == "dashboard") {
        include 'dashboard_user.php';
    } else if ($menu == "jadwal") {
        include 'jadwal_kereta.php';
    } else if ($menu == "pesan") {
        include 'pesan_kereta.php';
    } else if ($menu == "bayar") {
        include 'bayar.php';
    } else if ($menu == "riwayat") {
        include 'riwayat_pesanan.php';
    }
} else {
    include 'dashboard_user.php';
}
?>

<?php include 'footer.php'; ?>