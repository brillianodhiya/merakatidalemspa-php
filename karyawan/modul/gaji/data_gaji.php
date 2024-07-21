<?php
// Get the ID of the logged-in user
if (isset($_SESSION['Karyawan'])) {
    $user_id = $_SESSION['Karyawan'];
} elseif (isset($_SESSION['Admin'])) {
    $user_id = $_SESSION['Admin'];
} else {
    // Handle the case where the user is not logged in
    echo "You are not logged in!";
    exit;
}?>
<style>
.page-link {
    color: #800080;
  background-color: #fff;
}
    </style>
<body>
    <div class="container">
        <div class="card shadow mb-4">
            <h5 class="card-header text-center" >Data Gaji Karyawan</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Gaji</th>
                                <th>Kode Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Gaji Bersih</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT * FROM tb_gaji INNER JOIN tb_karyawan 
                        ON tb_gaji.id_karyawan = tb_karyawan.id_karyawan
                        WHERE tb_gaji.id_karyawan = '$user_id'");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['tgl_gaji']; ?></td>
                                    <td><?= $d['kode_karyawan'] ?></td>
                                    <td><?= $d['nama_karyawan'] ?></td>
                                    <td>
                                        <?php
                                     
                                        echo rupiah($d['total_gaji']);
                                        ?>
                                    </td>
                                    <td>
                                        <!-- <a href="?page=gaji&act=edit&id_gaji=<?= $d['id_gaji']; ?>" class="btn btn-warning text-white text-right"> <i class="fa fa-user-edit text-white"></i> </a> -->
                                        <a href="modul/gaji/cetak_perkaryawan.php?gaji=<?= $_GET['gaji']; ?>&id=<?= $d['id_gaji'] ?>" target="_blank" class="btn  text-white text-right" style="background-color:#800080;"><i class="fa fa-print text-white" ></i> </a>
                                    </td>
                                    </tr>
                                <?php
                            }
                                ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>