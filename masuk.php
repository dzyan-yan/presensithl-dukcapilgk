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
        $tgl             = date('Y-m-d');
        $bulan           = date('m');
        $waktu           = date ('H:i:s');
        $username        = $_POST['username'];
        $nama_user       = $_POST['nama_user'];
        $nik             = $_POST['nik'];
        $uker            = $_POST['uker'];
        $jabatan         = $_POST['jabatan'];


        $simpan = mysqli_query($koneksi, "INSERT INTO absen_masuk (tanggal, bulan, waktu, username, nama_user, nik, uker, jabatan) VALUES ('$tgl', '$bulan', '$waktu', '$username', '$nama_user', '$nik', '$uker', '$jabatan')");

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
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-light">
                    <!-- Awal Form -->
                    <div class="row mt-2">
                        <div class="col-lg-3 mb-3"> </div>

                        <!-- col lg-8 -->
                        <div class="col-lg-6 mb-3">
                            <div class="card shadow bg-info-200">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class=" p-1">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-5">Presensi Masuk Kerja</h1>
                                        </div>
                                        <form class="user text-gray-900" method="POST" action="">

                                            <div class="form-group">
                                                <input class="form-control" type="hidden" style="text-transform: capitalize" name="username" value="<?php echo $_SESSION['username']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="hidden" style="text-transform: capitalize" name="nama_user" value="<?php echo $_SESSION['nama_user']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="hidden" style="text-transform: capitalize" name="nik" value="<?php echo $_SESSION['nik']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="hidden" name="uker" value="<?php echo $_SESSION['uker']; ?>">
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="hidden"  style="text-transform: capitalize" name="jabatan" value="<?php echo $_SESSION['jabatan']; ?>">
                                            </div>

                                            <button type="submit" name="bsimpan" class="btn btn-primary btn-block">Presensi Masuk
                                            </button>

                                            <a href="home.php" class="btn btn-success btn-block mt-5">Kembali</a>

                                        </form>

                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                        <!-- end col lg-8 -->
                        <div class="col-lg-3 mb-3"> </div>
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