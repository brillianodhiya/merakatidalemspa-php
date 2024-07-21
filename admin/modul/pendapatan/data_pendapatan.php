<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Pendapatan Karyawan</h5>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Treatment</th>
                            <th>Harga</th>
                            <th>Potongan</th>
                            <th>Total Bayar</th>
                            <th>Tanggal </th>
                            <!-- <th>Opsi</th> -->
                        </tr>
                    </thead>
            

            <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM riwayat_pelanggan");
            while ($d = mysqli_fetch_array($data)) {
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['treatment']; ?></td>
                        <td><?= rupiah($d['harga']); ?></td>
                        <td><?= rupiah($d['potongan']); ?></td>
                        <td><?= rupiah($d['total']); ?></td>
                        <td><?= $d['tanggal_kunjung']; ?></td>
                        <!-- <td>
                            <a href="?page=pendapatan&act=del&id=<?= $d['id_pendapatan']; ?>" class="btn btn-danger text-white text-right"> <i class="fas fa-trash-alt fa-1x text-white"></i> </a>
                            
                        </td> -->
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