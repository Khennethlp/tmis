-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 03:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_accounts`
--

CREATE TABLE `m_accounts` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_accounts`
--

INSERT INTO `m_accounts` (`id`, `emp_id`, `fullname`, `username`, `password`, `section`, `role`, `created_at`) VALUES
(1, '24-11109', 'Khenneth Puerto', 'admin', 'admin', 'IT', 'admin', '2024-05-03 11:51:28'),
(299, 'N/A', 'ADMIN', 'admin', 'admin', 'General Affairs', 'admin', '2024-05-08 07:11:09'),
(300, ' 23-09803', 'JESSICA FAMILARAN', 'PDC_CLERK', 'PDC_CLERK', 'PDC', 'user', '2024-05-08 07:11:09'),
(301, '13-0317 ', 'Joanna Marie Carreon', 'Joancarreon', 'NFjoan2023', 'NF', 'user', '2024-05-08 07:11:09'),
(302, 'BF-48279', 'MARY JOYCE BARTOLOME', 'MJ BARTOLOME', 'MPD48279', 'MP', 'user', '2024-05-08 07:11:09'),
(303, 'MWM-00017959', 'MARY ROSE MORES', 'MR MORES', 'MPD17959', 'MP', 'user', '2024-05-08 07:11:09'),
(304, '17-03178', 'CATHERINE RAMOS', 'CATHERINERAMOS', 'MPD03178', 'MP', 'user', '2024-05-08 07:11:09'),
(305, '21-06234', 'Sumagui, Michelle Jane R.', 'EQD', 'CHENGOT', 'EQD', 'user', '2024-05-08 07:11:09'),
(306, '17-03137', 'Gay Marasigan', 'Gay', 'gabriella', 'IT', 'user', '2024-05-08 07:11:09'),
(307, ' 22-08055', 'Joselle Rose Velecina', '22-08055', 'Acc0unting', 'Accounting', 'user', '2024-05-08 07:11:09'),
(308, '15-02613', 'Juliet H. Masarap', 'QMJULIET', '15-02613', 'QM', 'user', '2024-05-08 07:11:09'),
(309, '21-06254', 'Cristel Mae J. Aguarin', '21-06254', 'PPG@2023', 'PPG', 'user', '2024-05-08 07:11:09'),
(310, '22-07915', 'Rea O. Briones', '22-07915', 'FGI@2023', 'PPG', 'user', '2024-05-08 07:11:09'),
(311, '21-06691', 'Genie Rose B. Liwanag', '21-06691', '21-06691', 'PPG', 'user', '2024-05-08 07:11:09'),
(312, '22-09248', 'Renabel N. Casilang', '22-09248', '22-09248', 'PPG', 'user', '2024-05-08 07:11:09'),
(313, '21-06344', 'Vanessa M. Lopez', '21-06344', '21-06344', 'PPG', 'user', '2024-05-08 07:11:09'),
(314, '21-07102', 'Leonellaine B. Garcia', 'HRSAS01', 'Elaine2107102', 'HR', 'user', '2024-05-08 07:11:09'),
(315, '22-07632', 'Emily L. Eresima', 'HRSAS02', 'Ems2207632', 'HR', 'user', '2024-05-08 07:11:09'),
(316, '22-07607', 'JEMARIE TRINIDAD', '22-07607', '22-07607', 'FG', 'user', '2024-05-08 07:11:09'),
(317, '20-05737', 'ANJEANETTE ATASAN', '20-05737', '20-05737', 'FG', 'user', '2024-05-08 07:11:09'),
(318, 'N/A', 'GA-Clerk-DS', 'GA-DS', 'DAYSHIFT', 'General Affairs', 'user', '2024-05-08 07:11:09'),
(319, 'N/A', 'GA-Clerk-NS', 'GA-NS', 'NIGHTSHIFT', 'General Affairs', 'user', '2024-05-08 07:11:09'),
(320, '14-02065', 'VALENCIA, LORNA', '14-02065', '14-02065', 'MM', 'user', '2024-05-08 07:11:09'),
(321, '21-06323', 'GATCHALIAN, JESSA ', '21-06323', '21-06323', 'MM', 'user', '2024-05-08 07:11:09'),
(322, '13-0821', 'DINGLASAN, GJOANA ', '13-0821', '13-0821', 'MM', 'user', '2024-05-08 07:11:09'),
(323, ' 22-08839', 'Uranza, Lani Diaz ', '22-08839', 'QAclerk', 'QA', 'user', '2024-05-08 07:11:09'),
(324, '22-08696', 'Ausa, Ivy Diaz', '22-08696', 'QAclerk', 'QA', 'user', '2024-05-08 07:11:09'),
(325, '23-09876', 'WELL,SANDIE R.', '23-09876', '23-09876', 'IMPEX', 'user', '2024-05-08 07:11:09'),
(326, '22-09338', 'MOICO,NICO C.', '22-09338', 'IMPEX123', 'IMPEX', 'user', '2024-05-08 07:11:09'),
(327, '22-07601', 'Ann Lorraine V. Luzano', '22-07601', 'PEC&C', 'PEC&C', 'user', '2024-05-08 07:11:09'),
(328, '14-02410', 'SAN JUAN, RUBIELYN', 'PC-D', '14-02410', 'PMD-PC', 'user', '2024-05-08 07:11:09'),
(329, '19-05168', 'De Chavez, Arrissa V.', 'RTS', 'AVDC', 'RTS', 'user', '2024-05-08 07:11:09'),
(330, '13-0205', 'Asis, Monica C.', 'PTT', 'BTS', 'RTS', 'user', '2024-05-08 07:11:09'),
(331, '18-04342', 'Jennifer Falcon', 'JFalcon', '1804342', 'PE-MPPD', 'user', '2024-05-08 07:11:09'),
(332, '21-06371', 'Permejo, Michelle', 'Michelle', '2106371', 'Section 1', 'user', '2024-05-08 07:11:09'),
(333, '17-03465', 'Policarpio, Bona B.', 'Bona', '1703465', 'Section 1', 'user', '2024-05-08 07:11:09'),
(334, '22-07875', 'Semilla, Mary Dian Manio', 'Dian', '2207875', 'Section 1', 'user', '2024-05-08 07:11:09'),
(335, '21_PK53587', 'Canoy, Mae Ann Serna', 'Mae Ann', '21PK53587', 'Section 1', 'user', '2024-05-08 07:11:09'),
(336, '13-00888', 'Barunia, Rachelle L.', 'Rachelle', '1300888', 'Section 2', 'user', '2024-05-08 07:11:09'),
(337, '22-07807', 'Casabuena, Princess Daivie P.', 'Daivie', '2207807', 'Section 2', 'user', '2024-05-08 07:11:09'),
(338, '14-01884', 'Dimapasok, Mary Joy A.', 'Mary Joy', '1401884', 'Section 3', 'user', '2024-05-08 07:11:09'),
(339, '15-02532', 'Escalona, Sharon A.', 'Sharon', '1502532', 'Section 3', 'user', '2024-05-08 07:11:09'),
(340, '23-09663', 'Caraan, Esther Grace Contreras', 'Esther', '2309663', 'Section 3', 'user', '2024-05-08 07:11:09'),
(341, 'Section 4', 'Almanzor, May Mercado', 'May', '2309433', 'Section 4', 'user', '2024-05-08 07:11:09'),
(342, '21_PK53858', 'Binauhan, Raquel M.', 'Raquel', '21PK53858', 'Section 4', 'user', '2024-05-08 07:11:09'),
(343, '22_PK64004', 'Catalla, Crisha Mae Pornobi', 'Crisha', '22PK64004', 'Section 4', 'user', '2024-05-08 07:11:09'),
(344, '20-05771', 'Manalo, Sharmaine G.', 'Sharmaine', '2005771', 'Section 5', 'user', '2024-05-08 07:11:09'),
(345, '19-05333', 'Villa, Ma. Fe. Elizabeth A.', 'Faye', '1905333', 'Section 5', 'user', '2024-05-08 07:11:09'),
(346, '22-08009', 'Delos Reyes, Daisa M.', 'Daisa', '2208009', 'Section 6', 'user', '2024-05-08 07:11:09'),
(347, '21-05970', 'Ramos, Joy D.', 'Joy', '2105970', 'Section 6', 'user', '2024-05-08 07:11:09'),
(348, '22-08369', 'Asilo, Megan Jaen', 'Meagan', '2208369', 'Section 6', 'user', '2024-05-08 07:11:09'),
(349, 'EN69-6601', 'Balmaceda, Renalyn', 'Renalyn', 'EN696601', 'Section 6', 'user', '2024-05-08 07:11:09'),
(350, '22-09200', 'Almonares, Mark Joel S.', 'Marky', '2209200', 'Section 7', 'user', '2024-05-08 07:11:09'),
(351, '13-0818', 'Viola, Karen L.', 'Karen', '130818', 'Section 7', 'user', '2024-05-08 07:11:09'),
(352, '21_PK51575', 'Calalo, John Patrick', 'Patrick', '21PK51575', 'Section 7', 'user', '2024-05-08 07:11:09'),
(353, '22_PK57323', 'Paz, Rogelyn V.', 'Rogelyn', '22PK57323', 'Section 7', 'user', '2024-05-08 07:11:09'),
(354, 'EN69-5998', 'Carandang, Ronnel M.', 'Ronnel', 'EN695998', 'Section 8', 'user', '2024-05-08 07:11:09'),
(355, '22_PK61728', 'Matriz, Kuenie Chin M.', 'Kuenie', '22PK61728', 'Section 8', 'user', '2024-05-08 07:11:09'),
(356, '14-01113', 'Berongoy, Maria Noime C.', 'Noime', '1401113', 'Section 8', 'user', '2024-05-08 07:11:09'),
(357, '23-09677', 'Fanoga, Chrissie Joyce F.', 'Chrissie', '2309677', 'Section 8', 'user', '2024-05-08 07:11:09'),
(358, '17-03276', 'Valencia, Princess C.', 'Princess', '1703276', 'Section 4', 'user', '2024-05-08 07:11:09'),
(359, '22-09407', 'Geron,Princess Shella L.', '22-09407', 'Partslist.01', 'PE-AME', 'user', '2024-05-08 07:11:09'),
(360, '13-0510', 'Alcantara, Edgar D.', '13-0510', '13-0510', 'PE-AME', 'user', '2024-05-08 07:11:09'),
(361, '22-08211', 'Servidad,Kim Aldrich ', '22-08211', '22-08211', 'PE-AME', 'user', '2024-05-08 07:11:09'),
(362, 'N/A', 'MAXIM', 'MAXIM', 'MAXIM', 'MAXIM', 'user', '2024-05-08 07:11:09'),
(363, 'N/A', 'ONESOURCE', 'ONESOURCE', 'ONESOURCE', 'ONESOURCE', 'user', '2024-05-08 07:11:09'),
(364, 'N/A', 'PKIMT', 'PKIMT', 'PKIMT', 'PKIMT', 'user', '2024-05-08 07:11:09'),
(365, 'N/A', 'MEGATREND', 'MEGATREND', 'MEGATREND', 'MEGATREND', 'user', '2024-05-08 07:11:09'),
(366, 'N/A', 'ADDEVEN', 'ADDEVEN', 'ADDEVEN', 'ADDEVEN', 'user', '2024-05-08 07:11:09'),
(367, 'N/A', 'GOLDENHAND', 'GOLDENHAND', 'GOLDENHAND', 'GOLDENHAND', 'user', '2024-05-08 07:11:09'),
(368, 'N/A', 'GUARD', 'GUARD', 'GUARD', 'ARAGON', 'user', '2024-05-08 07:11:09'),
(369, '15-02782', 'Gutierrez,Maricar V.', '15-02782', '15-02782', 'IT', 'user', '2024-05-08 07:11:09'),
(370, '15-02839', 'Mitra, Renelyn R.', '15-02839', '15-02839', 'IT', 'user', '2024-05-08 07:11:09'),
(371, '17-03219', 'Manalo, Mary Grace M.', '17-03219', '17-03219', 'IT', 'user', '2024-05-08 07:11:09'),
(372, '20-05704', 'Mahinay,Lonriel Y.', '20-05704', '20-05704', 'IT', 'user', '2024-05-08 07:11:09'),
(373, '21-06733', 'Cena, Emanuel John R.', '21-06733', '21-06733', 'IT', 'user', '2024-05-08 07:11:09'),
(374, '21-06814', 'Sauro, Jhon Paulo M.', '21-06814', '21-06814', 'IT', 'user', '2024-05-08 07:11:09'),
(375, '21-06993', 'Ballesteros, John Denver B.', '21-06993', '21-06993', 'IT', 'user', '2024-05-08 07:11:09'),
(376, ' 23-09801', 'Verna C. Faclarin', '23-09801', 'QCclerk2023', 'QC', 'user', '2024-05-08 07:11:09'),
(377, '22-08675', 'USER', 'user', 'user', 'IT', 'user', '2024-05-08 07:11:09'),
(378, 'N/A', 'USER1', 'user1', 'user1', 'IT', 'user', '2024-05-08 07:11:09'),
(379, 'N/A', 'USER2', 'user2', 'user2', 'IT', 'user', '2024-05-08 07:11:09'),
(380, 'N/A', 'USER3', 'user3', 'user3', 'IT', 'user', '2024-05-08 07:11:09'),
(381, 'N/A', 'USER4', 'user4', 'user4', 'IT', 'user', '2024-05-08 07:11:09'),
(382, 'N/A', 'USER5', 'user5', 'user5', 'IT', 'user', '2024-05-08 07:11:09'),
(383, 'N/A', 'user7', 'user7', 'user7', 'IT', 'user', '2024-05-08 07:11:09'),
(384, 'N/A', 'user8', 'user8', 'user8', 'IT', 'user', '2024-05-08 07:11:09'),
(385, 'n1', 'v1', 'v1', 'v1', 'IT', 'user', '2024-05-08 07:11:09'),
(386, 'n2', 'v2', 'v2', 'v2', 'IT', 'user', '2024-05-08 07:11:09'),
(387, 'n3', 'v3', 'v3', 'v3', 'IT', 'user', '2024-05-08 07:11:09'),
(388, 'n4', 'v4', 'v4', 'v4', 'IT', 'user', '2024-05-08 07:11:09'),
(389, 'n5', 'v5', 'v5', 'v5', 'IT', 'user', '2024-05-08 07:11:09'),
(390, 'n6', 'v6', 'v6', 'v6', 'IT', 'user', '2024-05-08 07:11:09'),
(391, 'n7', 'v7', 'v7', 'v7', 'IT', 'user', '2024-05-08 07:11:09'),
(392, 'n8', 'v8', 'v8', 'v8', 'IT', 'user', '2024-05-08 07:11:09'),
(393, 'n9', 'v9', 'v9', 'v9', 'IT', 'user', '2024-05-08 07:11:09'),
(394, 'n10', 'v10', 'v10', 'v10', 'IT', 'user', '2024-05-08 07:11:09'),
(395, '23-10743', 'Irish', 'Irish', '1234', 'IT', 'user', '2024-05-08 07:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `m_kanban`
--

CREATE TABLE `m_kanban` (
  `id` int(11) NOT NULL,
  `partcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packing_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kanban`
--

INSERT INTO `m_kanban` (`id`, `partcode`, `partname`, `packing_quantity`, `date_updated`) VALUES
(1, '01S69', 'RCOT5-NC-FALP', '500', '2024-05-02 15:47:55'),
(2, '01PFP', 'RCOT5-FALP', '500', '2024-04-26 17:09:58'),
(3, '01PFQ', 'RCOT7-FALP', '300', '2024-04-26 17:09:58'),
(4, '01PFH', 'RCOT10-FALP', '300', '2024-04-26 17:09:58'),
(5, '01S6B', 'RCOT10-NC-FALP', '300', '2024-04-26 17:09:58'),
(6, '01PFI', 'RCOT13-FALP', '200', '2024-04-26 17:09:58'),
(7, '01PFJ', 'RCOT15-FALP', '200', '2024-04-26 17:09:58'),
(8, '01S68', 'RCOT17-FALP', '150', '2024-04-26 17:09:58'),
(9, '01PFK', 'RCOT19-FALP', '100', '2024-04-26 17:09:58'),
(10, '01PFL', 'RCOT22-FALP', '100', '2024-04-26 17:09:58'),
(11, '01PFM', 'RCOT25-FALP', '100', '2024-04-26 17:09:58'),
(12, '01PFN', 'RCOT28-FALP', '50', '2024-04-26 17:09:58'),
(13, '01PFO', 'RCOT32-FALP', '50', '2024-04-26 17:09:58'),
(14, '01LUT', 'NCOT5-FALP', '500', '2024-04-26 17:09:58'),
(15, '01MNP', 'NCOT7-FALP', '300', '2024-04-26 17:09:58'),
(16, '01LUS', 'NCOT13-FALP', '200', '2024-04-26 17:09:58'),
(17, '01U8N', 'NCOT13-NC-FALP', '200', '2024-04-26 17:09:58'),
(18, '01N0P', 'NCOT15-FALP', '200', '2024-04-26 17:09:58'),
(19, '01N0Q', 'NCOT19-FALP', '100', '2024-04-26 17:09:58'),
(20, '01MKW', 'NCOT19-NC-FALP', '100', '2024-04-26 17:09:58'),
(21, '01N0R', 'NCOT22-FALP', '100', '2024-04-26 17:09:58'),
(22, '01NY6', 'NCOT25-FALP', '100', '2024-04-26 17:09:58'),
(23, '01MKX', 'NCOT25-NC-FALP', '100', '2024-04-26 17:09:58'),
(24, '01LUR', 'NCOT10-FALP', '300', '2024-04-26 17:09:58'),
(25, '01MKV', 'NCOT10-NC-FALP', '300', '2024-04-26 17:09:58'),
(26, '02KXT', 'VO4X0.5(B)-FALP', '500', '2024-04-26 17:09:58'),
(27, '02KXU', 'VO6X0.5(B)-FALP', '500', '2024-04-26 17:09:58'),
(28, '02KXV', 'VO8X0.5(B)-FALP', '400', '2024-04-26 17:09:58'),
(29, '02KXX', 'VO12X0.5(B)-FALP', '200', '2024-04-26 17:09:58'),
(30, '02KY1', 'VO18X0.6(B)-FALP', '100', '2024-04-26 17:09:58'),
(31, '02KY2', 'VO20X0.6(B)-FALP', '100', '2024-04-26 17:09:58'),
(32, '02KY4', 'VO6X1(B)-FALP', '200', '2024-04-26 17:09:58'),
(33, '02KY5', 'VO8X1(B)-FALP', '200', '2024-04-26 17:09:58'),
(34, '02KY6', 'VO10X1(B)-FALP', '200', '2024-04-26 17:09:58'),
(35, '02KY7', 'VO12X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(36, '02KY8', 'VO14X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(37, '02KY9', 'VO16X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(38, '02KYA', 'VO18X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(39, '02KYB', 'VO20X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(40, '02KYC', 'VO22X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(41, '02KYD', 'VO24X1(B)-FALP', '100', '2024-04-26 17:09:58'),
(42, '02KYE', 'VO26X1(B)-FALP', '50', '2024-04-26 17:09:58'),
(43, '02KYR', 'VO28X1(B)-FALP', '50', '2024-04-26 17:09:59'),
(44, '02KYS', 'VO30X1(B)-FALP', '50', '2024-04-26 17:09:59'),
(45, '02KYT', 'VO34X1(B)-FALP', '50', '2024-04-26 17:09:59'),
(46, '02KY3', 'VO4X1(B)', '100', '2024-04-26 17:09:59'),
(47, '01WTG', 'NCOT5-NC-FALP', '500', '2024-04-26 17:09:59'),
(48, '02KXY', 'VO14X0.5(B)-FALP', '150', '2024-04-26 17:09:59'),
(49, '02KY0', 'VO16X0.6(B)-FALP', '150', '2024-04-26 17:09:59'),
(50, '02KXW', 'VO10X0.5(B)-FALP', '300', '2024-04-26 17:09:59'),
(152, '01S69', 'RCOT5-NC-FALP', '500', '2024-05-03 11:02:29'),
(153, '01PFP', 'RCOT5-FALP', '500', '2024-05-03 11:02:29'),
(154, '01PFQ', 'RCOT7-FALP', '300', '2024-05-03 11:02:29'),
(155, '01PFH', 'RCOT10-FALP', '300', '2024-05-03 11:02:29'),
(156, '01S6B', 'RCOT10-NC-FALP', '300', '2024-05-03 11:02:29'),
(157, '01PFI', 'RCOT13-FALP', '200', '2024-05-03 11:02:29'),
(158, '01PFJ', 'RCOT15-FALP', '200', '2024-05-03 11:02:29'),
(159, '01S68', 'RCOT17-FALP', '150', '2024-05-03 11:02:29'),
(160, '01PFK', 'RCOT19-FALP', '100', '2024-05-03 11:02:29'),
(161, '01PFL', 'RCOT22-FALP', '100', '2024-05-03 11:02:29'),
(162, '01PFM', 'RCOT25-FALP', '100', '2024-05-03 11:02:29'),
(163, '01PFN', 'RCOT28-FALP', '50', '2024-05-03 11:02:29'),
(164, '01PFO', 'RCOT32-FALP', '50', '2024-05-03 11:02:29'),
(165, '01LUT', 'NCOT5-FALP', '500', '2024-05-03 11:02:29'),
(166, '01MNP', 'NCOT7-FALP', '300', '2024-05-03 11:02:29'),
(167, '01LUS', 'NCOT13-FALP', '200', '2024-05-03 11:02:29'),
(168, '01U8N', 'NCOT13-NC-FALP', '200', '2024-05-03 11:02:29'),
(169, '01N0P', 'NCOT15-FALP', '200', '2024-05-03 11:02:29'),
(170, '01N0Q', 'NCOT19-FALP', '100', '2024-05-03 11:02:29'),
(171, '01MKW', 'NCOT19-NC-FALP', '100', '2024-05-03 11:02:29'),
(172, '01N0R', 'NCOT22-FALP', '100', '2024-05-03 11:02:29'),
(173, '01NY6', 'NCOT25-FALP', '100', '2024-05-03 11:02:29'),
(174, '01MKX', 'NCOT25-NC-FALP', '100', '2024-05-03 11:02:29'),
(175, '01LUR', 'NCOT10-FALP', '300', '2024-05-03 11:02:29'),
(176, '01MKV', 'NCOT10-NC-FALP', '300', '2024-05-03 11:02:29'),
(177, '02KXT', 'VO4X0.5(B)-FALP', '500', '2024-05-03 11:02:29'),
(178, '02KXU', 'VO6X0.5(B)-FALP', '500', '2024-05-03 11:02:29'),
(179, '02KXV', 'VO8X0.5(B)-FALP', '400', '2024-05-03 11:02:29'),
(180, '02KXX', 'VO12X0.5(B)-FALP', '200', '2024-05-03 11:02:29'),
(181, '02KY1', 'VO18X0.6(B)-FALP', '100', '2024-05-03 11:02:29'),
(182, '02KY2', 'VO20X0.6(B)-FALP', '100', '2024-05-03 11:02:29'),
(183, '02KY4', 'VO6X1(B)-FALP', '200', '2024-05-03 11:02:29'),
(184, '02KY5', 'VO8X1(B)-FALP', '200', '2024-05-03 11:02:29'),
(185, '02KY6', 'VO10X1(B)-FALP', '200', '2024-05-03 11:02:29'),
(186, '02KY7', 'VO12X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(187, '02KY8', 'VO14X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(188, '02KY9', 'VO16X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(189, '02KYA', 'VO18X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(190, '02KYB', 'VO20X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(191, '02KYC', 'VO22X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(192, '02KYD', 'VO24X1(B)-FALP', '100', '2024-05-03 11:02:29'),
(193, '02KYE', 'VO26X1(B)-FALP', '50', '2024-05-03 11:02:29'),
(194, '02KYR', 'VO28X1(B)-FALP', '50', '2024-05-03 11:02:29'),
(195, '02KYS', 'VO30X1(B)-FALP', '50', '2024-05-03 11:02:29'),
(196, '02KYT', 'VO34X1(B)-FALP', '50', '2024-05-03 11:02:29'),
(197, '02KY3', 'VO4X1(B)', '100', '2024-05-03 11:02:29'),
(198, '01WTG', 'NCOT5-NC-FALP', '500', '2024-05-03 11:02:29'),
(199, '02KXY', 'VO14X0.5(B)-FALP', '150', '2024-05-03 11:02:29'),
(200, '02KY0', 'VO16X0.6(B)-FALP', '150', '2024-05-03 11:02:29'),
(201, '02KXW', 'VO10X0.5(B)-FALP', '300', '2024-05-03 11:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `t_partsin`
--

CREATE TABLE `t_partsin` (
  `id` int(11) NOT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packing_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_partsin`
--

INSERT INTO `t_partsin` (`id`, `qr_code`, `partcode`, `partname`, `packing_quantity`, `lot_address`, `barcode_label`, `date_updated`, `updated_by`) VALUES
(27, 'F1001LPC012404240404601PFP0000000500BCOT0000000079202404240', '01PFP', 'N/A', '500', 'rack 1', 'LPC0124042404046', '2024-05-08 13:55:21', 'Khenneth Puerto'),
(28, 'F1001LPC012404240600101PFQ0000000300BCOT0000000002202404250', '01PFQ', 'N/A', '300', 'rack 2', 'LPC0124042406001', '2024-05-08 13:56:34', 'Khenneth Puerto'),
(29, 'F1001LPC012404240305801PFH0000000300BCOT0000000146202404260', '01PFH', 'N/A', '300', 'rack 3', 'LPC0124042403058', '2024-05-08 13:56:49', 'Khenneth Puerto'),
(30, 'F1001LPC012404240700102KXU0000000500BCOT0000000025202404270', '02KXU', 'N/A', '500', 'rack 4', 'LPC0124042407001', '2024-05-08 13:57:05', 'Khenneth Puerto'),
(32, 'F1001LPC012404240800102KXV0000000400BCOT0000000040202404280', '02KXV', 'N/A', '400', 'rack 5', 'LPC0124042408001', '2024-05-08 14:38:07', 'Khenneth Puerto');

-- --------------------------------------------------------

--
-- Table structure for table `t_partsin_history`
--

CREATE TABLE `t_partsin_history` (
  `id` int(11) NOT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packing_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(255) NOT NULL,
  `lot_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_partsin_history`
--

INSERT INTO `t_partsin_history` (`id`, `qr_code`, `partcode`, `partname`, `packing_quantity`, `quantity`, `lot_address`, `barcode_label`, `date_updated`, `updated_by`) VALUES
(105, 'F1001LPC012404240404601PFP0000000500BCOT0000000079202404240', '01PFP', 'N/A', '500', 2, 'rack 1', 'LPC0124042404046', '2024-05-08 13:56:05', 'Khenneth Puerto'),
(106, 'F1001LPC012404240600101PFQ0000000300BCOT0000000002202404250', '01PFQ', 'N/A', '300', 5, 'rack 2', 'LPC0124042406001', '2024-05-08 14:00:01', 'Khenneth Puerto'),
(107, 'F1001LPC012404240305801PFH0000000300BCOT0000000146202404260', '01PFH', 'N/A', '300', 1, 'rack 3', 'LPC0124042403058', '2024-05-08 13:56:49', 'Khenneth Puerto'),
(108, 'F1001LPC012404240700102KXU0000000500BCOT0000000025202404270', '02KXU', 'N/A', '500', 2, 'rack 4', 'LPC0124042407001', '2024-05-08 13:59:07', 'Khenneth Puerto'),
(109, 'F1001LPC012404240800102KXV0000000400BCOT0000000040202404280', '02KXV', 'N/A', '400', 1, 'rack 5', 'LPC0124042408001', '2024-05-08 13:57:20', 'Khenneth Puerto'),
(110, 'F1001LPC012404240800102KXV0000000400BCOT0000000040202404280', '02KXV', 'N/A', '400', 1, 'rack 5', 'LPC0124042408001', '2024-05-08 14:38:07', 'Khenneth Puerto');

-- --------------------------------------------------------

--
-- Table structure for table `t_partsout`
--

CREATE TABLE `t_partsout` (
  `id` int(11) NOT NULL,
  `qr_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packing_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_partsout`
--

INSERT INTO `t_partsout` (`id`, `qr_code`, `partcode`, `partname`, `packing_quantity`, `lot_address`, `barcode_label`, `date_updated`, `updated_by`) VALUES
(24, 'F1001LPC012404240800102KXV0000000400BCOT0000000040202404280', '02KXV', 'N/A', '400', 'rack 5', 'LPC0124042408001', '2024-05-08 13:57:32', 'Khenneth Puerto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_accounts`
--
ALTER TABLE `m_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kanban`
--
ALTER TABLE `m_kanban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_partsin`
--
ALTER TABLE `t_partsin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_partsin_history`
--
ALTER TABLE `t_partsin_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_partsout`
--
ALTER TABLE `t_partsout`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_accounts`
--
ALTER TABLE `m_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT for table `m_kanban`
--
ALTER TABLE `m_kanban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `t_partsin`
--
ALTER TABLE `t_partsin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `t_partsin_history`
--
ALTER TABLE `t_partsin_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `t_partsout`
--
ALTER TABLE `t_partsout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
