<?php
include "../config/koneksi.php";
$query = mysqli_query($koneksi, "SELECT * FROM riwayat_pelanggan");
$id_tamu=1;
?>
<?php
$level = "admin";
?>
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold" style="color: #800080;">Tambah Data Pelanggan</h6>
        </div>
        <div class="card-body">
        
        <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Klien</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Nama" name="nama_tamu" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Alamat" name="alamat" required="required">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telfon</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Nomor Telfon" name="no_hp" required="required">
                    </div>
                    <div class="form-group">
                        <label>Treatment</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Treatment" name="treatment" required="required">
                        </div>
                    <div class="form-group">
                        <label>Masalah</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Masalah" name="masalah" required="required">
                    </div>
                    <div class="form-group">
                        <label>Pilih Karyawan</label>
                        <select class="form-control" name="id_karyawan" onchange="cek_database()" id="id_karyawan">
                            
                            <?php
                            $pegawai = mysqli_query($koneksi, "SELECT * FROM tb_karyawan");
                            foreach($pegawai as $p){?>
                            <option value="<?= $p['id_karyawan']; ?>"><?= $p['nama_karyawan']; ?></option>
                            <?php 
                        }
                            ?>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Treatment</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Harga Treatment" name="harga" required="required">
                    </div>
                    <div class="form-group">
                        <label>Potongan (%)</label>
                        <input type="text" class="form-control" 
                        placeholder="Masukkan Potongan Treatment" name="potongan" required="required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kunjungan</label>
                        <input type="date" class="form-control"  name="tanggal_kunjung" required="required">
                    </div>
                    
                    
                    <button name="saveTamu" type="submit" class="btn mr-2" style="background-color: #800080; color: #ffff;">Simpan</button>
               </form>
            </div>
        </div>
    </div>
</div>



<?php

// cek nis
if (isset($_POST['saveTamu'])) {
  $id_kar = $_POST['id_karyawan'];
  $nama_tamu = $_POST['nama_tamu'];
  $alamat = $_POST['alamat'];
  $no_hp = $_POST['no_hp'];
  $treatment = $_POST['treatment'];
  $masalah = $_POST['masalah'];
  $harga = $_POST['harga'];
  $potongan=$harga*($_POST['potongan'])/100;
  $total=$harga-$potongan;
  $tanggal_kunjung = $_POST['tanggal_kunjung'];


    //query INSERT disini
  
    $save = mysqli_query($koneksi, "INSERT INTO riwayat_pelanggan VALUES(NULL,'$id_kar', '$nama_tamu','$alamat',
    '$no_hp','$treatment','$masalah',  '$harga', '$potongan', '$total', '$tanggal_kunjung')");


    if ($save) {
        echo " <script>
	          alert('Data Berhasil disimpan !');
	          window.location='?page=tamu';
	          </script>";
    }else{
        echo"gagal";
    }
}

?>