<?php
$id = $_GET['id_keluar'];
$data = mysqli_query($koneksi, "SELECT * FROM pengeluaran WHERE id_keluar='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #800080;">Edit Data Pengeluaran</h6>
            </div>
            <div class="card-header py-2">
                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Pengeluaran :</label>
                            <input type="hidden" class="form-control" name="id_keluar" value="<?php echo $d['id_keluar']; ?>">
                            <input type="text" class="form-control" name="jenis_keluar" value="<?php echo $d['jenis_keluar']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah :</label>
                            <input type="text" class="form-control" name="jumlah" value="<?php echo $d['jumlah']; ?>">
                        </div>
                        <button name="updateKeluar" type="submit" class="btn mr-2" style="background-color:#800080; color:#ffff;">Simpan</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php

    if (isset($_POST['updateKeluar'])) {
        $updatekeluar = mysqli_query($koneksi, "UPDATE pengeluaran SET 
			jenis_keluar='$_POST[jenis_keluar]', jumlah='$_POST[jumlah]'
			WHERE id_keluar='$_POST[id_keluar]' ");

        if ($updatekeluar) {
            echo " <script>
	  alert('Data Berhasil diperbarui !');
	  window.location='?page=pengeluaran';
	  </script>";
        }
    }

    ?>

<?php
}
?>

</body>

</html>