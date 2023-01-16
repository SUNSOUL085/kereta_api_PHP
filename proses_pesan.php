<?php
include 'koneksi.php';
extract($_POST);

// Jalur untuk memanggil function (hanya alternatif / solusi saat ini)
if (isset($_GET['option'])) {
    $option = $_GET['option'];
    if ($option == 'simpanpesanan') {
        simpan_reservasi();
    } else if ($option == 'pembayaran') {
        pembayaran();
    } else if ($option == 'tambahkereta') {
        tambah_kereta();
    } else if ($option == 'hapuskereta') {
        hapus_kereta();
    } else if ($option == 'editkereta') {
        edit_kereta();
    } else if ($option == 'hapusjadwal') {
        hapus_jadwal();
    } else if ($option == 'tambahjadwal') {
        tambah_jadwal();
    } else if ($option == 'editjadwal') {
        edit_jadwal();
    }
     else if ($option == 'tambahGerbong') {
        tambah_gerbong();
    }
}


function cari_gerbong($id, $kelas)
{
    global $koneksi;
    $query = "SELECT gerbong.id_gerbong FROM gerbong WHERE id_kereta = '$id' AND kelas_gerbong = '$kelas'";
    $result = mysqli_query($koneksi, $query);
    $rs = mysqli_fetch_array($result);
    return $rs['id_gerbong'];
}
// cari_gerbong($id_kereta,$kelas);


function simpan_reservasi()
{
    global $koneksi;
    extract($_POST);
    // cek kondisi apakah penumpang sudah ada atau belum
    $queryCekPenumpang = "SELECT id_penumpang FROM penumpang WHERE id_penumpang = $id_penumpang";
    $cekPenumpang = mysqli_query($koneksi, $queryCekPenumpang);

    if($cekPenumpang){
        $queryReservasi = "INSERT INTO reservasi2 (id_reservasi, id_penumpang, id_jadwal, tgl_berangkat, tgl_pesan, status_bayar) VALUES ('$id_reservasi','$id_penumpang','$id_jadwal','$tgl_berangkat','$tgl_pesan', 'belum')";
            $simpanReservasi = mysqli_query($koneksi, $queryReservasi);
            if ($simpanReservasi) {
                echo "<script>alert('bisa');</script>";
                header("location: index.php?menu=bayar&id_reservasi=$id_reservasi");
            } else {
                echo "<script>alert('gagal simpan resevasi');</script>";
                // header("location: index.php?menu=pesan&id_kereta=$id_kereta&id_jadwal=$id_jadwal");
            }
    }else{
        // simpan data ke table penumpang
        $queryPenumpang = "INSERT INTO penumpang (id_penumpang, nama_penumpang,email, alamat, gender, no_tlp)
        VALUES ('$id_penumpang','$nama_penumpang','$email','$alamat','$gender','$no_hp')";
        $penumpang = mysqli_query($koneksi, $queryPenumpang);
        if ($penumpang) {
            //  simpan data ke table reservasi    
            $queryReservasi = "INSERT INTO reservasi2 (id_reservasi, id_penumpang, id_jadwal ,tgl_berangkat, tgl_pesan, status_bayar) VALUES ('$id_reservasi','$id_penumpang','$id_jadwal','$tgl_berangkat','$tgl_pesan', 'belum')";
            $simpanReservasi = mysqli_query($koneksi, $queryReservasi);
            if ($simpanReservasi) {
                echo "<script>alert('bisa');</script>";
                header("location: index.php?menu=bayar&id_reservasi=$id_reservasi");
            } else {
                echo "<script>alert('gagal simpan reservasi');</script>";
                // header("location: index.php?menu=pesan&id_kereta=$id_kereta&id_jadwal=$id_jadwal");
            }
            
        }else {
            echo "<script>alert('gagal');</script>";
        }
    }
}

function pembayaran()
{
    global $koneksi;
    extract($_POST);
    $simpanTransaksi = mysqli_query($koneksi, "INSERT INTO transaksi (id_transaksi, tgl_bayar, jumlah, total_bayar, id_reservasi) VALUES ('$id_transaksi','$tgl_bayar','1','$total','$id_reservasi')");
    // jika simpan transaksi berhasil, maka update status yang tadinya belum bayar menjadi sudah
    if ($simpanTransaksi) {
        $simpanTiket = mysqli_query($koneksi,"INSERT INTO tiket (id_tiket,id_jadwal,id_reservasi,no_kursi) VALUES ('$id_tiket','$id_jadwal','$id_reservasi','$no_kursi')");
        if($simpanTiket){
            echo "<script>alert('tiket jadi');</script>";
                $updateStatus = mysqli_query($koneksi, "UPDATE reservasi2 SET status_bayar='sudah' WHERE id_reservasi='$id_reservasi'");
                if ($updateStatus) {
                    echo "<script>alert('bisa');</script>";
                    header("location: tiket.php?id=$id_tiket");
                } else {
                    echo "<script>alert('gagal');</script>";
                    // header("location: index.php?menu=bayar&id_reservasi=$id_reservasi");
                }
        } else {
            echo "<script>alert('tiket gagal');</script>";
        }
        
    }
}



// ==================== CRUD data kereta ======================
function tambah_kereta()
{
    global $koneksi;
    extract($_POST);
    $query = "INSERT INTO kereta (id_kereta, nama_kereta, gerbong) VALUES ('$id_kereta', '$nama_kereta','$gerbong')";
    $simpan = mysqli_query($koneksi, $query);
    // jika berhasil disimpan
    if ($simpan) {
        echo '<script>alert("data kereta berhasil disimpan"); </script>';
        header("location: admin.php?menu=gerbong&id=$id_kereta");
    } else {
        echo '<script>alert("data kereta gagal disimpan");   document.location.href="admin.php?menu=kereta" </script>';
    }
}

function hapus_kereta()
{
    global $koneksi;
    $id = $_GET['id'];
    $query = "DELETE FROM kereta WHERE id_kereta='$id' ";
    $hapus = mysqli_query($koneksi, $query);
    // jika berhasil dihapus
    if ($hapus) {
        echo '<script>alert("data kereta berhasil dihapus");   document.location.href="admin.php?menu=kereta" </script>';
    } else {
        echo '<script>alert("data kereta gagal dihapus");   document.location.href="admin.php?menu=kereta" </script>';
    }
}

function edit_kereta()
{
    global $koneksi;
    extract($_POST);
    $query = "UPDATE kereta set id_kereta='$id_kereta_baru', nama_kereta='$nama_kereta', gerbong='$gerbong' WHERE id_kereta='$id_kereta_lama' ";
    $update = mysqli_query($koneksi, $query);
    // jika berhasil diupdate
    if ($update) {
        echo '<script>alert("data kereta berhasil diupdate");   document.location.href="admin.php?menu=kereta"; </script>';
    } else {
        echo '<script>alert("data kereta gagal diupdate"); </script>';
    }
}


// ================ CRUD Jadwal Kereta ==================
function hapus_jadwal()
{
    global $koneksi;
    $id = $_GET['id'];
    $query = "DELETE FROM jadwal WHERE id_jadwal='$id' ";
    $hapus = mysqli_query($koneksi, $query);
    // jika berhasil dihapus
    if ($hapus) {
        echo '<script>alert("data jadwal kereta berhasil dihapus");   document.location.href="admin.php?menu=jadwal" </script>';
    } else {
        echo '<script>alert("data jadwal kereta gagal dihapus");   document.location.href="admin.php?menu=jadwal" </script>';
    }
}

function tambah_jadwal()
{
    global $koneksi;
    extract($_POST);
    $query = "INSERT INTO jadwal (id_gerbong, stasiun_awal, stasiun_tujuan,keberangkatan, kedatangan, harga_tiket) VALUES ('$id_gerbong', '$stasiun_awal','$stasiun_tujuan','$keberangkatan','$kedatangan','$tarif')";
    $simpan = mysqli_query($koneksi, $query);
    // jika berhasil disimpan
    if ($simpan) {
        echo '<script>alert("data jadwal kereta berhasil disimpan");   document.location.href="admin.php?menu=jadwal" </script>';
    } else {
        echo '<script>alert("data jadwal kereta gagal disimpan");   document.location.href="admin.php?menu=jadwal" </script>';
    }
}

function edit_jadwal()
{
    global $koneksi;
    extract($_POST);
    $query = "UPDATE jadwal SET id_kereta='$id_kereta', stasiun_awal='$stasiun_awal', stasiun_tujuan='$stasiun_tujuan',keberangkatan='$keberangkatan', kedatangan='$kedatangan',tgl_berangkat='$tgl_berangkat', harga_tiket='$tarif' WHERE id_jadwal='$id_jadwal'";
    $update = mysqli_query($koneksi, $query);
    // jika berhasil diupdate
    if ($update) {
        echo '<script>alert("data jadwal kereta berhasil diupdate");   document.location.href="admin.php?menu=jadwal"; </script>';
    } else {
        echo '<script>alert("data jadwal kereta gagal diupdate"); </script>';
    }
}
// ===============================CRUD Gerbong=========================================
function tambah_gerbong(){
    global $koneksi;
    // extract($_POST);
    if(isset($_POST['tambahGerbong'])){
    $id_kereta = $_POST['id_kereta'];

        for($i = 0; $i < $_POST['jumlah_gerbong']; $i++){
            $id = $_POST["id_gerbong".$i];
            $kelas = $_POST["kelas".$i];
            $kode = $_POST["kode".$i];
            $kapasitas = $_POST["kapasitas".$i];
            // echo "id = $id. kelas = $kelas . kode = $kode . kapa = $kapasitas . kereta = $id_kereta";
            // echo "<br>";
            
            $query = "INSERT INTO gerbong (`id_gerbong`, `kelas_gerbong`, `kode_gerbong`, `kapasitas`, `id_kereta`) VALUES('$id','$kelas','$kode','$kapasitas','$id_kereta')";
            $hasil = mysqli_query($koneksi, $query);
            
        }
        echo '<script>alert("data selamat '.$_POST['jumlah_gerbong'].' gerbong berhasil di tambahkan "); document.location.href="admin.php?menu=kereta" </>';
    
    }
    
    //     $i = 1;
    //     for($j = 0; $j < $gerbong_eksekutif; $j++){
    //         $ID = 'GB00'.$id_kereta[6].$i;
    //         $query = "INSERT INTO gerbong VALUES('$ID','EKSEKUTIF','40','15','$id_kereta')";
    //         // echo "<script>alert('$ID')</script>";
    //         mysqli_query($koneksi, $query);
    //         $i++;
    //     }
    //     for($k = 0; $k < $gerbong_bisnis; $k++){
    //         $ID = 'GB00'.$id_kereta[6].$i;
    //         $query = "INSERT INTO gerbong VALUES('$ID','BISNIS','60','10','$id_kereta')";
    //         mysqli_query($koneksi, $query);
    //         $i++;
    //     }
    //     for($l = 0; $l < $gerbong_ekonomi; $l++){
    //         $ID = 'GB00'.$id_kereta[6].$i;
    //         $query = "INSERT INTO gerbong VALUES('$ID','EKONOMI','80','10','$id_kereta')";
    //         mysqli_query($koneksi, $query);
    //         $i++;
    //     }
    
    // echo '<script>alert("data selamat '.$jumlah_gerbong.' gerbong berhasil di tambahkan "); document.location.href="admin.php?menu=kereta" </script>';
    // echo '<script>alert("data '.$i,$j,$k,$l.'sedangkan '.$gerbong_eksekutif.$gerbong_bisnis.$gerbong_ekonomi.'  id nya '.$ID.'"); document.location.href="admin.php?menu=gerbong&id=KAI0003" </script>';
    
}
