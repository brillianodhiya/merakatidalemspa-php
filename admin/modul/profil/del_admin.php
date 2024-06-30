<?php

// menangkap data id yang di kirim dari url
$id = $_GET['id_admin'];

// menghapus data dari database
mysqli_query($koneksi, "DELETE FROM tb_admin WHERE id_admin='$id'");

// mengalihkan halaman kembali ke index.php
echo " <script>
      alert('Data Berhasil Dihapus !');
      window.location='?page=profil';
      </script>";
