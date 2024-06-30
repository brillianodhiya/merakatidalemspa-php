<div class="container">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center">Data Admin</h5>
        <div class="card-body">
            <a href="?page=profil&act=add" class="btn mb-3" style="background-color:#800080; color:#ffff;"><i class="fa fa-plus" style="color:#ffff;"></i> Tambah Admin</a></button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM tb_admin");
                        foreach ($sql as $d) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['nama_admin']; ?></td>
                                <td><?= $d['username']; ?></td>
                                <td><?= $d['password']; ?></td>
                            
                                <td>
                                    
                                    <a href="?page=profil&act=edit&id_admin=<?= $d['id_admin']; ?>" class="btn btn-primary text-white text-right"> <i class="fa fa-user-edit text-white"></i> </a>

                                    <a href="?page=profil&act=del&id_admin=<?= $d['id_admin']; ?>" class="btn btn-danger text-white text-right"> <i class="fas fa-trash-alt fa-1x text-white"></i> </a>
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
                <a href="?page=data_admin&act=del&id=<?= $d['id_admin'] ?>" class="btn btn-primary">Hapus</a>
            </div>
        </div>
    </div>
</div>