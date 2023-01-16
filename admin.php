<?php
// session_start();
// include 'koneksi.php';
$query = "SELECT jadwal.id_jadwal,jadwal.id_kereta,kereta.nama_kereta,jadwal.stasiun_awal,
    jadwal.stasiun_tujuan,jadwal.kedatangan,jadwal.keberangkatan,jadwal.harga_tiket 
    FROM jadwal join kereta ON jadwal.id_kereta = kereta.id_kereta";

?>

<!-- gabungkan dengan bagian header dan sidebar -->
<?php include 'header_sidebar.php' ?>

<?php
extract($_GET);
if (isset($menu)) {
    if ($menu == "pesan") {
        include 'pesan_kereta.php';
    } else if ($menu == "bayar") {
        include 'bayar.php';
    } else if ($menu == "jadwal") {
        include 'jadwal_kereta.php';
    } else if ($menu == "kereta") {
        include 'kereta.php';
    } else if ($menu == "edit_kereta") {
        include 'kereta_edit.php';
    } else if ($menu == "admin") {
        include 'dashboard_admin.php';
    } else if ($menu == "edit_jadwal") {
        include 'jadwal_kereta_edit.php';
    }else if ($menu == "gerbong") {
        include 'gerbong.php';
    }
} else {
    include 'dashboard_admin.php';
}

?>


<!-- gabungkan dengan footer -->
<?php include 'footer.php'; ?>