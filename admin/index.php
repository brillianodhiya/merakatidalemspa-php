<?php
session_start();
include '../config/koneksi.php';
include '../config/rupiah.php';
include '../config/timezone.php';
include 'tgl_indo.php'; 
include 'modul2/terbilang.php'; 
include 'modul2/tgl_indo.php'; 

setlocale(LC_TIME, 'id_ID.utf8');
$oke = mysqli_query($koneksi, "SELECT * FROM tb_aplikasi");
$oke1 = mysqli_fetch_array($oke);

if (@$_SESSION['Admin']) {
?>
    <?php
    if (@$_SESSION['Admin']) {
        $sesi = @$_SESSION['Admin'];
    }
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin = '$sesi'") or die(mysqli_error($koneksi));
    $data = mysqli_fetch_array($sql);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Halaman Administrator</title>
        <!-- Custom fonts for this template -->
        <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <style type="text/css">
   .sembunyikan{
  display: none;
}
 </style>

  <script src="js/Chart.bundle.js"></script>


  <script src="asset/js/jquery-1.10.2.js"></script>
  <script src="asset/js/jquery-ui.js"></script>

<script type="text/javascript">

     window.onload = function() { jam(); }

     function jam() {

      var e = document.getElementById('jam'),
          d = new Date(), h, m, s;
          h = d.getHours();
          m = set(d.getMinutes());
          s = set(d.getSeconds());
          e.innerHTML = h +':'+ m +':'+ s;
      setTimeout('jam()', 1000);
     }
     function set(e) {
      e = e < 10 ? '0'+ e : e;
      return e;
     }
    </script>
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    Merak Ati
                    <br>
                    Dalem Spa
                </a>
                <!-- Divider -->
      <hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - riwayat pelanggan -->
<li class="nav-item">
  <a class="nav-link" href="?page=tamu">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Riwayat Pelanggan</span></a>
</li>

<!-- Nav Item - karyawan -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Karyawan</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">:</h6> -->
      <a class="collapse-item" href="?page=karyawan">Data Karyawan</a>
      <a class="collapse-item" href="?page=absen">Kehadiran</a>
      <a class="collapse-item" href="?page=komhar_karyawan">Komisi Harian</a>
    </div>
  </div>
</li>

<!-- Nav Item - Administrasi -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Administrasi</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
      <a class="collapse-item" href="?page=pendapatan">Pendapatan</a>
      <a class="collapse-item" href="pengeluaran.php">Pengeluaran</a>
      <a class="collapse-item" href="?page=komisi">Komisi</a>
      
    </div>
  </div>
</li>

<!-- Nav Item - Pelaporan -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pelaporan</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">Login Screens:</h6> -->
      <a class="collapse-item" href="?page=laporan&act=pendapatan">Pendapatan Bulanan</a>
      <a class="collapse-item" href="pengeluaranbulanan.php">Pengeluaran Bulanan</a>
      <a class="collapse-item" href="?page=gaji&act=">Gaji Kryawan</a>
    </div>
  </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Login Screens:</h6>
      <a class="collapse-item" href="login.php">Login</a>
      <a class="collapse-item" href="register.php">Register</a>
      <!-- <a class="collapse-item" href="forgot-password.html">Forgot Password</a> -->
      <div class="collapse-divider"></div>
      <!-- <h6 class="collapse-header">Other Pages:</h6> -->
      <!-- <a class="collapse-item" href="404.html">404 Page</a>
      <a class="collapse-item" href="blank.html">Blank Page</a> -->
    </div>
  </div>
</li>



<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="tables.html">
    <i class="fas fa-fw fa-table"></i>
    <span>Tables</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                             <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                <!-- Counter - Messages -->
                                
                                <h5 style="color : black;   font-weight: 700; font-size: 14px" id="jam">00:00:00</h5>
                            </a>
                            </li>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        <?= $data['nama_admin']; ?>
                                    </span>
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="?page=profil">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <?php
                        error_reporting();
                        $page = @$_GET['page'];
                        $act = @$_GET['act'];

                        if ($page == 'karyawan') {
                            if ($act == '') {
                                include 'modul/karyawan/data_karyawan.php';
                            } elseif ($act == 'add') {
                                include 'modul/karyawan/add_karyawan.php';
                            } elseif ($act == 'edit') {
                                include 'modul/karyawan/edit_karyawan.php';
                            } elseif ($act == 'detail') {
                                include 'modul/karyawan/detail_karyawan.php';
                            } elseif ($act == 'del') {
                                include 'modul/karyawan/del_karyawan.php';
                            }
                        } elseif ($page == 'bagian') {
                            if ($act == '') {
                                include 'modul/bagian/data_bagian.php';
                            } elseif ($act == 'add') {
                                include 'modul/bagian/add_bagian.php';
                            } elseif ($act == 'edit') {
                                include 'modul/bagian/edit_bagian.php';
                            } elseif ($act == 'detail') {
                                include 'modul/bagian/detail_bagian.php';
                            } elseif ($act == 'del') {
                                include 'modul/bagian/del_bagian.php';
                            }
                        }elseif ($page == 'pendapatan') {
                            if ($act == '') {
                                include 'modul/pendapatan/data_pendapatan.php';
                            } elseif ($act == 'add') {
                                include 'modul/pendapatan/add_pendapatan.php';
                            } elseif ($act == 'edit') {
                                include 'modul/pendapatan/edit_pendapatan.php';
                            } elseif ($act == 'detail') {
                                include 'modul/pendapatan/detail_pendapatan.php';
                            } elseif ($act == 'del') {
                                include 'modul/pendapatan/del_pendapatan.php';
                            } 
                        } elseif ($page == 'jadwal') {
                            if ($act == '') {
                                include 'modul/jadwal/data_jadwal.php';
                            } elseif ($act == 'add') {
                                include 'modul/jadwal/add_jadwal.php';
                            } elseif ($act == 'edit') {
                                include 'modul/jadwal/edit_jadwal.php';
                            } elseif ($act == 'del') {
                                include 'modul/jadwal/del_jadwal.php';
                            } elseif ($act == 'detail') {
                                include 'modul/jadwal/detail_jadwal.php';
                            }
                        } elseif ($page == 'aplikasi') {
                            if ($act == '') {
                                include 'modul/aplikasi/data_aplikasi.php';
                            } elseif ($act == 'add') {
                                include 'modul/aplikasi/add_aplikasi.php';
                            } elseif ($act == 'edit') {
                                include 'modul/aplikasi/edit_aplikasi.php';
                            }
                        } elseif ($page == 'gaji') {
                            if ($act == '') {
                                include 'modul/gaji/data_gaji.php';
                            } elseif ($act == 'add') {
                                include 'modul/gaji/add_gaji.php';
                            } elseif ($act == 'edit') {
                                include 'modul/gaji/edit_gaji.php';
                            } elseif ($act == 'del') {
                                include 'modul/gaji/del_gaji.php';
                            } elseif ($act == 'detail') {
                                include 'modul/gaji/detail_gaji.php';
                            } elseif ($act == 'hitung') {
                                include 'modul/gaji/hitung_gaji.php';
                            } elseif ($act == 'hal') {
                                include 'modul/gaji/hal_gaji.php';
                            }
                        } elseif ($page == 'absen') {
                            if ($act == '') {
                                include 'modul/absen/data_absen.php';
                            } elseif ($act == 'add') {
                                include 'modul/absen/add_absen.php';
                            } elseif ($act == 'edit') {
                                include 'modul/absen/edit_absen.php';
                            } elseif ($act == 'confirm') {
                                include 'modul/absen/konfirmasi_absen.php';
                            } elseif ($act == 'unconfirm') {
                                include 'modul/absen/nonkonfirmasi_absen.php';
                            } elseif ($act == 'edit') {
                                include 'modul/absen/edit_absen.php';
                            } elseif ($act == 'detail') {
                                include 'modul/absen/detail_absen.php';
                            }
                        } elseif ($page == 'rekrutmen') {
                            if ($act == '') {
                                include 'modul/rekrutmen/data_rekrutmen.php';
                            } elseif ($act == 'add') {
                                include 'modul/rekrutmen/add_rekrutmen.php';
                            } elseif ($act == 'detail') {
                                include 'modul/rekrutmen/detail_rekrutmen.php';
                            } elseif ($act == 'aktif') {
                                include 'modul/rekrutmen/aktif_rekrutmen.php';
                            } elseif ($act == 'nonaktif') {
                                include 'modul/rekrutmen/nonaktif_rekrutmen.php';
                            } elseif ($act == 'pelamar') {
                                include 'modul/rekrutmen/pelamar_rekrutmen.php';
                            } elseif ($act == 'del') {
                                include 'modul/rekrutmen/del_rekrutmen.php';
                            }
                        } elseif ($page == 'pinjaman') {
                            if ($act == '') {
                                include 'modul/pinjaman/data_pinjaman.php';
                            } elseif ($act == 'add') {
                                include 'modul/pinjaman/add_pinjaman.php';
                            } elseif ($act == 'detail') {
                                include 'modul/pinjaman/detail_pinjaman.php';
                            }
                        } elseif ($page == 'profil') {
                            if ($act == '') {
                                include 'modul/profil/data_profil.php';
                            }
                        } elseif ($page == 'komisi') {
                            if ($act == '') {
                                include 'modul/komisi/data_komisi.php';
                            } elseif ($act == 'add') {
                                include 'modul/komisi/add_komisi.php';
                            } elseif ($act == 'detail') {
                                include 'modul/komisi/detail_komisi.php';
                            } elseif ($act == 'edit') {
                                include 'modul/komisi/edit_komisi.php';
                            } elseif ($act == 'del') {
                                include 'modul/komisi/del_komisi.php';
                            }
                        } elseif ($page == 'komhar_karyawan') {
                            if ($act == '') {
                                include 'modul/komhar_karyawan/data_komhar.php';
                            } elseif ($act == 'add') {
                                include 'modul/komhar_karyawan /add_komhar.php';
                            } elseif ($act == 'detail') {
                                include 'modul/komhar_karyawan /detail_komhar.php';
                            } elseif ($act == 'edit') {
                                include 'modul/komhar_karyawan /edit_komhar.php';
                            } elseif ($act == 'del') {
                                include 'modul/komhar_karyawan /del_komhar.php';
                            }
                        } elseif ($page == 'laporan') {
                            if ($act == '') {
                                include 'modul/laporan/laporan_pendapatan.php';
                            } elseif ($act == 'gaji') {
                                include 'modul/laporan/laporan_penggajian.php';
                            }
                        } elseif ($page == 'tamu') {
                            if ($act == '') {
                                include 'modul/tamu/riwayat.php';
                            } elseif ($act == 'add') {
                                include 'modul/tamu/add_riwayat.php';
                            }elseif ($act == 'detail') {
                                include 'modul/tamu/detail_riwayat.php';
                            }elseif ($act == 'edit') {
                                include 'modul/tamu/edit_riwayat.php';
                            }elseif ($act == 'del') {
                                include 'modul/tamu/del_riwayat.php';
                            }
                        } elseif ($page == '') {
                            include 'home.php';
                        } else {
                            echo "<b>404!</b> Tidak ada halaman !";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin keluar ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Silahkan pilih logout untuk keluar</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../assets/js/demo/datatables-demo.js"></script>

        <script type="text/javascript" src="../assets/vendor/ckeditor/ckeditor.js"></script>

    <?php } else {

    include 'modul/500.html';
}

    ?>

    </body>

    </html>