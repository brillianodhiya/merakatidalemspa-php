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
<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Komisi Karyawan</h5>
        <div class="card-body">
            <a href="?page=komhar&act=add" class="btn mb-3" style="background-color: #800080; color: #ffff;"><i class="fa fa-plus" style= "color: #ffff;"></i> Tambah Komisi Karyawan</a></button>
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                        <th>Kode Karyawan</th>
                            <th>Treatment</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Nama Tamu</th>
                            <th>Harga</th>
                            <th>Jenis Komisi</th>
                            <th>Jumlah Komisi</th>
                            <th>Jumlah Pendapatan Komisi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

            <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM komhar 
            INNER JOIN riwayat_pelanggan ON komhar.id_tamu=riwayat_pelanggan.id_tamu 
            INNER JOIN komisi on komhar.id_kom=komisi.id_kom
            INNER JOIN tb_karyawan on komhar.id_karyawan=tb_karyawan.id_karyawan
            WHERE tb_karyawan.id_karyawan = '$user_id'");       
            
            while ($d = mysqli_fetch_array($data)) {
                $total_komisi = ($d['jumlah'] / 100) * $d['total'];
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['nama_karyawan']; ?></td>
                        <td><?= $d['kode_karyawan']; ?></td>
                        <td><?= $d['treatment']; ?></td>
                        <td><?= $d['tanggal_kunjung']; ?></td>
                        <td><?= $d['nama_tamu']; ?></td>
                        <td><?= rupiah($d['total']); ?></td>
                        <td><?= $d['kode_komisi']; ?></td>
    
                        <td><?= $d['jumlah']; ?>%</td>
                        <td><?= rupiah($total_komisi); ?></td>
                        <td>
                            <a href="?page=komhar&act=edit&id=<?= $d['id_komhar']; ?>" class="btn btn-primary text-white text-right" > <i class="fa fa-user-edit text-white"></i> </a>
                            <a href="?page=komhar&act=del&id=<?= $d['id_komhar']; ?>" class="btn btn-danger text-white text-right"> <i class="fas fa-trash-alt fa-1x text-white"></i> </a>
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

