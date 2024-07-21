<?php
$id = $_GET['id_price'];
$data = mysqli_query($koneksi, "SELECT * FROM pricelist WHERE id_price='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #800080;">Edit Data Pricelist</h6>
            </div>
            <div class="card-header py-2">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Treatment :</label>
                            <input type="hidden" class="form-control" name="id_price" value="<?php echo $d['id_price']; ?>">
                            <input type="text" class="form-control" name="nama_treatment" value="<?php echo $d['nama_treatment']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga :</label>
                            <input type="text" class="form-control" name="harga" value="<?php echo $d['harga']; ?>">
                        </div>
                        <button name="updateKeluar" type="submit" class="btn mr-2" style="background-color:#800080; color:#ffff;">Simpan</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php

    if (isset($_POST['updateKeluar'])) {
        $updatekeluar = mysqli_query($koneksi, "UPDATE pricelist SET 
			 nama_treatment='$_POST[nama_treatment]',
            harga='$_POST[harga]'
			WHERE id_price='$_POST[id_price]' ");

        if ($updatekeluar) {
            echo " <script>
	  alert('Data Berhasil diperbarui !');
	  window.location='?page=pricelist';
	  </script>";
        }
    }

    ?>

<?php
}
?>

</body>

</html>