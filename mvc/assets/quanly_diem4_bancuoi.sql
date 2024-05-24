-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 24, 2024 at 04:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanly_diem4`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`` PROCEDURE `UpdatediemTBQT` (IN `inputString` TEXT, IN `delimiterChar` CHAR(1))   BEGIN
 DROP TEMPORARY TABLE IF EXISTS temp_string;
 CREATE TEMPORARY TABLE temp_string(vals text); 
 WHILE LOCATE(delimiterChar, inputString) > 1 DO
    INSERT INTO temp_string SELECT SUBSTRING_INDEX(inputString,delimiterChar,1);
    SET inputString = REPLACE(inputString, (SELECT LEFT(inputString, LOCATE(delimiterChar, inputString))),'');
 END WHILE;
 INSERT INTO temp_string(vals) VALUES (inputString);
UPDATE diem as d
SET d.DiemTKQT = (d.DiemCCan + d.DiemHS1 + 2*d.DiemHS2 + d.DiemTH)/5
WHERE d.MaD IN (SELECT TRIM(vals) FROM temp_string);
END$$

CREATE DEFINER=`` PROCEDURE `UpdateDiemTKHP` (IN `MaD` CHAR(10))   BEGIN

UPDATE diem as d
SET d.DiemTKH10 = (d.DiemTKQT*0.4 + d.DiemThi*0.6) WHERE d.MaD = MaD;

UPDATE diem as d
    SET d.DiemTKH4 = CASE
        WHEN d.DiemTKH10 >= 9.0 THEN 4.0
        WHEN d.DiemTKH10 >= 8.5 THEN 3.7
        WHEN d.DiemTKH10 >= 8.0 THEN 3.5
        WHEN d.DiemTKH10 >= 7.0 THEN 3.0
        WHEN d.DiemTKH10 >= 6.5 THEN 2.5
        WHEN d.DiemTKH10 >= 5.5 THEN 2.0
        WHEN d.DiemTKH10 >= 5.0 THEN 1.5
        WHEN d.DiemTKH10 >= 4.0 THEN 1.0
        ELSE 0.0
 	END,
    d.XepLoai = CASE
        WHEN d.DiemTKH10 >= 9.0 THEN 'Xuất sắc'
        WHEN d.DiemTKH10 >= 8.0 THEN 'Giỏi'
        WHEN d.DiemTKH10 >= 7.0 THEN 'Khá'
        WHEN d.DiemTKH10 >= 5.0 THEN 'Trung bình'
        WHEN d.DiemTKH10 >= 4.0 THEN 'Yếu'
        ELSE 'Kém'
	END
        WHERE d.MaD = MaD and d.DiemTKH10 IS NOT NULL;
END$$

CREATE DEFINER=`` PROCEDURE `UpdateTBDTKH410` (IN `MaHK` CHAR(10), IN `MaSV` CHAR(10))   BEGIN
DECLARE TongTC float DEFAULT 0;
DECLARE TongTCDTKH4 float DEFAULT 0;
DECLARE TongTCDTKH10 float DEFAULT 0;
DECLARE TBHKH10 float DEFAULT 0;
DECLARE TBHKH4 float DEFAULT 0;
DECLARE TongTCDKY float DEFAULT 0;
DECLARE tbtlh10 float DEFAULT 0;
DECLARE tbtlh4 float DEFAULT 0;
DECLARE KQtbtlh10 float DEFAULT 0;
DECLARE KQtbtlh4 float DEFAULT 0;


SELECT
SUM(Hp.SoTC),
SUM(Hp.SoTC * d.DiemTKH10),
SUM(Hp.SoTC * d.DiemTKH4)
INTO TongTC, TongTCDTKH10, TongTCDTKH4
FROM hocphan as hp
JOIN sinhvienhpdiemhk as svhpdhk
ON svhpdhk.MaHP = hp.MaHP
AND svhpdhk.MaHK = MaHK
AND svhpdhk.MaSV = (SELECT sv.MaSV from sinhvien as sv where sv.MaSV = MaSV)
JOIN diem AS d ON d.MaD = svhpdhk.MaD;

SET TBHKH10 = ROUND(TongTCDTKH10/TongTC, 2);
SET TBHKH4 = ROUND(TongTCDTKH4/TongTC, 2);


UPDATE ketqua as kq 
JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv and sv.MaSV = MaSV
SET kq.DiemTK10=TBHKH10, kq.DiemTK4=TBHKH4  WHERE kq.MaHK=MaHK; 

SELECT SUM(HP.SoTC) INTO TongTCDKY
FROM hocphan as hp
JOIN sinhvienhpdiemhk as svhpdhk ON svhpdhk.MaHP = hp.MaHP
JOIN sinhvien AS SV on sv.MaSV = svhpdhk.MaSV AND sv.MaSV = MaSV
JOIN hocky AS HK ON HK.MaHK = svhpdhk.MaHK
JOIN ketqua AS KQ ON kq.MaHK = hk.MaHK
JOIN ketquasv as kqsv ON kqsv.MaDiemTK = kq.MaDiemTk AND kqsv.Masv = sv.MaSV
WHERE CAST(SUBSTRING(svhpdhk.MaHK, 3) AS UNSIGNED) <= CAST(SUBSTRING(MaHK, 3)AS UNSIGNED); 

select SUM(kq.DiemTK10 * kq.SoTCHK), SUM(kq.DiemTK4 * kq.SoTCHK) INTO tbtlh10, tbtlh4 
from ketqua as kq JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv AND sv.MaSV = MaSV 
WHERE CAST(SUBSTRING(kq.MaHK, 3) AS UNSIGNED) <=CAST(SUBSTRING(MaHK, 3)AS UNSIGNED); 

SET KQtbtlh4=round(tbtlh4/TongTCDKY, 2); 
SET KQtbtlh10=round(tbtlh10/TongTCDKY, 2); 

UPDATE ketqua as kq 
JOIN ketquasv as kqsv ON kqsv.MaDiemTK=kq.MaDiemTk 
JOIN sinhvien as sv ON sv.MaSV=kqsv.Masv and sv.MaSV = MaSV
SET kq.TongSTCDK=TongTCDKY, KQ.SoTCHK=TongTC, KQ.DiemTBTLH10=KQtbtlh10, KQ.DiemTBTLH4=KQtbtlh4 WHERE kq.MaHK=MaHK; 
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diem`
--

CREATE TABLE `diem` (
  `MaD` char(10) NOT NULL,
  `DiemCCan` float DEFAULT NULL,
  `DiemHS1` float DEFAULT NULL,
  `DiemHS2` float DEFAULT NULL,
  `DiemTH` float DEFAULT NULL,
  `DiemTKQT` float DEFAULT NULL,
  `DiemThi` float DEFAULT NULL,
  `DiemTKH10` float DEFAULT NULL,
  `DiemTKH4` float DEFAULT NULL,
  `DiemChu` varchar(20) DEFAULT NULL,
  `XepLoai` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diem`
--

INSERT INTO `diem` (`MaD`, `DiemCCan`, `DiemHS1`, `DiemHS2`, `DiemTH`, `DiemTKQT`, `DiemThi`, `DiemTKH10`, `DiemTKH4`, `DiemChu`, `XepLoai`) VALUES
('D01', 10, 6, 9, 9, NULL, 8, NULL, NULL, NULL, NULL),
('D02', 10, 6, 8, 10, NULL, 9.3, NULL, NULL, NULL, NULL),
('D03', 10, 5, 5, 10, NULL, 7.3, NULL, NULL, NULL, NULL),
('D04', 10, 9, 10, 5, NULL, 8.9, NULL, NULL, NULL, NULL),
('D05', 10, 7.5, 9, 7, 8.5, 7.7, NULL, NULL, NULL, NULL),
('D06', 10, 5, 7, 6, NULL, 6.5, NULL, NULL, NULL, NULL),
('D07', 10, 5, 9, 9, NULL, 9.7, NULL, NULL, NULL, NULL),
('D08', 10, 7, 7, 5, 7.2, 8.8, NULL, NULL, NULL, NULL),
('D09', 10, 6, 9, 9, NULL, 9.8, NULL, NULL, NULL, NULL),
('D10', 10, 6, 8, 10, NULL, 7.8, NULL, NULL, NULL, NULL),
('D11', 10, 5, 5, 10, NULL, 9.5, NULL, NULL, NULL, NULL),
('D12', 10, 9, 10, 5, NULL, 9, NULL, NULL, NULL, NULL),
('D13', 10, 7, 8, 7, NULL, 6.7, NULL, NULL, NULL, NULL),
('D14', 10, 5, 7, 6, NULL, 6.6, NULL, NULL, NULL, NULL),
('D15', 10, 5, 9, 9, NULL, 7.7, NULL, NULL, NULL, NULL),
('D16', 10, 7, 7, 5, NULL, 8.9, NULL, NULL, NULL, NULL),
('D17', 10, 5, 5, 10, NULL, 6.3, NULL, NULL, NULL, NULL),
('D18', 10, 9, 10, 5, NULL, 9.6, NULL, NULL, NULL, NULL),
('D19', 10, 7, 8, 7, NULL, 9.4, NULL, NULL, NULL, NULL),
('D20', 10, 6, 8, 10, NULL, 8.3, NULL, NULL, NULL, NULL),
('D21', 10, 5, 5, 10, NULL, 8.1, NULL, NULL, NULL, NULL),
('D22', 10, 9, 10, 5, NULL, 5.6, NULL, NULL, NULL, NULL),
('D23', 10, 7, 8, 7, NULL, 8.9, NULL, NULL, NULL, NULL),
('D24', 10, 5, 7, 6, NULL, 7.6, NULL, NULL, NULL, NULL),
('D26', 10, 5, 5, 10, NULL, 6.3, NULL, NULL, NULL, NULL),
('D27', 10, 9, 10, 5, NULL, 8.8, NULL, NULL, NULL, NULL),
('D28', 10, 7, 8, 7, NULL, 9.9, NULL, NULL, NULL, NULL),
('D29', 10, 5, 7, 6, NULL, 8.1, NULL, NULL, NULL, NULL),
('D30', 10, 5, 9, 9, NULL, 5.9, NULL, NULL, NULL, NULL),
('D31', 9, 7, 7, 7, 7.4, 5.1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGV` char(10) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `HocVi` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `GT` bit(2) NOT NULL,
  `ID` int(10) DEFAULT NULL,
  `MaKhoa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`MaGV`, `HoTen`, `HocVi`, `NgaySinh`, `GT`, `ID`, `MaKhoa`) VALUES
('110891', 'Lê Bảo Anh', 'Thạc sĩ', '1987-05-15', b'00', 19, 'K01'),
('1234', 'Trần Thị Bích', 'Thạc sĩ', '2024-05-23', b'00', NULL, 'K01'),
('156266', 'Cao Tấn Phát', 'Thạc sĩ', '1971-01-22', b'01', 14, 'K01'),
('315631', 'Vương Gia Như', 'Thạc sĩ', '1990-01-27', b'00', 18, 'K01'),
('455754', 'Võ Linh Bảo', 'Thạc sĩ', '1988-08-27', b'00', 17, 'K01'),
('497201', 'Lê Khánh Chi', 'Thạc sĩ', '1990-09-19', b'00', 13, 'K01'),
('507802', 'Bế Văn Duy', 'Thạc sĩ', '1984-04-20', b'01', 16, 'K01'),
('508064', 'Vũ Quang Minh', 'Thạc sĩ', '1980-11-02', b'01', 11, 'K01'),
('595416', 'Nông Thanh Hồng', 'Thạc sĩ', '1977-10-14', b'00', 20, 'K01'),
('635560', 'Đinh Duy Lâm', 'Thạc sĩ', '1971-08-26', b'01', 15, 'K01');

-- --------------------------------------------------------

--
-- Table structure for table `gvlhp`
--

CREATE TABLE `gvlhp` (
  `ID` int(9) NOT NULL,
  `MaLHP` char(10) NOT NULL,
  `MaGV` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gvlhp`
--

INSERT INTO `gvlhp` (`ID`, `MaLHP`, `MaGV`) VALUES
(1, 'LHP01', '110891'),
(2, 'LHP02', '156266'),
(3, 'LHP03', '110891'),
(4, 'LHP04', '110891'),
(5, 'LHP05', '110891'),
(6, 'LHP06', '497201'),
(7, 'LHP07', '156266'),
(8, 'LHP08', '595416'),
(9, 'LHP09', '315631'),
(10, 'LHP10', '455754'),
(11, 'LHP11', '156266'),
(12, 'LHP12', '455754'),
(13, 'LHP13', '635560'),
(14, 'LHP14', '595416'),
(15, 'LHP15', '455754'),
(16, 'LHP16', '497201'),
(17, 'LHP17', '156266'),
(18, 'LHP18', NULL),
(19, 'LHP19', '455754'),
(20, 'LHP20', '455754');

-- --------------------------------------------------------

--
-- Table structure for table `hkhplopdn`
--

CREATE TABLE `hkhplopdn` (
  `MaHK` char(10) NOT NULL,
  `MaLop` char(10) NOT NULL,
  `MaHP` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hkhplopdn`
--

INSERT INTO `hkhplopdn` (`MaHK`, `MaLop`, `MaHP`) VALUES
('HK05', 'TI01', 'HP06'),
('HK05', 'TI01', 'HP07'),
('HK05', 'TI01', 'HP08'),
('HK05', 'TI01', 'HP09'),
('HK05', 'TI01', 'HP10'),
('HK05', 'TI02', 'HP06'),
('HK05', 'TI02', 'HP07'),
('HK05', 'TI02', 'HP08'),
('HK05', 'TI02', 'HP09'),
('HK05', 'TI02', 'HP10'),
('HK06', 'TI01', 'HP01'),
('HK06', 'TI01', 'HP02'),
('HK06', 'TI01', 'HP03'),
('HK06', 'TI01', 'HP04'),
('HK06', 'TI01', 'HP05'),
('HK06', 'TI02', 'HP01'),
('HK06', 'TI02', 'HP02'),
('HK06', 'TI02', 'HP03'),
('HK06', 'TI02', 'HP04'),
('HK06', 'TI02', 'HP05');

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `MaHK` char(10) NOT NULL,
  `TenHK` varchar(50) NOT NULL,
  `NamHoc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hocky`
--

INSERT INTO `hocky` (`MaHK`, `TenHK`, `NamHoc`) VALUES
('HK01', 'I', '2021-07-01'),
('HK02', 'II', '2022-01-01'),
('HK03', 'I', '2022-07-01'),
('HK04', 'II', '2023-01-01'),
('HK05', 'I', '2023-07-01'),
('HK06', 'II', '2024-01-01'),
('HK07', 'I', '2024-07-01'),
('HK08', 'II', '2025-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `MaHP` char(10) NOT NULL,
  `TenHP` varchar(50) NOT NULL,
  `SoTC` int(11) NOT NULL,
  `SoTiet` int(99) NOT NULL,
  `MaKhoa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`MaHP`, `TenHP`, `SoTC`, `SoTiet`, `MaKhoa`) VALUES
('HP01', 'Lập trình .NET', 4, 60, 'K01'),
('HP02', 'Công nghệ Java', 3, 45, 'K01'),
('HP03', 'Công nghệ phần mềm', 2, 30, 'K01'),
('HP04', 'Đồ án 1', 3, 90, 'K01'),
('HP05', 'Ứng dụng dữ liệu WEB', 2, 30, 'K01'),
('HP06', 'Kỹ thuật điện tử số', 2, 30, 'K01'),
('HP07', 'Phân tích và thiết kế các hệ thống thông tin', 3, 45, 'K01'),
('HP08', 'Quản lý dự án công nghệ thông tin', 2, 30, 'K01'),
('HP09', 'Chủ nghĩa xã hội khoa học', 2, 30, 'K01'),
('HP10', 'Mạng máy tính', 3, 45, 'K01');

-- --------------------------------------------------------

--
-- Table structure for table `ketqua`
--

CREATE TABLE `ketqua` (
  `MaDiemTk` char(10) NOT NULL,
  `DiemTK10` float DEFAULT NULL,
  `DiemTK4` float DEFAULT NULL,
  `XepLoai` varchar(10) DEFAULT NULL,
  `SoTCHK` int(11) DEFAULT NULL,
  `TongSTCDK` int(11) DEFAULT NULL,
  `DiemTBTLH10` float DEFAULT NULL,
  `DiemTBTLH4` float DEFAULT NULL,
  `TTHocVu` varchar(30) DEFAULT NULL,
  `MaHK` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ketqua`
--

INSERT INTO `ketqua` (`MaDiemTk`, `DiemTK10`, `DiemTK4`, `XepLoai`, `SoTCHK`, `TongSTCDK`, `DiemTBTLH10`, `DiemTBTLH4`, `TTHocVu`, `MaHK`) VALUES
('DTK01', 7.67, 3.04, NULL, 12, 12, 7.67, 3.04, NULL, 'HK05'),
('DTK02', 8.38, 3.45, NULL, 14, 26, 8.05, 3.26, NULL, 'HK06'),
('DTK03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HK05'),
('DTK04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HK06');

-- --------------------------------------------------------

--
-- Table structure for table `ketquadiem`
--

CREATE TABLE `ketquadiem` (
  `MaDiemTk` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `MaD` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ketquadiem`
--

INSERT INTO `ketquadiem` (`MaDiemTk`, `MaD`) VALUES
('DTK01', 'D01'),
('DTK01', 'D02'),
('DTK01', 'D03'),
('DTK01', 'D04'),
('DTK01', 'D05'),
('DTK02', 'D06'),
('DTK02', 'D07'),
('DTK02', 'D08'),
('DTK02', 'D09'),
('DTK02', 'D10'),
('DTK03', 'D11'),
('DTK03', 'D12'),
('DTK03', 'D13'),
('DTK03', 'D14'),
('DTK03', 'D15'),
('DTK04', 'D16'),
('DTK04', 'D17'),
('DTK04', 'D18'),
('DTK04', 'D19'),
('DTK04', 'D20');

-- --------------------------------------------------------

--
-- Table structure for table `ketquasv`
--

CREATE TABLE `ketquasv` (
  `Masv` char(10) NOT NULL,
  `MaDiemTK` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ketquasv`
--

INSERT INTO `ketquasv` (`Masv`, `MaDiemTK`) VALUES
('2110310096', 'DTK01'),
('2110310096', 'DTK02'),
('2110310150', 'DTK03'),
('2110310150', 'DTK04');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` char(10) NOT NULL,
  `TenKhoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('K01', 'Công nghệ Thông tin'),
('K02', 'Thương mại'),
('K03', 'Du lịch và Khách sạn'),
('K04', 'Công nghệ thực phẩm'),
('K05', 'Cơ khí'),
('K06', 'Điện – Tự động hóa'),
('K07', 'Điện tử'),
('K08', 'Dệt may và Thời trang'),
('K09', 'Quản trị & Marketing'),
('K10', 'Kế toán Kiểm toán');

-- --------------------------------------------------------

--
-- Table structure for table `lopdn`
--

CREATE TABLE `lopdn` (
  `MaLop` char(10) NOT NULL,
  `TenLop` varchar(50) NOT NULL,
  `MaKhoa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lopdn`
--

INSERT INTO `lopdn` (`MaLop`, `TenLop`, `MaKhoa`) VALUES
('TI01', 'DHTI2101', 'K01'),
('TI02', 'DHTI2102', 'K01');

-- --------------------------------------------------------

--
-- Table structure for table `lopdnsv`
--

CREATE TABLE `lopdnsv` (
  `MaLop` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lopdnsv`
--

INSERT INTO `lopdnsv` (`MaLop`, `MaSV`) VALUES
('TI01', '2110310096'),
('TI01', '2110310150'),
('TI01', '2110310191'),
('TI01', '2110310271'),
('TI01', '2110310562'),
('TI02', '2110310575'),
('TI02', '2110310597'),
('TI02', '2110310691'),
('TI02', '2110310740'),
('TI02', '2110310950');

-- --------------------------------------------------------

--
-- Table structure for table `lophp`
--

CREATE TABLE `lophp` (
  `MaLHP` char(10) NOT NULL,
  `TenLopHP` varchar(50) NOT NULL,
  `MaHP` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lophp`
--

INSERT INTO `lophp` (`MaLHP`, `TenLopHP`, `MaHP`) VALUES
('LHP01', 'Lập trình .NET', 'HP01'),
('LHP02', 'Công nghệ Java', 'HP02'),
('LHP03', 'Công nghệ phần mềm', 'HP03'),
('LHP04', 'Đồ án 1', 'HP04'),
('LHP05', 'Ứng dụng dữ liệu WEB', 'HP05'),
('LHP06', 'Kỹ thuật điện tử số', 'HP06'),
('LHP07', 'Phân tích và thiết kế các hệ thống thông tin', 'HP07'),
('LHP08', 'Quản lý dự án công nghệ thông tin', 'HP08'),
('LHP09', 'Chủ nghĩa xã hội khoa học', 'HP09'),
('LHP10', 'Mạng máy tính', 'HP10'),
('LHP11', 'Lập trình .NET', 'HP01'),
('LHP12', 'Công nghệ Java', 'HP02'),
('LHP13', 'Công nghệ phần mềm', 'HP03'),
('LHP14', 'Đồ án 1', 'HP04'),
('LHP15', 'Ứng dụng dữ liệu WEB', 'HP05'),
('LHP16', 'Kỹ thuật điện tử số', 'HP06'),
('LHP17', 'Phân tích và thiết kế các hệ thống thông tin', 'HP07'),
('LHP18', 'Quản lý dự án công nghệ thông tin', 'HP08'),
('LHP19', 'Chủ nghĩa xã hội khoa học', 'HP09'),
('LHP20', 'Mạng máy tính', 'HP10');

-- --------------------------------------------------------

--
-- Table structure for table `lophpsv`
--

CREATE TABLE `lophpsv` (
  `MaLHP` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lophpsv`
--

INSERT INTO `lophpsv` (`MaLHP`, `MaSV`) VALUES
('LHP01', '2110310096'),
('LHP01', '2110310150'),
('LHP01', '2110310191'),
('LHP01', '2110310271'),
('LHP01', '2110310562'),
('LHP02', '2110310096'),
('LHP02', '2110310150'),
('LHP02', '2110310191'),
('LHP02', '2110310271'),
('LHP02', '2110310562'),
('LHP03', '2110310096'),
('LHP03', '2110310150'),
('LHP03', '2110310191'),
('LHP03', '2110310271'),
('LHP03', '2110310562'),
('LHP04', '2110310096'),
('LHP04', '2110310150'),
('LHP04', '2110310191'),
('LHP04', '2110310271'),
('LHP04', '2110310562'),
('LHP05', '2110310096'),
('LHP05', '2110310150'),
('LHP05', '2110310191'),
('LHP05', '2110310271'),
('LHP05', '2110310562'),
('LHP06', '2110310096'),
('LHP06', '2110310150'),
('LHP06', '2110310191'),
('LHP06', '2110310271'),
('LHP06', '2110310562'),
('LHP07', '2110310096'),
('LHP07', '2110310150'),
('LHP07', '2110310191'),
('LHP07', '2110310271'),
('LHP07', '2110310562'),
('LHP08', '2110310096'),
('LHP08', '2110310150'),
('LHP08', '2110310191'),
('LHP08', '2110310271'),
('LHP08', '2110310562'),
('LHP09', '2110310096'),
('LHP09', '2110310150'),
('LHP09', '2110310191'),
('LHP09', '2110310271'),
('LHP09', '2110310562'),
('LHP10', '2110310096'),
('LHP10', '2110310150'),
('LHP10', '2110310191'),
('LHP10', '2110310271'),
('LHP10', '2110310562');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`ID`, `Username`, `Password`, `Role`) VALUES
(1, 'lananhhoang', 'fcea920f7412b5da7be0cf42b8c93759', 1),
(2, 'danghaipham', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'syhungngo', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'duonghadoan', 'e10adc3949ba59abbe56e057f20f883e', 1),
(5, 'tranhuyphung', 'e10adc3949ba59abbe56e057f20f883e', 1),
(6, 'phuongnamhoang', 'e10adc3949ba59abbe56e057f20f883e', 1),
(7, 'phuongtungnguyen', 'e10adc3949ba59abbe56e057f20f883e', 1),
(8, 'ducthanhpham', 'e10adc3949ba59abbe56e057f20f883e', 1),
(9, 'dinhhoaitran', 'e10adc3949ba59abbe56e057f20f883e', 1),
(10, 'giaanvuong', 'e10adc3949ba59abbe56e057f20f883e', 1),
(11, 'quangminhvu', 'e10adc3949ba59abbe56e057f20f883e', 2),
(12, 'tranhuyphung', 'e10adc3949ba59abbe56e057f20f883e', 2),
(13, 'khanhchile', 'e10adc3949ba59abbe56e057f20f883e', 2),
(14, 'tanphatcao', 'e10adc3949ba59abbe56e057f20f883e', 2),
(15, 'duylamdinh', 'e10adc3949ba59abbe56e057f20f883e', 2),
(16, 'vanduybe', 'e10adc3949ba59abbe56e057f20f883e', 2),
(17, 'linhbaovo', 'e10adc3949ba59abbe56e057f20f883e', 2),
(18, 'giaanvuong', 'e10adc3949ba59abbe56e057f20f883e', 2),
(19, 'baoanhle', 'e10adc3949ba59abbe56e057f20f883e', 2),
(20, 'thanhhongnong', 'e10adc3949ba59abbe56e057f20f883e', 2),
(21, 'tuanhuetran', 'e10adc3949ba59abbe56e057f20f883e', 3),
(22, 'nhatthanhpham', 'e10adc3949ba59abbe56e057f20f883e', 3),
(23, 'ngocchuongvu', 'e10adc3949ba59abbe56e057f20f883e', 3),
(24, 'quangtrungnghiem', 'e10adc3949ba59abbe56e057f20f883e', 3),
(25, 'quidatnguyen', 'e10adc3949ba59abbe56e057f20f883e', 3),
(26, 'myduyenvuong', 'e10adc3949ba59abbe56e057f20f883e', 3),
(27, 'thuhiendo', 'e10adc3949ba59abbe56e057f20f883e', 3),
(28, 'thuthaodao', 'e10adc3949ba59abbe56e057f20f883e', 3),
(29, 'thiduongtran', 'e10adc3949ba59abbe56e057f20f883e', 3),
(30, 'baoanhle', 'e10adc3949ba59abbe56e057f20f883e', 3),
(31, 'quangkhoatran', 'e10adc3949ba59abbe56e057f20f883e', 4),
(32, 'thaitienbui', 'e10adc3949ba59abbe56e057f20f883e', 4),
(33, 'ducminhtruong', 'e10adc3949ba59abbe56e057f20f883e', 4),
(34, 'baphutran', 'e10adc3949ba59abbe56e057f20f883e', 4),
(35, 'viethapham', 'e10adc3949ba59abbe56e057f20f883e', 4),
(36, 'thilanhvo', 'e10adc3949ba59abbe56e057f20f883e', 4),
(37, 'thaoquevu', 'e10adc3949ba59abbe56e057f20f883e', 4),
(38, 'mailinhle', 'e10adc3949ba59abbe56e057f20f883e', 4),
(39, 'thuydungle', 'e10adc3949ba59abbe56e057f20f883e', 4),
(40, 'thiloanmai', 'e10adc3949ba59abbe56e057f20f883e', 4),
(41, 'thiendatnguyen', 'e10adc3949ba59abbe56e057f20f883e', 5),
(42, 'vuhoangle', 'e10adc3949ba59abbe56e057f20f883e', 5),
(43, 'tanduongdang', 'e10adc3949ba59abbe56e057f20f883e', 5),
(44, 'ductoanvo', 'e10adc3949ba59abbe56e057f20f883e', 5),
(45, 'quocdungtrieu', 'e10adc3949ba59abbe56e057f20f883e', 5),
(46, 'loctiendang', 'e10adc3949ba59abbe56e057f20f883e', 5),
(47, 'thisinhnguyen', 'e10adc3949ba59abbe56e057f20f883e', 5),
(48, 'thuhuongpham', 'e10adc3949ba59abbe56e057f20f883e', 5),
(49, 'kimthaoha', 'e10adc3949ba59abbe56e057f20f883e', 5),
(50, 'ngoctuyenngo', 'e10adc3949ba59abbe56e057f20f883e', 5),
(51, 'ductuanho', 'e10adc3949ba59abbe56e057f20f883e', 6),
(52, 'vantrieunguyen', 'e10adc3949ba59abbe56e057f20f883e', 6),
(53, 'minhducle', 'e10adc3949ba59abbe56e057f20f883e', 6),
(54, 'ducbaonguyen', 'e10adc3949ba59abbe56e057f20f883e', 6),
(55, 'vantinhluu', 'e10adc3949ba59abbe56e057f20f883e', 6),
(56, 'thitamnguyen', 'e10adc3949ba59abbe56e057f20f883e', 6),
(57, 'thiphungtran', 'e10adc3949ba59abbe56e057f20f883e', 6),
(58, 'diemvinguyen', 'e10adc3949ba59abbe56e057f20f883e', 6),
(59, 'chauphuongha', 'e10adc3949ba59abbe56e057f20f883e', 6),
(60, 'kimthanhtra', 'e10adc3949ba59abbe56e057f20f883e', 6);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` char(10) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `GT` bit(2) NOT NULL,
  `NgaySinh` date NOT NULL,
  `Nganh` varchar(50) NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `HoTen`, `GT`, `NgaySinh`, `Nganh`, `ID`) VALUES
('2110310096', 'Phạm Đăng Hải', b'01', '2003-01-01', 'Công Nghệ Thông Tin', 2),
('2110310150', 'Hoàng Lan Anh', b'00', '2003-03-24', 'Công Nghệ Thông Tin', 1),
('2110310191', 'Ngô Sỹ Hưng', b'01', '2003-11-12', 'Công Nghệ Thông Tin', 3),
('2110310271', 'Vương Gia An', b'00', '2003-02-23', 'Công Nghệ Thông Tin', 10),
('2110310562', 'Hoàng Phương Nam', b'00', '2003-01-30', 'Công Nghệ Thông Tin', 6),
('2110310575', 'Nguyễn Phương Tùng', b'01', '2003-12-09', 'Công Nghệ Thông Tin', 7),
('2110310597', 'Trần Đình Hoài', b'00', '2003-09-08', 'Công Nghệ Thông Tin', 9),
('2110310691', 'Đoàn Dương Hà', b'00', '2003-09-19', 'Công Nghệ Thông Tin', 4),
('2110310740', 'Phạm Đức Thanh', b'01', '2003-08-26', 'Công Nghệ Thông Tin', 8),
('2110310950', 'Phùng Trần Huy', b'01', '2003-03-01', 'Công Nghệ Thông Tin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvienhpdiemhk`
--

CREATE TABLE `sinhvienhpdiemhk` (
  `ID` int(11) NOT NULL,
  `MaSV` char(10) NOT NULL,
  `MaHP` char(10) NOT NULL,
  `MaD` char(10) DEFAULT NULL,
  `MaHK` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinhvienhpdiemhk`
--

INSERT INTO `sinhvienhpdiemhk` (`ID`, `MaSV`, `MaHP`, `MaD`, `MaHK`) VALUES
(7, '2110310096', 'HP06', 'D01', 'HK05'),
(8, '2110310096', 'HP07', 'D02', 'HK05'),
(9, '2110310096', 'HP08', 'D03', 'HK05'),
(10, '2110310096', 'HP09', 'D04', 'HK05'),
(11, '2110310096', 'HP10', 'D05', 'HK05'),
(12, '2110310096', 'HP01', 'D06', 'HK06'),
(13, '2110310096', 'HP02', 'D07', 'HK06'),
(14, '2110310096', 'HP03', 'D08', 'HK06'),
(15, '2110310096', 'HP04', 'D09', 'HK06'),
(16, '2110310096', 'HP05', 'D10', 'HK06'),
(17, '2110310150', 'HP10', 'D08', 'HK05'),
(21, '2110310191', 'HP10', 'D31', 'HK05'),
(22, '2110310271', 'HP10', NULL, 'HK05'),
(23, '2110310562', 'HP10', NULL, 'HK05');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvienkhoa`
--

CREATE TABLE `sinhvienkhoa` (
  `ID` int(11) NOT NULL,
  `MaSV` char(10) NOT NULL,
  `MaKhoa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sinhvienkhoa`
--

INSERT INTO `sinhvienkhoa` (`ID`, `MaSV`, `MaKhoa`) VALUES
(1, '2110310096', 'K01'),
(2, '2110310150', 'K01'),
(3, '2110310191', 'K01'),
(4, '2110310271', 'K01'),
(5, '2110310562', 'K01'),
(6, '2110310575', 'K01'),
(7, '2110310597', 'K01'),
(8, '2110310691', 'K01'),
(9, '2110310740', 'K01'),
(10, '2110310950', 'K01');

-- --------------------------------------------------------

--
-- Table structure for table `svdiemrenluyen`
--

CREATE TABLE `svdiemrenluyen` (
  `MaSV` char(10) NOT NULL,
  `MaHK` char(10) NOT NULL,
  `DiemRL` float DEFAULT NULL,
  `xeploai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `svdiemrenluyen`
--

INSERT INTO `svdiemrenluyen` (`MaSV`, `MaHK`, `DiemRL`, `xeploai`) VALUES
('2110310096', 'HK05', 90, 'Xuất sắc'),
('2110310096', 'HK06', 84, 'Giỏi'),
('2110310150', 'HK05', 73, 'Khá'),
('2110310150', 'HK06', 86, 'Giỏi'),
('2110310191', 'HK05', 90, 'Xuất sắc'),
('2110310191', 'HK06', 88, 'Giỏi'),
('2110310271', 'HK05', 75, 'Khá'),
('2110310271', 'HK06', 90, 'Xuất sắc'),
('2110310562', 'HK05', 85, 'Giỏi'),
('2110310562', 'HK06', 75, 'Khá');

-- --------------------------------------------------------

--
-- Table structure for table `tiethoclhp`
--

CREATE TABLE `tiethoclhp` (
  `MaTietHoc` char(10) NOT NULL,
  `Thu` varchar(9) DEFAULT NULL,
  `Tiet` varchar(6) NOT NULL,
  `MaLHP` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiethoclhp`
--

INSERT INTO `tiethoclhp` (`MaTietHoc`, `Thu`, `Tiet`, `MaLHP`) VALUES
('TIET01', '2', '1-3', 'LHP01'),
('TIET02', '3', '7-9', 'LHP02'),
('TIET03', '4', '4-6', 'LHP03'),
('TIET04', '5', '10-12', 'LHP04'),
('TIET05', '6', '1-3', 'LHP05'),
('TIET06', '2', '4-6', 'LHP06'),
('TIET07', '3', '10-12', 'LHP07'),
('TIET08', '4', '1-3', 'LHP08'),
('TIET09', '5', '7-9', 'LHP09'),
('TIET10', '6', '4-6', 'LHP10'),
('TIET11', '2', '7-9', 'LHP11'),
('TIET12', '3', '1-3', 'LHP12'),
('TIET13', '4', '7-9', 'LHP13'),
('TIET14', '5', '1-3', 'LHP14'),
('TIET15', '6', '7-9', 'LHP15'),
('TIET16', '2', '10-12', 'LHP16'),
('TIET17', '3', '4-6', 'LHP17'),
('TIET18', '4', '10-12', 'LHP18'),
('TIET19', '5', '4-6', 'LHP19'),
('TIET20', '6', '10-12', 'LHP20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diem`
--
ALTER TABLE `diem`
  ADD PRIMARY KEY (`MaD`);

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGV`),
  ADD KEY `FK_GVID` (`ID`),
  ADD KEY `FK_GVKhoa` (`MaKhoa`);

--
-- Indexes for table `gvlhp`
--
ALTER TABLE `gvlhp`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_MaGV_GVLHP` (`MaGV`),
  ADD KEY `FK_MaLHP_GVLHP` (`MaLHP`);

--
-- Indexes for table `hkhplopdn`
--
ALTER TABLE `hkhplopdn`
  ADD PRIMARY KEY (`MaHK`,`MaLop`,`MaHP`),
  ADD KEY `FK_HKHPLOPDN_MaLop` (`MaLop`),
  ADD KEY `FK_HKHPLOPDN_MaHP` (`MaHP`);

--
-- Indexes for table `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`MaHK`);

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`MaHP`),
  ADD KEY `FK_HPKhoa` (`MaKhoa`);

--
-- Indexes for table `ketqua`
--
ALTER TABLE `ketqua`
  ADD PRIMARY KEY (`MaDiemTk`),
  ADD KEY `FK_KQHK` (`MaHK`);

--
-- Indexes for table `ketquadiem`
--
ALTER TABLE `ketquadiem`
  ADD PRIMARY KEY (`MaDiemTk`,`MaD`),
  ADD KEY `FK_KQD_D` (`MaD`);

--
-- Indexes for table `ketquasv`
--
ALTER TABLE `ketquasv`
  ADD PRIMARY KEY (`Masv`,`MaDiemTK`) USING BTREE,
  ADD KEY `FK_KQSVMaDTK` (`MaDiemTK`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MaKhoa`);

--
-- Indexes for table `lopdn`
--
ALTER TABLE `lopdn`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `FK_LDNKhoa` (`MaKhoa`);

--
-- Indexes for table `lopdnsv`
--
ALTER TABLE `lopdnsv`
  ADD PRIMARY KEY (`MaLop`,`MaSV`),
  ADD KEY `FK_LOPDNSV_MaSV` (`MaSV`);

--
-- Indexes for table `lophp`
--
ALTER TABLE `lophp`
  ADD PRIMARY KEY (`MaLHP`),
  ADD KEY `FK_LHPMHP` (`MaHP`);

--
-- Indexes for table `lophpsv`
--
ALTER TABLE `lophpsv`
  ADD PRIMARY KEY (`MaLHP`,`MaSV`),
  ADD KEY `FK_LHPSVMaSV` (`MaSV`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`),
  ADD KEY `FK_SVID` (`ID`);

--
-- Indexes for table `sinhvienhpdiemhk`
--
ALTER TABLE `sinhvienhpdiemhk`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_HK_CS` (`MaHK`),
  ADD KEY `FK_MHP_CS` (`MaHP`),
  ADD KEY `FK_MSV_CS` (`MaSV`),
  ADD KEY `FK_MD_CS` (`MaD`);

--
-- Indexes for table `sinhvienkhoa`
--
ALTER TABLE `sinhvienkhoa`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MaSV` (`MaSV`),
  ADD KEY `FK_MaKhoa_SVK` (`MaKhoa`);

--
-- Indexes for table `svdiemrenluyen`
--
ALTER TABLE `svdiemrenluyen`
  ADD PRIMARY KEY (`MaSV`,`MaHK`),
  ADD KEY `FK_MaHK_TBDRL` (`MaHK`);

--
-- Indexes for table `tiethoclhp`
--
ALTER TABLE `tiethoclhp`
  ADD PRIMARY KEY (`MaTietHoc`),
  ADD KEY `FK_TIETHOCLHP_MaLHP` (`MaLHP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gvlhp`
--
ALTER TABLE `gvlhp`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sinhvienhpdiemhk`
--
ALTER TABLE `sinhvienhpdiemhk`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sinhvienkhoa`
--
ALTER TABLE `sinhvienkhoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `FK_GVID` FOREIGN KEY (`ID`) REFERENCES `nguoidung` (`ID`),
  ADD CONSTRAINT `FK_GVKhoa` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `gvlhp`
--
ALTER TABLE `gvlhp`
  ADD CONSTRAINT `FK_MaGV_GVLHP` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MaLHP_GVLHP` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`);

--
-- Constraints for table `hkhplopdn`
--
ALTER TABLE `hkhplopdn`
  ADD CONSTRAINT `FK_HKHPLOPDN_MaHK` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`),
  ADD CONSTRAINT `FK_HKHPLOPDN_MaHP` FOREIGN KEY (`MaHP`) REFERENCES `hocphan` (`MaHP`),
  ADD CONSTRAINT `FK_HKHPLOPDN_MaLop` FOREIGN KEY (`MaLop`) REFERENCES `lopdn` (`MaLop`);

--
-- Constraints for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD CONSTRAINT `FK_HPKhoa` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `ketqua`
--
ALTER TABLE `ketqua`
  ADD CONSTRAINT `FK_KQHK` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`);

--
-- Constraints for table `ketquadiem`
--
ALTER TABLE `ketquadiem`
  ADD CONSTRAINT `FK_KQD_D` FOREIGN KEY (`MaD`) REFERENCES `diem` (`MaD`),
  ADD CONSTRAINT `FK_KQD_DTK` FOREIGN KEY (`MaDiemTk`) REFERENCES `ketqua` (`MaDiemTk`);

--
-- Constraints for table `ketquasv`
--
ALTER TABLE `ketquasv`
  ADD CONSTRAINT `FK_KQSVMaDTK` FOREIGN KEY (`MaDiemTK`) REFERENCES `ketqua` (`MaDiemTk`),
  ADD CONSTRAINT `FK_KQSVMaSV` FOREIGN KEY (`Masv`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `lopdn`
--
ALTER TABLE `lopdn`
  ADD CONSTRAINT `FK_LDNKhoa` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `lopdnsv`
--
ALTER TABLE `lopdnsv`
  ADD CONSTRAINT `FK_LOPDNSV_MaLop` FOREIGN KEY (`MaLop`) REFERENCES `lopdn` (`MaLop`),
  ADD CONSTRAINT `FK_LOPDNSV_MaSV` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `lophp`
--
ALTER TABLE `lophp`
  ADD CONSTRAINT `FK_LHPMHP` FOREIGN KEY (`MaHP`) REFERENCES `hocphan` (`MaHP`);

--
-- Constraints for table `lophpsv`
--
ALTER TABLE `lophpsv`
  ADD CONSTRAINT `FK_LHPSVMaLHP` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`),
  ADD CONSTRAINT `FK_LHPSVMaSV` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_SVID` FOREIGN KEY (`ID`) REFERENCES `nguoidung` (`ID`);

--
-- Constraints for table `sinhvienhpdiemhk`
--
ALTER TABLE `sinhvienhpdiemhk`
  ADD CONSTRAINT `FK_HK_CS` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MD_CS` FOREIGN KEY (`MaD`) REFERENCES `diem` (`MaD`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MHP_CS` FOREIGN KEY (`MaHP`) REFERENCES `hocphan` (`MaHP`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MSV_CS` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`) ON UPDATE CASCADE;

--
-- Constraints for table `sinhvienkhoa`
--
ALTER TABLE `sinhvienkhoa`
  ADD CONSTRAINT `FK_MaKhoa_SVK` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Masv_SVK` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `svdiemrenluyen`
--
ALTER TABLE `svdiemrenluyen`
  ADD CONSTRAINT `FK_MaHK_TBDRL` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`),
  ADD CONSTRAINT `FK_MaSV_TBDRL` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Constraints for table `tiethoclhp`
--
ALTER TABLE `tiethoclhp`
  ADD CONSTRAINT `FK_TIETHOCLHP_MaLHP` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
