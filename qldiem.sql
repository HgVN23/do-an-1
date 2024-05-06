-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 03, 2024 at 05:15 PM
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
-- Database: `qldiem`
--

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
  `XepLoai` varchar(10) DEFAULT NULL,
  `DiemRL` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `ID` int(10) NOT NULL,
  `MaKhoa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hkhplopdn`
--

CREATE TABLE `hkhplopdn` (
  `MaHK` char(10) NOT NULL,
  `MaLop` char(10) NOT NULL,
  `MaHP` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `MaHK` char(10) NOT NULL,
  `TenHK` varchar(50) NOT NULL,
  `NamHoc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `ketqua`
--

CREATE TABLE `ketqua` (
  `MaDiemTk` char(10) NOT NULL,
  `DiemTK10` float DEFAULT NULL,
  `DiemTK4` float DEFAULT NULL,
  `XepLoai` varchar(10) DEFAULT NULL,
  `TTHocVu` varchar(30) DEFAULT NULL,
  `MaD` char(10) NOT NULL,
  `MaHK` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ketquasv`
--

CREATE TABLE `ketquasv` (
  `Masv` char(10) NOT NULL,
  `MaDiemTK` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` char(10) NOT NULL,
  `TenKhoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lopdn`
--

CREATE TABLE `lopdn` (
  `MaLop` char(10) NOT NULL,
  `TenLop` varchar(50) NOT NULL,
  `MaKhoa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lopdnsv`
--

CREATE TABLE `lopdnsv` (
  `MaLop` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lophp`
--

CREATE TABLE `lophp` (
  `MaLHP` char(10) NOT NULL,
  `TenLopHP` varchar(50) NOT NULL,
  `MaGV` char(10) NOT NULL,
  `MaHP` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lophpsv`
--

CREATE TABLE `lophpsv` (
  `MaLHP` char(10) NOT NULL,
  `MaSV` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`ID`, `Username`, `Password`, `Role`) VALUES
(1, 'lananhhoang', '*00A51F3F48415C7D4E8', 1),
(2, 'danghaipham', '*00A51F3F48415C7D4E8', 1);

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
('2110310150', 'Hoàng Lan Anh', b'00', '2003-03-24', 'Công Nghệ Thông Tin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tiethoclhp`
--

CREATE TABLE `tiethoclhp` (
  `MaTietHoc` char(10) NOT NULL,
  `ThoiGian` varchar(50) DEFAULT NULL,
  `MaLHP` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD KEY `FK_KQDiem` (`MaD`),
  ADD KEY `FK_KQHK` (`MaHK`);

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
  ADD KEY `FK_LHPGV` (`MaGV`),
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
-- Indexes for table `tiethoclhp`
--
ALTER TABLE `tiethoclhp`
  ADD PRIMARY KEY (`MaTietHoc`),
  ADD KEY `FK_TIETHOCLHP_MaLHP` (`MaLHP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `FK_KQDiem` FOREIGN KEY (`MaD`) REFERENCES `diem` (`MaD`),
  ADD CONSTRAINT `FK_KQHK` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`);

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
  ADD CONSTRAINT `FK_LHPGV` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`),
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
-- Constraints for table `tiethoclhp`
--
ALTER TABLE `tiethoclhp`
  ADD CONSTRAINT `FK_TIETHOCLHP_MaLHP` FOREIGN KEY (`MaLHP`) REFERENCES `lophp` (`MaLHP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
