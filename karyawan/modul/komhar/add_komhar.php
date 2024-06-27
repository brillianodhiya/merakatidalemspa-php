
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Komisi Harian </h6>
        </div>
        <div class="card-body">
            <p style="color: red">Silahkan isi absen setiap hari kerja</p>
            <div class="container">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Karyawan</label>
                        <input type="hidden" class="form-control" name="id_karyawan" value="<?= $data['id_karyawan']; ?>" readonly>
                        <input type="text" class="form-control" name="kode_karyawan" value="<?= $data['kode_karyawan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" name="nama_karyawan" value="<?= $data['nama_karyawan']; ?>" readonly>
                    </div>
                   
                    <div class="form-group">
                        <label>Tanggal Kunjungan</label>
                        <input type="date" class="form-control" name="tanggal_kunjung" id="tanggal_kunjung" required="required">
                    </div>
                    <div class="form-group">
    <label>Nama Tamu</label>
    <select class="form-control" name="id_tamu" id="id_tamu">
        <option value="">-- Pilih Nama Tamu --</option>

    </select>
</div>
                    <div class="form-group">
                    <label>Treatment</label>
                        <input 
                        type="text"
                        class="form-control"
                        name="treatment"
                        readonly
                        id="treatment"
                        >

                    </div>
                    
                    <div class="form-group">
                    <label>Pilih Komisi</label>
                        <select class="form-control" name="id_kom" onchange="cek_database()" id="id_kom">
                            
                            <?php
                            $komisi = mysqli_query($koneksi, "SELECT * FROM komisi");
                            foreach($komisi as $k){?>
                            <option value="<?= $k['id_kom']; ?>"><?=$k['kode_komisi']; ?></option>
                            <?php 
                        }
                            ?>
                            
                        </select>
                    </div>

                    <div class="form-group">
                    <label>Harga</label>
                        <input 
                        type="text"
                        class="form-control"
                        name="harga"
                        readonly
                        id="harga"
                        >
                    </div>
                    <button name="saveMasuk" type="submit" class="btn btn-primary mr-2">Masukkan Komisi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var listTamu = []

document.getElementById('tanggal_kunjung').addEventListener('change', function() {
    var selectedDate = this.value;
    fetchTamuData(selectedDate);
});

function fetchTamuData(selectedDate) {
    // Menggunakan teknologi Ajax (misalnya dengan jQuery atau fetch API)
    // Kirim permintaan ke server dengan parameter tanggal
    // Tangani respons dari server dan isi dropdown nama tamu
    // console.log(selectedDate);
    var id_karyawan =  <?php
    echo $data['id_karyawan'];
    ?>;
    // gunakan fetch GET
    var url = ""
    if (window.location.origin.includes("localhost")) {
        url = '/adminsalon/config/fetch_tamu.php?tanggal_kunjung=' + selectedDate
    } else {
        url = '/config/fetch_tamu.php?tanggal_kunjung=' + selectedDate
    }
    fetch(url + "&id_karyawan=" + id_karyawan)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // isi dropdown nama tamu
            if (data) {
                listTamu = data;
                var idTamu = document.getElementById('id_tamu');
                idTamu.innerHTML = '';
                // idTamu.innerHTML = '<option value="">-- Pilih Nama Tamu --</option>';
                data.forEach(tamu => {
                    var option = document.createElement('option');
                    option.value = tamu.id_tamu;
                    option.text = tamu.nama_tamu;
                    idTamu.appendChild(option);
                });

                // rubah treatment dan harga mengikuti array pertama
                document.getElementById('treatment').value = data[0].treatment;
                document.getElementById('harga').value = data[0].total;
            }
        });

}

// fungsi ketika nama tamu di rubah maka rubah treatment dengan treatment, harga dengan harga
document.getElementById('id_tamu').addEventListener('change', function() {
    var selectedIdTamu = this.value;
    var selectedTamu = listTamu.find(tamu => tamu.id_tamu == selectedIdTamu);
    // console.log(selectedTamu);
    document.getElementById('treatment').value = selectedTamu.treatment;
    document.getElementById('harga').value = selectedTamu.total;
});

</script>

<?php

// cek nis
if (isset($_POST['saveMasuk'])) {
  
  $id_tamu = $_POST['id_tamu'];
  $id_kar = $_POST['id_karyawan'];
  $id_komisi = $_POST['id_kom'];
  $treatment = $_POST['treatment'];
//   hitung total komisi
  $harga = $_POST['harga'];
  $komisi = mysqli_query($koneksi, "SELECT * FROM komisi WHERE id_kom = '$id_komisi'");
  $data_komisi = mysqli_fetch_array($komisi);
  $total_komisi = $harga * $data_komisi['jumlah'] / 100;    
    //query INSERT disini


  
    $save = mysqli_query($koneksi, "INSERT INTO komhar VALUES(NULL, 
    '$id_tamu', '$id_kar', '$id_komisi', '$total_komisi')");


    if ($save) {
        echo " <script>
	          alert('Data Berhasil disimpan !');
	          window.location='?page=komhar';
	          </script>";
    }else{
        echo"gagal";
    }
}

?>