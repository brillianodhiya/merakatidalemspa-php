<?php

// menangkap data id yang di kirim dari url
$id = $_GET['id_price'];

// menghapus data dari database
mysqli_query($koneksi, "DELETE FROM pricelist WHERE id_price='$id'");

// mengalihkan halaman kembali ke index.php
echo " <script>
      alert('Data Berhasil Dihapus !');
      window.location='?page=pricelist';
      </script>";
