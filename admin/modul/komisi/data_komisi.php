<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Komisi</h5>
        <div class="card-body">
            <a href="?page=komisi&act=add" class="btn mb-3" style="background-color:#800080; color:#ffff;"><i class="fa fa-plus" style="color:#ffff;"></i> Tambah Komisi</a></button>
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Komisi</th>
                            <th>Jumlah Komisi (%)
                            </th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
            <tbody>
            <?php
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM komisi");
            while ($d = mysqli_fetch_array($data)) {
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d['kode_komisi']; ?></td>
                        <td><?= $d['jumlah']; ?></td>
                        <td>
                            <a href="?page=komisi&act=edit&id_kom=<?= $d['id_kom']; ?>" class="btn btn-primary text-white text-right"> <i class="fa fa-user-edit text-white"></i> </a>
                            <a href="?page=komisi&act=del&id_kom=<?= $d['id_kom']; ?>" class="btn btn-danger text-white text-right"> <i class="fas fa-trash-alt fa-1x text-white"></i> </a>
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