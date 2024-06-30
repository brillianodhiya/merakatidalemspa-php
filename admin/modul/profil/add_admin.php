<?php
include "../config/koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM tb_admin");

?>
<?php
$level = "admin";
?>
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold" style="color:#800080;">Tambah Data Admin</h6>
        </div>
        <div class="card-body">
        
        <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Admin</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Nama Admin" name="nama_admin" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Username" name="username" required="required">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Password" name="password" required="required">
                    </div>
                    
                    
                    <button name="saveKeluar" type="submit" class="btn mr-2" style="background-color:#800080; color:#ffff;">Simpan</button>
               </form>
            </div>
        </div>
    </div>
</div>



<?php
//...

if (isset($_POST['saveKeluar'])) {
  $nama = $_POST['nama_admin'];
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $save = mysqli_query($koneksi, "INSERT INTO tb_admin (nama_admin, username, password) VALUES ('$nama', '$user', '$pass')");

  if ($save) {
    echo " <script>
	          alert('Data Berhasil disimpan!');
	          window.location='?page=profil';
	          </script>";
  } else {
    echo "gagal";
  }
}

?>