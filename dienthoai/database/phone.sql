-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 2, 2024 lúc 03:46 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phone`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `MaChiTietHoaDon` int(100) NOT NULL,
  `MaHoaDon` varchar(10) NOT NULL,
  `MaSP` int(30) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` varchar(30) NOT NULL,
  `DonViTinh` varchar(10) NOT NULL,
  `ThanhTien` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`MaChiTietHoaDon`, `MaHoaDon`, `MaSP`, `SoLuong`, `DonGia`, `DonViTinh`, `ThanhTien`) VALUES
(53, 'HD1', 6, 1, '27000000', 'chiếc', '27000000'),
(54, 'HD2', 9, 1, '11000000', 'chiếc', '11000000'),
(55, 'HD3', 98, 1, '13900000', 'chiếc', '13900000'),
(56, 'HD4', 57, 1, '14900000', 'chiếc', '14900000'),
(57, 'HD4', 8, 3, '18500000', 'chiếc', '55500000'),
(58, 'HD5', 154, 1, '1650000', 'chiếc', '1650000'),
(59, 'HD5', 87, 1, '13900000', 'chiếc', '13900000'),
(60, 'HD5', 99, 1, '13900000', 'chiếc', '13900000'),
(61, 'HD6', 144, 1, '13000000', 'chiếc', '13000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietkhuyenmai`
--

CREATE TABLE `chitietkhuyenmai` (
  `MaSp` varchar(30) NOT NULL,
  `MaKhuyenMai` varchar(30) NOT NULL,
  `TiLeKhuyenMai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(100) NOT NULL,
  `MaHoaDon` varchar(10) NOT NULL,
  `TenKhachHang` varchar(30) NOT NULL,
  `SDTNguoiNhan` varchar(30) NOT NULL,
  `DiaChiGiaoHang` varchar(30) NOT NULL,
  `TenNguoiGiaoHang` varchar(30) NOT NULL,
  `TinhTrangDonHang` varchar(10) NOT NULL,
  `ngayhoanthanh` date NOT NULL DEFAULT current_timestamp(),
  `trangthaithanhtoan` varchar(30) NOT NULL DEFAULT 'chuathanhtoan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `MaHoaDon`, `TenKhachHang`, `SDTNguoiNhan`, `DiaChiGiaoHang`, `TenNguoiGiaoHang`, `TinhTrangDonHang`, `ngayhoanthanh`, `trangthaithanhtoan`) VALUES
(48, 'HD1', 'nghngh', '0343337777', 'HCM', 'master', 'danggiao', '2023-10-24', 'chuathanhtoan'),
(49, 'HD2', 'nghngh', '0343337777', 'HCM', '', 'chuagiao', '2024-03-02', 'chuathanhtoan'),
(50, 'HD3', 'nghngh', '0343337777', 'HCM', '', 'chuagiao', '2024-03-03', 'chuathanhtoan'),
(51, 'HD4', 'nghngh', '0343337777', 'HCM', '', 'chuagiao', '2024-03-06', 'chuathanhtoan'),
(53, 'HD5', 'nghngh', '0343337777', 'HCM', '', 'chuagiao', '2024-03-06', 'chuathanhtoan'),
(54, 'HD6', 'nghngh', '0343337777', 'HCM', '', 'chuagiao', '2024-03-14', 'dathanhtoan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `goiy`
--

CREATE TABLE `goiy` (
  `sanphamchinh` int(30) NOT NULL,
  `sanphamphu` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `goiy`
--

INSERT INTO `goiy` (`sanphamchinh`, `sanphamphu`) VALUES
(144, 150),
(144, 151),
(6, 154),
(6, 150),
(8, 148);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHoaDon` varchar(10) NOT NULL,
  `NgayDatHang` date NOT NULL DEFAULT current_timestamp(),
  `Phuongthucnhahang` varchar(10) NOT NULL,
  `UserName` varchar(300) NOT NULL,
  `TongTien` varchar(30) NOT NULL,
  `PhiVanChuyen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MaHoaDon`, `NgayDatHang`, `Phuongthucnhahang`, `UserName`, `TongTien`, `PhiVanChuyen`) VALUES
('HD1', '2024-03-24', '1', 'nghngh', '27000000', '0'),
('HD2', '2024-03-02', '1', 'nghngh', '11000000', '0'),
('HD3', '2024-03-03', '1', 'nghngh', '13900000', '0'),
('HD4', '2024-03-06', '1', 'nghngh', '70400000', '0'),
('HD5', '2024-03-06', '1', 'nghngh', '29450000', '0'),
('HD6', '2024-03-14', '1', 'nghngh', '13000000', '0');

--
-- Bẫy `hoadon`
--
DELIMITER $$
CREATE TRIGGER `delete_ct_hoadon` BEFORE DELETE ON `hoadon` FOR EACH ROW DELETE FROM chitiethoadon WHERE
MaHoaDon=old.MaHoaDon
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_donhang_hoadon` BEFORE DELETE ON `hoadon` FOR EACH ROW DELETE FROM donhang WHERE donhang.MaHoaDon=old.MaHoaDon
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKhuyenMai` varchar(10) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsunhaphang`
--

CREATE TABLE `lichsunhaphang` (
  `MaKhachHang` int(100) NOT NULL,
  `MaSP` int(100) NOT NULL,
  `DonGia` int(11) NOT NULL,
  `Ngay` date NOT NULL DEFAULT current_timestamp(),
  `SLNhap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lichsunhaphang`
--

INSERT INTO `lichsunhaphang` (`MaKhachHang`, `MaSP`, `DonGia`, `Ngay`, `SLNhap`) VALUES
(0, 131, 10000000, '2023-04-24', 10),
(0, 6, 19900000, '2023-04-24', 10),
(0, 1, 160000000, '2023-04-24', 100),
(0, 1, 160000000, '2023-05-09', 1),
(0, 1, 160000000, '2023-05-09', 0),
(0, 1, 160000000, '2023-05-09', 0),
(0, 1, 160000000, '2023-05-09', 0),
(0, 1, 150000000, '2023-05-09', 0),
(0, 5, 0, '2023-05-09', 0),
(0, 5, 27000000, '2023-05-09', 0),
(0, 5, 27780000, '2023-05-09', 0),
(0, 5, 27000000, '2023-05-09', 0),
(0, 5, 2778, '2023-05-09', 0),
(0, 5, 27000000, '2023-05-09', 0),
(0, 5, 16000000, '2023-05-09', 10),
(0, 6, 19900000, '2023-05-11', 1),
(0, 6, 19900000, '2023-05-11', 2),
(0, 6, 19900000, '2023-05-11', 0),
(0, 6, 19900000, '2023-05-11', -1),
(0, 6, 19900000, '2023-05-11', -2),
(0, 6, 200, '2023-05-11', 0),
(0, 6, 23, '2023-05-11', 0),
(0, 6, 23, '2023-05-11', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoaiSP` varchar(30) NOT NULL,
  `TenLoaiSP` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoaiSP`, `TenLoaiSP`) VALUES
('ip', 'Iphone'),
('op', 'Oppo'),
('pk', 'Phụ kiện'),
('so', 'Sony'),
('ss', 'Samsung');

--
-- Bẫy `loaisp`
--
DELIMITER $$
CREATE TRIGGER `xoa_loai` BEFORE DELETE ON `loaisp` FOR EACH ROW DELETE FROM sanpham WHERE MaLoaiSP=old.MaLoaiSP
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `MaKhachHang` varchar(10) NOT NULL,
  `TenKhachHang` varchar(30) NOT NULL,
  `Quyen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaLoaiSP` varchar(20) NOT NULL,
  `TenSP` varchar(100) NOT NULL,
  `SLTon` int(11) NOT NULL,
  `DonGia` int(11) NOT NULL,
  `Image` varchar(200) CHARACTER SET utf8 NOT NULL,
  `MaSP` int(30) NOT NULL,
  `trangthai` tinyint(1) NOT NULL DEFAULT 1,
  `ram` varchar(30) DEFAULT NULL,
  `bonhotrong` varchar(30) DEFAULT NULL,
  `manhinh` varchar(30) DEFAULT NULL,
  `pin` int(30) DEFAULT NULL,
  `nhucau` varchar(30) NOT NULL,
  `dacbiet` varchar(30) DEFAULT NULL,
  `loai` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaLoaiSP`, `TenSP`, `SLTon`, `DonGia`, `Image`, `MaSP`, `trangthai`, `ram`, `bonhotrong`, `manhinh`, `pin`, `nhucau`, `dacbiet`, `loai`) VALUES
('ip', 'iPhone X 32GB black blue', 0, 160000000, 'Images/iphone/iphone1.png', 1, 0, '3GB', '32GB', '5.8', 0, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('ip', 'iPhone XR 256GB', 441, 16000000, 'images/iphone/iphone13.png', 5, 2, '3GB', '256GB', '5.8', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone X 128GB', 24, 27000000, 'images/iphone/iphone14.png', 6, 1, '3GB', '128GB', '5.8', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone X 256GB', 0, 23400000, 'images/iphone/iphone15.png', 7, 0, '3GB', '256GB', '5.8', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone XR 64GB', 7, 18500000, 'images/iphone/iphone16.png', 8, 1, '3GB', '64GB', '5.8', 0, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('ip', 'iPhone 8 Plus 256GB', 9, 11000000, 'images/iphone/iphone17.png', 9, 1, '2GB', '256GB', '4.7', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone 7 64GB', 10, 1090000, 'images/iphone/iphone18.png', 10, 1, '2GB', '64GB', '4.7', 1960, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone XS Max 512GB', 0, 29900000, 'images/iphone/iphone19.png', 11, 1, '3GB', '128GB', '5.8', 0, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone 7 32GB', 10, 8900000, 'images/iphone/iphone2.png', 12, 1, '2GB', '32GB', '4.7', 1960, 'Livestream', 'Kháng nước, bụi', 0),
('ip', 'iPhone 7 128GB', 10, 9900000, 'images/iphone/iphone20.png', 13, 1, '2GB', '128GB', '4.7', 1960, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('ip', 'iPhone 8 128GB', 10, 11900000, 'images/iphone/iphone21.png', 14, 1, '2GB', '128GB', '4.7', 0, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone XS 256GB', 10, 13900000, 'images/iphone/iphone22.png', 15, 1, '3GB', '256GB', '5.8', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone XS 128GB', 10, 14900000, 'images/iphone/iphone23.png', 16, 1, '3GB', '128GB', '5.8', 0, 'Mỏng nhẹ', 'Hỗ trợ 5G', 0),
('ip', 'iphone 13 pro max', 10, 13000000, 'Images/iphone/iphone25.png', 18, 1, '6GB', '128GB', ' 6.7', 4352, 'Livestream', 'Hỗ trợ 5G', 0),
('ip', 'iPhone XS 64GB', 10, 12900000, 'images/iphone/iphone3.png', 19, 1, '3GB', '64GB', '5.8', 0, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('ip', 'iPhone XS Max 128GB', 10, 18900000, 'images/iphone/iphone4.png', 20, 1, '3GB', '128GB', '5.8', 0, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('ip', 'iPhone 8 32GB', 10, 8900000, 'images/iphone/iphone6.png', 22, 1, '2GB', '32GB', '4.7', 0, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('ip', 'iPhone XS Max 64GB', 10, 12900000, 'images/iphone/iphone7.png', 23, 1, '3GB', '64GB', '5.8', 0, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('ip', 'iPhone 8 Plus', 10, 9900000, 'images/iphone/iphone8.png', 24, 1, '2GB', '64GB', '4.7', 0, 'Chụp ảnh, quay phim', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iPhone X 64GB', 10, 10900000, 'images/iphone/iphone9.png', 25, 1, '3GB', '64GB', '5.8', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo Find X', 10, 21900000, 'images/oppo/oppo1.png', 50, 1, '3GB', '128GB', '5.5', 1200, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('op', 'Oppo F3', 10, 8900000, 'images/oppo/oppo10.png', 51, 1, '2GB', '128GB', '6.4', 1200, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('op', 'Oppo A71+', 10, 10900000, 'images/oppo/oppo11.png', 52, 1, '2GB', '64GB', '5.5', 1200, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo A71', 10, 10000000, 'images/oppo/oppo12.png', 53, 1, '2GB', '128GB', '4.7', 1200, 'Livestream', 'Kháng nước, bụi', 0),
('op', 'Oppo A83', 10, 12900000, 'images/oppo/oppo13.png', 54, 1, '8GB', '64GB', '4.7', 1200, 'Chụp ảnh, quay phim', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo A37', 10, 11900000, 'images/oppo/oppo14.png', 55, 1, '8GB', '64GB', '6.4', 1200, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('op', 'Oppo F11', 10, 12900000, 'images/oppo/oppo15.png', 56, 1, '2GB', '32GB', '5.5', 1200, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('op', 'Oppo F11s', 9, 14900000, 'images/oppo/oppo16.png', 57, 1, '2GB', '64GB', '5.5', 1200, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo A3s', 10, 7900000, 'images/oppo/oppo17.png', 58, 1, '2GB', '128GB', '4.7', 1200, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo F7 Youth', 10, 6900000, 'images/oppo/oppo18.png', 59, 1, '8GB', '64GB', '4.7', 1200, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('op', 'Oppo F7', 10, 8900000, 'images/oppo/oppo19.png', 60, 1, '8GB', '32GB', '4.7', 1200, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('op', 'Oppo A3', 10, 9900000, 'images/oppo/oppo2.png', 61, 1, '2GB', '64GB', '6.4', 1200, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('op', 'Oppo F3s', 10, 8900000, 'images/oppo/oppo20.png', 62, 1, '2GB', '64GB', '4.7', 1200, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo F7s', 10, 7900000, 'images/oppo/oppo21.png', 63, 1, '8GB', '128GB', '5.5', 1200, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('op', 'Oppo F9s', 10, 13900000, 'images/oppo/oppo22.png', 64, 1, '3GB', '64GB', '6.4', 1200, 'Livestream', 'Kháng nước, bụi', 0),
('op', 'Oppo A37w', 10, 3100000, 'images/oppo/oppo23.png', 65, 1, '3GB', '64GB', '5.5', 1200, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('op', 'Oppo A83s', 10, 13900000, 'images/oppo/oppo24.png', 66, 1, '3GB', '64GB', '5.5', 1200, 'Chụp ảnh, quay phim', 'Bảo mật khuôn mặt 3D', 0),
('op', 'Oppo A7', 10, 9900000, 'images/oppo/oppo3.png', 67, 1, '3GB', '128GB', '5.5', 1200, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('op', 'Oppo A3+', 10, 8900000, 'images/oppo/oppo4.png', 68, 1, '2GB', '32GB', '6.4', 1200, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('op', 'Oppo R17', 10, 12900000, 'images/oppo/oppo5.png', 69, 1, '3GB', '32GB', '4.7', 1200, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('op', 'Oppo F9', 10, 13800000, 'images/oppo/oppo6.png', 70, 1, '3GB', '32GB', '6.4', 1200, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('op', 'Oppo F15', 10, 2900000, 'images/oppo/oppo7.png', 71, 1, '2GB', '128GB', '5.5', 1200, 'Mỏng nhẹ', 'Hỗ trợ 5G', 0),
('op', 'Oppo F1s', 10, 16900000, 'images/oppo/oppo9.png', 73, 1, '8GB', '128GB', '5.5', 1200, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('so', 'Sony Xperia 10', 10, 5900000, 'images/sony/sony1.png', 74, 1, '8GB', '64GB', '6.4', 0, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('so', 'Sony Xperia XZ1', 10, 7900000, 'images/sony/sony10.png', 75, 1, '2GB', '32GB', '4.7', 0, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('so', 'Sony Xperia XA1', 10, 9900000, 'images/sony/sony11.png', 76, 1, '2GB', '64GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('so', 'Sony Xperia Z2a', 10, 7800000, 'images/sony/sony12.png', 77, 1, '8GB', '128GB', '4.7', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('so', 'Sony Xperia Z', 10, 3900000, 'images/sony/sony13.png', 78, 1, '8GB', '64GB', '4.7', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Xperia Z C6602', 10, 4600000, 'images/sony/sony14.png', 79, 1, '8GB', '128GB', '4.7', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('so', 'Sony Xperia Ericsson', 10, 5800000, 'images/sony/sony15.png', 80, 1, '2GB', '32GB', '5.5', 0, 'Mỏng nhẹ', 'Hỗ trợ 5G', 0),
('so', 'Sony Ericsson K508', 10, 5900000, 'images/sony/sony16.png', 81, 1, '2GB', '64GB', '6.4', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('so', 'Sony Ericsson Z505', 10, 1900000, 'images/sony/sony17.png', 82, 1, '2GB', '32GB', '5.5', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('so', 'Sony Ericsson K510i', 10, 2900000, 'images/sony/sony18.png', 83, 1, '3GB', '128GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Ericsson W88i', 10, 13900000, 'images/sony/sony19.png', 84, 1, '8GB', '32GB', '6.4', 0, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('so', 'Sony Xperia 4', 10, 5600000, 'images/sony/sony2.png', 85, 1, '8GB', '128GB', '6.4', 0, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Ericsson D750i', 10, 6200000, 'images/sony/sony20.png', 86, 1, '3GB', '64GB', '4.7', 0, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('so', 'Sony Ericsson W830i', 9, 13900000, 'images/sony/sony21.png', 87, 1, '2GB', '64GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Ericsson T303', 10, 4900000, 'images/sony/sony22.png', 88, 1, '2GB', '64GB', '6.4', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Ericsson T230', 10, 2700000, 'images/sony/sony23.png', 89, 1, '3GB', '64GB', '4.7', 0, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('so', 'Sony Xperia Z600', 10, 2600000, 'images/sony/sony24.png', 90, 1, '8GB', '128GB', '4.7', 0, 'Chụp ảnh, quay phim', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Xperia 1', 10, 4900000, 'images/sony/sony3.png', 91, 1, '3GB', '32GB', '6.4', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Xperia 10 Plus', 10, 3800000, 'images/sony/sony4.png', 92, 1, '8GB', '64GB', '6.4', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Xperia L3', 10, 1800000, 'images/sony/sony5.png', 93, 1, '2GB', '32GB', '5.5', 0, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('so', 'Sony Xperia 2', 10, 4400000, 'images/sony/sony6.png', 94, 1, '3GB', '64GB', '4.7', 0, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('so', 'Sony Xperia 10 Ultra', 10, 13900000, 'images/sony/sony8.png', 96, 1, '2GB', '64GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('so', 'Sony Xperia X72', 10, 13900000, 'images/sony/sony9.png', 97, 1, '2GB', '128GB', '5.5', 0, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('ss', 'Samsung Galaxy A7', 9, 13900000, 'images/samsung/samsung1.png', 98, 1, '3GB', '32GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy Note tím', 9, 13900000, 'images/samsung/samsung10.png', 99, 1, '8GB', '128GB', '6.7', 0, 'Livestream', 'Kháng nước, bụi', 0),
('ss', 'Samsung Galaxy A9', 10, 13900000, 'images/samsung/samsung11.png', 100, 1, '3GB', '32GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy A10', 10, 13900000, 'images/samsung/samsung12.png', 101, 1, '2GB', '64GB', '6.4', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy A20', 10, 13900000, 'images/samsung/samsung13.png', 102, 1, '3GB', '128GB', '6.4', 0, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy A50', 10, 13900000, 'images/samsung/samsung14.png', 103, 1, '2GB', '64GB', '4.7', 0, 'Chơi game / Cấu hình cao', 'Kháng nước, bụi', 0),
('ss', 'Samsung Galaxy A8 St', 10, 13900000, 'images/samsung/samsung15.png', 104, 1, '3GB', '64GB', '6.4', 0, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy A30', 10, 13900000, 'images/samsung/samsung16.png', 105, 1, '8GB', '64GB', '5.5', 0, 'Chụp ảnh, quay phim', 'Kháng nước, bụi', 0),
('ss', 'Samsung Galaxy M20', 10, 13900000, 'images/samsung/samsung17.png', 106, 1, '2GB', '128GB', '5.5', 0, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy S10', 10, 13900000, 'images/samsung/samsung18.png', 107, 1, '8GB', '64GB', '4.7', 0, 'Livestream', 'Kháng nước, bụi', 0),
('ss', 'Samsung Galaxy S10+', 10, 13900000, 'images/samsung/samsung19.png', 108, 1, '8GB', '32GB', '5.5', 0, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy J4+', 10, 13900000, 'images/samsung/samsung2.png', 109, 1, '2GB', '32GB', '5.5', 3300, 'Chụp ảnh, quay phim', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy j4+ blue', 10, 13900000, 'images/samsung/samsung20.png', 110, 1, '2GB', '32GB', '5.5', 3300, 'Mỏng nhẹ', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy J2', 10, 13900000, 'images/samsung/samsung21.png', 111, 1, '2GB', '64GB', '4.7', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy J2 Co', 10, 13900000, 'images/samsung/samsung22.png', 112, 1, '3GB', '128GB', '5.5', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy S10e', 10, 13900000, 'images/samsung/samsung23.png', 113, 1, '2GB', '64GB', '5.5', 0, 'Chơi game / Cấu hình cao', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy A80', 10, 13900000, 'images/samsung/samsung24.png', 114, 1, '8GB', '128GB', '6.4', 0, 'Chụp ảnh, quay phim', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy S9+ 6', 10, 17900000, 'images/samsung/samsung3.png', 115, 1, '8GB', '64GB', '5.5', 0, 'Livestream', 'Kháng nước, bụi', 0),
('ss', 'Samsung Galaxy Note đen', 10, 17900000, 'images/samsung/samsung4.png', 116, 1, '8GB', '128GB', '6.7', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy Note Xám', 10, 13900000, 'images/samsung/samsung5.png', 117, 1, '8GB', '128GB', '6.7', 0, 'Livestream', 'Bảo mật khuôn mặt 3D', 0),
('ss', 'Samsung Galaxy J4+ Black', 10, 13900000, 'images/samsung/samsung6.png', 118, 1, '2GB', '32GB', '5.6', 3300, 'Chụp ảnh, quay phim', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy J6', 10, 13900000, 'images/samsung/samsung7.png', 119, 1, '3GB', '32GB', '5.6', 0, 'Livestream', 'Hỗ trợ 5G', 0),
('ss', 'Samsung Galaxy Note ', 10, 13900000, 'images/samsung/samsung9.png', 121, 1, '8GB', '128GB', '6.7', 0, 'Mỏng nhẹ', 'Hỗ trợ 5G', 0),
('hu', 'HUAWEI P40 ', 10, 10000000, 'Images/huawei/huawei1682215326.png', 131, 2, '8GB', '128GB', '6.1', 3800, 'Mỏng nhẹ', 'Bảo mật khuôn mặt 3D', 0),
('ip', 'iphone 15 promax', 99, 13000000, 'Images/iphone/iphone1699198262.jpg', 144, 1, '8GB', '256GB', '6.7', 4332, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('pk', 'Tai nghe Bluetooth True Wireless', 2, 13000000, 'Images/phụ kiện/phụ kiện1699244441.jpg', 148, 1, '', '', '', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 1),
('pk', 'Pin sạc dự phòng 10000mAh', 10, 560000, 'Images/phụ kiện/phụ kiện1699245566.jpg', 149, 1, '', '', '', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 1),
('pk', 'Adapter Sạc Type C 20W', 0, 550000, 'Images/iphone/iphone1699257538.jpg', 150, 1, '8GB', '256GB', '6.7', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 0),
('pk', 'Tai nghe Bluetooth AirPods Pro Gen 2 MagSafe Charge (USB-C) Apple MTJV3', 10, 5990000, 'Images/phụ kiện/phụ kiện1699257962.jpg', 151, 1, '', '', '', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 1),
('pk', 'Ốp lưng MagSafe cho iPhone 15 Pro Max Nhựa trong Apple MT233', 10, 1285000, 'Images/phụ kiện/phụ kiện1699258125.jpg', 152, 1, '', '', '', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 1),
('pk', 'Miếng dán camera iPhone 15 Pro Max OPTIX ALUMINIUM UNIQ', 10, 351000, 'Images/phụ kiện/phụ kiện1699258314.jpg', 153, 1, '', '', '', 0, 'Chơi game / Cấu hình cao', 'Bảo mật khuôn mặt 3D', 1),
('pk', 'Tai nghe Bluetooth True Wireless JBL Tune 230 TWS', 40, 1650000, 'Images/phụ kiện/phụ kiện1699261370.png', 154, 1, '', '', '', 0, '', '', 1);

--
-- Bẫy `sanpham`
--
DELIMITER $$
CREATE TRIGGER `sl_khong_nho_hon_0` BEFORE UPDATE ON `sanpham` FOR EACH ROW if new.SLTon < 0 THEN
	SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = 'Số lượng không nhỏ hơn 0';
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tichluy`
--

CREATE TABLE `tichluy` (
  `MaKhachHang` int(11) NOT NULL,
  `xutich` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `MaKhachHang` int(100) NOT NULL,
  `UserName` varchar(300) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `DiaChi` varchar(300) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SDT` varchar(100) NOT NULL,
  `Quyen` varchar(100) DEFAULT NULL,
  `TrangThai` varchar(30) NOT NULL,
  `tenKH` varchar(100) NOT NULL DEFAULT 'khachhang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`MaKhachHang`, `UserName`, `Password`, `DiaChi`, `Email`, `SDT`, `Quyen`, `TrangThai`, `tenKH`) VALUES
(1, 'master', '123456789', 'HCMl', 'master@master.com', '0987654321', 'master', '1', 'khachhang'),
(2, 'admin', '123456789', 'HN', 'admin@admin', '', 'customer', '1', 'khachhang'),
(3, 'nghngh', '123456789', 'HCMi', 'nghngh@gmail.com', '0987654321', 'nvdd', '1', 'khachhang'),
(4, 'ngng', '123456789', 'HCMi', 'ngng@gmail.com', '0987654321', 'nvqlkho', '1', 'khachhang'),

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vnpay`
--

CREATE TABLE `vnpay` (
  `MaDonHang` int(100) NOT NULL,
  `idvnpay` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `tongtien` int(100) NOT NULL,
  `noidungthanhtoan` varchar(300) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `trangthaivnpay` varchar(30) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'chuahoanthanh',
  `magiaodichVnpay` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `maBank` varchar(6) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ngay` varchar(30) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `vnpay`
--

INSERT INTO `vnpay` (`MaDonHang`, `idvnpay`, `tongtien`, `noidungthanhtoan`, `trangthaivnpay`, `magiaodichVnpay`, `maBank`, `ngay`) VALUES
(48, '202310252144028521', 27000000, 'Thanh toan GD:202310252144028521', 'chuahoanthanh', '', '', '20231025214402'),
(50, '202311031415387295', 13900000, 'Thanh toan GD:202311031415387295', 'chuahoanthanh', '', '', '20231103141538'),
(54, '202311141731396405', 13000000, 'Thanh toan GD:202311141731396405', '00', '14180413', 'NCB', '20231114173139');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`MaChiTietHoaDon`),
  ADD KEY `MaHoaDon` (`MaHoaDon`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietkhuyenmai`
--
ALTER TABLE `chitietkhuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`),
  ADD UNIQUE KEY `MaKhuyenMai` (`MaKhuyenMai`),
  ADD KEY `MaSp` (`MaSp`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD UNIQUE KEY `MaHoaDon` (`MaHoaDon`),
  ADD KEY `TenKhachHang` (`TenKhachHang`);

--
-- Chỉ mục cho bảng `goiy`
--
ALTER TABLE `goiy`
  ADD KEY `sanphamchinh` (`sanphamchinh`),
  ADD KEY `sanphamphu` (`sanphamphu`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHoaDon`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `lichsunhaphang`
--
ALTER TABLE `lichsunhaphang`
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`MaKhachHang`),
  ADD KEY `MaKhachHang` (`MaKhachHang`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`MaKhachHang`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- Chỉ mục cho bảng `vnpay`
--
ALTER TABLE `vnpay`
  ADD PRIMARY KEY (`idvnpay`),
  ADD KEY `MaDonHang` (`MaDonHang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `MaChiTietHoaDon` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `MaKhachHang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`MaHoaDon`) REFERENCES `hoadon` (`MaHoaDon`),
  ADD CONSTRAINT `chitiethoadon_ibfk_3` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaHoaDon`) REFERENCES `hoadon` (`MaHoaDon`),
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`TenKhachHang`) REFERENCES `user` (`UserName`);

--
-- Các ràng buộc cho bảng `goiy`
--
ALTER TABLE `goiy`
  ADD CONSTRAINT `goiy_ibfk_1` FOREIGN KEY (`sanphamchinh`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `goiy_ibfk_2` FOREIGN KEY (`sanphamphu`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `lichsunhaphang`
--
ALTER TABLE `lichsunhaphang`
  ADD CONSTRAINT `lichsunhaphang_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaLoaiSP`) REFERENCES `loaisp` (`MaLoaiSP`);

--
-- Các ràng buộc cho bảng `vnpay`
--
ALTER TABLE `vnpay`
  ADD CONSTRAINT `vnpay_ibfk_1` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
