<?php 
    include 'koneksi.php';
    if(isset($_GET['id'])){
        $query = "SELECT tiket.*,jadwal.*,reservasi2.*,penumpang.*,gerbong.*,kereta.* FROM tiket JOIN jadwal ON jadwal.id_jadwal = tiket.id_jadwal JOIN reservasi2 ON reservasi2.id_reservasi = tiket.id_reservasi JOIN gerbong ON gerbong.id_gerbong = jadwal.id_gerbong JOIN penumpang ON reservasi2.id_penumpang = penumpang.id_penumpang JOIN kereta ON kereta.id_kereta = gerbong.id_kereta WHERE tiket.id_tiket = '".$_GET['id']."'";

        $coba = mysqli_query($koneksi , $query);
        $tkt = mysqli_fetch_array($coba);
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Print tiket</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
            <!-- Write page content code here -->

            <!-- Start XP Row -->    
            <div class="row">
                <!-- Start XP Col -->
                <div class="col-lg-12">
                    <div class="card shadow border-warning my-4" onclick="window.print()">
                        <div class="card-body text-dark pl-5">
                                <!-- Start XP Col -->
                            <div class="row">
                                <div class="col-6 "><img class="card-img-top" src="img/kai.png" alt="Card image cap" style="width: 6rem;"></div>
                                <div class="col-6 d-flex justify-content-end h1">BOARDING PASS</div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="row my-3 ">
                                        <div class="col-6 my-2">
                                            nama /name
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                <?= $tkt['nama_penumpang'] ?>
                                            </div>
                                        </div>
                                        <div class="col-6   my-2">
                                            kode booking / booking code
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                <?= $tkt['id_reservasi'] ?>
                                            </div>
                                        </div>
                                        <div class="col-6 my-2">
                                            nomor identitas / id number
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                <?= $tkt['id_penumpang'] ?>
                                            </div>
                                        </div>
                                        <div class="col-6   my-2">
                                            tipe penumpang / pax type
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                UMUM
                                            </div>
                                        </div>
                                        <div class="col-6 my-2">
                                            kereta api / train
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                <?= $tkt['nama_kereta'] ?>
                                            </div>
                                        </div>
                                        <div class="col-6   my-2">
                                            no tempat duduk / seat number
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                <?= $tkt['no_kursi'] ?>
                                            </div>
                                        </div>
                                        <div class="col-6 my-2">
                                            Berangkat
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                                <?= $tkt['stasiun_awal'] ?>
                                                <br>
                                                <?= date('d M Y') ?>; <?= $tkt['kedatangan'] ?> WIB
                                            </div>
                                        </div>
                                        <div class="col-6   my-2">
                                            Perkiraan Tiba
                                            <div class="card-title h5 font-weight-bold text-uppercase">
                                            <?= $tkt['stasiun_tujuan'] ?>
                                            <br>
                                            <?= date('d M Y') ?>; <?= $tkt['keberangkatan'] ?> WIB
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <img class="card-img-top" src="img/bc.png" alt="Card image cap" style="width: 12rem;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8"></div>
                                <div class="col-4">
                                    <p class="font-italic">*kalo mau tutor ada di custom dek</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    <!-- End XP Col -->

            </div>
             <!-- End XP Row -->  
            
        </div>
        
        <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>    

</body>
