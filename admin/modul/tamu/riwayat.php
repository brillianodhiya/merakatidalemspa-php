
<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Pelanggan</h5>
        <div class="card-body">
            <a href="?page=tamu&act=add" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Pelanggan</a></button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th width="40px"> Id</th>
                        <th>Nama Klien</th>
                        <th>Alamat</th>
                        <th>Nomor Telfon</th>
                        <th>Treatment</th>
                        <th>Masalah</th>
                        <th>Nama Karyawan</th>
                        <th>Harga</th>
                        <th>Potongan</th>
                        <th>Total Bayar</th>
                        <th>Tanggal Kunjungan</th>
                        <th style="text-align: center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM riwayat_pelanggan INNER JOIN tb_karyawan 
                        ON riwayat_pelanggan.id_karyawan = tb_karyawan.id_karyawan");
             
                        foreach ($sql as $d) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama_tamu']; ?></td>
                                <td><?= $d['alamat']; ?></td>
                                <td><?= $d['no_hp']; ?></td>
                                <td><?= $d['treatment']; ?></td>
                                <td><?= $d['masalah']; ?></td>
                                <td><?= $d['nama_karyawan']; ?></td>
                                <td><?= rupiah($d['harga']); ?></td>
                                <td><?= rupiah($d['potongan']); ?></td>
                                <td><?= rupiah($d['total']); ?></td>
                                <td><?= $d['tanggal_kunjung']; ?></td>
                                <td>
                                    <a href="?page=tamu&act=edit&id_tamu=<?= $d['id_tamu']; ?>" class="btn btn-warning text-white text-right"> <i class="fa fa-user-edit text-white"></i> </a>

                                    <a href="?page=tamu&act=del&id_tamu=<?= $d['id_tamu']; ?>" class="btn btn-danger text-white text-right"> <i class="fas fa-trash-alt fa-1x text-white"></i> </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal Hapus-->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah data akan dihapus ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="?page=tamu&act=del&id=<?= $d['id_tamu'] ?>" class="btn btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>