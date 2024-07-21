<?php
        include 'koneksi.php'; // Assume this is your database connection file
        
        if (isset($_GET['bulan'])) {

            $bulan = $_GET['bulan']."-25"; // exptected example 06-2024
            $neracaQuery = "SELECT * FROM tb_neraca WHERE MONTH(bulan) = MONTH('$bulan') AND YEAR(bulan) = YEAR('$bulan')";
            $resultneracaQuery = mysqli_query($koneksi, $neracaQuery);

            $row = mysqli_fetch_assoc($resultneracaQuery);
            
            $data = array(
                'modal' => $row['modal'],
                'peralatan' => $row['peralatan'],
            );
            
            echo json_encode($data);
        }
?>