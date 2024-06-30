/*
 Navicat Premium Data Transfer

 Source Server         : Local MySql
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : salondata

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 28/06/2024 16:37:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for komhar
-- ----------------------------
DROP TABLE IF EXISTS `komhar`;
CREATE TABLE `komhar`  (
  `id_komhar` int NOT NULL AUTO_INCREMENT,
  `id_tamu` int NOT NULL,
  `id_karyawan` int NOT NULL,
  `id_kom` int NOT NULL,
  `total_komisi` int NOT NULL,
  PRIMARY KEY (`id_komhar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of komhar
-- ----------------------------
INSERT INTO `komhar` VALUES (1, 12, 1, 1, 0);
INSERT INTO `komhar` VALUES (2, 14, 1, 1, 0);
INSERT INTO `komhar` VALUES (3, 17, 1, 1, 0);
INSERT INTO `komhar` VALUES (11, 21, 1, 3, 56000);
INSERT INTO `komhar` VALUES (12, 23, 1, 2, 70400);

-- ----------------------------
-- Table structure for komisi
-- ----------------------------
DROP TABLE IF EXISTS `komisi`;
CREATE TABLE `komisi`  (
  `id_kom` int NOT NULL AUTO_INCREMENT,
  `kode_komisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_kom`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of komisi
-- ----------------------------
INSERT INTO `komisi` VALUES (1, 'Facial Treatment', '10');
INSERT INTO `komisi` VALUES (2, 'Spa Treatment', '10');
INSERT INTO `komisi` VALUES (3, 'Treatment Satuan', '7');
INSERT INTO `komisi` VALUES (4, 'Bawa Pelanggan', '10');

-- ----------------------------
-- Table structure for pendapatan
-- ----------------------------
DROP TABLE IF EXISTS `pendapatan`;
CREATE TABLE `pendapatan`  (
  `id_pendapatan` int NOT NULL AUTO_INCREMENT,
  `id_tamu` int NOT NULL,
  `id_kar` int NOT NULL,
  `potongan` bigint NOT NULL,
  `total_bayar` double NOT NULL,
  `tgl_tambah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pendapatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pendapatan
-- ----------------------------
INSERT INTO `pendapatan` VALUES (1, 5, 0, 0, 15, '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for riwayat_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `riwayat_pelanggan`;
CREATE TABLE `riwayat_pelanggan`  (
  `id_tamu` int NOT NULL AUTO_INCREMENT,
  `id_karyawan` int NOT NULL,
  `nama_tamu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` bigint NOT NULL,
  `treatment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `masalah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga` double NOT NULL,
  `potongan` double NOT NULL,
  `total` double NOT NULL,
  `tanggal_kunjung` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_tamu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of riwayat_pelanggan
-- ----------------------------
INSERT INTO `riwayat_pelanggan` VALUES (5, 1, 'Mbkiki', 'Jl 4 Sehat 5 Sempurna', 83851249042, 'Acne Facial', 'Berjerawat', 100000, 0, 100000, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (12, 1, 'Mbak lala', 'Jl Rejowiyoso, Perumahan Danau Elga No 10, Banggle, Kanigoro', 89761455333, 'Acne Facial with pdt', 'berjerawat', 100000, 5000, 95000, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (14, 1, 'Mba lilik', 'Jl Lestari No 145', 83851249042, 'Komedo Facial', 'kusam', 85000, 8500, 76500, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (15, 1, 'Mba lilik', 'Jl.Beliton', 83851249042, 'Acne Facial', 'jerawat', 100000, 5000, 95000, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (16, 2, 'Mb rahma p', 'Jl Lestari No 145', 83851249043, 'Komedo Facial', 'kusam', 80000, 8000, 72000, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (17, 2, 'ratna', 'Jl 4 Sehat 5 Sempurna', 83851249042, 'Korean glasskin treatment', 'kusam', 155000, 38750, 116250, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (18, 2, 'kaila', 'Jl 4 Sehat 5 Sempurna', 83851249042, 'Acne Facial', 'jerawat', 80000, 13600, 66400, '2024-06-05');
INSERT INTO `riwayat_pelanggan` VALUES (19, 2, 'Sutrisna', 'Jl Rejowiyoso, Perumahan Danau Elga No 10, Banggle, Kanigoro', 83851249042, 'Acne Facial with pdt', 'berjerawat', 100000, 10000, 90000, '2024-06-01');
INSERT INTO `riwayat_pelanggan` VALUES (20, 2, 'Lail', 'Jalan pustaka ratu 17 gang 3', 85432876555, 'Aesthetic Facial', 'Normal tanpa masalah, hanya perawatan saja', 80000, 0, 80000, '2024-04-30');
INSERT INTO `riwayat_pelanggan` VALUES (21, 1, 'Aulia Zulfa Isti', 'Cikarang', 88907002408, 'IPL', 'Jerawatan dan bekas jerawat', 800000, 0, 800000, '2024-06-26');
INSERT INTO `riwayat_pelanggan` VALUES (23, 1, 'Lareassa', 'Trenggalek', 85155436866, 'Acne Facial', 'Jerawat', 800000, 96000, 704000, '2024-06-26');

-- ----------------------------
-- Table structure for tb_absenkaryawan
-- ----------------------------
DROP TABLE IF EXISTS `tb_absenkaryawan`;
CREATE TABLE `tb_absenkaryawan`  (
  `id_absensikaryawan` int NOT NULL AUTO_INCREMENT,
  `id_karyawan` int NOT NULL,
  `tgl_absensi` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_absensi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `valid_absensi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_absensikaryawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_absenkaryawan
-- ----------------------------
INSERT INTO `tb_absenkaryawan` VALUES (4, 74, '2021-03-06', '07:47:14', '08:32:33', '', 'hadir', 'Y', '');
INSERT INTO `tb_absenkaryawan` VALUES (5, 74, '2021-03-07', '05:45:13', '05:50:50', '', 'hadir', 'Y', '');
INSERT INTO `tb_absenkaryawan` VALUES (6, 74, '2021-03-10', '09:24:43', '09:24:43', '          mohon izin pak, sedang sakit            ', 'sakit', 'Y', '6366418_preview.png');
INSERT INTO `tb_absenkaryawan` VALUES (7, 74, '2024-05-22', '03:26:54', '03:26:54', '', 'hadir', 'N', '');
INSERT INTO `tb_absenkaryawan` VALUES (8, 1, '2024-05-26', '05:48:51', '05:48:51', '', 'hadir', 'Y', '');
INSERT INTO `tb_absenkaryawan` VALUES (9, 1, '2024-06-01', '10:13:51', '10:13:51', '', 'hadir', 'N', '');
INSERT INTO `tb_absenkaryawan` VALUES (10, 1, '2024-06-02', '08:46:00', '17:46:17', '', 'hadir', 'Y', '');
INSERT INTO `tb_absenkaryawan` VALUES (11, 1, '2024-06-03', '08:46:00', '17:46:17', '', 'hadir', 'Y', '');
INSERT INTO `tb_absenkaryawan` VALUES (12, 1, '2024-06-27', '20:48:25', '20:48:20', '          mohon izin pak, sedang sakit            ', 'sakit', 'Y', '');
INSERT INTO `tb_absenkaryawan` VALUES (13, 1, '2024-06-04', '08:46:00', '17:46:17', '', 'hadir', 'Y', '');

-- ----------------------------
-- Table structure for tb_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin`  (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES (1, 'admin', 'admin', 'admin', 'Logo-UPN-Universitas-Negeri-Padang-PNG.png');

-- ----------------------------
-- Table structure for tb_aplikasi
-- ----------------------------
DROP TABLE IF EXISTS `tb_aplikasi`;
CREATE TABLE `tb_aplikasi`  (
  `id_aplikasi` int NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_aplikasi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_aplikasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_aplikasi
-- ----------------------------
INSERT INTO `tb_aplikasi` VALUES (2, 'CV.Flexco Ltd', 'Sistem Informasi Penggajian dan Perekrutan Karyawan', 'IMG-20210304-WA0005.jpg');

-- ----------------------------
-- Table structure for tb_bagian
-- ----------------------------
DROP TABLE IF EXISTS `tb_bagian`;
CREATE TABLE `tb_bagian`  (
  `id_bagian` int NOT NULL AUTO_INCREMENT,
  `nama_bagian` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gapok` int NOT NULL,
  PRIMARY KEY (`id_bagian`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_bagian
-- ----------------------------
INSERT INTO `tb_bagian` VALUES (2, 'Desain', 1000000);
INSERT INTO `tb_bagian` VALUES (3, 'Cetak', 1000000);
INSERT INTO `tb_bagian` VALUES (5, 'Finishing', 1000000);
INSERT INTO `tb_bagian` VALUES (6, 'Keuangan dan Administrasi', 500000);
INSERT INTO `tb_bagian` VALUES (7, 'Pemasaran', 500000);
INSERT INTO `tb_bagian` VALUES (9, 'Produksi', 1000000);

-- ----------------------------
-- Table structure for tb_gaji
-- ----------------------------
DROP TABLE IF EXISTS `tb_gaji`;
CREATE TABLE `tb_gaji`  (
  `id_gaji` int NOT NULL AUTO_INCREMENT,
  `tgl_gaji` date NOT NULL,
  `id_karyawan` int NOT NULL,
  `potongan` int NOT NULL,
  `gapok` int NOT NULL,
  `tunjangan` int NOT NULL,
  `bonus` int NOT NULL,
  `gaji_absen_masuk` int NULL DEFAULT NULL,
  `komisi` int NULL DEFAULT NULL,
  `detail_komisi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `absen_izin_count` int NULL DEFAULT NULL,
  `total_absen_izin` int NULL DEFAULT NULL,
  `total_gaji` int NULL DEFAULT NULL,
  `absen_masuk_count` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_gaji`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 137 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_gaji
-- ----------------------------
INSERT INTO `tb_gaji` VALUES (142, '2024-06-28', 1, 0, 700000, 0, 0, 30000, 126400, 'Facial Treatment, Facial Treatment, Treatment Satuan, Spa Treatment, ', 2, 20000, 836400, 3);
INSERT INTO `tb_gaji` VALUES (143, '2024-06-28', 1, 0, 700000, 0, 0, 30000, 126400, 'Facial Treatment, Facial Treatment, Treatment Satuan, Spa Treatment, ', 2, 20000, 836400, 3);

-- ----------------------------
-- Table structure for tb_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `tb_karyawan`;
CREATE TABLE `tb_karyawan`  (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `kode_karyawan` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_karyawan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` bigint NOT NULL,
  `tgl_masuk` date NOT NULL,
  PRIMARY KEY (`id_karyawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_karyawan
-- ----------------------------
INSERT INTO `tb_karyawan` VALUES (1, 'Therapis001', 'Devi Budianti', 'Therapis001', 'Therapis001', 89765423456, '2019-08-25');
INSERT INTO `tb_karyawan` VALUES (2, 'Therapis002', 'Imroatul Faizah', 'Therapis002', 'Therapis002', 83851249042, '2021-01-14');

-- ----------------------------
-- Table structure for tb_pelamar
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelamar`;
CREATE TABLE `tb_pelamar`  (
  `id_pelamar` int NOT NULL AUTO_INCREMENT,
  `id_rekrutmen` int NOT NULL,
  `kode_pelamar` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pelamar` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_pelamar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pelamar
-- ----------------------------
INSERT INTO `tb_pelamar` VALUES (17, 14, 'FCI006', 'Wahyu Riswan', '1997-02-28', 'Dharmasraya', 'Komplek perumahan kompi siteba', 'admin.jpg');

-- ----------------------------
-- Table structure for tb_rekrutmen
-- ----------------------------
DROP TABLE IF EXISTS `tb_rekrutmen`;
CREATE TABLE `tb_rekrutmen`  (
  `id_rekrutmen` int NOT NULL AUTO_INCREMENT,
  `id_bagian` int NOT NULL,
  `tanggal` date NOT NULL,
  `syarat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` int NOT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_rekrutmen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_rekrutmen
-- ----------------------------
INSERT INTO `tb_rekrutmen` VALUES (14, 2, '2021-03-09', 'S1', 3, 'N');
INSERT INTO `tb_rekrutmen` VALUES (15, 7, '2021-03-11', 'asasasasa', 2, 'Y');

-- ----------------------------
-- Table structure for tb_tunjangan
-- ----------------------------
DROP TABLE IF EXISTS `tb_tunjangan`;
CREATE TABLE `tb_tunjangan`  (
  `id_tunjangan` int NOT NULL AUTO_INCREMENT,
  `nama_tunjangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_tunjangan` int NOT NULL,
  PRIMARY KEY (`id_tunjangan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_tunjangan
-- ----------------------------
INSERT INTO `tb_tunjangan` VALUES (1, 'Uang Makan', 25000);
INSERT INTO `tb_tunjangan` VALUES (2, 'Kesehatan', 100000);
INSERT INTO `tb_tunjangan` VALUES (3, 'Facial Treatment', 0);
INSERT INTO `tb_tunjangan` VALUES (4, 'Facial Treatment', 0);

-- ----------------------------
-- Table structure for tb_tunjangankaryawan
-- ----------------------------
DROP TABLE IF EXISTS `tb_tunjangankaryawan`;
CREATE TABLE `tb_tunjangankaryawan`  (
  `id_tunjangankaryawan` int NOT NULL AUTO_INCREMENT,
  `id_tunjangan` int NOT NULL,
  `id_karyawan` int NOT NULL,
  PRIMARY KEY (`id_tunjangankaryawan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_tunjangankaryawan
-- ----------------------------
INSERT INTO `tb_tunjangankaryawan` VALUES (1, 2, 74);

SET FOREIGN_KEY_CHECKS = 1;
