<?php
        include 'koneksi.php'; // Assume this is your database connection file
        
        // echo("<p>ppp2</p>");
            $query = "SELECT * FROM pricelist";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($result)) {
                // echo "<option value='" . $row['id_tamu'] . "'>" . $row['nama_tamu'] . "</option>";
                // return json
                $data[] = array(
                    'id_price' => $row['id_price'],
                    'nama_treatment' => $row['nama_treatment'],
                    'harga' => $row['harga'],
                );
            }
            echo json_encode($data);
?>