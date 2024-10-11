<?php
//buat session start
session_start();

//uji jika sesion telah diset/ tidak
if (
    empty($_SESSION['username'])
    or empty($_SESSION['password'])
    or empty($_SESSION['nama_user'])
) {
    echo "<script> alert('Maaf, Silahkan Login terlebih dahulu...!'); 
	document.location='index.php';</script>";
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


    <title>Halaman Presensi Pegawai</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">


    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/sweetalert.css">

    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body id="page-top">

    <!-- koneksi ke database -->
    <?php

    include "koneksi.php";

    //uji tombol simpan
    if (isset($_POST['bsimpan'])) {

        date_default_timezone_set("Asia/Jakarta");
        $tgl             = date('Y-m-d H:i:s');
        $username        = $_POST['username'];
        $nama_user       = $_POST['nama_user'];


        $simpan = mysqli_query($koneksi, "INSERT INTO absen_masuk (tanggal, username, nama_user) VALUES ('$tgl','$username', '$nama_user')");

        if ($simpan) {

            echo "<script>
            Swal.fire({
              title: 'Sukses!',
              text: 'Data Berhasil Disimpan',
              icon: 'success',
              showConfirmButton: false,
              timer: 2500
            });
          </script>";
        } else {
            echo "<script>
                Swal.fire({
                  title: 'Error!',
                  text: 'Data gagal disimpan.',
                  icon: 'error',
                  confirmButtonText: 'Coba lagi'
                });
              </script>";
        }
    }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- awal -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <marquee behavior="" direction="">
                                    <span class="mr-2 d-none d-lg-inline text-white">
                                        -- Semoga Lelahmu Jadi Ibadah dan Jangan Lupa Bersyukur --
                                    </span>
                                </marquee>
                            </a>
                        </li>
                        <!-- akhir -->

                        <div class="topbar-divider d-none d-sm-block"> </div>

                        <!-- awal -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <span class="mr-2 d-none d-lg-inline text-white">
                                    <?php
                                    setlocale(LC_TIME, 'id_ID.utf8');
                                    date_default_timezone_set("Asia/Jakarta");
                                    echo strftime('%A, %d %B %Y') ?>
                                </span>
                            </a>
                        </li>
                        <!-- akhir -->

                        <div class="topbar-divider d-none d-sm-block"> </div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white"> Halo,
                                    <?php echo $_SESSION['nama_user'];
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-light">
                    <!-- Awal Form -->
                    <div class="row mt-2">
                        <!-- col lg-8 -->
                        <div class="col-lg-12 mb-3">
                            <div class="card shadow bg-info-200">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class=" p-1">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-2">Presensi Kerja</h1>
                                            <a href="masuk.php" class="btn btn-success mt-2 mb-2">Presensi Masuk Kerja</a>
                                            <a href="pulang.php" class="btn btn-info mt-2 mb-2">Presensi Pulang Kerja</a>
                                            <a href="buku_kerja.php" class="btn btn-primary mt-2 mb-2">Mengisi Buku Kerja</a>
                                            <hr>
                                            <h1 class="h4 text-gray-900 mb-2">Rekapitulasi Data</h1>
                                            <a href="rekap_masuk.php" class="btn btn-success mt-2 mb-2">Rekapitulasi Presensi Masuk Kerja</a>
                                            <a href="rekap_pulang.php" class="btn btn-info mt-2 mb-2">Rekapitulasi Presensi Pulang Kerja</a>
                                            <a href="rekap_buku_kerja.php" class="btn btn-warning mt-2 mb-2">Rekapitulasi Data Buku Kerja</a>

                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                        <!-- end col lg-8 -->
                    </div>
                    <!-- Akhir Form -->


                    <!-- AWAL TABEL RIWAYAT PRESENSI -->
                    <div class="row" align="center">
                        <div class="col-md-6 col">
                            <!-- Awal Tabel Riwayat Presensi Masuk -->
                            <div class="card shadow">
                                <div class="card-header text-center py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Riwayat Presensi Masuk Bulan Ini</h5>
                                </div>

                                <div class="card-body text-gray-900">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Tanggal</th>
                                                    <th>Waktu</th>
                                                </tr>
                                            </thead>

                                            <tbody style="text-transform: capitalize">
                                                <?php
                                                date_default_timezone_set("Asia/Jakarta");
                                                $tgl_sekarang = date('n');

                                                $tampil = mysqli_query($koneksi, "SELECT * FROM absen_masuk where bulan like '%$tgl_sekarang%' order by id_absen desc");

                                                $no = 1;
                                                while ($data = mysqli_fetch_array($tampil)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td class="text-center"><?= $data['nama_user'] ?></td>
                                                        <td class="text-center"><?= $data['tanggal'] ?></td>
                                                        <td class="text-center"><?= $data['waktu']  ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Tabel Riwayat Presensi Masuk -->
                        </div>
                        <div class="col-md-6 col">
                            <!-- Awal Tabel Riwayat Presensi Pulang -->
                            <div class="card shadow">
                                <div class="card-header text-center py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Riwayat Presensi Pulang Bulan Ini</h5>
                                </div>

                                <div class="card-body text-gray-900">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Tanggal</th>
                                                    <th>Waktu</th>
                                                </tr>
                                            </thead>

                                            <tbody style="text-transform: capitalize">
                                                <?php
                                                date_default_timezone_set("Asia/Jakarta");
                                                $tgl_sekarang = date('n');

                                                $tampil = mysqli_query($koneksi, "SELECT * FROM absen_pulang where bulan like '%$tgl_sekarang%' order by id_absen desc");

                                                $no = 1;
                                                while ($data = mysqli_fetch_array($tampil)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td class="text-center"><?= $data['nama_user'] ?></td>
                                                        <td class="text-center"><?= $data['tanggal'] ?></td>
                                                        <td class="text-center"><?= $data['waktu']  ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Tabel Riwayat Presensi Pulang -->
                        </div>
                    </div>
                    <!-- AKHIR TABEL RIWAYAT PRESENSI -->


                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer text-center bg-light">
                <div class="copyright text-primary my-auto">
                    <h6>Copyright &copy; Dinas Kependudukan dan Pencatatan Sipil Kabupaten Gunungkidul 2024 - <?= date("Y") ?> | All rights reserved</h6>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-gray-900" id="exampleModalLabel">Yakin ingin keluar..?</h4>
                    <button class="close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Oke untuk melanjutkan.! <br> Semoga Lelahmu Jadi Ibadah. (^_^)</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="logout.php">Oke</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- tambahan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- tambahan -->

</body>

</html>