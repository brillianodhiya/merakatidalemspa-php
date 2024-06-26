<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Komisi Karyawan</h5>
        <div class="card-body">
            <a href="?page=komhar&act=add" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Komisi Karyawan</a></button>
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                     
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
            </div>

            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM komhar 
            INNER JOIN riwayat_pelanggan ON komhar.id_tamu=riwayat_pelanggan.id_tamu 
            INNER JOIN komisi on komhar.id_kom=komisi.id_kom");       
            while ($d = mysqli_fetch_array($data)) {
                $total_komisi = ($d['jumlah'] / 100) * $d['total'];
            ?>
                <tbody>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['treatment']; ?></td>
                        <td><?= $d['tanggal_kunjung']; ?></td>
                        <td><?= $d['nama_tamu']; ?></td>
                        <td><?= rupiah($d['total']); ?></td>
                        <td><?= $d['kode_komisi']; ?></td>
    
                        <td><?= $d['jumlah']; ?>%</td>
                        <td><?= rupiah($total_komisi); ?></td>
                        <td>
                            <a href="?page=komhar&act=edit&id=<?= $d['id_komhar']; ?>" class="btn btn-warning text-white text-right"> <i class="fa fa-user-edit text-white"></i> </a>
                            <a href="?page=komhar&act=del&id=<?= $d['id_komhar']; ?>" class="btn btn-danger text-white text-right"> <i class="fas fa-trash-alt fa-1x text-white"></i> </a>
                        </td>
                    </tr>
                <?php

            }
                ?>
                </tr>
        </div>
        </tbody>
        </table>
    </div>
</div>

