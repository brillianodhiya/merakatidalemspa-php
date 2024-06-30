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
}
?>

<div class="container" style="max-width:800px; margin:40px auto;">
    <div class="card shadow mb-4">
        <h5 class="card-header text-center text-white" style="background-color:#800080;">Profil Karyawan</h5>
        <div class="card-body" >
        <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan
            WHERE tb_karyawan.id_karyawan = '$user_id'");
            foreach ($sql as $d) { ?>
                <tr>
                    <td><b>Nama Karyawan</b></td>
                    <td><?= $d['nama_karyawan']; ?></td>
                </tr>
                <tr>
                    <td><b>Username</b></td>
                    <td><?= $d['username']; ?></td>
                </tr>
                <tr>
                    <td><b>Password</b></td>
                    <td><?= $d['password']; ?></td>
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