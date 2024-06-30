<?php

// menangkap data id yang di kirim dari url
$id = $_GET['id_keluar'];

// menghapus data dari database
mysqli_query($koneksi, "DELETE FROM pengeluaran WHERE id_keluar='$id'");

// mengalihkan halaman kembali ke index.php
echo " <script>
      alert('Data Berhasil Dihapus !');
      window.location='?page=pengeluaran';
      </script>";
