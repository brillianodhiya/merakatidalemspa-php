<?php
// https://www.malasngoding.com
// menghubungkan dengan koneksi database
include "../config/koneksi.php";

// mengambil data barang dengan kode paling besar
// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(kode_karyawan) as kodeTerbesar FROM tb_karyawan");
$data = mysqli_fetch_array($query);

// cek apakah kode karyawan terbesar ada atau tidak
if ($data['kodeTerbesar'] != null) {
    $kodeKaryawan = $data['kodeTerbesar'];

    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    $urutan = (int) substr($kodeKaryawan, 8, 8);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $urutan++;

    // membentuk kode barang baru
    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
    $huruf = "Therapis";
    $kodeKaryawan = $huruf . sprintf("%03s", $urutan);
} else {
    // jika tidak ada data, buat kode karyawan pertama dengan format Therapis001
    $kodeKaryawan = "Therapis001";
}
?>
<?php
$level = "karyawan";
?>
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Karyawan</h6>
        </div>
        <div class="card-body">

            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Karyawan :</label>
                        <input type="text" class="form-control" name="kode_karyawan" required="required" value="<?php echo $kodeKaryawan ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama :</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama_karyawan" required="required">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telfon :</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor" name="no_hp" required="required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk :</label>
                        <input type="date" class="form-control"  name="tgl_masuk" required="required">
                    </div>
                    <button name="saveKaryawan" type="submit" class="btn btn-success mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php

// cek nis
if (isset($_POST['saveKaryawan'])) {
    $id         = $_POST['id_karyawan'];
    $kode         = $_POST['kode_karyawan'];
    $nama         = $_POST['nama_karyawan'];
    $username    = $_POST['kode_karyawan'];
    $pass        = $_POST['kode_karyawan'];
    $no_hp       = $_POST['no_hp'];
    $tgl_masuk      = $_POST['tgl_masuk'];
    


    //query INSERT disini
    $nama = addslashes($_POST['nama_karyawan']);
    $save = mysqli_query($koneksi, "INSERT INTO tb_karyawan (id_karyawan, kode_karyawan, nama_karyawan, username, password, no_hp, tgl_masuk)
    VALUES (NULL, '$kode', '$nama', '$username', '$pass', '$no_hp', '$tgl_masuk')");

    if ($save) {
        echo " <script>
	          alert('Data Berhasil disimpan !');
	          window.location='?page=karyawan';
	          </script>";
    }
}

?>