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
            $totalPengurangan = 0;
            $totalWaktuTelatDalamMenit = 0;
            while ($abs = mysqli_fetch_array($resultAbsensiQuery)) {
                # code...
                if ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] == 'hadir') {
                    $jam_masuk = $abs['jam_masuk'];
                    $jam_keluar = $abs['jam_keluar'];
                    // jika jam keluar kosong gunakan jam 20:00:00
                    if ($jam_keluar == "") {
                        $jam_keluar = "20:00:00";
                    }
                    if ($totalMasuk <= 25) {
                        $totalMasuk++;
                    }
                    // jika jam masuk melebihi jam 9:00 maka akan dihitung terlambat
                    // contoh jika masuk jam 9:40 menit maka akan dihitung terlambat 40 menit
                    // jam keluar melebihi dihitung maksimal jam 20:00 jika lebih maka tidak ada denda absen keluar 
                    // ada pengurangan 10000 per 30 menit keterlambatan absen masuk
                    // tambahkan perhitungan per 30 menit nya juga
                    $telat = strtotime($jam_masuk) - strtotime("09:00:00");
                    $telat = $telat / 60;
                    if ($telat > 0) {
                        $totalWaktuTelatDalamMenit += ceil($telat);
                        $totalPengurangan += ceil($telat/30)*10000;
                    }
                    // jika jam keluar terdeteksi sebelum jam 20:00:00
                    // maka akan dihitung telat dan juga dikenakan pemotongan per 30 menitnya
                    if ($jam_keluar < "18:00:00") {
                        $telat = strtotime("20:00:00") - strtotime($jam_keluar);
                        $telat = $telat / 60;
                        if ($telat > 0) {
                            $totalWaktuTelatDalamMenit += ceil($telat);
                            $totalPengurangan += ceil($telat/30)*10000;
                        }
                    }
                    
                   
                } elseif ($abs['valid_absensi'] == "Y" && $abs['status_absensi'] != 'hadir') {
                    $totalIzin++;
                } elseif ($abs['valid_absensi'] == "N") {
                    $totalTidakValid++;
                }
            }

            // jika totalMasuk + totalIzin + totalTidakValid < 26 maka sisanya akan masuk ke izin
            if ($totalMasuk + $totalIzin + $totalTidakValid < 25) {
                $totalIzin += 25 - ($totalMasuk + $totalIzin + $totalTidakValid);
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
                $totalGaji = $gajiPok + $totalGajiMasuk + $totalKomisi - $totalGajiIzin - $totalPengurangan;

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
                'totalGaji' => $totalGaji,
                'totalPengurangan' => $totalPengurangan,
                'totalWaktuTelatDalamMenit' => $totalWaktuTelatDalamMenit
            );
            
            echo json_encode($data);
        }
?>