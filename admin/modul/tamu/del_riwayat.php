<?php

// menangkap data id yang di kirim dari url
$id = $_GET['id_tamu'];

// menghapus data dari database
mysqli_query($koneksi, "DELETE FROM riwayat_pelanggan WHERE id_tamu='$id'");

// mengalihkan halaman kembali ke index.php
echo " <script>
      alert('Data Berhasil Dihapus !');
      window.location='?page=tamu';
      </script>";
