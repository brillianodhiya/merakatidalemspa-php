<?php
$id = $_GET['id_admin'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE id_admin='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #800080;">Edit Data Admin</h6>
            </div>
            <div class="card-header py-2">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Username :</label>
                            <input type="hidden" class="form-control" name="id_admin" value="<?php echo $d['id_admin']; ?>">
                            <input type="text" class="form-control" name="username" value="<?php echo $d['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            <input type="text" class="form-control" name="password" value="<?php echo $d['password']; ?>">
                        </div>
                        <button name="updateKeluar" type="submit" class="btn mr-2" style="background-color:#800080; color:#ffff;">Simpan</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php

    if (isset($_POST['updateKeluar'])) {
        $updatekeluar = mysqli_query($koneksi, "UPDATE tb_admin SET 
			 username='$_POST[username]',
            password='$_POST[password]'
			WHERE id_admin='$_POST[id_admin]' ");

        if ($updatekeluar) {
            echo " <script>
	  alert('Data Berhasil diperbarui !');
	  window.location='?page=profil';
	  </script>";
        }
    }

    ?>

<?php
}
?>

</body>

</html>