-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2017 at 12:08 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `izcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `user_id`, `cat_name`, `position`) VALUES
(2, 1, 'Historiessss', 3),
(5, 1, 'album', 5),
(12, 1, 'Category 16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `author` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `page_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL,
  `post_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `user_id`, `cat_id`, `page_name`, `content`, `position`, `post_on`) VALUES
(3, 1, 5, 'Page1', 'page content\r\npage content\r\npage content', 1, '2017-06-03 23:07:24'),
(4, 1, 5, 'Page1', 'page content\r\npage content\r\npage content', 1, '2017-06-03 23:38:48'),
(5, 1, 1, 'page test', 'page testpage testpage test', 1, '2017-06-03 00:00:00'),
(6, 1, 8, 'page name 1', 'khÃ´ng cÃ³ ná»™i dung gÃ¬ cáº£ :))', 4, '2017-07-06 16:53:17'),
(9, 1, 0, 'page tuấn 1', 'không có nội dung gì', 1, '2017-07-02 15:35:56'),
(11, 1, 2, 'page name 3', 'COCA-COLA TRÊN TAY, SĂN NGAY HỨNG KHỞI!\r\nCHỦ ĐỀ 2: BIỂU CẢM HỨNG KHỞI \"HÀI HƯỚC\" NHẤT\r\n\r\nLoa loa loa! Coca-Cola chính thức bật mí mục tiêu săn hứng khởi mới - Biểu Cảm Hài Hước Nhất. Giờ các bạn tha hồ sáng tạo bá đạo truy tìm những biểu cảm vui tới bến, cười té ghế và hài thốn-tận-rốn!\r\n\r\nNhanh tay thu thập bảo bối Coca-Cola lợi hại, tìm đúng mục tiêu và tung chiêu Coke Kiss mát lạnh lên mặt đối tượng rồi gửi hình về cho Coca-Cola nha. Càng hài, càng lố, cơ hội rinh quà càng cao. Samsung Galaxy S8+, Samsung Gear 360, loa JBL Flip cùng hàng trăm phần quà hấp dẫn đang chờ!COCA-COLA TRÊN TAY, SĂN NGAY HỨNG KHỞI!\r\nCHỦ ĐỀ 2: BIỂU CẢM HỨNG KHỞI \"HÀI HƯỚC\" NHẤT\r\n\r\nLoa loa loa! Coca-Cola chính thức bật mí mục tiêu săn hứng khởi mới - Biểu Cảm Hài Hước Nhất. Giờ các bạn tha hồ sáng tạo bá đạo truy tìm những biểu cảm vui tới bến, cười té ghế và hài thốn-tận-rốn!\r\n\r\nNhanh tay thu thập bảo bối Coca-Cola lợi hại, tìm đúng mục tiêu và tung chiêu Coke Kiss mát lạnh lên mặt đối tượng rồi gửi hình về cho Coca-Cola nha. Càng hài, càng lố, cơ hội rinh quà càng cao. Samsung Galaxy S8+, Samsung Gear 360, loa JBL Flip cùng hàng trăm phần quà hấp dẫn đang chờ!COCA-COLA TRÊN TAY, SĂN NGAY HỨNG KHỞI!\r\nCHỦ ĐỀ 2: BIỂU CẢM HỨNG KHỞI \"HÀI HƯỚC\" NHẤT\r\n\r\nLoa loa loa! Coca-Cola chính thức bật mí mục tiêu săn hứng khởi mới - Biểu Cảm Hài Hước Nhất. Giờ các bạn tha hồ sáng tạo bá đạo truy tìm những biểu cảm vui tới bến, cười té ghế và hài thốn-tận-rốn!\r\n\r\nNhanh tay thu thập bảo bối Coca-Cola lợi hại, tìm đúng mục tiêu và tung chiêu Coke Kiss mát lạnh lên mặt đối tượng rồi gửi hình về cho Coca-Cola nha. Càng hài, càng lố, cơ hội rinh quà càng cao. Samsung Galaxy S8+, Samsung Gear 360, loa JBL Flip cùng hàng trăm phần quà hấp dẫn đang chờ!COCA-COLA TRÊN TAY, SĂN NGAY HỨNG KHỞI!\r\nCHỦ ĐỀ 2: BIỂU CẢM HỨNG KHỞI \"HÀI HƯỚC\" NHẤT\r\n\r\nLoa loa loa! Coca-Cola chính thức bật mí mục tiêu săn hứng khởi mới - Biểu Cảm Hài Hước Nhất. Giờ các bạn tha hồ sáng tạo bá đạo truy tìm những biểu cảm vui tới bến, cười té ghế và hài thốn-tận-rốn!\r\n\r\nNhanh tay thu thập bảo bối Coca-Cola lợi hại, tìm đúng mục tiêu và tung chiêu Coke Kiss mát lạnh lên mặt đối tượng rồi gửi hình về cho Coca-Cola nha. Càng hài, càng lố, cơ hội rinh quà càng cao. Samsung Galaxy S8+, Samsung Gear 360, loa JBL Flip cùng hàng trăm phần quà hấp dẫn đang chờ!', 3, '2017-07-02 21:48:51'),
(12, 1, 2, 'tuan 084', '*Nắm tay con thật chặt\r\nGiữ tay con thật lâu\r\nHứa với con 1 câu mẹ đi đâu mẹ đưa con đi đó❤️\r\n.\r\nMẹ con cháu lại tiếp tục cuộc hành trình đi khám phá thế giới bao la tươi đẹp :x\r\nNhân dịp con đc 1 tuổi rưỡi mẹ con đưa con đi xuất ngoại lần đầu tiên đây ạ.\r\n.\r\nMẹ con nhà cute \"say Hello\" đất nước Thái Lan xinh đẹp :x*Nắm tay con thật chặt\r\nGiữ tay con thật lâu\r\nHứa với con 1 câu mẹ đi đâu mẹ đưa con đi đó❤️\r\n.\r\nMẹ con cháu lại tiếp tục cuộc hành trình đi khám phá thế giới bao la tươi đẹp :x\r\nNhân dịp con đc 1 tuổi rưỡi mẹ con đưa con đi xuất ngoại lần đầu tiên đây ạ.\r\n.\r\nMẹ con nhà cute \"say Hello\" đất nước Thái Lan xinh đẹp :x*Nắm tay con thật chặt\r\nGiữ tay con thật lâu\r\nHứa với con 1 câu mẹ đi đâu mẹ đưa con đi đó❤️\r\n.\r\nMẹ con cháu lại tiếp tục cuộc hành trình đi khám phá thế giới bao la tươi đẹp :x\r\nNhân dịp con đc 1 tuổi rưỡi mẹ con đưa con đi xuất ngoại lần đầu tiên đây ạ.\r\n.\r\nMẹ con nhà cute \"say Hello\" đất nước Thái Lan xinh đẹp :x*Nắm tay con thật chặt\r\nGiữ tay con thật lâu\r\nHứa với con 1 câu mẹ đi đâu mẹ đưa con đi đó❤️\r\n.\r\nMẹ con cháu lại tiếp tục cuộc hành trình đi khám phá thế giới bao la tươi đẹp :x\r\nNhân dịp con đc 1 tuổi rưỡi mẹ con đưa con đi xuất ngoại lần đầu tiên đây ạ.\r\n.\r\nMẹ con nhà cute \"say Hello\" đất nước Thái Lan xinh đẹp :x*Nắm tay con thật chặt\r\nGiữ tay con thật lâu\r\nHứa với con 1 câu mẹ đi đâu mẹ đưa con đi đó❤️\r\n.\r\nMẹ con cháu lại tiếp tục cuộc hành trình đi khám phá thế giới bao la tươi đẹp :x\r\nNhân dịp con đc 1 tuổi rưỡi mẹ con đưa con đi xuất ngoại lần đầu tiên đây ạ.\r\n.\r\nMẹ con nhà cute \"say Hello\" đất nước Thái Lan xinh đẹp :x', 4, '2017-07-06 16:59:54'),
(13, 1, 2, 'Lộ biên bản nội tình vụ Ngọc Trinh kiện nhà hát', 'Trước khi đọc biên bản viết tay được thư ký của Nhà hát Kịch TP.HCM ghi lại trong quyển sổ họp vào ngày 30-10-2014, chủ tọa phiên tòa đã yêu cầu ông Âu Ngọc Khánh – phó giám đốc Nhà hát Kịch TP.HCM nộp cho tòa văn bản chính thức ghi lại buổi họp của nhà hát vào chiều ngày 1-11-2014 về việc nhà hát chấm dứt việc hợp tác với Ngọc Trinmh và xác nhận văn bản này là thật.\r\n\r\nNgay sau đó, tòa mời bà Nguyễn Thị Xuân Tuyền – thư ký ghi biên bản viết tay cuộc họp của nhà hát vào ngày 30-10-2014 mà chủ tọa phiên tòa đang cầm trong tay để xác nhận nó là thật và đúng.\r\n\r\n\r\nNghệ sĩ Khánh Hoàng - nguyên giám đốc Nhà hát Kịch TP.HCM (áo xanh) và  ông Trần Anh Kiệt - giám đốc Nhà hát Kịch TP.HCM hiện nay trước khi vào phiên tòa.\r\n\r\nNgay sau đó chủ tọa phiên tòa đã đọc lớn trước tòa nguyên văn biên bản thư ký viết tay ghi lại cuộc họp ngày 30-10-2014 của Nhà hát Kịch TP.HCM (do ông Trần Quý Bình chủ trì). Theo đó, ông Quý Bình yêu cầu bộ phận trị sự, hành chánh của nhà hát hủy hợp đồng với Ngọc Trinh, hủy vé đã bán ra, hoàn tiền số vé đã bán trên mạng mà nhà hát giữ tiền, không nói thông tin này ra bên ngoài, và những quyết định này đã được ông Trần Khánh Hoàng (lúc đó đang là giám đốc nhà hát) đồng ý.\r\n\r\nĐáng chú ý là nội dung của biên bản này khác với nội dung biên bản chiều ngày 1-11-2014 của nhà hát, cho rằng Ngọc Trinh không đồng ý hợp tác nữa và là người chấm dứt hợp đồng trước. \r\n\r\n\r\nNghệ sĩ Ngọc Trinh căng thẳng khi trình bày tại phiên tòa.\r\n\r\nTrước đó, tại phiên xử chiều ngày 4-4, luật sư của Ngọc Trinh và luật sư của Nhà hát Kịch TP.HCM đã tranh luận căng thẳng về việc bên nào là người chấm dứt hợp đồng trước. Luật sư của Nhà hát Kịch TP.HCM và cả ông Trần Quý Bình đều luôn luôn khẳng định rằng Ngọc Trinh mới chính là người chấm dứt hợp đồng trước, không chịu ký vào hợp đồng do Nhà hát Kịch TP.HCM đưa ra nên nhà hát không có trách nhiệm bồi thường.\r\n\r\nVậy nên, việc công bố biên bản viết tay vào ngày 30-10-2014 tại tòa là một bất ngờ lớn. Nó chứng minh nhà hát đã chủ động và có chủ trương hủy hợp đồng với Ngọc Trinh từ trước khi có một văn bản chính thức về việc này.\r\n\r\n\r\nTừ  trái qua, ông Âu Ngọc Khánh - phó giám đốc Nhà hát Kịch TP.HCM, ông Trần Quý Bình - phó giám đốc nhà hát và nghệ sĩ Khánh Hoàng- nguyên giám đốc nhà hát tại tòa sáng 7-7.\r\n\r\nVì sao một văn bản bất lợi cho Nhà hát Kịch TP.HCM như thế lại xuất hiện tại tòa và xuất hiện trễ như vậy?\r\n\r\nPháp Luật TP.HCM đã trao đổi với ông Âu Ngọc Khánh – phó giám đốc Nhà hát Kịch TP.HCM, ông Khánh cho biết: “Văn bản viết tay trong quyển số nói trên được Nhà hát nộp cho tòa sau phiên tòa ngày 4-4. Lý do tòa yêu cầu nộp văn bản này để xác định văn bản chấm dứt hợp đồng với Ngọc Trinh của nhà hát, bản đánh chữ vi tính, in ra là có thật”.\r\n\r\nSau khi tòa đọc văn bản viết tay, nhiều nghệ sĩ và người tham dự phiên tòa sáng 7-7 đã ồ lên. Sau khi tòa đọc văn bản này, đại diện VKS tại tòa đã phát biểu quan điểm về vụ kiện: Hợp đồng hợp tác giữa bà Ngọc Trinh và Nhà hát kịch TP.HCM tuy chưa ký kết bằng văn bản nhưng đã được thực hiện với 6 vở kịch và 55 suất diễn, cùng với buổi họp báo công bố việc hợp tác vào năm 2014 nên được công nhận là có hiệu lực theo luật dân sự. Nhà hát Kịch TP.HCM đã vi phạm hợp đồng khi chấm dứt hợp tác với bà Ngọc Trinh nên có trách nhiệm bồi thường thiệt hại.\r\n\r\nTòa tuyên bố nghị án kéo dài do cần có nhiều thời giam để xem xét trước khi đưa ra quyết định; tòa dự kiến sẽ tuyên án vào ngày 11-7.', 3, '2017-07-07 16:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yahoo` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `avatar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` tinyint(4) NOT NULL,
  `active` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `website`, `yahoo`, `bio`, `avatar`, `user_level`, `active`, `registration_date`) VALUES
(1, 'Chien', 'Tuan', 'chientuan084@gmail.com', 'chientuan', 'www.chientuan.com', 'izwebz', 'không có bio', NULL, 2, NULL, '2017-06-02 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `comment_date` (`comment_date`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `post_on` (`post_on`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `registration_date` (`registration_date`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `pass` (`pass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
