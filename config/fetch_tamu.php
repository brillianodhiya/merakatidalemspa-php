<?php
        include 'koneksi.php'; // Assume this is your database connection file
        
        if (isset($_GET['tanggal_kunjung'])) {
        // echo("<p>ppp2</p>");

            $tanggal_kunjung = $_GET['tanggal_kunjung'];
            $query = "SELECT * FROM riwayat_pelanggan WHERE tanggal_kunjung = '$tanggal_kunjung'";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($result)) {
                // echo "<option value='" . $row['id_tamu'] . "'>" . $row['nama_tamu'] . "</option>";
                // return json
                $data[] = array(
                    'id_tamu' => $row['id_tamu'],
                    'nama_tamu' => $row['nama_tamu'],
                    'alamat' => $row['alamat'],
                    'no_hp' => $row['no_hp'],
                    'treatment' => $row['treatment'],
                    'masalah' => $row['masalah'],
                    'harga' => $row['harga'],
                    'potongan' => $row['potongan'],
                    'total' => $row['total'],
                    'tanggal_kunjung' => $row['tanggal_kunjung']
                );
            }
            echo json_encode($data);
        }
?>