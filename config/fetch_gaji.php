<?php
        include 'koneksi.php'; // Assume this is your database connection file
        
        if (isset($_GET['bulan'])) {

            $bulan = $_GET['bulan']."-25"; // exptected example 06-2024
            $idKaryawan = $_GET['id_karyawan'];
            $absensiQuery = "SELECT * FROM tb_absenkaryawan WHERE id_karyawan='$idKaryawan' AND MONTH(tgl_absensi) = MONTH('$bulan') AND YEAR(tgl_absensi) = YEAR('$bulan')";
            $resultAbsensiQuery = mysqli_query($koneksi, $absensiQuery);
            $totalMasuk = 0;
            $totalIzin = 0;
            $totalTidakValid = 0;
            while ($abs = mysqli_fetch_array($resultAbsensiQuery)) {
                # code...
                if ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] == 'hadir') {
                    if ($totalMasuk <= 25) {
                        $totalMasuk++;
                    }
                } elseif ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] != 'hadir') {
                    $totalIzin++;
                } elseif ($abs['valid_absensi'] == "N") {
                    $totalTidakValid++;
                }
            }

            $queryListKomisi = mysqli_query($koneksi, "SELECT rp.*, kh.total_komisi, kc.kode_komisi
            FROM riwayat_pelanggan rp
            JOIN komhar kh ON rp.id_tamu = kh.id_tamu
            JOIN komisi kc ON kh.id_kom = kc.id_kom WHERE rp.id_karyawan='$idKaryawan' AND MONTH(rp.tanggal_kunjung) = MONTH('$bulan') AND YEAR(rp.tanggal_kunjung) = YEAR('$bulan')");
                $totalKomisi = 0;
                $countKomisi = 0;
                $kalimatkomisi = "";
                while ($lk = mysqli_fetch_array($queryListKomisi)) {
                    # code...
                    $totalKomisi += $lk['total_komisi'];
                    $countKomisi++;
                    $kalimatkomisi .= $lk['kode_komisi'] . ", ";
                }
                // echo "<p>".$kalimatkomisi."</p>";
        
                $totalGajiMasuk = $totalMasuk*10000;
                $totalCountIzinDanTidakValid = $totalIzin + $totalTidakValid;
                $totalGajiIzin = $totalCountIzinDanTidakValid*10000;
                $gajiPok = 700000;
                $totalGaji = $gajiPok + $totalGajiMasuk + $totalKomisi - $totalGajiIzin;

            $data = array(
                'totalMasuk' => $totalMasuk,
                'totalIzin' => $totalIzin,
                'totalTidakValid' => $totalTidakValid,
                'bulan' => $bulan,
                'idKaryawan' => $idKaryawan,
                'totalGajiMasuk' => $totalGajiMasuk,
                'totalCountIzinDanTidakValid' => $totalCountIzinDanTidakValid,
                'totalGajiIzin' => $totalGajiIzin,
                'gajiPok' => $gajiPok,
                'totalKomisi' => $totalKomisi,
                'countKomisi' => $countKomisi,
                'kalimatkomisi' => $kalimatkomisi,
                'totalGaji' => $totalGaji
            );
            
            echo json_encode($data);
        }
?>