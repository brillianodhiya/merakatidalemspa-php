<?php
$id = $_GET['id_tamu'];
$data = mysqli_query($koneksi, "SELECT * FROM riwayat_pelanggan WHERE id_tamu='$id'");
               
while ($d = mysqli_fetch_array($data)) {
?>

    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #800080;">Edit Data Pelanggan</h6>
            </div>
            <div class="card-header py-2">
                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Klien</label>
                            <input type="hidden" class="form-control" name="id_tamu" value="<?php echo $d['id_tamu']; ?>">
                            <input type="text" class="form-control" name="nama_tamu" value="<?php echo $d['nama_tamu']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" value="<?php echo $d['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nomor Telfon</label>
                            <input name="no_hp" type="text" class="form-control" value="<?php echo $d['no_hp']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Treatment</label>
                            <!-- <input name="treatment" type="text" class="form-control" value="<?php echo $d['treatment']; ?>"> -->
                            <select class="form-control" name="treatment" onchange="getHarga()" id="treatment">
                            
                            <?php
                            $komisi = mysqli_query($koneksi, "SELECT * FROM pricelist");
                            foreach($komisi as $k){?>
                            <option value="<?= $k['nama_treatment']; ?>" harga="<?= $k['harga'] ?>" 
                            <?php if($d['treatment'] == $k['nama_treatment']) echo 'selected'; ?>>
                            <?= $k['nama_treatment']; ?></option>
                            <?php 
                        }
                            ?>
                            
                        </select>
                        </div>
                        <div class="form-group">
                            <label>Malasah</label>
                            <input name="masalah" type="text" class="form-control" value="<?php echo $d['masalah']; ?>">
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
                            <label>Harga</label>
                            <input name="harga" type="text" class="form-control" value="<?php echo $d['harga']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Potongan</label>
                            <input name="potongan" type="text" class="form-control"  placeholder="Harap Isi Kembali Potongan Harga" required="required">
                        </div>
                        <button name="updateTamu" type="submit" class="btn mr-2" style="background-color: #800080; color:#ffff;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php

if (isset($_POST['updateTamu'])) {

    $id_kar = $_POST['id_karyawan'];
    $nama_tamu = $_POST['nama_tamu'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $treatment = $_POST['treatment'];
    $masalah = $_POST['masalah'];
    $harga = $_POST['harga'];
    $potongan=$harga*($_POST['potongan'])/100;
    $total=$harga-$potongan;


    //query INSERT disini
    $save = mysqli_query($koneksi, "UPDATE riwayat_pelanggan SET nama_tamu='$nama_tamu', alamat='$alamat', 
    no_hp='$no_hp', treatment='$treatment', masalah='$masalah', masalah='$masalah', harga='$harga', potongan='$potongan', total='$total' WHERE id_tamu='$id'");

    if ($save) {
        echo " <script>
      alert('Data Berhasil Diubah !');
      window.location='?page=tamu';
      </script>";
    }
}

    ?>

<?php
}
?>

</body>
<script>
    const getHarga = () => {
        const treatment = document.getElementById('treatment');
        const harga = document.getElementById('harga');
        const selectedHarga = treatment.options[treatment.selectedIndex].getAttribute('harga');
        harga.value = selectedHarga;
    }
</script>

</html>