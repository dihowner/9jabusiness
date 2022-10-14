-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 06:07 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesscreation`
--

CREATE TABLE `businesscreation` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `business_category` varchar(255) NOT NULL,
  `attachment` longtext NOT NULL COMMENT 'For logo and building...',
  `url` varchar(255) DEFAULT NULL,
  `founder` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `datefounded` varchar(255) DEFAULT NULL,
  `workhours` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` int(255) NOT NULL DEFAULT 0 COMMENT '0-pending\r\n1-approved\r\n2-failed',
  `apprBy` varchar(255) DEFAULT NULL,
  `msg` longtext DEFAULT NULL,
  `earnings` decimal(20,2) NOT NULL DEFAULT 0.00,
  `dateCreated` varchar(255) DEFAULT NULL,
  `dateApproved` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businesscreation`
--

INSERT INTO `businesscreation` (`id`, `userid`, `businessname`, `address`, `business_category`, `attachment`, `url`, `founder`, `mobile`, `datefounded`, `workhours`, `description`, `status`, `apprBy`, `msg`, `earnings`, `dateCreated`, `dateApproved`) VALUES
(6, '2', 'Cizar Consult', 'NO 20B, Reservation Road, FLOWER GARDEN GRA, ILORIN KWARA STATE', '', '{\"logo\":\"business/ciza2021301015.png\",\"office\":\"business/ciza77302677.png\"}', 'http:www.edata.com.ng', 'IBK', '9033530086', '2021-04-06', '', '', 1, NULL, NULL, '0.22', 'Fri 30 April, 2021; 10:50 am', 'Fri 30 April, 2021; 06:05 pm'),
(7, '2', 'Golden Gem Nursery School', 'NO 20B, Reservation Road, FLOWER GARDEN GRA, ILORIN KWARA STATE', '', '{\"logo\":\"business/gold2021300640.png\",\"office\":\"business/gold81166029.png\"}', 'http:www.edata.com.ng', 'IBK', '9033530086', '2021-02-28', '', '', 1, NULL, NULL, '25.00', 'Fri 30 April, 2021; 06:12 pm', 'Fri 30 April, 2021; 06:13 pm'),
(11, '2', 'Cizar Consult', 'Flower Garden GRA Ilorin', '23', '', '', 'Manager Mr Adedeji', '08172722917', '2020-11-12', '', '', 1, NULL, NULL, '2.00', 'Mon 3 May, 2021; 12:07 pm', 'Mon 3 May, 2021; 03:12 pm'),
(12, '10', ' Breeder\'s Farm', ' olodo road along Abeokuta ibadan road', '3', '', 'http:www.realbiz/ogunsola.com', 'JIMSON', '08061332621', '2015-03-10', '7.00hrs - 18.00hrs', 'We deal in breeding of livestock to have a better output', 2, NULL, NULL, '0.00', 'Mon 3 May, 2021; 04:47 pm', 'Wed 5 May, 2021; 05:55 pm'),
(14, '10', 'Jimsoninfotwch', 'ANUOLUWAPO OLOSE OKE AREGBA ABK', '23', '', 'http:www.realbiz/ogunsola.com', 'JIMSON', '08061332621', '2017-05-03', '8am- 6pm', 'Dealing in information marketing', 2, NULL, NULL, '0.00', 'Mon 3 May, 2021; 04:55 pm', 'Wed 5 May, 2021; 07:25 am'),
(16, '2', 'Plat Technologies Limited', '12 Ilofa Rd, GRA, Ilorin, Kwara, Nigeria', '39', '', 'https://www.platgroupng.com/', '', '08020889646', '', '8.00 am - 5.00 pm', 'We are an integrated Information and Communication Technology comapany firm with over a decade experience in website development, web applications development, search engine optimisation, webometrics consultancy, new and social media management, software development and ICT consultancy. We have offices in Ilorin and Lagos.', 1, NULL, NULL, '70.00', 'Thu 6 May, 2021; 01:30 pm', 'Thu 6 May, 2021; 02:47 pm'),
(17, '24', 'Henchris Collections', '7 Omowunmi street Oke Afa Islo', '35', '', '', 'Henry', '07083667314', '2018-10-10', '24 hours', 'Food cafe, clothings', 1, NULL, NULL, '0.18', 'Thu 6 May, 2021; 02:18 pm', 'Thu 6 May, 2021; 02:48 pm'),
(18, '24', 'Emma Store', '27 prosperity road oke Afa Isolo lagos', '35', '', '', 'Ugochinyere', '08094183538', '2017-02-09', '24 hours', 'Sale of food stuff and drinks', 1, NULL, NULL, '0.18', 'Thu 6 May, 2021; 02:21 pm', 'Thu 6 May, 2021; 02:49 pm'),
(19, '24', 'Nkiruka Beauty Saloon', '5, Omowunmi street Oke Afa Isolo lagos', '33', '', '', 'Mrs Nkiruka', '07080509124', '2020-06-01', '24 hours', 'Making of hair, makeup, ', 1, NULL, NULL, '0.26', 'Fri 7 May, 2021; 04:02 pm', 'Sat 8 May, 2021; 02:53 pm'),
(20, '24', 'Seyicele Event Services', '24 wake olatunji street Araromi Itoki ogun state', '37', '', '', 'Oluwaseyi ', '08116238680', '2020-03-26', '24 hours', 'Indoor and outdoor event services', 1, NULL, NULL, '0.18', 'Fri 7 May, 2021; 04:04 pm', 'Sat 8 May, 2021; 02:52 pm'),
(21, '43', 'God\'s Glory', 'Oau Ile Ife Osun state', '39', '', '', 'Oyedeji', '08146328189', '2021-05-08', '24/7', 'I sell airtime and Data and handle all kinds of subscription', 2, NULL, NULL, '0.00', 'Sat 8 May, 2021; 08:11 pm', 'Sun 9 May, 2021; 01:30 pm'),
(22, '24', 'Deetee Collection', '5 adeleke street ayobo lagos', '26', '', '', 'Ajewole Oluwatomisin', '07032794428', '2017-09-10', '', '', 1, NULL, NULL, '0.20', 'Sat 8 May, 2021; 10:01 pm', 'Sun 9 May, 2021; 01:14 pm'),
(23, '24', 'Kayus Stores', '24 wale olatunji street dalemo Alakuko Lagos State.', '35', '', '', 'Kayode', '07013097952', '2021-05-08', '24 hours', 'Sales of wholes drinks', 1, NULL, NULL, '0.12', 'Sat 8 May, 2021; 10:12 pm', 'Sun 9 May, 2021; 01:14 pm'),
(24, '49', 'Accuxel Prints & Design', '3, Ikokoro Junction, Off Niger Road, Ilorin, Kwara State, Ilorin, Kwara, Nigeria', '27', '', 'https://accuxel.com/', 'Shamsudeen Badmus', '+2347084232505', '2016-05-09', '08:00am-07:00pm', 'Search for Companies or Services\r\nLocation\r\nSIGN IN\r\nBusiness Directory\r\nNigeria Business Directory\r\nBrowse Categories\r\nBrowse Locations\r\nPublic Holidays 2021\r\nContact us\r\n+ ADD BUSINESS\r\nJobs\r\nJobs in Nigeria\r\nAccounting Jobs\r\nSales Jobs\r\nInternship Jobs\r\n+ POST A JOB\r\nReal Estate\r\nReal Estate in Nigeria\r\nAvailable Properties\r\n+ LIST PROPERTY\r\nLottery\r\nBaba Ijebu\r\nBaba Ijebu Result\r\nBaba Ijebu Lotto Prediction\r\nBaba Ijebu Past Result\r\nGolden Chance\r\nGolden Chance Result\r\nGolden Chance Forecast\r\nGreen Lotto\r\nGreen Lotto Result\r\nGreen Lotto Prediction\r\nSoccer Prediction\r\n\r\n\r\nJOBS	REAL ESTATE	PUBLIC HOLIDAYS	LOTTO RESULTS	SOCCER PREDICTION	COVID19 TRACKER	BUSINESS DIRECTORY\r\nNigeria	Ilorin	Advertising	Accuxel Prints & Design\r\nAccuxel Prints & Design\r\n5.09 ReviewsWRITE A REVIEW\r\n\r\n \r\nContacts	Map	Products (3)	Reviews (9)	Send Enquiry\r\n					+6\r\nADD A PHOTO\r\nVERIFIED\r\nLISTING	RECENTRLY\r\nUPDATED\r\nCOMPANY NAME\r\nAccuxel Prints & Design\r\nADDRESS\r\n3, Ikokoro Junction, Off Niger Road, Ilorin, Kwara State, Ilorin, Kwara, Nigeria\r\nVIEW MAP \r\nPHONE NUMBER\r\n+2347084232505\r\nMOBILE PHONE\r\n+2347084232505\r\nWEBSITE\r\nhttps://accuxel.com\r\nWORKING HOURS\r\nSunday: Closed  \r\nSEE ALL \r\nESTABLISHMENT YEAR 2016\r\nEMPLOYEES 6-10\r\nCOMPANY MANAGER Shamsudeen Badmus\r\nE-MAIL\r\nSEND ENQUIRY\r\nSHARE THIS LISTING\r\nReviews\r\n9 Reviews\r\n5.0 WRITE A REVIEW\r\n5.0\r\nOladele\r\n12 Mar, 2021\r\nGood T-Shirt Printing company\r\nI needed to print a customized shirt for a burial event in the last minute and they turned up for me. It was fast and the shirt printing was good. I will definitely recommend them as the best printing company for any jobs that comes my way\r\nREPLYUSEFULWRONG\r\n5.0\r\nMuiza\r\n28 Feb, 2021\r\nExcellent Business Card Design and Printing\r\nI Saw their information online and i went ahead to call them. long story short, i did my company business card design with them. the design was awesome so i decided to print it and it was just as excellent as the digital design\r\n\r\n\r\nREPLYUSEFULWRONG\r\n5.0\r\nChibuzor\r\n8 Oct, 2020\r\nFast Response and Beautiful job\r\nCame across them online while looking for wedding invitation printing and didn\'t expect prompt response but the response I got was fast so we did the wedding invitation and it\'s very beautiful\r\n\r\n\r\nREPLYUSEFULWRONG\r\n5.0\r\nDouglas\r\n19 Aug, 2020\r\nVery easy to work with\r\nThe branded paper bags, face cap and cloth label tag we printed with them is of superb quality and we couldn\'t ask for more. They gave us Clear and sharp print. They went above and beyond.\r\n\r\nWe will surely continue patronizing them\r\n\r\n\r\nREPLYUSEFULWRONG\r\n5.0\r\nSofia\r\n3 Apr, 2020\r\nBeautiful Invitation cards\r\nThe invitation Accuxel did for me was beautiful and they didn\'t disappoint because it was delivered weeks before the event. I will definitely continue to use them for my printing and design works because everyone that received the IV really loved it.\r\n\r\n\r\nREPLYUSEFULWRONG\r\n5.0\r\nOscar\r\n7 Feb, 2020\r\nOn Point Place to Print\r\nThe work given to them was on point and delivered on schedule\r\nREPLYUSEFULWRONG\r\n5.0\r\nDumelo\r\n18 Jan, 2020\r\nprofessional print and handling\r\nThe way our jobs (confidential) was carefully handled and printed was very satisfying.\r\n\r\nYou guys just won me for life.\r\nREPLYUSEFUL 1WRONG\r\n5.0\r\nOgonbo\r\n2 Oct, 2019\r\nFast, sharp and good quality\r\nI made some notepads with them and they are amazing. Fast, sharp and good quality.\r\n\r\nREPLYUSEFULWRONG 1\r\n5.0\r\nOgonbo Yola\r\n17 Sep, 2019\r\nGood quality branded sweatshirts\r\nThey helped us with some graduating sweatshirts and the quality and branding is perfect. Very easy to communicate with through whatsapp and instagram\r\nREPLYUSEFUL 1WRONG\r\nSEE ALL 9 REVIEWS \r\nQuestions & Answers\r\n0 ASK A QUESTION\r\nHave questions? Get answers from Accuxel Prints & Design or BusinessList.com.ng users. Visitors havenâ€™t asked any questions yet.\r\n\r\n \r\nCompany Details\r\nLOCATION MAP\r\nSHOW MAP\r\n3, Ikokoro Junction, Off Niger Road, Ilorin, Kwara State, Ilorin, Kwara, Nigeria\r\nGET DIRECTIONS \r\nDESCRIPTION\r\nAccuxel Design & Prints is where Creativity meets with Topnotch Prints and our services are perfectly tailored to help businesses position themselves and penetrate their market powerfully while saving cost.\r\n\r\n\r\nWe have made it easier to go from not having any business presence both online and offline to having a well-optimized business website and solid offline branding. Itâ€™s so easy that you can now easily order for a variety of services like Corporate Business Website Design, to Ecommerce Website Design, Brochure Website Design, Real Estate Website Design services, Portfolio Website Design, Branded Souvenirs, Branded Stationaries, and Printed Marketing materials at a competitive price, with lightning-fast delivery.\r\n\r\nAt Accuxel, execution and on-time delivery of all our services are efficient because we are skilled, experienced, and make use of both High-end and Hi-tech Development programs, Printing Equipment, and Tools that are guaranteed to get you the desired outstanding result.\r\n\r\nWe have worked with several local as well as international clients for over 7 years, and we believe that repeat business and growth stem from great work.', 1, NULL, NULL, '0.15', 'Sun 9 May, 2021; 01:11 pm', 'Sun 9 May, 2021; 01:13 pm'),
(25, '12', 'Ajikobi Microfinance Bank Limited.', '13, Ajikobi Street, Ilorin, Kwara, Nigeria', '36', '{\"logo\":\"business/ajik2021090111.png\",\"office\":\"business/ajik40153291.png\"}', 'http://KCYUSUF@ajikobimicrofinance.com', ' MR. OLADELE MATHEW O', '08132084536,07062946436', '2008-01-07', 'Monday - Friday : 8am to 5pm', 'Ajikob microfinance bank is a financial institution that have the following product: saving account, current account,fixed deposit, loan, daily contribution,', 1, NULL, NULL, '0.16', 'Sun 9 May, 2021; 01:46 pm', 'Sun 9 May, 2021; 09:13 pm'),
(26, '12', 'Curl Links Technologies', '1, Sulu Gambari Road, Kwara State Library Board, Opposite Central Bank of Nigeria (CBN), Ilorin, Kwara', '34', '{\"logo\":\"business/curl2021090159.png\",\"office\":\"business/curl34084743.png\"}', 'http://www.curllinkstech.com', 'Yusuf Tajudeen', '09034225262,08084540224', '2011-01-05', 'Monday to Friday from 8am to 5pm', 'Curl Links Technologies is an information technology company dedicated to business success through long-term relationships with our clients and staff. Our expertise is providing market-oriented and web-based IT solutions. Our services including corporate Website Design and Development, Content Management System (CMS), eCommerce Solution, Web Application Development, Search Engine Optimization (SEO), Social Media Optimization (SMO), Software Development as well as Mobile Application Development.', 1, NULL, NULL, '0.08', 'Sun 9 May, 2021; 01:53 pm', 'Sun 9 May, 2021; 09:14 pm'),
(27, '54', 'Minah\'s Stitches And Collections', 'Ilorin kwara and Osun state', '33', '', '', 'Haminat', '07050950980', '2017-05-13', '9am - 6pm', 'We define class', 2, NULL, NULL, '0.00', 'Sun 9 May, 2021; 05:42 pm', 'Mon 10 May, 2021; 08:48 pm'),
(28, '24', 'Posimi Collections', 'Ikorodu lagos', '33', '', '', 'Anuoluwaposimi', '08068043327', '2017-05-08', '24hours', 'Sales of fashioned cloth, bags e.t.c', 1, NULL, NULL, '0.15', 'Sun 9 May, 2021; 10:48 pm', 'Mon 10 May, 2021; 10:35 am'),
(29, '24', 'Reliable Choice Cake', 'Alhaji kudirat street Oke Afa Isolo lagos', '37', '', '', 'Esther', '+234 803 526 9044', '2019-10-10', 'Monday to Saturday', 'Cakes making decorations and event services', 1, NULL, NULL, '0.09', 'Sun 9 May, 2021; 10:52 pm', 'Mon 10 May, 2021; 10:35 am'),
(30, '49', 'DONSONS CONSTRUCTIONS', 'Plot 10 Jawe Layout, Agbeola Oro. Kwara State..................................No 5 kabiru Olorunfemi Street, igando bus stop. Igando. Lagos State. , Ilorin, Kwara, Nigeria', '27', '', 'http://www.donsonsc.com', 'AO Daniel', '+2348123773826', '2010-05-10', '08:00am-05:00pm', '', 1, NULL, NULL, '0.20', 'Mon 10 May, 2021; 01:39 am', 'Mon 10 May, 2021; 10:36 am'),
(31, '57', 'Deerahscents', 'Tanke oke odo ilorin, Kwara State', '33', '', '', 'Bolaji Kudirat', '09035513840', '2021-01-12', '24/7', 'Deals with different brands of perfume and body spray', 1, NULL, NULL, '0.10', 'Mon 10 May, 2021; 01:07 pm', 'Mon 10 May, 2021; 08:48 pm'),
(32, '24', 'Matrix Homes And Properties', '46, Akowonjo Road opp UBA Bakery Bus Stop Egbeda Lagos', '30', '', '', 'Mr Kolawole', '', '2013-08-06', 'Monday - Saturday 7am-6pm', 'Sales of land and properties', 1, NULL, NULL, '0.20', 'Tue 11 May, 2021; 12:43 pm', 'Tue 11 May, 2021; 01:43 pm'),
(33, '24', 'Kazeem Auto Ltd', '15, shomeke, mowe ogun state', '23', '', '', 'Mr Kazeem', '07085630914', '2017-07-05', 'Monday-saturday', 'Sales of automobile part', 1, NULL, NULL, '0.18', 'Tue 11 May, 2021; 12:48 pm', 'Tue 11 May, 2021; 01:42 pm'),
(34, '24', 'Go Green Food Ltd', '5, Omowunmi street Oke Afa Isolo lagos', '35', '', '', 'Mr Tade Ojelabi', '', '2020-12-19', '24 hours', 'Sales of food and drinks', 1, NULL, NULL, '0.05', 'Wed 12 May, 2021; 09:51 am', 'Thu 13 May, 2021; 03:27 am'),
(35, '24', 'Yemikemi Collection', '5, Omowunmi street Oke Afa Isolo lagos', '33', '', '', 'Kemi', '08025435279', '2010-06-16', '', 'Sales of abaya, uniform jewery', 1, NULL, NULL, '0.13', 'Wed 12 May, 2021; 09:56 am', 'Thu 13 May, 2021; 03:26 am'),
(36, '24', 'Derek Private School', 'Prince Awofadeju Oke Afa Isolo Lagos', '7', '', '', 'Derek', '+234 803 456 4421', '2009-04-15', 'Mon _ friday', 'School and learning', 0, NULL, NULL, '0.00', 'Thu 13 May, 2021; 10:33 am', 'Sat 15 May, 2021; 07:58 pm'),
(37, '24', 'Derek Private School', 'Prince Awofadeju Oke Afa Isolo Lagos', '7', '', '', 'Derek', '+234 803 456 4421', '2009-04-15', 'Mon _ friday', 'School and learning', 0, NULL, NULL, '0.10', 'Thu 13 May, 2021; 10:34 am', 'Thu 13 May, 2021; 09:13 pm'),
(38, '24', 'Seal Health Care', '2, ashilowo street, abesan estate ipaja lagospm ok', '33', '', '', 'Me Seal', '08023328627', '2016-06-06', '24hours', 'Healthcare', 0, NULL, NULL, '0.15', 'Fri 14 May, 2021; 02:22 pm', 'Sat 15 May, 2021; 07:44 pm'),
(39, '24', 'Holy Mount Of Glory Church', '1, ejila awori ota ogun state', '18', '', '', 'Feyosara', '09048723911', '2010-05-04', '24hours', '', 0, NULL, NULL, '0.10', 'Fri 14 May, 2021; 02:26 pm', 'Sat 15 May, 2021; 07:43 pm'),
(40, '68', 'Mordencity Investment Ltd', 'CT014 commissioner lodge way, GRA ilorin Kwara State ,Â Ilorin,Â Kwara', '30', '', 'http://www.mordencity.com/', 'Prince Adewole Onibokun', '08034307945', '2008-05-15', '8am-6pm', 'Morden City Investments Limited is a Nigerian based Real Estate and business company, with the headquarter in Ilorin, the capital of Kwara state. We specialize in the following services;', 0, NULL, NULL, '0.20', 'Sat 15 May, 2021; 08:20 pm', 'Sat 15 May, 2021; 08:29 pm'),
(41, '2', '3REE Interior Design & Maintenance', 'House 4 Soyebo Street, Igboya. Ile Ife., Ilesa, Osun, Nigeria', '17', '', 'http://www.3reedesign.com', 'Adeyemi Henry Adeniyi', '08037370745', '2016-05-15', '8am-6pm', 'Started last year with a portfolio of domestic and some industrial building maintenance and design. we design both interior and exterior 3D\'s where we represent your own design idea and bring them to reality. We renovate, rebuild and turn your old interior furniture and cabinetry into new ones. We manage your interior spaces and also maintain those spaces for you.\r\n\r\nWe supply interior furniture and cabinetry for both industrial and domestic use. We fix interior jagajaga.', 0, NULL, NULL, '0.18', 'Sat 15 May, 2021; 08:42 pm', 'Sat 15 May, 2021; 08:43 pm'),
(42, '68', 'Gifted Jaytee Creative World', '12 idi emi ita elepa osin offa garage,Â Ilorin,Â Kwara, Nigeria', '37', '', 'http://www.facebook.com/Giftedjayteebridals', 'Gifted Jaytee', '08036447412', '2021-05-15', '6am-6pm', 'GIFTED JAYTEE BRIDALS\r\n~Bridal handfans(Trad/white)\r\n\r\n~Bridal bouquet\r\n\r\n~Fascinators/hatinator\r\n\r\n~Single roses for bridesmaid\r\n\r\n~sales/rent of wedding gown\r\n\r\n~Bridal shower accessories', 0, NULL, NULL, '0.10', 'Sat 15 May, 2021; 09:01 pm', 'Sat 15 May, 2021; 09:54 pm'),
(43, '68', 'Accuxel Prints & Design', '3, Ikokoro Junction, Off Niger Road, Ilorin, Kwara State,Â Ilorin,Â Kwara, Nigeria', '17', '', 'https://accuxel.com', 'Shamsudeen Badmus', '07084232505', '2016-08-17', '8am-6pm', '', 0, NULL, NULL, '0.10', 'Mon 17 May, 2021; 07:43 am', 'Mon 17 May, 2021; 07:56 am'),
(44, '68', 'RIDWIN INT\'L', 'lanwa community, zango-agric, Ilorin, Kwara State ,Â Ilorin,Â Kwara, Nigeria', '34', '', 'http://ridnaija.com', 'Bamidele Oluwaseun', '08100319771', '2019-10-18', '8am-6pm', 'It\'s a digital marketing agency. It also deals with trainings, digital analysis and beverages.\r\nWe are also into data analysis, content writing/copywriting, brand promotion and free online marketing in Ilorin.', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 07:55 am', NULL),
(45, '70', 'Lollytommy Stitches ', 'Tanke bubu, sanrab bus stop', '39', '{\"logo\":\"business/loll2021170821.png\",\"office\":\"business/loll65059183.png\"}', '', 'Ololade ', '08107524145', '2018-04-28', '12 hours ', 'Deals in sowing and selling of fabrics. ', 0, NULL, NULL, '0.20', 'Mon 17 May, 2021; 08:44 am', 'Mon 17 May, 2021; 10:55 am'),
(46, '70', 'Accuxel Prints & Design', '3, Ikokoro Junction, Off Niger Road, Ilorin, Kwara State, Ilorin, Kwara, Nigeria', '38', '', 'https://accuxel.com/', 'Shamsudeen Badmus', '+2347084232505', '2021-05-17', '8:00am - 7:00pm', 'https://www.businesslist.com.ng/product/22441/portrait-a4-branded-paper-bags', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 09:52 am', NULL),
(47, '71', 'SISGE', 'NO192,OPP. OLD WEMA BANK TAIWO ROAD, ILORIN, Ilorin, Kwara, Nigeria', '36', '', 'http://www.sisgesubscriptions.com', 'Isaac Oni', '+2348158301503', '2017-07-08', '9:00am- 5:00pn', 'Always open for service', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 10:24 am', NULL),
(48, '71', 'MegaMore Wireless Broadband', '9 Zango Road, Gate B, Dakata, Kano, Kano, Nigeria', '34', '{\"logo\":\"business/mega2021171008.png\",\"office\":\"business/mega84213360.png\"}', 'http://megamore.ng', ' Amin A. Dayekh', '+2347065525271', '2019-10-11', '9:00am-5:30pm', 'Highly reliable', 0, NULL, NULL, '0.20', 'Mon 17 May, 2021; 10:37 am', 'Mon 17 May, 2021; 10:54 am'),
(49, '49', 'Smart Laundry Consult', 'Km 5,Old jebba road, Beside Kwara agro mall Opposite Hassada motors,Agric Ilorin Kwara state, Ilorin, Kwara, Nigeria', '33', '', 'https://m.facebook.com/Slaundryconsult/', 'AO Daniel', '', '', '', 'Km 5,Old jebba road, Beside Kwara agro mall Opposite Hassada motors,Agric Ilorin Kwara state, Ilorin, Kwara, Nigeria', 0, NULL, NULL, '0.22', 'Mon 17 May, 2021; 01:11 pm', 'Mon 17 May, 2021; 06:35 pm'),
(50, '49', 'Ediaro.com (Fladio International Nigeria Limited)', '40 Saboline, Ilorin, Kwara State, Nigeria., Ilorin, Kwara', '39', '', 'https://www.ediaro.com', '', '', '', '', 'ediaro.com was established as a firm in Nigeria on October 23, 2009 with interest in youth development, website development, Search Engine Optimization (SEO), international opportunities, eLibrary, among others. On August 19, 2010, it became statutorily incorporated as: Fladio International Nigeria Limited with registration number RC 907451 in Abuja, Nigeria under the Nigeria Companies and Allied Matters Act (CAMA) 1990. It\'s interest\'s are further more diversified to e-commerce, bulk SMS text messaging, website hosting, domain registration, inverter and solar system, intercom, call centre, Automobile, Properties, Professional ICT, Real Estate, Publishing,Transportation, Oil and Gas among others.', 0, NULL, NULL, '0.21', 'Mon 17 May, 2021; 01:26 pm', 'Mon 17 May, 2021; 06:34 pm'),
(51, '49', 'UNACORAI LTD', '1 AGBA DAM LAKE SHORES GRA, Ilorin, Kwara, Nigeria', '17', '', '', '', '', '', 'Minda to Friday', '', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 01:39 pm', NULL),
(52, '49', 'SISGE FOREX INSTITUTE', 'NO192,OPP. OLD WEMA BANK TAIWO ROAD, ILORIN, Ilorin, Kwara, Nigeria', '28', '', 'http://www.sisgesubscriptions.com', 'Isaac Oni', '+2348158301503', '', 'Monday to Friday', '', 0, NULL, NULL, '0.18', 'Mon 17 May, 2021; 10:59 pm', 'Tue 18 May, 2021; 06:58 am'),
(53, '49', 'The Informant247', '223, Ibrahim Taiwo Road Beside Chupet cosmetics, Ilorin , Ilorin, Kwara, Nigeria', '38', '', 'http://www.theinformant247.com', 'Salihu Sola Toafeek', '', '', '', '', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 11:01 pm', NULL),
(54, '49', 'Sweet \'n\' Savory Confections', 'Danialu, Upper Gaa Akanbi, Ilorin, Kwara, Nigeria', '35', '', 'https://api.whatsapp.com/send', 'Adesola Olubunmi', '', '', 'Everyday', 'We create sweet savour for your tastebuds. Moist, fluffy and scrumptious cakes made fresh with no added preservative is our specialty. Tasty small chops and pastries are also available for your events, meetings and get-togethers.\r\nYou don\'t need to break the bank to enjoy any of our treats.\r\nFeel free to contact us to place an order. Let\'s bake you some happiness!!!', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 11:04 pm', NULL),
(55, '49', 'Taby\'s Cuisine:cakes And Hospitality Academy', 'No 7 temidire stree eruda opp kwara stadium ,taiwo oke, Ilorin, Kwara, Nigeria', '35', '', '', 'Omotunde Tabitha', '+234 816 083 2343', '', 'Everyday', '', 0, NULL, NULL, '0.00', 'Mon 17 May, 2021; 11:06 pm', NULL),
(56, '49', 'Baalja Automobile Center', 'ADDRESS Plot 20B House of Assembly\'s Quarters, Irewolede, New Yidi RoadIlorin West 234243Ilorin, Ilorin, Kwara, Nigeria', '23', '', 'https://baalja-automobile-center.business.site', 'Tijani Ibraheem', '0807 099 4359', '', '08:00 - 06:00', '', 0, NULL, NULL, '0.20', 'Mon 17 May, 2021; 11:15 pm', 'Tue 18 May, 2021; 07:03 am'),
(57, '70', 'Adesoye College Offa ', 'Igosun road Offa, Kwara State ', '7', '{\"logo\":\"business/ades2021180748.png\",\"office\":\"business/ades47325927.png\"}', 'https://adesoyecollege.org ', 'Emmanuel Adesoye ', '08166035806', '2021-05-18', '7:00am - 4 :00pm', 'Serene environment and give quality education ', 0, NULL, NULL, '0.26', 'Tue 18 May, 2021; 07:35 am', 'Wed 19 May, 2021; 09:03 am'),
(58, '70', 'GODTIME FUELLESS TECHNOLOGY LTD', 'NO, 12 Along Isa Kaita Road, City Centre, Kaduna State Nigeria , Kaduna, Kaduna', '19', '{\"logo\":\"business/godt2021180739.png\",\"office\":\"business/godt16845656.png\"}', 'https://www.blogger.com/profile/12899337900580564333', 'Engr.Godtime Bamidele', '+234 705 231 1271', '2021-05-18', '9:00am - 8:00pm', 'Number one in fueless technology. ', 0, NULL, NULL, '0.26', 'Tue 18 May, 2021; 07:43 am', 'Wed 19 May, 2021; 09:03 am'),
(59, '71', 'Bangeez Web Solutions Ltd', 'G24 Ado Bayero Mall, Zoo Road, Kano, Kano, Nigeria', '34', '', 'https://bangeez.com', 'Ibrahim Nasir', '08060358004', '2021-05-18', '24hrs services', 'Always available for services any time', 0, NULL, NULL, '0.18', 'Tue 18 May, 2021; 08:36 am', 'Wed 19 May, 2021; 09:04 am'),
(60, '71', 'Adunni Health Services', 'Office 4, Centro Plaza, BUK Road, Kabuga Kano , Kano, Kano, Nigeria', '33', '{\"logo\":\"business/adun2021180849.png\",\"office\":\"business/adun49474571.png\"}', 'http://www.ahsplasticsurgerykano.com.ng/', ' Dr Kamal Gbadamosi', '+2348172151362', '2021-05-18', '9am-7:30pm', 'An international health analysist ', 0, NULL, NULL, '0.20', 'Tue 18 May, 2021; 08:49 am', 'Wed 19 May, 2021; 09:04 am'),
(61, '24', 'Holy Mount Of Glory Church', '1, ejila awori ota ogun state', '18', '', '', 'Feyisara', '09048723911', '2010-05-04', '24hours', '', 0, NULL, NULL, '0.15', 'Tue 18 May, 2021; 12:20 pm', 'Wed 19 May, 2021; 09:04 am'),
(62, '70', 'IBM Electrical Services', '329 Kofar Doka, Zaria, Kaduna, Nigeria', '19', '{\"logo\":\"business/ibm 2021190710.png\",\"office\":\"business/ibm 26323229.png\"}', 'https://ibmelectricals.github.io/', ' Isah Bala Mukhtar', '0803374496', '2014-07-24', '8:00am - 5:00pm ', 'Suppliers of electrical appliances ', 0, NULL, NULL, '0.19', 'Wed 19 May, 2021; 07:43 am', 'Wed 19 May, 2021; 09:05 am'),
(63, '70', 'AHMADU BELLO UNIVERSITY ABU Zaria', 'ADDRESS Sokoto Road, PMB 06, Zaria, kaduna State, Zaria, Kaduna, Nigeria', '7', '{\"logo\":\"business/ahma2021190733.png\",\"office\":\"business/ahma85603311.png\"}', 'https://www.abu.edu.ng/', 'AHMADU BELLO ', '+23469550098', '1978-09-16', '8:00am -  5:00pm', 'Best learning center ', 0, NULL, NULL, '0.26', 'Wed 19 May, 2021; 07:51 am', 'Wed 19 May, 2021; 09:05 am'),
(64, '71', 'All IMO HOTELS BOOKING', 'No 80 zander street owerri off Christ church , Owerri, Imo, Nigeria', '28', '', 'https://imohotelsbooking.com.ng', 'Obinna Ekelaka', '07067284445', '2021-05-19', '24hrs services', '', 0, NULL, NULL, '0.14', 'Wed 19 May, 2021; 08:08 am', 'Wed 19 May, 2021; 09:05 am'),
(65, '71', 'Embassy Cleaning Services', '14 Item Street ,Owerri, Owerri, Imo, Nigeria', '39', '', 'https://embassy-home-cleaning-servicesdomestic-industrial.business.site/', 'Lindarose', '08035494674', '2010-03-16', '24hrs services', 'The best in cleaning services', 0, NULL, NULL, '0.19', 'Wed 19 May, 2021; 08:30 am', 'Wed 19 May, 2021; 09:05 am'),
(66, '68', 'SISGE', 'NO192,OPP. OLD WEMA BANK TAIWO ROAD, ILORIN,Â Ilorin,Â Kwara, Nigeria', '39', '', 'NO192,OPP. OLD WEMA BANK TAIWO ROAD, ILORIN,Â Ilorin,Â Kwara, Nigeria', 'Isaac Oni', '08158301503', '2021-02-11', '8am-6pm', 'We are professional in Forex, volatility,binary and crptocurency trading,we also have a reliable plateform where you can send customised bulksms,buy airtime,data and cable subscriptions to all the networks.', 0, '', NULL, '0.00', 'Wed 19 May, 2021; 05:18 pm', 'Fri 21 May, 2021; 08:21 am'),
(67, '68', 'The Informant247', '223, Ibrahim Taiwo Road Beside Chupet cosmetics, Ilorin ,Â Ilorin,Â Kwara, Nigeria', '38', '', 'http://www.theinformant247.com', 'Salihu Shola Taofeek', '08094647101', '2021-05-19', '8am-6am', 'The Informant247 is an informational web-based social media platform which enables social media users to have access to current and well researched information.', 0, NULL, NULL, '0.20', 'Wed 19 May, 2021; 05:25 pm', 'Thu 20 May, 2021; 06:13 am'),
(68, '71', 'Fendoz Hotel', 'No 48 Amaokohia layout, New Road by Rochas Foundation College Owerri, IMO State. , Owerri, Imo, Nigeria', '28', '{\"logo\":\"business/fend2021200728.png\",\"office\":\"business/fend85872361.png\"}', 'http://www.fendozhotel.com', 'Fendoz', '+234 905 244 0556', '2021-05-20', '24hrs services', 'Fendoz Hotel Owerri is a home of comfort, where our guests pleasure its our priority. It has siren environment with a free wifi, lift, good air conditioner, twin bed and more.', 0, '', NULL, '0.00', 'Thu 20 May, 2021; 07:17 am', 'Thu 20 May, 2021; 09:12 am'),
(69, '70', '              Northern Int\'l Health Academy, Zaria', 'P.O.Box 540, Kofar Kuyanbana, Zaria City, Zaria, Kaduna, Nigeria', '7', '{\"logo\":\"business/    2021200739.png\",\"office\":\"business/    87342271.png\"}', '', 'Falalu Abdulrauf Musa', '08066878066', '2021-05-20', '8:00am - 5:00pm ', 'Education at its peak ', 0, '', NULL, '0.00', 'Thu 20 May, 2021; 07:27 am', 'Thu 20 May, 2021; 09:12 am'),
(70, '71', 'DSG STUDIOS', 'Shop D World Center, IMSU JUNCTION, By Works Layout, Opp Amanda Hospita, Owerri., Owerri, Imo, Nigeria', '33', '{\"logo\":\"business/dsg 2021200743.png\",\"office\":\"business/dsg 18274317.png\"}', 'http://www.dsgstudios.com.ng', 'DSG', '+2348032380656', '2021-05-20', '8:00am-7:00pm', 'ABOUT DSG STUDIO, Be it Wedding, Anniversary, Dedication, Conferences, Campaign, Documentary, Burials, and Movie Production We have the Biggest Studio in the South East We have the Best production too', 0, '', NULL, '0.00', 'Thu 20 May, 2021; 07:29 am', 'Thu 20 May, 2021; 09:11 am'),
(71, '70', 'BULAIWATI CONSULT LIMITED', 'SUITE HB34,GIDAN HALI,F15 NEW KADUNA ROAD,ZARIA, Zaria, Kaduna, Nigeria', '31', '{\"logo\":\"business/bula2021200743.png\",\"office\":\"business/bula34038634.png\"}', '', 'ENGR. (DR) BUBA BABASHANI', '08036406186', '2021-05-20', '9:00am - 5:00pm ', 'Produced varieties of Agriculture products ', 0, '', NULL, '0.00', 'Thu 20 May, 2021; 07:32 am', 'Thu 20 May, 2021; 09:10 am'),
(72, '67', 'GreenInfo And Consultancy Services ', '80 Ibrahim Taiwo Road, Kano', '39', '', '', 'Suleiman Abdussamad', '07025777799', '', '10am To 10pm', '', 0, '', NULL, '0.00', 'Thu 20 May, 2021; 12:09 pm', 'Thu 20 May, 2021; 05:33 pm'),
(73, '70', 'ROEMICHS INT\'L SCHOOL ILORIN ', 'Pipeline junction ilorin ', '7', '{\"logo\":\"business/roem2021210717.png\",\"office\":\"business/roem84472133.png\"}', 'https://roemichsschool.com', 'Mrs Jumoke', '0805125100', '2021-05-21', '6:00am - 5:00pm ', 'Serene environment where your wards can get the best education needed ', 0, NULL, NULL, '0.00', 'Fri 21 May, 2021; 07:54 am', NULL),
(74, '70', 'City Of Heaven On Earth', 'Yenagoa, Bayelsa State, Yenagoa, Bayelsa, Nigeria', '18', '', 'http://cityofheavenonearth.org/', 'Pastor Strongman', '08037645523', '2021-05-21', '8:00am - 2:00pm', 'God is good all the time ', 0, NULL, NULL, '0.00', 'Fri 21 May, 2021; 08:00 am', NULL),
(75, '70', 'Chelok Drive Academy', '246, Melford Okilo Road, Yenagoa, Bayelsa State, Yenagoa, Bayelsa, Nigeria', '7', '{\"logo\":\"business/chel2021220916.png\",\"office\":\"business/chel40572149.png\"}', '', 'Okoye Elisus', '+2348034174610', '2005-07-21', '10:00am - 2:00pm ', 'Teaching in the best way ', 0, NULL, NULL, '0.00', 'Sat 22 May, 2021; 09:08 am', NULL),
(76, '70', 'GOD\'S GRANT COMPUTERS', '62 Samphino Rd,Kpansia., Yenagoa, Bayelsa, Nigeria', '7', '{\"logo\":\"business/god\\2021220940.png\",\"office\":\"business/god\\39991625.png\"}', '', 'Michael Uvoh', '08134516437', '2012-07-23', '10:00am - 2:00pm ', 'Technology in the highest level ', 0, NULL, NULL, '0.00', 'Sat 22 May, 2021; 09:14 am', NULL),
(77, '71', 'Ecoscience Bioenvironmental Services Limited', 'Block 11, Liberty Centre, Liberty Estate, Independence Layout, Enugu, Enugu, Nigeria', '39', '{\"logo\":\"business/ecos2021220939.png\",\"office\":\"business/ecos49137689.png\"}', 'http://ecoscience.ng', 'Obinna Mgbabu', '08030401157', '2007-07-19', '8am - 9pm daily ', 'Has Your Home or Business Been Invaded by Pests? Donâ€™t worry again; youâ€™re in the right place! Ecoscience is #1 leading pest control company in Nigeria and the foremost fumigation company', 0, NULL, NULL, '0.00', 'Sat 22 May, 2021; 09:49 am', NULL),
(78, '71', 'PADE Business Consulting', '37 Ishielu Street, Independence Layout., Enugu, Enugu, Nigeria', '39', '{\"logo\":\"business/pade2021221007.png\",\"office\":\"business/pade89802182.png\"}', 'http://www.padebusinessconsulting.com', 'PADE Business', '+2347033276618', '2019-07-07', '8am -6pm', 'PADE is a Business Consulting brand focused on effectively and efficiently organizing and setting up blueprints for business', 0, NULL, NULL, '0.00', 'Sat 22 May, 2021; 10:09 am', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `businessreview`
--

CREATE TABLE `businessreview` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `bus_id` int(255) NOT NULL COMMENT 'Business ID',
  `message` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `msg` longtext DEFAULT NULL,
  `earnings` decimal(20,2) NOT NULL DEFAULT 0.00,
  `apprBy` varchar(255) DEFAULT NULL,
  `dateCreated` varchar(255) NOT NULL,
  `dateApproved` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businessreview`
--

INSERT INTO `businessreview` (`id`, `userid`, `bus_id`, `message`, `status`, `msg`, `earnings`, `apprBy`, `dateCreated`, `dateApproved`) VALUES
(33, 23, 11, 'It\\\'s actually a good site to make payment but  b', '1', NULL, '0.05', NULL, 'Thu 6 May, 2021; 01:55 pm', 'Thu 6 May, 2021; 02:51 pm'),
(34, 24, 11, 'Nice and intelligent staff', '2', NULL, '0.00', NULL, 'Thu 6 May, 2021; 02:22 pm', 'Thu 6 May, 2021; 02:52 pm'),
(35, 24, 11, 'Nice and intelligent staff', '2', NULL, '0.00', NULL, 'Thu 6 May, 2021; 02:22 pm', 'Thu 6 May, 2021; 02:52 pm'),
(36, 24, 6, 'It is a very reliable company', '1', NULL, '0.10', NULL, 'Thu 6 May, 2021; 03:06 pm', 'Sun 9 May, 2021; 01:39 pm'),
(37, 24, 16, 'They are a very active and quick to respond of customer service', '1', NULL, '0.08', NULL, 'Thu 6 May, 2021; 03:07 pm', 'Sun 9 May, 2021; 01:39 pm'),
(38, 27, 6, 'I like making business with this company, they are legit, secured and faster in developing', '1', NULL, '0.13', NULL, 'Thu 6 May, 2021; 03:36 pm', 'Sun 9 May, 2021; 01:39 pm'),
(39, 27, 11, 'It\\\'s actually a good site at all the time', '2', NULL, '0.00', NULL, 'Thu 6 May, 2021; 03:37 pm', 'Sun 9 May, 2021; 01:38 pm'),
(40, 27, 16, 'Nice company with good project delivery', '1', NULL, '0.05', NULL, 'Thu 6 May, 2021; 03:39 pm', 'Sun 9 May, 2021; 01:38 pm'),
(41, 29, 7, 'I know them they are real and their data is very cheap', '2', NULL, '0.00', NULL, 'Thu 6 May, 2021; 05:42 pm', 'Sun 9 May, 2021; 01:37 pm'),
(42, 10, 18, 'Great platform, good business, their products are great', '1', NULL, '0.01', NULL, 'Sat 8 May, 2021; 06:42 pm', 'Sun 9 May, 2021; 01:37 pm'),
(43, 10, 17, 'Good platform,, their products are great', '1', NULL, '0.02', NULL, 'Sat 8 May, 2021; 06:43 pm', 'Sun 9 May, 2021; 01:36 pm'),
(44, 10, 7, 'Great school of learning with good facility', '2', NULL, '0.00', NULL, 'Sat 8 May, 2021; 06:44 pm', 'Sun 9 May, 2021; 01:36 pm'),
(45, 10, 20, 'Great service provider', '1', NULL, '0.00', NULL, 'Sat 8 May, 2021; 06:45 pm', 'Sun 9 May, 2021; 01:36 pm'),
(46, 43, 20, 'Good start', '2', NULL, '0.00', NULL, 'Sat 8 May, 2021; 08:12 pm', 'Sun 9 May, 2021; 01:12 pm'),
(47, 43, 20, 'Good start', '2', NULL, '0.00', NULL, 'Sat 8 May, 2021; 08:12 pm', 'Sun 9 May, 2021; 01:11 pm'),
(48, 43, 19, 'Good service you got there', '1', NULL, '0.13', NULL, 'Sat 8 May, 2021; 08:14 pm', 'Sun 9 May, 2021; 01:11 pm'),
(49, 43, 16, 'I love this', '2', NULL, '0.00', NULL, 'Sat 8 May, 2021; 08:16 pm', 'Sun 9 May, 2021; 01:11 pm'),
(50, 43, 16, 'I love this', '1', NULL, '0.01', NULL, 'Sat 8 May, 2021; 08:16 pm', 'Sun 9 May, 2021; 01:11 pm'),
(51, 43, 7, 'Help to the educational sector', '2', NULL, '0.00', NULL, 'Sat 8 May, 2021; 08:18 pm', 'Sun 9 May, 2021; 01:10 pm'),
(52, 49, 6, 'Good service and well customer care', '1', NULL, '0.05', NULL, 'Sun 9 May, 2021; 01:02 pm', 'Sun 9 May, 2021; 01:10 pm'),
(53, 49, 16, 'All things said are true and confirmed by myself', '1', NULL, '0.09', NULL, 'Sun 9 May, 2021; 01:03 pm', 'Sun 9 May, 2021; 01:10 pm'),
(54, 49, 19, 'Good service as approved by my sister,she always go there to beautify herself all the time', '1', NULL, '0.13', NULL, 'Sun 9 May, 2021; 01:14 pm', 'Sun 9 May, 2021; 01:36 pm'),
(55, 49, 17, 'Good business', '1', NULL, '0.02', NULL, 'Sun 9 May, 2021; 01:28 pm', 'Sun 9 May, 2021; 01:35 pm'),
(56, 49, 23, 'Very great work', '1', NULL, '0.01', NULL, 'Sun 9 May, 2021; 01:38 pm', 'Sun 9 May, 2021; 01:40 pm'),
(57, 49, 7, 'Good service as approved by my myself... Have  always been there to experience their work myself most of the time', '2', NULL, '0.00', NULL, 'Sun 9 May, 2021; 01:42 pm', 'Sun 9 May, 2021; 09:16 pm'),
(58, 49, 20, 'Good service as approved by my myself... Have  always been there to experience their work myself most of the time', '1', NULL, '0.01', NULL, 'Sun 9 May, 2021; 01:43 pm', 'Sun 9 May, 2021; 09:16 pm'),
(59, 49, 18, 'Good service as approved by my myself... Have  always been there to experience their work myself most of the time', '1', NULL, '0.11', NULL, 'Sun 9 May, 2021; 01:43 pm', 'Sun 9 May, 2021; 09:17 pm'),
(60, 49, 22, 'Good service as approved by my myself... Have  always been there to experience their work myself most of the time', '2', NULL, '0.00', NULL, 'Sun 9 May, 2021; 01:43 pm', 'Sun 9 May, 2021; 09:17 pm'),
(61, 49, 11, 'Good service as approved by my myself... Have  always been there to experience their work myself most of the time', '2', NULL, '0.00', NULL, 'Sun 9 May, 2021; 01:48 pm', 'Sun 9 May, 2021; 09:17 pm'),
(62, 52, 11, 'Best innovative solutions, buy data, airtime to cash, pay bills and more.\nSupport the coming project - eDeposite', '1', NULL, '0.11', NULL, 'Sun 9 May, 2021; 02:25 pm', 'Sun 9 May, 2021; 09:18 pm'),
(63, 24, 26, 'A very reputable and we\\\'ll experienced company with a well trained staff', '1', NULL, '0.01', NULL, 'Sun 9 May, 2021; 10:55 pm', 'Mon 10 May, 2021; 10:41 am'),
(64, 24, 24, 'I give a 5 star rating to them cos they are quick in responding and they delivered a good and neat job', '1', NULL, '0.00', NULL, 'Sun 9 May, 2021; 10:59 pm', 'Mon 10 May, 2021; 10:41 am'),
(65, 24, 25, 'A trust worthy, good with a well trained and respectful staff', '1', NULL, '0.00', NULL, 'Sun 9 May, 2021; 11:01 pm', 'Mon 10 May, 2021; 10:42 am'),
(66, 52, 25, 'Daily thrift, savings account, current account.. and flexible loan', '1', NULL, '0.01', NULL, 'Sun 9 May, 2021; 11:21 pm', 'Mon 10 May, 2021; 10:47 am'),
(67, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.00', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:41 am'),
(68, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.00', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:47 am'),
(69, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.00', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:47 am'),
(70, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.00', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:47 am'),
(71, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.00', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:47 am'),
(72, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.13', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:40 am'),
(73, 49, 26, 'Curl Link Technology is a nice a very much appreciative company', '1', NULL, '0.13', NULL, 'Mon 10 May, 2021; 01:26 am', 'Mon 10 May, 2021; 10:40 am'),
(74, 49, 7, 'A school created for the future minds builders', '1', NULL, '0.00', NULL, 'Mon 10 May, 2021; 01:33 am', 'Mon 10 May, 2021; 10:40 am'),
(75, 49, 25, 'Yes test and trusted by a very dear person...confirmed that its real', '1', NULL, '0.01', NULL, 'Mon 10 May, 2021; 01:34 am', 'Mon 10 May, 2021; 10:39 am'),
(76, 24, 30, 'They are  good and experience and reliable company and very attentive to customers', '1', NULL, '0.00', NULL, 'Tue 11 May, 2021; 12:57 pm', 'Tue 11 May, 2021; 03:25 pm'),
(77, 24, 31, 'A nice and last longing product with effective delivery services', '1', NULL, '0.09', NULL, 'Tue 11 May, 2021; 12:58 pm', 'Tue 11 May, 2021; 03:25 pm'),
(78, 68, 19, 'Their customer service is top notch. Keep the good work. I got my hair treated in just 45mins', '1', NULL, '0.11', NULL, 'Sat 15 May, 2021; 08:23 pm', 'Sat 15 May, 2021; 08:31 pm'),
(79, 68, 16, 'Plat designed a website for my company, their delivery was as promised', '1', NULL, '0.13', NULL, 'Sat 15 May, 2021; 08:24 pm', 'Sat 15 May, 2021; 08:31 pm'),
(80, 68, 30, 'The road they constructed last year October has spoilt. I won\\\'t recommend their patronage', '1', NULL, '0.06', NULL, 'Sat 15 May, 2021; 08:25 pm', 'Sat 15 May, 2021; 08:31 pm'),
(81, 68, 17, 'They don\\\'t have the quality of materials needed', '1', NULL, '0.09', NULL, 'Sat 15 May, 2021; 08:26 pm', 'Sat 15 May, 2021; 08:31 pm'),
(82, 68, 34, 'This business has changed their location', '1', NULL, '0.13', NULL, 'Sat 15 May, 2021; 08:27 pm', 'Sat 15 May, 2021; 08:32 pm'),
(83, 70, 7, 'This is a school that gives your wards the best training needed. A serene environment ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:18 am', 'Mon 17 May, 2021; 11:22 am'),
(84, 70, 43, 'The best wear you can get always available at accuxel store at affordable price ', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:19 am', NULL),
(85, 70, 6, 'For your e data, e wallet and e currency contact cizar, very reliable ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:21 am', 'Mon 17 May, 2021; 11:23 am'),
(86, 70, 36, 'Derek gives their students best education you can trust ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:22 am', 'Mon 17 May, 2021; 11:24 am'),
(87, 71, 40, 'A reliable investment organisation ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:39 am', 'Mon 17 May, 2021; 11:24 am'),
(88, 71, 33, 'His an expert automobile engineer', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:40 am', 'Mon 17 May, 2021; 11:25 am'),
(89, 71, 18, 'Good customer relationship', '1', NULL, '0.09', NULL, 'Mon 17 May, 2021; 10:41 am', 'Mon 17 May, 2021; 11:25 am'),
(90, 71, 16, 'Expert when it comes to web design', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:43 am', 'Mon 17 May, 2021; 11:25 am'),
(91, 71, 29, 'Expert in baking and small chop making', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:44 am', 'Mon 17 May, 2021; 11:25 am'),
(92, 71, 29, 'Expert in baking and small chop making', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:44 am', NULL),
(93, 71, 19, 'Good customer care and relationship ', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:46 am', NULL),
(94, 70, 35, 'The best fabrics you can get are available at Yemikemi collection.. ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:46 am', 'Mon 17 May, 2021; 11:26 am'),
(95, 71, 20, 'Offer great service when it comes to event', '1', NULL, '0.08', NULL, 'Mon 17 May, 2021; 10:47 am', 'Mon 17 May, 2021; 11:26 am'),
(96, 70, 22, 'Very authentic and reliable, check it out ', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:47 am', NULL),
(97, 71, 35, 'Good customer service n customer care', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:48 am', NULL),
(98, 70, 28, 'Deals in all leather bags and accessories at very affordable prices ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:48 am', 'Mon 17 May, 2021; 11:29 am'),
(99, 71, 35, 'Good customer service n customer care', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:48 am', NULL),
(100, 71, 42, 'Good in what they does', '1', NULL, '0.04', NULL, 'Mon 17 May, 2021; 10:49 am', 'Mon 17 May, 2021; 11:29 am'),
(101, 71, 41, 'Expert in their line of work', '1', NULL, '0.10', NULL, 'Mon 17 May, 2021; 10:50 am', 'Mon 17 May, 2021; 11:30 am'),
(102, 70, 41, 'Good customer service and reliable ', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:51 am', NULL),
(103, 71, 34, 'There products are yummy', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:52 am', 'Mon 17 May, 2021; 11:31 am'),
(104, 71, 34, 'There products are yummy', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 10:52 am', NULL),
(105, 70, 26, 'Best in web design and you can trust their work ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:52 am', 'Mon 17 May, 2021; 11:31 am'),
(106, 70, 33, 'Best in automatic and manual car repair and maintenance ', '1', NULL, '0.13', NULL, 'Mon 17 May, 2021; 10:53 am', 'Mon 17 May, 2021; 11:32 am'),
(107, 70, 42, 'Expert in bridal wears and all wedding accessories. ', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 12:41 pm', NULL),
(108, 49, 38, 'Best hair Care ever', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 01:06 pm', NULL),
(109, 68, 35, 'I think I like their marketing strategy.', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:03 pm', NULL),
(110, 68, 11, 'Nice business that pay slot of of people\\\'s', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:05 pm', NULL),
(111, 68, 37, 'They also are also trying in learning', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:06 pm', NULL),
(112, 68, 25, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(113, 68, 25, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(114, 68, 25, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(115, 68, 25, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(116, 68, 25, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(117, 68, 25, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(118, 68, 25, 'Good service you got there..', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(119, 68, 25, 'Good service you got there..', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:09 pm', NULL),
(120, 68, 36, 'Good service you got there', '0', NULL, '0.00', NULL, 'Mon 17 May, 2021; 05:11 pm', NULL),
(121, 70, 20, 'Their services are awesome and they delivered as promised I recommend them ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 07:48 am', 'Tue 18 May, 2021; 05:53 pm'),
(122, 70, 52, 'Best in foreign exchange and reliable, you can trust them any day ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 07:51 am', 'Tue 18 May, 2021; 05:53 pm'),
(123, 70, 18, 'Their delivery service is number one in town, they don\\\'t disappoint you can trust them.. ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 07:53 am', 'Tue 18 May, 2021; 05:34 pm'),
(124, 70, 25, 'Tested and trusted also reliable and their interest isn\\\'t much ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 07:54 am', 'Tue 18 May, 2021; 05:35 pm'),
(125, 70, 31, 'All their products are quality products, their perfumes last long and not too expensive. ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 07:55 am', 'Tue 18 May, 2021; 05:35 pm'),
(126, 70, 34, 'They delivered both indoor and outdoor services, and their services are best in town.. ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 07:57 am', 'Tue 18 May, 2021; 05:36 pm'),
(127, 70, 40, 'Reliable and trusted investment services, visit them and you will not regret dealing with them ', '1', NULL, '0.10', NULL, 'Tue 18 May, 2021; 07:59 am', 'Tue 18 May, 2021; 05:36 pm'),
(128, 70, 29, 'For your wedding and birthday cake you can trust their services, they are best in what they do ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:00 am', 'Tue 18 May, 2021; 05:36 pm'),
(129, 70, 19, 'Giving you good look is what they\\\'re after, you can trust their work it\\\'s awesome ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:01 am', 'Tue 18 May, 2021; 05:52 pm'),
(130, 70, 39, 'God the Father, the Son and Holy Spirit still answers prayer worship with them and your life will not remain the same ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:03 am', 'Tue 18 May, 2021; 05:37 pm'),
(131, 70, 32, 'Buying any properties from them would be a great idea because you will not regret doing so and their charges are OK ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:05 am', 'Tue 18 May, 2021; 05:37 pm'),
(132, 70, 49, 'For all your laundry and dry cleaning you can only get the best from smart laundry, your clothes will always remain new. ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:06 am', 'Tue 18 May, 2021; 05:46 pm'),
(133, 70, 56, 'Both Japanese and Toyota Car is what they deal with, they will help you to service your car ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:08 am', 'Tue 18 May, 2021; 05:46 pm'),
(134, 70, 38, 'Health is Wealth for any ailments visit them today and you will come back with good news because God use them to heal people ', '1', NULL, '0.09', NULL, 'Tue 18 May, 2021; 08:09 am', 'Tue 18 May, 2021; 05:46 pm'),
(135, 71, 30, 'This company is one of the best when it comes to construction, they can improve on their services to serve better', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:52 am', 'Tue 18 May, 2021; 05:47 pm'),
(136, 71, 28, 'They offer quality services and their products are always made from quality materials. one of the best in everything they does', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:54 am', 'Tue 18 May, 2021; 05:47 pm'),
(137, 71, 31, 'They always offer quality products and there prices are affordable ', '1', NULL, '0.05', NULL, 'Tue 18 May, 2021; 08:55 am', 'Tue 18 May, 2021; 05:48 pm'),
(138, 71, 39, 'God is really doing wonders in this church, more annointing to the minister in charge', '1', NULL, '0.05', NULL, 'Tue 18 May, 2021; 08:58 am', 'Tue 18 May, 2021; 05:48 pm'),
(139, 71, 36, 'School with quality and standard education with the latest curriculum. Also maintain discipline ', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 08:59 am', 'Tue 18 May, 2021; 05:49 pm'),
(140, 71, 23, 'Their prices are cheap and affordable. They also maintain good customer relationship ', '1', NULL, '0.08', NULL, 'Tue 18 May, 2021; 09:02 am', 'Tue 18 May, 2021; 05:49 pm'),
(141, 71, 26, 'They offer quality service and up to date expert in what they does', '1', NULL, '0.02', NULL, 'Tue 18 May, 2021; 09:04 am', 'Tue 18 May, 2021; 05:50 pm'),
(142, 71, 52, 'These people are forex guru with mad strategy', '1', NULL, '0.08', NULL, 'Tue 18 May, 2021; 09:05 am', 'Tue 18 May, 2021; 05:50 pm'),
(143, 71, 38, 'Very good in their line of services ', '1', NULL, '0.00', NULL, 'Tue 18 May, 2021; 09:06 am', 'Tue 18 May, 2021; 05:50 pm'),
(144, 71, 38, 'Very good in their line of services ', '1', NULL, '0.00', NULL, 'Tue 18 May, 2021; 09:06 am', 'Tue 18 May, 2021; 05:50 pm'),
(145, 71, 45, 'Offer quality services at an affordable price. A fashion experts with latest technology', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 09:09 am', 'Tue 18 May, 2021; 05:51 pm'),
(146, 71, 37, 'A well discipline school with an experienced staff', '1', NULL, '0.13', NULL, 'Tue 18 May, 2021; 09:10 am', 'Tue 18 May, 2021; 05:51 pm'),
(147, 70, 30, 'The best construction company you can find around, their work is perfect and reliable. ', '0', NULL, '0.00', NULL, 'Wed 19 May, 2021; 07:55 am', NULL),
(148, 70, 50, 'This company gives you the best e-commerce and all networking tips that you may be needing. ', '0', NULL, '0.00', NULL, 'Wed 19 May, 2021; 07:59 am', NULL),
(149, 70, 17, 'Best in outdoor and indoor services, their food is very delicious and they keep to promise. ', '0', NULL, '0.00', NULL, 'Wed 19 May, 2021; 08:00 am', NULL),
(150, 70, 48, 'Mega more company is a reliable company you can trust, their service is the best in town. ', '0', NULL, '0.00', NULL, 'Wed 19 May, 2021; 08:01 am', NULL),
(151, 70, 16, 'Expert in web development and design, they are very affordable and easy to work with. ', '0', NULL, '0.00', NULL, 'Wed 19 May, 2021; 08:07 am', NULL),
(152, 71, 43, 'The best I have seen so far when it comes to printing and design. Tested and trusted. Keep the good work going', '0', NULL, '0.00', NULL, 'Wed 19 May, 2021; 08:33 am', NULL),
(153, 71, 49, 'One of the best cleaning services I have related with, you guys are the best', '1', NULL, '0.13', NULL, 'Wed 19 May, 2021; 08:34 am', 'Wed 19 May, 2021; 11:03 am'),
(154, 71, 6, 'Cizar consult the father of all when it comes to e data, e wallet, e currency. You are the best', '1', NULL, '0.13', NULL, 'Wed 19 May, 2021; 08:36 am', 'Wed 19 May, 2021; 11:03 am'),
(155, 71, 17, 'Their customer care unit is super, you will always want to come again', '1', NULL, '0.10', NULL, 'Wed 19 May, 2021; 08:38 am', 'Wed 19 May, 2021; 11:54 am'),
(156, 71, 25, 'This is one of the micro finance bank that offers good services to their customer with low interest on loan given to their customer with a good paying policy', '1', NULL, '0.09', NULL, 'Wed 19 May, 2021; 08:44 am', 'Wed 19 May, 2021; 12:27 pm'),
(157, 71, 11, 'They offer good customer services in buying of data, conversion of airtime to cash, pos services and lot more', '1', NULL, '0.12', NULL, 'Wed 19 May, 2021; 08:48 am', 'Wed 19 May, 2021; 12:28 pm'),
(158, 71, 50, 'This is a tested and trusted firm, I have patronised them and they offer quality services with good customer support ', '1', NULL, '0.05', NULL, 'Wed 19 May, 2021; 08:50 am', 'Wed 19 May, 2021; 12:28 pm'),
(159, 70, 64, 'Very comfortable and accommodating, it\\\'s home away from home, the best place to relax. ', '1', NULL, '0.12', NULL, 'Wed 19 May, 2021; 09:07 am', 'Wed 19 May, 2021; 12:29 pm'),
(160, 70, 11, 'The best company to get all your network data and anything related to Cryptocurrency services will be soughted out with cizar consult', '1', NULL, '0.05', NULL, 'Wed 19 May, 2021; 09:13 am', 'Wed 19 May, 2021; 12:35 pm'),
(161, 71, 57, 'The best international school in Nigeria, with upto date facilities and amenities. I have been there and I confirmed it. The school is home away from home cos it\\\'s strictly boarding school', '1', NULL, '0.13', NULL, 'Wed 19 May, 2021; 09:16 am', 'Wed 19 May, 2021; 12:34 pm'),
(162, 70, 59, 'Professional in web design services and logo creation, best in animated design you can trust them for any of your designs ', '1', NULL, '0.13', NULL, 'Wed 19 May, 2021; 09:17 am', 'Wed 19 May, 2021; 12:34 pm'),
(163, 71, 58, 'The first fueless technology I come across, am really impressed they are the best and their product is quality and last long', '1', NULL, '0.13', NULL, 'Wed 19 May, 2021; 09:18 am', 'Wed 19 May, 2021; 12:34 pm'),
(164, 70, 60, 'All health care professionals that handles all health challenges are available at Adunni health, the best hand you can trust when it comes to treatment. ', '1', NULL, '0.13', NULL, 'Wed 19 May, 2021; 09:21 am', 'Wed 19 May, 2021; 12:35 pm'),
(165, 71, 63, 'This is one of the best university in Nigeria, am proud to say this anywhere. They have the best in everything like lecturers, facilcilty, learning environment, power supply, security and their academic calendar is fast', '0', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:32 am', NULL),
(166, 70, 65, 'Fo house cleaning, office cleaning and all other cleaning services this is the best company to contact, they will give you the best. ', '0', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:34 am', NULL),
(167, 71, 62, 'IBM I have know them for decades and they have Neva disappoint, they are one of the best and all their staffs are all experienced ones', '0', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:34 am', NULL),
(168, 70, 67, 'Searching for current and updated information on anything around the world the best place to get that information is the informant247', '0', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:36 am', NULL),
(169, 71, 67, 'The informant is a platform I don\\\'t like missing, because they have always make me an upto date person when it\\\'s comes to happenings around, if you want to know latest news around just check in to informant247', '0', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:37 am', NULL),
(170, 71, 22, 'Deetee collection is where you can get that quality and original material you are looking for, have tried them you can check them out too', '0', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:39 am', NULL),
(171, 71, 22, 'Deetee collection is where you can get that quality and original material you are looking for, have tried them you can check them out too', '1', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:39 am', 'Thu 20 May, 2021; 03:37 pm'),
(172, 71, 56, 'His an autho expert and guru too, he surprised me by fixing a car that have taken to several mechanics. I can boost of him anywhere', '1', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:42 am', 'Thu 20 May, 2021; 03:37 pm'),
(173, 71, 32, 'Any properties you buy at matrix home is genuine and I can assure you have confirmed it because have run background check on them and have seen people that are living in properties gotten from them without encountering any issue', '1', NULL, '0.00', NULL, 'Thu 20 May, 2021; 07:47 am', 'Thu 20 May, 2021; 03:36 pm'),
(174, 71, 7, 'A school with a well experienced teacher sited in a conducive environment with up to date teaching curriculum ', '2', 'Invalid business details', '0.00', '', 'Thu 20 May, 2021; 07:49 am', 'Thu 20 May, 2021; 03:36 pm'),
(175, 70, 68, 'Home away from home, the best place you can enjoy yourself after a long day work, best in customer service delivery ', '0', NULL, '0.00', NULL, 'Fri 21 May, 2021; 08:03 am', NULL),
(176, 70, 70, 'For any of your occasions be it birthday, wedding or burial DG studio will give you the best shot ', '0', NULL, '0.00', NULL, 'Fri 21 May, 2021; 08:05 am', NULL),
(177, 70, 72, 'The one and only consultant agent you can rely on without being denied or disappointed.. ', '0', NULL, '0.00', NULL, 'Sat 22 May, 2021; 09:19 am', NULL),
(178, 71, 71, 'They are an agriculturist firm where you can get the new varieties of crops with seedlings too', '0', NULL, '0.00', NULL, 'Sat 22 May, 2021; 10:19 am', NULL),
(179, 71, 69, 'This is a good where future leaders were build most especially in health aspect. It\\\'s located in a conducive environment ', '2', '', '0.00', '', 'Sat 22 May, 2021; 10:21 am', 'Sun 23 May, 2021; 09:35 am');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(3, 'Agriculture'),
(6, 'Public Offices and Social Services'),
(7, 'Schools and Learning Centers'),
(14, 'Leather Works'),
(15, 'Pets Breeding'),
(17, 'Beads, Decoration and Pastries '),
(18, 'Religious Organization'),
(19, 'Solar, Renewable and Green Energy'),
(23, 'Automobile, Transport & Motoring'),
(24, 'Refrigeration and Cooling System'),
(26, 'Shopping and SuperMarket'),
(27, 'Tradesmen & Construction'),
(28, 'Hotels, Tourism, Real Estate and Accommodation'),
(29, 'Legal Firm'),
(30, 'Assets and Properties'),
(31, 'Manufacturing & Industry'),
(32, 'Law and Legal Services'),
(33, 'Health & Beauty'),
(34, 'Computers & Internet'),
(35, 'Food & Drink'),
(36, 'Finances & Insurance'),
(37, 'Events, Indoor and Outdoor programmes'),
(38, 'Entertainment & Media'),
(39, 'Business Services');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL COMMENT 'Our own tx id',
  `walletID` varchar(255) NOT NULL COMMENT 'Only meant for payment using cryptos',
  `planID` int(255) NOT NULL,
  `status` int(255) NOT NULL DEFAULT 0,
  `attachment` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'edt',
  `dateCreated` varchar(255) NOT NULL,
  `dateUpdated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `userid`, `amount`, `transaction_id`, `walletID`, `planID`, `status`, `attachment`, `currency`, `dateCreated`, `dateUpdated`) VALUES
(1, '1', '9500.00', '528563812864', '', 0, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:04 am', 'Thu 15 April, 2021; 01:04 am'),
(2, '1', '9500.00', '289429367335', '', 0, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:04 am', 'Thu 15 April, 2021; 01:04 am'),
(3, '1', '9500.00', '562132368819', '', 0, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:06 am', 'Thu 15 April, 2021; 01:06 am'),
(4, '1', '9500.00', '507718250604', '', 0, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:11 am', 'Thu 15 April, 2021; 01:11 am'),
(5, '1', '9500.00', '705003749579', '', 0, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:12 am', 'Thu 15 April, 2021; 01:12 am'),
(6, '1', '4900.00', '175351204221', '', 0, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:20 am', 'Thu 15 April, 2021; 01:20 am'),
(7, '1', '3500.00', '567723304217', '', 5, 3, NULL, 'edt', 'Thu 15 April, 2021; 01:46 am', 'Thu 15 April, 2021; 01:46 am'),
(9, '1', '3500.00', '391999429875', 'eth_ywvfvy373dhw3y', 5, 3, 'proof/pay2.PNG', 'eth', 'Thu 15 April, 2021; 01:50 am', 'Thu 15 April, 2021; 01:50 am'),
(10, '1', '2450.00', '406905238505', 'btc_TcgyftPuMVTcgyftPuMVTcgyftPuMVTcgy', 3, 1, 'proof/pay.png', 'btc', 'Thu 15 April, 2021; 01:53 am', 'Thu 15 April, 2021; 01:53 am'),
(11, '2', '2.50', '446055793989', 'bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq', 10, 1, 'proof/alh abass id.jpg', 'btc', 'Mon 3 May, 2021; 07:24 pm', 'Mon 3 May, 2021; 07:24 pm'),
(12, '2', '2.50', '440141621978', 'bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq', 10, 1, 'proof/cf866028-34c6-4a13-b784-25bbf3db9d85.jpeg', 'btc', 'Mon 3 May, 2021; 07:24 pm', 'Mon 3 May, 2021; 07:24 pm'),
(13, '14', '2.50', '859530827828', 'bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq', 10, 0, NULL, 'btc', 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(14, '14', '2.50', '807142715045', 'bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq', 10, 0, NULL, 'btc', 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(15, '14', '2.50', '538183602831', '0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27', 10, 0, NULL, 'eth', 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(16, '14', '2.50', '697169898929', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 10, 0, NULL, 'tron', 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(17, '14', '2.50', '551178539392', 'pay_RTWbFHkPLyetRTWbFHkPLyetRTWbFHkPL', 10, 0, NULL, 'paypal', 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(18, '16', '2.50', '792697706159', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 10, 0, NULL, 'tron', 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(19, '16', '2.50', '688171884604', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 10, 0, NULL, 'tron', 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(20, '16', '2.50', '869565839149', 'bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq', 10, 0, NULL, 'btc', 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(21, '16', '2.50', '737038589811', '0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27', 10, 0, NULL, 'eth', 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(22, '16', '2.50', '719150907913', 'moneymanibrahim86@gmail.com', 10, 0, NULL, 'paypal', 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(23, '2', '11.50', '575879293212', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 8, 1, 'proof/ibm passport.jpg', 'tron', 'Sun 16 May, 2021; 02:33 pm', 'Sun 16 May, 2021; 02:33 pm'),
(24, '2', '11.50', '641743746405', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 8, 5, 'proof/539bfd89-29a1-4ec7-be3e-c71c0666aa0e.jpeg', 'tron', 'Sun 16 May, 2021; 02:34 pm', 'Sun 16 May, 2021; 02:34 pm'),
(25, '2', '11.50', '124608331415', '0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27', 8, 5, 'proof/e1813314-941b-4ade-a7cb-1770db19b11a.jpeg', 'eth', 'Sun 16 May, 2021; 02:34 pm', 'Sun 16 May, 2021; 02:34 pm'),
(26, '2', '11.50', '411969238120', '0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27', 8, 5, 'proof/830cd63b-cd1f-4ce6-a37d-747496237e9d.jpeg', 'eth', 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(27, '2', '11.50', '421357654431', '0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27', 8, 5, 'proof/03c648ef-6d94-405b-8ff4-4a0d4109fadc.jpeg', 'eth', 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(28, '2', '11.50', '484641280038', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 8, 5, 'proof/8b19a25d-2fd3-46b1-a2e2-dbc1ef0800e7.jpeg', 'tron', 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(29, '2', '11.50', '146459786709', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4', 8, 5, 'proof/5e7d0117-5a8e-44ce-ab32-d5002892e7c4.jpeg', 'tron', 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL COMMENT 'Price of Level',
  `bus_no` int(255) NOT NULL DEFAULT 0 COMMENT 'questionnaire per day',
  `bus_review` int(255) NOT NULL DEFAULT 0 COMMENT 'Payment per questionnaire',
  `refComm` decimal(20,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `bus_no`, `bus_review`, `refComm`) VALUES
(6, 'Free Mode', '0', 2, 4, '5.00'),
(7, 'Full Time ', '22.5', 45, 60, '40.00'),
(8, 'Part Time ', '11.5', 25, 40, '30.00'),
(9, 'Freelance', '7.3', 10, 20, '20.00'),
(10, 'Beginner ', '2.5', 4, 5, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(255) NOT NULL,
  `userID` varchar(255) NOT NULL COMMENT 'user id',
  `clientReferred` varchar(255) NOT NULL COMMENT 'client referred id',
  `pointRcv` varchar(255) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`id`, `userID`, `clientReferred`, `pointRcv`) VALUES
(2, '2', '7', 'NO'),
(3, '2', '11', 'NO'),
(4, '2', '12', 'NO'),
(5, '5', '15', 'NO'),
(6, '10', '16', 'NO'),
(7, '2', '17', 'NO'),
(8, '2', '18', 'NO'),
(9, '2', '19', 'NO'),
(10, '11', '20', 'NO'),
(11, '11', '21', 'NO'),
(12, '11', '22', 'NO'),
(13, '11', '23', 'NO'),
(14, '11', '24', 'NO'),
(15, '11', '25', 'NO'),
(16, '11', '26', 'NO'),
(17, '11', '27', 'NO'),
(18, '11', '28', 'NO'),
(19, '11', '29', 'NO'),
(20, '11', '30', 'NO'),
(21, '11', '31', 'NO'),
(22, '2', '33', 'NO'),
(23, '11', '34', 'NO'),
(24, '11', '35', 'NO'),
(25, '11', '36', 'NO'),
(26, '11', '37', 'NO'),
(27, '11', '38', 'NO'),
(28, '2', '39', 'NO'),
(29, '2', '41', 'NO'),
(30, '2', '42', 'NO'),
(31, '11', '43', 'NO'),
(32, '11', '44', 'NO'),
(33, '11', '45', 'NO'),
(34, '11', '46', 'NO'),
(35, '11', '47', 'NO'),
(36, '47', '48', 'NO'),
(37, '2', '49', 'NO'),
(38, '11', '50', 'NO'),
(39, '11', '51', 'NO'),
(40, '11', '52', 'NO'),
(41, '11', '53', 'NO'),
(42, '47', '54', 'NO'),
(43, '11', '55', 'NO'),
(44, '52', '56', 'NO'),
(45, '47', '57', 'NO'),
(46, '11', '58', 'NO'),
(47, '47', '59', 'NO'),
(48, '24', '60', 'NO'),
(49, '11', '61', 'NO'),
(50, '11', '62', 'NO'),
(51, '11', '63', 'NO'),
(52, '47', '64', 'NO'),
(53, '23', '65', 'NO'),
(54, '11', '66', 'NO'),
(55, '2', '67', 'NO'),
(56, '2', '68', 'NO'),
(57, '2', '69', 'NO'),
(58, '2', '70', 'NO'),
(59, '70', '71', 'NO'),
(60, '11', '72', 'NO'),
(61, '11', '73', 'NO'),
(62, '2', '74', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

CREATE TABLE `reset` (
  `id` int(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reset`
--

INSERT INTO `reset` (`id`, `userid`, `code`, `status`) VALUES
(1, '5', 'f4z8af19zb7cd87', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'refComm', '30'),
(2, 'btcWallet', 'bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq'),
(3, 'paypalAddr', 'moneymanibrahim86@gmail.com'),
(4, 'tronWallet', 'TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4'),
(5, 'ethAddr', '0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27'),
(6, 'businesspoint', '{\"creation\":0.2600000000000000088817841970012523233890533447265625,\"review\":0.13000000000000000444089209850062616169452667236328125}'),
(7, 'withdrawSettings', '{\"wdrDay\":\"Tue,Wed,Thur\",\"min_withdrawal\":5,\"max_withdrawal\":550}'),
(8, 'defPlan', '6'),
(9, 'edtMerchant', 'aHqd6iuPLsOiRhuALTeObY95zvsoQujM'),
(10, 'dollarNaira', '380');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL COMMENT 'our own tx id',
  `reference_id` varchar(255) DEFAULT NULL COMMENT 'tx id from edeposite api',
  `response` longtext NOT NULL COMMENT 'From API',
  `type` varchar(255) NOT NULL DEFAULT 'plan' COMMENT 'As specified as plan on default means this transaction is for plan not referral bonus',
  `status` int(255) NOT NULL DEFAULT 0,
  `apprBy` varchar(255) DEFAULT 'System',
  `dateCreated` varchar(255) NOT NULL,
  `dateUpdated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `userid`, `amount`, `transaction_id`, `reference_id`, `response`, `type`, `status`, `apprBy`, `dateCreated`, `dateUpdated`) VALUES
(1, 1, '15.00', '22937101', '4218268090115104', '{ \"transaction_token\": 2, \"total_transaction_charge\": 0.04999999701976776, \"total_transaction_token_charge\": 9.999999310821295e-4, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8\", \"transaction_id\": \"4218268090115104\", \"sender_initial_token\": 10, \"sender_final_token\": 7.999000072479248, \"recipient_initial_token\": 2.4207632541656496, \"receipient_final_token\": 4.42076301574707, \"panic\": null }', 'plan', 1, NULL, '', ''),
(2, 1, '132.00', '70495690', '', 'Failed to connect to api.edeposite.info port 443: Timed out', 'plan', 1, NULL, '', ''),
(3, 1, '132.00', '56907049', '4218151042680901', '{ \"transaction_token\": 2, \"total_transaction_charge\": 0.04999999701976776, \"total_transaction_token_charge\": 9.999999310821295e-4, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8\", \"transaction_id\": \"4218151042680901\", \"sender_initial_token\": 10, \"sender_final_token\": 7.999000072479248, \"recipient_initial_token\": 2.4207632541656496, \"receipient_final_token\": 4.42076301574707, \"panic\": null }', 'plan', 1, NULL, '', ''),
(4, 1, '65.00', '7319849780', '4218151042680901', '{ \"transaction_token\": 2, \"total_transaction_charge\": 0.04999999701976776, \"total_transaction_token_charge\": 9.999999310821295e-4, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8\", \"transaction_id\": \"4218151042680901\", \"sender_initial_token\": 10, \"sender_final_token\": 7.999000072479248, \"recipient_initial_token\": 2.4207632541656496, \"receipient_final_token\": 4.42076301574707, \"panic\": null }', 'plan', 1, NULL, 'Thu 1 April, 2021; 09:59 pm', 'Thu 1 April, 2021; 09:59 pm'),
(5, 1, '65.00', '4382628299', '4218151042680901', '{ \"transaction_token\": 2, \"total_transaction_charge\": 0.04999999701976776, \"total_transaction_token_charge\": 9.999999310821295e-4, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8\", \"transaction_id\": \"4218151042680901\", \"sender_initial_token\": 10, \"sender_final_token\": 7.999000072479248, \"recipient_initial_token\": 2.4207632541656496, \"receipient_final_token\": 4.42076301574707, \"panic\": null }', 'plan', 1, NULL, 'Thu 1 April, 2021; 10:22 pm', 'Thu 1 April, 2021; 10:22 pm'),
(6, 1, '65.00', '5240057975', '4218151042680901', '{ \"transaction_token\": 2, \"total_transaction_charge\": 0.04999999701976776, \"total_transaction_token_charge\": 9.999999310821295e-4, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8\", \"transaction_id\": \"4218151042680901\", \"sender_initial_token\": 10, \"sender_final_token\": 7.999000072479248, \"recipient_initial_token\": 2.4207632541656496, \"receipient_final_token\": 4.42076301574707, \"panic\": null }', 'plan', 1, NULL, 'Thu 1 April, 2021; 10:26 pm', 'Thu 1 April, 2021; 10:26 pm'),
(7, 1, '65.00', '3180013871', '4218151042680901', '{ \"transaction_token\": 2, \"total_transaction_charge\": 0.04999999701976776, \"total_transaction_token_charge\": 9.999999310821295e-4, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8\", \"transaction_id\": \"4218151042680901\", \"sender_initial_token\": 10, \"sender_final_token\": 7.999000072479248, \"recipient_initial_token\": 2.4207632541656496, \"receipient_final_token\": 4.42076301574707, \"panic\": null }', 'plan', 1, NULL, 'Thu 1 April, 2021; 10:28 pm', 'Thu 1 April, 2021; 10:28 pm'),
(8, 1, '390.00', '6163234696', '', '{ \"panic\": \"Transaction token \'390.195eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\" } ', 'plan', 3, NULL, 'Thu 1 April, 2021; 10:56 pm', 'Thu 1 April, 2021; 10:56 pm'),
(9, 1, '901.00', '6163234696', '', '{\n    \"panic\": \"Transaction token \'901.4505eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 1 April, 2021; 11:02 pm', 'Thu 1 April, 2021; 11:02 pm'),
(10, 1, '337.00', '6163234696', '', '{\n    \"panic\": \"Transaction token \'337.1685eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 1 April, 2021; 11:02 pm', 'Thu 1 April, 2021; 11:02 pm'),
(11, 1, '2450.00', '1458817903', '1458817903', '{\"msg\":\"Plan activated successfully\",\"panic\":null}', 'plan', 1, NULL, 'Tue 13 April, 2021; 04:40 pm', 'Tue 13 April, 2021; 04:40 pm'),
(12, 1, '9500.00', '679269367586', '', '{\n    \"panic\": \"Transaction token \'9504.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 12:54 am', 'Thu 15 April, 2021; 12:54 am'),
(13, 1, '9500.00', '528563812864', '', '{\n    \"panic\": \"Transaction token \'9504.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:04 am', 'Thu 15 April, 2021; 01:04 am'),
(14, 1, '9500.00', '289429367335', '', '{\n    \"panic\": \"Transaction token \'9504.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:04 am', 'Thu 15 April, 2021; 01:04 am'),
(15, 1, '9500.00', '562132368819', '', '{\n    \"panic\": \"Transaction token \'9504.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:06 am', 'Thu 15 April, 2021; 01:06 am'),
(16, 1, '9500.00', '507718250604', '', '{\n    \"panic\": \"Transaction token \'9504.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:11 am', 'Thu 15 April, 2021; 01:11 am'),
(17, 1, '9500.00', '705003749579', '', '{\n    \"panic\": \"Transaction token \'9504.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:12 am', 'Thu 15 April, 2021; 01:12 am'),
(18, 1, '4900.00', '175351204221', '', '{\n    \"panic\": \"Transaction token \'4902.45eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:20 am', 'Thu 15 April, 2021; 01:20 am'),
(19, 1, '3500.00', '567723304217', '', '{\n    \"panic\": \"Transaction token \'3501.75eDT\' is greater than user \'cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\' balance: \'5.998001eDT\'\"\n}\n', 'plan', 3, NULL, 'Thu 15 April, 2021; 01:46 am', 'Thu 15 April, 2021; 01:46 am'),
(21, 1, '3500.00', '391999429875', '', '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"eth_ywvfvy373dhw3y\",\"type\":\"eth\"}', 'plan', 0, NULL, 'Thu 15 April, 2021; 01:50 am', 'Thu 15 April, 2021; 01:50 am'),
(22, 1, '2450.00', '406905238505', '', '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"btc_TcgyftPuMVTcgyftPuMVTcgyftPuMVTcgy\",\"type\":\"btc\"}', 'plan', 0, NULL, 'Thu 15 April, 2021; 01:53 am', 'Thu 15 April, 2021; 01:53 am'),
(23, 1, '0.00', '1861228443', '0065872454104407', '1', 'plan', 1, NULL, 'Tue 20 April, 2021; 11:29 pm', 'Tue 20 April, 2021; 11:29 pm'),
(24, 1, '0.00', '6470217043', '0065871454044072', '{ \"transaction_number\": \"0065871044072454\", \"token\": 2.9999999242136255e-5, \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\", \"to_whom\": \"user\", \"created_at\": 1618939520, \"status\": false }', 'plan', 1, NULL, 'Tue 20 April, 2021; 11:31 pm', 'Tue 20 April, 2021; 11:31 pm'),
(25, 1, '450.00', '4973379342', '0065871044072454', '{\n    \"transaction_number\": \"0065871044072454\",\n    \"token\": 2.9999999242136255e-5,\n    \"from\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\",\n    \"to\": \"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\",\n    \"to_whom\": \"user\",\n    \"created_at\": 1618939520,\n    \"status\": false\n}', 'plan', 1, NULL, 'Wed 21 April, 2021; 12:13 am', 'Wed 21 April, 2021; 12:13 am'),
(26, 4, '100.00', '4307431547', '', '{\"msg\":\"Business creation earning\",\"bus_id\":\"5\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 29 April, 2021; 11:44 am', 'Thu 29 April, 2021; 11:44 am'),
(27, 1, '150.00', '4567633655', '', '{\"msg\":\"Business creation earning\",\"bus_id\":\"1\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Fri 30 April, 2021; 12:24 pm', 'Fri 30 April, 2021; 12:24 pm'),
(28, 2, '0.22', '2295463471', '', '{\"msg\":\"Business creation earning\",\"bus_id\":\"6\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Fri 30 April, 2021; 06:05 pm', 'Fri 30 April, 2021; 06:05 pm'),
(29, 2, '25.00', '2255322673', '', '{\"msg\":\"Business creation earning\",\"bus_id\":\"7\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Fri 30 April, 2021; 06:13 pm', 'Fri 30 April, 2021; 06:13 pm'),
(30, 10, '2.50', '7323433210', '1335413416862843', '{\n    \"transaction_number\": \"1335413416862843\",\n    \"token\": 2.5,\n    \"from\": \"dXzI43vmby8cxJuw7ZhScaJyU7gQSyJf\",\n    \"to\": \"dXzI43vmby8cxJuw7ZhScaJyU7gQSyJf\",\n    \"to_whom\": \"user\",\n    \"created_at\": 1620036076,\n    \"status\": false\n}', 'plan', 1, NULL, 'Mon 3 May, 2021; 11:01 am', 'Mon 3 May, 2021; 11:01 am'),
(31, 10, '2.50', '2731278668', '5266713700449853', '{\n    \"transaction_number\": \"5266713700449853\",\n    \"token\": 2.5,\n    \"from\": \"fXwo0TeuapkoLGTPf7KSH12Vxj6si5Ut\",\n    \"to\": \"dXzI43vmby8cxJuw7ZhScaJyU7gQSyJf\",\n    \"to_whom\": \"user\",\n    \"created_at\": 1620040731,\n    \"status\": false\n}', 'plan', 1, NULL, 'Mon 3 May, 2021; 12:18 pm', 'Mon 3 May, 2021; 12:18 pm'),
(32, 2, '2.00', '5211895038', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"11\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 3 May, 2021; 03:12 pm', 'Mon 3 May, 2021; 03:12 pm'),
(33, 2, '2.50', '446055793989', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq\",\"type\":\"btc\"}', 'plan', 0, NULL, 'Mon 3 May, 2021; 07:24 pm', 'Mon 3 May, 2021; 07:24 pm'),
(34, 2, '2.50', '440141621978', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq\",\"type\":\"btc\"}', 'plan', 0, NULL, 'Mon 3 May, 2021; 07:24 pm', 'Mon 3 May, 2021; 07:24 pm'),
(35, 5, '2.00', '9333225460', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"10\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 12:39 am', 'Tue 4 May, 2021; 12:39 am'),
(36, 5, '1.00', '8939796980', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"19\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 01:38 am', 'Tue 4 May, 2021; 01:38 am'),
(37, 5, '2.00', '3918867831', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"10\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 01:47 am', 'Tue 4 May, 2021; 01:47 am'),
(38, 5, '3.00', '8862373205', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"18\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 01:49 am', 'Tue 4 May, 2021; 01:49 am'),
(39, 5, '4.00', '6432196044', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"18\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 01:51 am', 'Tue 4 May, 2021; 01:51 am'),
(40, 5, '2.00', '1200165294', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"18\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 01:53 am', 'Tue 4 May, 2021; 01:53 am'),
(41, 5, '4.00', '1118225671', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"19\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 4 May, 2021; 01:57 am', 'Tue 4 May, 2021; 01:57 am'),
(42, 14, '2.50', '859530827828', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq\",\"type\":\"btc\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(43, 14, '2.50', '807142715045', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq\",\"type\":\"btc\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(44, 14, '2.50', '538183602831', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27\",\"type\":\"eth\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(45, 14, '2.50', '697169898929', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(46, 14, '2.50', '551178539392', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"pay_RTWbFHkPLyetRTWbFHkPLyetRTWbFHkPL\",\"type\":\"paypal\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 06:08 am', 'Tue 4 May, 2021; 06:08 am'),
(47, 16, '2.50', '792697706159', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(48, 16, '2.50', '688171884604', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(49, 16, '2.50', '869565839149', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"bc1qds5863q2me8sl4gq5kqj4q9pza953w8h2kclgq\",\"type\":\"btc\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(50, 16, '2.50', '737038589811', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27\",\"type\":\"eth\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(51, 16, '2.50', '719150907913', NULL, '{\"msg\":\"Payment will be made to wallet address\",\"wallet_addr\":\"moneymanibrahim86@gmail.com\",\"type\":\"paypal\"}', 'plan', 0, NULL, 'Tue 4 May, 2021; 05:43 pm', 'Tue 4 May, 2021; 05:43 pm'),
(52, 10, '0.08', '3260265282', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"13\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 5 May, 2021; 07:24 am', 'Wed 5 May, 2021; 07:24 am'),
(53, 5, '0.13', '3358549732', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"31\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 5 May, 2021; 07:36 am', 'Wed 5 May, 2021; 07:36 am'),
(54, 18, '2.50', '4758544965', '6726540395401267', '{\n    \"transaction_number\": \"6726540395401267\",\n    \"token\": 2.5,\n    \"from\": \"a3vlJd28bRDLspB4WssSd4XSsvIqkIcY\",\n    \"to\": \"aHqd6iuPLsOiRhuALTeObY95zvsoQujM\",\n    \"to_whom\": \"user\",\n    \"created_at\": 1620224417,\n    \"status\": false\n}', 'plan', 1, NULL, 'Wed 5 May, 2021; 03:20 pm', 'Wed 5 May, 2021; 03:20 pm'),
(55, 2, '0.25', '4758544965', '6726540395401267', 'Referral bonus credited', 'referral', 1, NULL, 'Wed 5 May, 2021; 03:20 pm', 'Wed 5 May, 2021; 03:20 pm'),
(56, 2, '70.00', '8888139700', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"16\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 6 May, 2021; 02:47 pm', 'Thu 6 May, 2021; 02:47 pm'),
(57, 24, '0.18', '8998396839', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"17\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 6 May, 2021; 02:48 pm', 'Thu 6 May, 2021; 02:48 pm'),
(58, 24, '0.18', '5472256380', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"18\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 6 May, 2021; 02:49 pm', 'Thu 6 May, 2021; 02:49 pm'),
(59, 23, '0.05', '2848767303', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"33\",\"type\":\"review\"}', 'earning', 1, NULL, 'Thu 6 May, 2021; 02:51 pm', 'Thu 6 May, 2021; 02:51 pm'),
(60, 24, '0.18', '9221545859', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"20\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 8 May, 2021; 02:52 pm', 'Sat 8 May, 2021; 02:52 pm'),
(61, 24, '0.26', '9176148864', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"19\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 8 May, 2021; 02:53 pm', 'Sat 8 May, 2021; 02:53 pm'),
(62, 49, '0.09', '1601140786', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"53\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:10 pm', 'Sun 9 May, 2021; 01:10 pm'),
(63, 49, '0.05', '1556288665', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"52\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:10 pm', 'Sun 9 May, 2021; 01:10 pm'),
(64, 43, '0.01', '8546051598', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"50\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:11 pm', 'Sun 9 May, 2021; 01:11 pm'),
(65, 43, '0.13', '8745498325', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"48\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:11 pm', 'Sun 9 May, 2021; 01:11 pm'),
(66, 49, '0.15', '6144871077', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"24\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:13 pm', 'Sun 9 May, 2021; 01:13 pm'),
(67, 24, '0.12', '2962420400', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"23\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:14 pm', 'Sun 9 May, 2021; 01:14 pm'),
(68, 24, '0.20', '4490135404', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"22\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:14 pm', 'Sun 9 May, 2021; 01:14 pm'),
(69, 49, '11.50', '3122279889', '0198112425377798', '{\n    \"transaction_number\": \"0198112425377798\",\n    \"token\": 11.5,\n    \"from\": \"fqVAXnSilbgOOHCdruXPLat7Fl5M5PZQ\",\n    \"to\": \"aHqd6iuPLsOiRhuALTeObY95zvsoQujM\",\n    \"to_whom\": \"user\",\n    \"created_at\": 1620563090,\n    \"status\": false\n}', 'plan', 1, NULL, 'Sun 9 May, 2021; 01:24 pm', 'Sun 9 May, 2021; 01:24 pm'),
(70, 2, '3.45', '3122279889', '0198112425377798', 'Referral bonus credited', 'referral', 1, NULL, 'Sun 9 May, 2021; 01:24 pm', 'Sun 9 May, 2021; 01:24 pm'),
(71, 49, '0.02', '3200177694', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"55\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:35 pm', 'Sun 9 May, 2021; 01:35 pm'),
(72, 49, '0.13', '1762522369', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"54\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:36 pm', 'Sun 9 May, 2021; 01:36 pm'),
(73, 10, '0.00', '4451213417', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"45\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:36 pm', 'Sun 9 May, 2021; 01:36 pm'),
(74, 10, '0.02', '4849335258', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"43\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:36 pm', 'Sun 9 May, 2021; 01:36 pm'),
(75, 10, '0.01', '8432460365', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"42\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:37 pm', 'Sun 9 May, 2021; 01:37 pm'),
(76, 27, '0.05', '4166148698', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"40\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:38 pm', 'Sun 9 May, 2021; 01:38 pm'),
(77, 27, '0.13', '1978930983', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"38\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:39 pm', 'Sun 9 May, 2021; 01:39 pm'),
(78, 24, '0.08', '5802675859', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"37\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:39 pm', 'Sun 9 May, 2021; 01:39 pm'),
(79, 24, '0.10', '2953870639', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"36\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:39 pm', 'Sun 9 May, 2021; 01:39 pm'),
(80, 49, '0.01', '8615633138', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"56\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 01:40 pm', 'Sun 9 May, 2021; 01:40 pm'),
(81, 12, '2.50', '7841619599', '2150047975253227', '{\n    \"transaction_number\": \"2150047975253227\",\n    \"token\": 2.5,\n    \"from\": \"dCyDemX4StvuyS1b2ehjYr0VVt1ALKeo\",\n    \"to\": \"aHqd6iuPLsOiRhuALTeObY95zvsoQujM\",\n    \"to_whom\": \"user\",\n    \"created_at\": 1620566276,\n    \"status\": false\n}', 'plan', 1, NULL, 'Sun 9 May, 2021; 02:18 pm', 'Sun 9 May, 2021; 02:18 pm'),
(82, 2, '0.25', '7841619599', '2150047975253227', 'Referral bonus credited', 'referral', 1, NULL, 'Sun 9 May, 2021; 02:18 pm', 'Sun 9 May, 2021; 02:18 pm'),
(83, 12, '0.16', '7310755089', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"25\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 09:13 pm', 'Sun 9 May, 2021; 09:13 pm'),
(84, 12, '0.08', '7961376335', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"26\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 09:14 pm', 'Sun 9 May, 2021; 09:14 pm'),
(85, 49, '0.01', '9532729682', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"58\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 09:16 pm', 'Sun 9 May, 2021; 09:16 pm'),
(86, 49, '0.11', '7392287419', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"59\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 09:17 pm', 'Sun 9 May, 2021; 09:17 pm'),
(87, 52, '0.11', '1808752092', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"62\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sun 9 May, 2021; 09:18 pm', 'Sun 9 May, 2021; 09:18 pm'),
(88, 24, '0.09', '1551844040', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"29\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:35 am', 'Mon 10 May, 2021; 10:35 am'),
(89, 24, '0.15', '4845316183', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"28\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:35 am', 'Mon 10 May, 2021; 10:35 am'),
(90, 49, '0.20', '2811236850', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"30\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:36 am', 'Mon 10 May, 2021; 10:36 am'),
(91, 49, '0.01', '2788082056', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"75\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:39 am', 'Mon 10 May, 2021; 10:39 am'),
(92, 49, '0.00', '8715891634', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"74\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:40 am', 'Mon 10 May, 2021; 10:40 am'),
(93, 49, '0.13', '4088752411', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"73\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:40 am', 'Mon 10 May, 2021; 10:40 am'),
(94, 49, '0.13', '5036978181', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"72\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:40 am', 'Mon 10 May, 2021; 10:40 am'),
(95, 49, '0.00', '1117979428', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"67\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:41 am', 'Mon 10 May, 2021; 10:41 am'),
(96, 24, '0.01', '5433616783', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"63\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:41 am', 'Mon 10 May, 2021; 10:41 am'),
(97, 24, '0.00', '9137530899', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"64\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:41 am', 'Mon 10 May, 2021; 10:41 am'),
(98, 24, '0.00', '8790068705', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"65\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:42 am', 'Mon 10 May, 2021; 10:42 am'),
(99, 49, '0.00', '1961022322', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"70\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:47 am', 'Mon 10 May, 2021; 10:47 am'),
(100, 49, '0.00', '5316896034', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"69\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:47 am', 'Mon 10 May, 2021; 10:47 am'),
(101, 49, '0.00', '9326825931', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"68\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:47 am', 'Mon 10 May, 2021; 10:47 am'),
(102, 49, '0.00', '8679477729', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"71\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:47 am', 'Mon 10 May, 2021; 10:47 am'),
(103, 52, '0.01', '9621490642', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"66\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 10:47 am', 'Mon 10 May, 2021; 10:47 am'),
(104, 57, '0.10', '5339129672', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"31\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 10 May, 2021; 08:48 pm', 'Mon 10 May, 2021; 08:48 pm'),
(105, 24, '0.18', '1130283131', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"33\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Tue 11 May, 2021; 01:42 pm', 'Tue 11 May, 2021; 01:42 pm'),
(106, 24, '0.20', '8529549670', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"32\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Tue 11 May, 2021; 01:43 pm', 'Tue 11 May, 2021; 01:43 pm'),
(107, 24, '0.09', '8627745832', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"77\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 11 May, 2021; 03:25 pm', 'Tue 11 May, 2021; 03:25 pm'),
(108, 24, '0.00', '1728047155', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"76\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 11 May, 2021; 03:25 pm', 'Tue 11 May, 2021; 03:25 pm'),
(109, 24, '0.13', '7738935818', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"35\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 13 May, 2021; 03:26 am', 'Thu 13 May, 2021; 03:26 am'),
(110, 24, '0.05', '8047966771', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"34\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 13 May, 2021; 03:27 am', 'Thu 13 May, 2021; 03:27 am'),
(111, 24, '0.10', '4236712464', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"37\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Thu 13 May, 2021; 09:13 pm', 'Thu 13 May, 2021; 09:13 pm'),
(112, 24, '0.10', '1495881499', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"39\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 07:43 pm', 'Sat 15 May, 2021; 07:43 pm'),
(113, 24, '0.15', '1833768294', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"38\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 07:44 pm', 'Sat 15 May, 2021; 07:44 pm'),
(114, 24, '0.00', '3664047332', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"36\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 07:58 pm', 'Sat 15 May, 2021; 07:58 pm'),
(115, 68, '0.20', '7826240476', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"40\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:29 pm', 'Sat 15 May, 2021; 08:29 pm'),
(116, 68, '0.11', '5588876015', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"78\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:31 pm', 'Sat 15 May, 2021; 08:31 pm'),
(117, 68, '0.13', '1175284904', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"79\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:31 pm', 'Sat 15 May, 2021; 08:31 pm'),
(118, 68, '0.06', '3814116468', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"80\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:31 pm', 'Sat 15 May, 2021; 08:31 pm'),
(119, 68, '0.09', '7310647307', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"81\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:31 pm', 'Sat 15 May, 2021; 08:31 pm'),
(120, 68, '0.13', '8156192046', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"82\",\"type\":\"review\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:32 pm', 'Sat 15 May, 2021; 08:32 pm'),
(121, 2, '0.18', '6087692674', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"41\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 08:43 pm', 'Sat 15 May, 2021; 08:43 pm'),
(122, 68, '0.10', '7582073793', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"42\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Sat 15 May, 2021; 09:54 pm', 'Sat 15 May, 2021; 09:54 pm'),
(123, 2, '11.50', '575879293212', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:33 pm', 'Sun 16 May, 2021; 02:33 pm'),
(124, 2, '11.50', '641743746405', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:34 pm', 'Sun 16 May, 2021; 02:34 pm'),
(125, 2, '11.50', '124608331415', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27\",\"type\":\"eth\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:34 pm', 'Sun 16 May, 2021; 02:34 pm'),
(126, 2, '11.50', '411969238120', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27\",\"type\":\"eth\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(127, 2, '11.50', '421357654431', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"0x47d4d3FF72EdcA1bB6a3c4B96A2A1dF8BD5baB27\",\"type\":\"eth\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(128, 2, '11.50', '484641280038', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(129, 2, '11.50', '146459786709', NULL, '{\"msg\":\"Plan activation with Crypto\",\"plan_name\":\"Part Time \",\"wallet_addr\":\"TCjnb6CwBchWQeX5vGfGN6Thgp9CPerSK4\",\"type\":\"tron\"}', 'plan', 0, NULL, 'Sun 16 May, 2021; 02:35 pm', 'Sun 16 May, 2021; 02:35 pm'),
(130, 68, '0.10', '6661672215', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"43\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 07:56 am', 'Mon 17 May, 2021; 07:56 am'),
(131, 71, '0.20', '5617574033', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"48\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 10:54 am', 'Mon 17 May, 2021; 10:54 am'),
(132, 70, '0.20', '6088968868', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"45\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 10:55 am', 'Mon 17 May, 2021; 10:55 am'),
(133, 70, '0.13', '1769049364', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"83\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:22 am', 'Mon 17 May, 2021; 11:22 am'),
(134, 70, '0.13', '3862598161', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"85\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:23 am', 'Mon 17 May, 2021; 11:23 am'),
(135, 70, '0.13', '8910546881', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"86\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:24 am', 'Mon 17 May, 2021; 11:24 am'),
(136, 71, '0.13', '7654234230', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"87\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:24 am', 'Mon 17 May, 2021; 11:24 am'),
(137, 71, '0.13', '4156857748', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"88\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:25 am', 'Mon 17 May, 2021; 11:25 am'),
(138, 71, '0.09', '7741970873', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"89\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:25 am', 'Mon 17 May, 2021; 11:25 am'),
(139, 71, '0.13', '9370934861', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"90\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:25 am', 'Mon 17 May, 2021; 11:25 am'),
(140, 71, '0.13', '5679073775', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"91\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:25 am', 'Mon 17 May, 2021; 11:25 am'),
(141, 70, '0.13', '5592515211', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"94\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:26 am', 'Mon 17 May, 2021; 11:26 am'),
(142, 71, '0.08', '2265091669', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"95\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:26 am', 'Mon 17 May, 2021; 11:26 am'),
(143, 70, '0.13', '6705333978', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"98\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:29 am', 'Mon 17 May, 2021; 11:29 am'),
(144, 71, '0.04', '2745044188', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"100\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:29 am', 'Mon 17 May, 2021; 11:29 am'),
(145, 71, '0.10', '6696815070', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"101\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:30 am', 'Mon 17 May, 2021; 11:30 am'),
(146, 71, '0.13', '8390025147', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"103\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:31 am', 'Mon 17 May, 2021; 11:31 am'),
(147, 70, '0.13', '3905815333', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"105\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:31 am', 'Mon 17 May, 2021; 11:31 am'),
(148, 70, '0.13', '3432289604', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"106\",\"type\":\"review\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 11:32 am', 'Mon 17 May, 2021; 11:32 am'),
(149, 49, '0.21', '7592060834', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"50\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 06:34 pm', 'Mon 17 May, 2021; 06:34 pm'),
(150, 49, '0.22', '8265256652', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"49\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Mon 17 May, 2021; 06:35 pm', 'Mon 17 May, 2021; 06:35 pm'),
(151, 49, '0.18', '9164386894', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"52\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 06:58 am', 'Tue 18 May, 2021; 06:58 am'),
(152, 49, '0.20', '7422065488', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"56\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 07:03 am', 'Tue 18 May, 2021; 07:03 am'),
(153, 70, '0.13', '3456975921', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"123\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:34 pm', 'Tue 18 May, 2021; 05:34 pm'),
(154, 70, '0.13', '6776236882', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"124\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:35 pm', 'Tue 18 May, 2021; 05:35 pm'),
(155, 70, '0.13', '8505967977', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"125\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:35 pm', 'Tue 18 May, 2021; 05:35 pm'),
(156, 70, '0.13', '6472840162', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"126\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:36 pm', 'Tue 18 May, 2021; 05:36 pm'),
(157, 70, '0.10', '4106555089', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"127\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:36 pm', 'Tue 18 May, 2021; 05:36 pm'),
(158, 70, '0.13', '9065212441', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"128\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:36 pm', 'Tue 18 May, 2021; 05:36 pm'),
(159, 70, '0.13', '5813079674', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"130\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:37 pm', 'Tue 18 May, 2021; 05:37 pm'),
(160, 70, '0.13', '2413583078', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"131\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:37 pm', 'Tue 18 May, 2021; 05:37 pm'),
(161, 70, '0.13', '2765258592', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"132\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:46 pm', 'Tue 18 May, 2021; 05:46 pm'),
(162, 70, '0.13', '7865368127', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"133\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:46 pm', 'Tue 18 May, 2021; 05:46 pm'),
(163, 70, '0.09', '8411052860', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"134\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:46 pm', 'Tue 18 May, 2021; 05:46 pm'),
(164, 71, '0.13', '6935975566', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"135\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:47 pm', 'Tue 18 May, 2021; 05:47 pm'),
(165, 71, '0.13', '3420843208', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"136\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:47 pm', 'Tue 18 May, 2021; 05:47 pm'),
(166, 71, '0.05', '3780695946', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"137\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:48 pm', 'Tue 18 May, 2021; 05:48 pm'),
(167, 71, '0.05', '3963651762', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"138\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:48 pm', 'Tue 18 May, 2021; 05:48 pm'),
(168, 71, '0.13', '5658726391', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"139\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:49 pm', 'Tue 18 May, 2021; 05:49 pm'),
(169, 71, '0.08', '7770315768', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"140\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:49 pm', 'Tue 18 May, 2021; 05:49 pm'),
(170, 71, '0.02', '2861595207', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"141\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:50 pm', 'Tue 18 May, 2021; 05:50 pm'),
(171, 71, '0.08', '9124415155', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"142\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:50 pm', 'Tue 18 May, 2021; 05:50 pm'),
(172, 71, '0.00', '6660121991', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"143\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:50 pm', 'Tue 18 May, 2021; 05:50 pm'),
(173, 71, '0.00', '9299093040', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"144\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:50 pm', 'Tue 18 May, 2021; 05:50 pm'),
(174, 71, '0.13', '7201489204', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"145\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:51 pm', 'Tue 18 May, 2021; 05:51 pm'),
(175, 71, '0.13', '8153125179', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"146\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:51 pm', 'Tue 18 May, 2021; 05:51 pm'),
(176, 70, '0.13', '6124151723', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"129\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:52 pm', 'Tue 18 May, 2021; 05:52 pm'),
(177, 70, '0.13', '5362445303', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"122\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:53 pm', 'Tue 18 May, 2021; 05:53 pm'),
(178, 70, '0.13', '7755058186', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"121\",\"type\":\"review\"}', 'earning', 1, NULL, 'Tue 18 May, 2021; 05:53 pm', 'Tue 18 May, 2021; 05:53 pm'),
(179, 70, '0.26', '6899182672', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"58\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:03 am', 'Wed 19 May, 2021; 09:03 am'),
(180, 70, '0.26', '9267392891', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"57\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:03 am', 'Wed 19 May, 2021; 09:03 am'),
(181, 71, '0.18', '9050437208', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"59\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:04 am', 'Wed 19 May, 2021; 09:04 am'),
(182, 71, '0.20', '8390342367', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"60\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:04 am', 'Wed 19 May, 2021; 09:04 am'),
(183, 24, '0.15', '2459792435', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"61\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:04 am', 'Wed 19 May, 2021; 09:04 am'),
(184, 70, '0.19', '2889151505', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"62\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:05 am', 'Wed 19 May, 2021; 09:05 am'),
(185, 70, '0.26', '9650014125', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"63\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:05 am', 'Wed 19 May, 2021; 09:05 am'),
(186, 71, '0.14', '2639669450', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"64\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:05 am', 'Wed 19 May, 2021; 09:05 am'),
(187, 71, '0.19', '9116823336', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"65\",\"type\":\"creation\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 09:05 am', 'Wed 19 May, 2021; 09:05 am'),
(188, 71, '0.13', '4712936501', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"153\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 11:03 am', 'Wed 19 May, 2021; 11:03 am'),
(189, 71, '0.13', '3841366731', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"154\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 11:03 am', 'Wed 19 May, 2021; 11:03 am'),
(190, 71, '0.10', '4290668289', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"155\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 11:54 am', 'Wed 19 May, 2021; 11:54 am'),
(191, 71, '0.09', '8609191757', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"156\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:27 pm', 'Wed 19 May, 2021; 12:27 pm'),
(192, 71, '0.12', '9698427438', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"157\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:28 pm', 'Wed 19 May, 2021; 12:28 pm'),
(193, 71, '0.05', '5874732550', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"158\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:28 pm', 'Wed 19 May, 2021; 12:28 pm'),
(194, 70, '0.12', '8008016808', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"159\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:29 pm', 'Wed 19 May, 2021; 12:29 pm'),
(195, 71, '0.13', '6168052715', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"161\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:34 pm', 'Wed 19 May, 2021; 12:34 pm'),
(196, 70, '0.13', '7973384234', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"162\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:34 pm', 'Wed 19 May, 2021; 12:34 pm'),
(197, 71, '0.13', '3042228515', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"163\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:34 pm', 'Wed 19 May, 2021; 12:34 pm'),
(198, 70, '0.13', '9888184629', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"164\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:35 pm', 'Wed 19 May, 2021; 12:35 pm'),
(199, 70, '0.05', '3677848957', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"160\",\"type\":\"review\"}', 'earning', 1, NULL, 'Wed 19 May, 2021; 12:35 pm', 'Wed 19 May, 2021; 12:35 pm'),
(200, 68, '0.20', '1556785656', NULL, '{\"msg\":\"Business creation earning\",\"bus_id\":\"67\",\"type\":\"creation\"}', 'earning', 1, 'System', 'Thu 20 May, 2021; 06:13 am', 'Thu 20 May, 2021; 06:13 am'),
(201, 70, '0.00', '2189793874', NULL, '{\"msg\":\"Approval of Business creation\",\"bus_id\":\"71\",\"ngnAmnt\":\"0.14\",\"convRate\":\"380\",\"usdAmnt\":0.000368421052631578960744052064768538912176154553890228271484375,\"type\":\"creation\"}', 'earning', 1, '', 'Thu 20 May, 2021; 09:10 am', 'Thu 20 May, 2021; 09:10 am'),
(202, 71, '0.00', '7641555537', NULL, '{\"msg\":\"Approval of Business creation\",\"bus_id\":\"70\",\"ngnAmnt\":\"0.12\",\"convRate\":\"380\",\"usdAmnt\":0.0003157894736842105300363148234765731103834696114063262939453125,\"type\":\"creation\"}', 'earning', 1, '', 'Thu 20 May, 2021; 09:11 am', 'Thu 20 May, 2021; 09:11 am'),
(203, 70, '0.00', '4683945758', NULL, '{\"msg\":\"Approval of Business creation\",\"bus_id\":\"69\",\"ngnAmnt\":null,\"convRate\":\"380\",\"usdAmnt\":0,\"type\":\"creation\"}', 'earning', 1, '', 'Thu 20 May, 2021; 09:12 am', 'Thu 20 May, 2021; 09:12 am'),
(204, 71, '0.00', '8712844997', NULL, '{\"msg\":\"Approval of Business creation\",\"bus_id\":\"68\",\"ngnAmnt\":\"0.24\",\"convRate\":\"380\",\"usdAmnt\":0.000631578947368421060072629646953146220766939222812652587890625,\"type\":\"creation\"}', 'earning', 1, '', 'Thu 20 May, 2021; 09:12 am', 'Thu 20 May, 2021; 09:12 am'),
(205, 71, '0.00', '2951788265', NULL, '{\"msg\":\"Declination of Business review\",\"bus_id\":\"7\",\"type\":\"creation\"}', 'earning', 3, '', 'Thu 20 May, 2021; 03:36 pm', 'Thu 20 May, 2021; 03:36 pm'),
(206, 71, '0.00', '6554716363', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"173\",\"ngnAmnt\":\"0.13\",\"convRate\":\"380\",\"usdAmnt\":0.000342105263157894772495237756260166861466132104396820068359375,\"type\":\"review\"}', 'earning', 1, '', 'Thu 20 May, 2021; 03:36 pm', 'Thu 20 May, 2021; 03:36 pm'),
(207, 71, '0.00', '2145379672', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"172\",\"ngnAmnt\":\"0.13\",\"convRate\":\"380\",\"usdAmnt\":0.000342105263157894772495237756260166861466132104396820068359375,\"type\":\"review\"}', 'earning', 1, '', 'Thu 20 May, 2021; 03:37 pm', 'Thu 20 May, 2021; 03:37 pm'),
(208, 71, '0.00', '1305193086', NULL, '{\"msg\":\"Business review earning\",\"bus_review_id\":\"171\",\"ngnAmnt\":\"0.13\",\"convRate\":\"380\",\"usdAmnt\":0.000342105263157894772495237756260166861466132104396820068359375,\"type\":\"review\"}', 'earning', 1, '', 'Thu 20 May, 2021; 03:37 pm', 'Thu 20 May, 2021; 03:37 pm'),
(209, 67, '0.00', '3249585370', NULL, '{\"msg\":\"Approval of Business creation\",\"bus_id\":\"72\",\"ngnAmnt\":\"0.26\",\"convRate\":\"380\",\"usdAmnt\":0.00068421052631578954499047551252033372293226420879364013671875,\"type\":\"creation\"}', 'earning', 1, '', 'Thu 20 May, 2021; 05:33 pm', 'Thu 20 May, 2021; 05:33 pm'),
(210, 68, '0.00', '8536291668', NULL, '{\"msg\":\"Approval of Business creation\",\"bus_id\":\"66\",\"ngnAmnt\":\"0.20\",\"convRate\":\"380\",\"usdAmnt\":0.0005263157894736841986571551643692146171815693378448486328125,\"type\":\"creation\"}', 'earning', 1, '', 'Fri 21 May, 2021; 08:21 am', 'Fri 21 May, 2021; 08:21 am'),
(211, 71, '0.00', '5680175422', NULL, '{\"msg\":\"Declination of Business review\",\"bus_id\":\"69\",\"type\":\"creation\"}', 'earning', 3, '', 'Sun 23 May, 2021; 09:35 am', 'Sun 23 May, 2021; 09:35 am');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT '0' COMMENT 'user, moderator or admin',
  `usercode` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `edt_address` varchar(255) DEFAULT NULL,
  `btc_address` varchar(255) DEFAULT NULL,
  `eth_address` varchar(255) DEFAULT NULL,
  `trx_address` varchar(255) DEFAULT NULL,
  `paypal_address` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `activation` varchar(255) DEFAULT NULL,
  `planID` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0 - banned or suspended\r\n1 - Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `usercode`, `fullname`, `username`, `email`, `password`, `avatar`, `phone`, `edt_address`, `btc_address`, `eth_address`, `trx_address`, `paypal_address`, `account_name`, `account_no`, `bank_name`, `address`, `city`, `state`, `country`, `activation`, `planID`, `status`) VALUES
(2, '2', 'e4e9u1', '', 'bukester', 'bukesterisrael@gmail.com', 'c93b3453f55f4ab71f186b0b5fbfa25d', '202104217047.jpg', '08172722917', 'Rrhgg', 'Tffggg', 'Gffggf', 'Fffff', 'Fffff', 'Komolafe Israel ', '0049216793', 'GtB', 'Flower Garden GRA Ilorin', 'Ibadan', 'Kwara', '', 'YES', '6', '1'),
(9, '0', 'iquca3', 'Oluwatayo Adeyemi', 'dihowner', 'oluwatayoadeyemi@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(10, '0', '2e5ugi', 'OGUNSOLA JIMOH AYINLA', 'ojimoh', 'jimsonbreeder@yahoo.com', '314f0ce92ac7549d418f483184b2ac26', '202105035324.jpg', '08061332621', 'dXzI43vmby8cxJuw7ZhScaJyU7gQSyJf', '', '', '', '', 'OGUNSOLA JIMOH AYINLA', '0051031362', 'GTB', 'NUCCY VILLA AMOJE STREET ANUOLUWAPO OLOSE OKE AREGBA ABK OGUN STATE', '', 'Ogun', NULL, 'YES', '10', '1'),
(11, '1', 'o7a1u8', 'Mohammed Ibrahim', 'ibrahim1996', 'moneymanibrahim86@gmail.com', '306ef1b41deb07a312225bdbc3fb1afa', '202105031708.jpg', NULL, 'euWYDW2FO3iaTtI0PENvy8G1zskqMHsw', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(12, '0', 'coye6i', 'Abdulwahab Nurudeen Folohunsho', 'folohunsho', 'abdulfolohunsho26@gmail.com', 'f7c6ee5bde67828d4ff75c711debf69e', '202105038854.jpg', '+2348122775999', 'Gtbank', 'dCyDemX4StvuyS1b2ehjYr0VVt1ALKeo', 'dCyDemX4StvuyS1b2ehjYr0VVt1ALKeo', 'dCyDemX4StvuyS1b2ehjYr0VVt1ALKeo', '', 'Abdulwahab Nurudeen Adebayo', 'dCyDemX4StvuyS1b2ehjYr0VVt1ALKeo', '', '1c bolohunduro street, sango-Basin', 'Ilorin', '', NULL, 'YES', '10', '1'),
(14, '0', 'jumora', 'Akintomiwa Opemipo', 'musthy', 'ibnakintomiwa@gmail.com', '5eda958ce0a8c250ad09b1c610a85e1d', '202105039008.jpg', NULL, 'cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(15, '1', '3ezate', 'Folasade Olukoju Favour', 'sade', 'folasadefavsy@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', NULL, 'Faazgh67843gufd', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(16, '0', 'uloto6', 'Abdulrahmon Alade Salahudeen', 'alade17', 'abdulrahmon26@gmail.com', 'a45f22393b8e3e953ef84e07a69751ec', '202105046101.jpg', '+2348138324483', 'dLVFYDMbYgsYLTrv09SPAjVt8ETFJOhZ', '', '', '', '', 'SALAHUDEEN ABDRAHMON ALADE', '0109979013', 'GTBANK', 'Oyebo street Junaid villa Abiola way Abeokuta', 'Abeokuta', 'Ogun', NULL, 'YES', '6', '1'),
(17, '0', 'safive', 'Yusuf Waseelat Nike', 'waseelat', 'waseelatnike@gmail.com', '5ec829debe54b19a5f78d9a65b900a39', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(19, '0', 'u5e2ex', 'Olawuyi Adetunde David', 'dandyinterbiz', 'duogglassdandy@gmail.com', 'bee298bacb36b91f60d134fc635eef24', '202105063402.jpg', '08060020331', 'GTB BANK PLC', '', '', '', '', 'OLAWUYI ADETUNDE DAVID', '', '', 'No3 aiyetoro street', 'ILORIN Kwara State', '', NULL, 'YES', '6', '1'),
(20, '0', 'isi9iy', 'Adeola Fayemi', 'adexstringz', 'adexstringz321@gmail.com', '46095b07053f299f8833cd8f79c10740', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(21, '0', 'zifeci', 'Akintola Ayodeji Festus', 'festywc', 'festy1220@gmail.com', '40ea7a9852e1dc41a95b467f0de23429', '202105067266.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(22, '0', '7eboda', 'Ahmad Inusa Sfada', 'amadas', 'ahmedinusasfada@gmail.com', '4d9e1a33f5e52f6cea308ce35c34dc3c', '202105061623.jpg', '09034036332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26C Sani Ahmed Daura Housing Estate, Damaturu, Yobe State.', 'Damaturu', 'Yobe', NULL, 'YES', '6', '1'),
(23, '0', 'e5iwuy', 'Rabiu Ganiyat Moromoke', 'ganiyat4', 'rabiuganiyat414@gmail.com', 'cf4b656a7cf0778a462ce8b09e524e79', '202105061436.jpg', '08102970319', '', '', '', '', '', 'Rabiu Ganiyat Moromoke', '7131223013', 'FCMB', 'Adewole ilorin', '', 'Kwara', NULL, 'YES', '6', '1'),
(24, '0', 'u7awud', 'Oladeji Suliat Oluwaseyi', 'oseyi', 'ogunfoworaoluwaseyisuliat@gmail.com', '9c9b5a316780eadf7dd83e1ae25ec714', '202105067924.jpg', '07064246702', 'Access bank', '', '', '', '', 'Oladeji suliat Oluwaseyi', '', '', '19 jimoh ramoni Street nnpc ejigbo lagos', 'Lagos', 'Lagos', NULL, 'YES', '6', '1'),
(25, '0', '9ela3u', 'Onyewuchi Elisha Chigozie', 'elisha', 'chigotubes@gmail.com', '9ae57347efd0d84b7b073d2280288658', '202105066876.jpg', '09064404373', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38 Babatunde Street Olodi-Apapa', '', 'Lagos', NULL, 'YES', '6', '1'),
(26, '0', 'esezi9', 'Muhammad Umar Aliyu', 'muhammadu402', 'muhammadu402@gmail.com', '449de48a5ebf424544d277cee2e5aa1c', '202105062635.jpg', '+2348030485554', 'Zenith Bank PLC', 'bc1qu48d7dt5p0q0crqqpa7k3u4jtgcqtz', '0x236Cf55919Ea5791985f67144b84e12a', 'TLGqnouVGo9KZf9kvSu4VzwRpeHJ9cjT1a', 'muhammadu402@gmail.com', 'MUHAMMAD UMAR ALIYU', '2110365176', 'Zenith Bank PLC', 'Chiranchi Gidan Kwari Dorayi', 'Kano', 'Kano', NULL, 'YES', '6', '1'),
(27, '0', 'oma9o8', 'Aminu Ahmad Babba', 'aababba02', 'aababba02@yahoo.com', '1f652dddc9c43f588e65c48108ff28be', '202105063847.jpg', '08160805892', 'apqwTHbOUVOxyg0QoYqQ8IacBTHt4mw0', '', '', '', '', 'AHMAD AMINU BABBA', '0244366752', 'GT BANK', 'Kankara', 'Kankara', 'Katsina', NULL, 'YES', '6', '1'),
(28, '0', 'uqiyi7', 'Oyovwire Christiana O.', 'christianasandra', 'christianasandra1@gmail.com', '017a71ce3d6157af241422c88d2d0433', '202105061384.jpg', '07030231069', '', '', '', '', '', 'OYOVWIRE CHRISTIANA OBRUCHE', '0119443373', 'Guaranty trust bank (Gtb)', 'No 13 Olondo close Lafenwa', 'Abeokuta', 'Ogun', NULL, 'YES', '6', '1'),
(29, '0', 'me7epu', 'Akinjisola Bright', 'akinjisola20', 'akinjisolab31@gmail.com', 'd0c8a72effc8f974387d30dbabbd8e56', '202105062344.jpg', '08109477898', 'Zenith Bank', '1DgGheeeK59MtUSMhUuUJtS49QCfJ2dA1k', '0x311302bc7bc2c26985b3e41cda9a3cd9', 'TDxNNUts69g4EsjymodmMypiZCKV2ehuBd', '', 'Akinjisola Bright', '', '', 'No 02 okemapo alade idanre', 'Akure', '', NULL, 'YES', '6', '1'),
(31, '0', 'ipelow', 'Olaniyi Oluwaseun David', 'ola504', 'olaniyioluwaseun87@gmail.com', '501d3305fe4d1fba37d4ba172093ec38', '202105063870.jpg', '09066161070', '', '1H71hLgGknMMcrf1bCWVfFTwkmKLCUxPgY', '0xd8cd79Bd9cd05E7163B8ea0b6a97aE09', '', '', 'Olaniyi oluwaseun David', '0541808166', 'GTB ', 'Amoyo', 'Ilorin ', '', NULL, 'YES', '6', '1'),
(32, '0', 'ebokup', 'OWOLABI ISIAKA REMILEKUN', 'easy2easy', 'easycash331@gmail.com', '8f463faf2556c598ec8eaf6a638ae113', '202105068560.jpg', '08067023941', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '30 niyi Ibrahim street,', 'Osogbo', 'Osun', NULL, 'YES', '6', '1'),
(33, '0', 'oyuhik', 'Ottah Blessing Oghenewarhe', 'modupe', 'oghenewarhe2000@gmail.com', '2203de247afd9ab70f6624febd320d0a', '202105073924.jpg', '08133924110', 'Guaranty trust bank', '', '', '', '', 'Ottah Blessing Oghenewarhe', 'eqsYVhiG4tKAU47w3qkedJ8LDsAAkoFs', '', 'Tanke', 'Ilorin', 'Kwara', NULL, 'YES', '6', '1'),
(34, '0', 'fixebu', 'Abah Christian', 'abahc100', 'abahchristianomale@gmail.com', '333a59b862e458eb30513a44ff6335f1', '', '08132804181', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Umuahia', 'Umuahia', 'Abia', NULL, 'YES', '6', '1'),
(35, '0', 'fu5ero', 'Adeyemi Ibrahim Adekunle', 'yemiboss19', 'yemiboss19@yahoo.com', '3b7eee20b977876fb09eced44346c584', '202105076692.jpg', '07031001314', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34, Baba Elewedu Street Magboro Ogun state.', 'Obafemi Owode', 'Ogun', NULL, 'YES', '6', '1'),
(36, '0', '3odida', 'Saminu Babannana', 'saminu2020', 'saminubaba0@gmail.com', 'e286b902a887453b970d93881e115b08', '202105071367.jpg', '07062734546', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yalwa ward zing', '', 'Taraba', NULL, 'YES', '6', '1'),
(37, '0', 'a0o1id', 'Christian Ugochukwu Nwabiukwu', 'ugochrist1393', 'christianugoo@gmail.com', '0cad6cf4bf0d0464eda2536ff34202a2', '202105073974.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(38, '0', 'mo3ozu', 'Rasak Akorede Kareem ', 'roscryptech', 'rasakkareem282@gmail.com', '8672afb278d14f83f75bf024279b7714', '202105074862.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(39, '0', 'qebe2i', 'Damilola Olowookere', 'damms005', 'vewoxa4802@cnxingye.com', '67f923e02e8df7bf5ecf52f7ad991486', '202105074643.jpg', NULL, 'cgfbrth6ut7ujyujyjjyj', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(40, '0', 'i3uvah', 'Ayoola Daniel', 'geeky', 'geekydaniel4@gmail.com', '3c5ecf80f22224a83bd18e78e5906e30', '202105078058.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(41, '0', 'xe9a5e', 'Elisha Dauda', 'dauda', 'daudavarashi@gmail.com', '88ed6cbf4d9f35d685989c80db4b2941', '202105074380.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(42, '0', 'ayigud', 'Saka Omotayo', 'tybello', 'majortybello@gmail.com', '37260a764d15764bed86458aacdb3c73', '202105082738.jpg', '', 'aUGDXBfKcOVJnjxjEtMjHFZDuYwoqnM5', '', '', '', '', '', '', '', '', '', 'Lagos', NULL, 'YES', '6', '1'),
(43, '0', 'aduluj', 'Favour Gbemisoye', 'favour ', 'favourgbemisoye@gmail.com', '763b8f806a1de771084e992291302166', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(44, '0', '0ufequ', 'Emmanuel Isah', 'eddie', 'emmanuelhabeeb@gmail.com', '30da9b9f4620026039a3a23199710660', '202105092555.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(45, '0', 'zezo9i', 'Banmeke Rasheedah', 'horlabopo', 'horlabopo@ymail.com', '376368c56f295415260c788a296894de', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(46, '0', 'vune9o', 'Adebisi Temitope', 'temmytee', 'eruditewhisper@gmail.com', 'e256461964d028e55d05ef3a03956b5b', '202105094037.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(47, '0', 'ivexa5', 'Ajiboye Mubarak AyomidE', 'ajiboye1', 'ajiboyemubarak1@gmail.com', '2c542b4f539a094378f412da68f1fab1', '202105091446.jpg', NULL, '', '', '', '', '', 'AjiboyE Mubarak AyomidE', '0233890776', 'GT bank', NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(48, '0', 'fohixa', 'Babafemi Tomisin ', 'femzs', 'babafemitosin@gmail.com', '82e878ec15a370a889492cde733a8dc4', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(49, '0', 'ije2a8', 'Raji Ibraheem', 'braimo', 'ibraheemtimileyinraji@gmail.com', '6e838bb1f7d0e92e2203a71984f8f0f3', '', NULL, 'fqVAXnSilbgOOHCdruXPLat7Fl5M5PZQ', '', '', '', '', 'Raji Ibraheem Timileyin', '0534396030', 'Guaranty Trust Bank', NULL, NULL, NULL, NULL, 'YES', '8', '1'),
(50, '0', 'i6ecol', 'Adefemi Kafayat ', 'kolawole', 'femiliving@yahoo.com', 'deba8f3fdd4fb7d65bf4f7cc02743ed7', '202105096487.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(51, '0', '5oni7o', 'Alabi Sunday', 'easyboi4', 'easyboi4@gmail.com', '1cb22101302c7c7f8e3146f770526467', '202105098072.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(52, '0', 'a2uda5', 'Ibrahim Shuaib Adedo', 'iamadedo', 'oneluvadex1@gmail.com', 'd1e6d5264ee43d649e35e42a60634bab', '202105098928.jpg', '09015519219', 'Polaris bank', '17jpTiX9D74PDPKqAw5WjbmdWYSW8DfeQG', '0x65869dce1c1289c457b4206a83c39f1f', 'TMrNtpNa31ZQBivjUoA5AtbTmrjwQ461tP', 'realiamadedo@gmail.com', 'Ibrahim Shuaib Adedo', '', '', 'Department of Physiology, College Of Health Sciences, University of Ilorin', 'Ilorin', 'Kwara', NULL, 'YES', '6', '1'),
(53, '0', '3u7ume', 'Adeniran Abdul Wasiu Adekunle', 'hardek939', 'adeniran939@gmail.com', 'cab9d0704fbdbc3583658e332d800595', '202105092642.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(54, '0', '7a7uze', 'Oyegunju Haminat Adeola', 'minahpearl', '13olami05@gmail.com', '9955d663c0118c9d8db7f268b4fdd476', '202105093905.jpg', '07050950980', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ilorin', 'Ilesha', 'Kwara', NULL, 'YES', '6', '1'),
(55, '0', 'o3ihol', 'Tosho ', 'tosho ', 'tshkeremi@gmail.com', '5a9429ef6afa16ed240340aac4cfc266', '202105096012.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(56, '0', 'qifuxe', 'Ibrahim Abdulhhameed Kale ', 'adedo ', 'oneluvadex3000@gmail.com', 'd178b69df9b788ab434b8619cf405570', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(57, '0', 'nayuwi', 'Bolaji Jibola', 'deerahscents', 'bolajikudirat664@gmail.com', 'b00fec2d50f2c251a3c4124cc72b0819', '', '09035513840', '', '', '', '', '', 'Bolaji Kudirat', '0448969906', 'GT Bank', 'Tanke oke odo', 'Ilorin', 'Kwara', NULL, 'YES', '6', '1'),
(58, '0', 'iwici7', 'Michael Olatunle', 'mike', 'michaelolatunle@gmail.com', 'c65fcfc9984fc93e5d01c2313c9a38d9', '202105106030.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(59, '0', '2iruki', 'Precious Adeniyi', 'precious', 'preciousadeniyi056@gmail.com', '688a15f524afd9b2dec289f8ac37f2bb', '202105117673.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(60, '0', 'irolok', 'Olaniyi Taiwo Ruth', 'gr8ful princess', 'olaniyitaiwo02@gmail.com', 'f6962b54a8357cd10e4d3466ecebd8e2', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(61, '0', 'o8o0ud', 'Olatona Faruq Opeyemi', 'hushlad', 'hushlad003@gmail.com', '2026f68ad365a6374b777f4e46262af1', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(62, '0', 'fo6ipi', 'Ogundele Ayomide Ike', 'annike', 'ogundeleayomide101@gmail.com', 'ee64381f22c56052c2f935c30319ab27', '202105112027.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(63, '0', 'ovipen', 'Kayode Michael Ariyo', 'kpc', 'kmapacific@gmail.com', 'f4573bfd91d13c322a4446077745d025', '202105116350.jpg', '08037480541', '', '', '', '', '', 'ARIYO KAYODE MICHAEL', '0071862515', 'Sterling Bank', '66, Eksuth Road', 'Ado Ekiti', 'Ekiti', NULL, 'YES', '6', '1'),
(64, '0', 'ucidag', 'Adekunle Abdulmujeeb ', 'madeline_graphics', 'temitopem749@gmail.com', 'efea81f4595ce81adf1ba6699202458e', '202105126206.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(65, '0', 'ocukas', 'Jimoh Olushola Ismaila', 'jundullahi', 'shola.sholi@gmail.com', '9cc3f226bf5c9b5c7fa029d6cebf185f', '202105123838.jpg', '08064003494', '', '', '', '', '', 'Jimoh olushola ismaila', '3023669284', 'Polaris bank', '5, oloyede , okoafo badagry', 'Lagos', '', NULL, 'YES', '6', '1'),
(66, '0', 'upavu4', 'Ola Monisola Grace ', 'monisola123 ', 'ola.monisolagrace@gmail.com', 'fe6ca2dee21e30e42f66df13121d2d4e', '202105142907.jpg', '07039509745', 'GTB', '', '', '', '', 'Ola Monisola Grace ', '', '', '31, Bola Ayeni street', 'Lagos', '', NULL, 'YES', '6', '1'),
(67, '0', 'kiri2i', 'Abdussamad Rabo Suleiman', 'asrabo', 'asrabo2010@gmail.com', '50c6681d3a221a07d21a75f6f82a35d9', '202105141234.jpg', '08039246717', 'First Bank', '', '', '', '', 'Suleiman Abdussamad Rabo', '', '', '24 sabon Fegi Nassarawa Kano', '', 'Kano', NULL, 'YES', '6', '1'),
(68, '0', 'ofomar', 'Lawal Rildwan Shola', 'lawal', 'lawalrildwansholaa@gmail.com', 'a0e3965a6152d9f9043de035a9a50d82', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(69, '0', 'ajisiy', 'Yusuf', 'abdulkadir ', 'abdulkadirsf@gmal.com', '8fc3cfd758f605f241cb3b4f4ce8691a', '202105175608.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(70, '0', '5a5ele', 'Adeyemi Tomilola Olabode ', 'tommylolly', 'tommylolly0507@gmail.com', 'a974e569df96bd0687358289585d3d94', '202105178345.jpg', '07065082811', '', '', '', '', '', 'ADEYEMI, OLABODE TOMILOLA', '0036437422 ', 'GTB ', '4, Oyinloye Avenue off University road, Tanke ', '', 'Kwara', NULL, 'YES', '6', '1'),
(71, '0', 'buweqo', 'Akingboye Oludayo', 'djkeke', 'oludayosam@gmail.com', 'b0e584c10ada3be7ee12c5d1b874a73e', '202105176759.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(72, '0', 'u0agid', 'Aina Rosin Omolarq', 'aina.omolara', 'oyadejiomolara2002@gmail.com', 'e0bae0f0b626e41974e8bf4c4054588b', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(73, '0', '1atobe', 'DEEMAH INFOTECH ', 'deemah', 'deemahinfo@gmail.com', '89b0cd00a2606e6808ff87eacf4ade55', '202105198200.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1'),
(74, '0', 'wakefe', 'Oluyemi Ifejola Oluwadamilola', 'oluyemi ifejola oluwadamilola', 'samueloluyemi1@gmail.com', '53fd9fbf6556d7a88af7ebfab42e45bc', '202105198301.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YES', '6', '1');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(255) NOT NULL,
  `clientID` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(255) NOT NULL,
  `clientID` varchar(255) NOT NULL,
  `eDT` decimal(20,2) NOT NULL,
  `usd` decimal(20,2) NOT NULL COMMENT 'dollars'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `clientID`, `eDT`, `usd`) VALUES
(1, '1', '0.00', '3173.00'),
(2, '2', '0.00', '81.35'),
(3, '3', '0.00', '0.00'),
(4, '4', '0.00', '0.00'),
(5, '5', '0.00', '10.13'),
(6, '6', '0.00', '0.00'),
(7, '7', '0.00', '0.00'),
(8, '9', '0.00', '0.00'),
(9, '10', '0.00', '0.11'),
(10, '11', '0.00', '0.00'),
(11, '12', '0.00', '0.24'),
(12, '13', '0.00', '0.00'),
(13, '14', '0.00', '0.00'),
(14, '15', '0.00', '0.00'),
(15, '16', '0.00', '0.00'),
(16, '17', '0.00', '0.00'),
(17, '18', '0.00', '0.00'),
(18, '19', '0.00', '0.00'),
(19, '20', '0.00', '0.00'),
(20, '21', '0.00', '0.00'),
(21, '22', '0.00', '0.00'),
(22, '23', '0.00', '0.05'),
(23, '24', '0.00', '2.70'),
(24, '25', '0.00', '0.00'),
(25, '26', '0.00', '0.00'),
(26, '27', '0.00', '0.18'),
(27, '28', '0.00', '0.00'),
(28, '29', '0.00', '0.00'),
(29, '30', '0.00', '0.00'),
(30, '31', '0.00', '0.00'),
(31, '32', '0.00', '0.00'),
(32, '33', '0.00', '0.00'),
(33, '34', '0.00', '0.00'),
(34, '35', '0.00', '0.00'),
(35, '36', '0.00', '0.00'),
(36, '37', '0.00', '0.00'),
(37, '38', '0.00', '0.00'),
(38, '39', '0.00', '0.00'),
(39, '40', '0.00', '0.00'),
(40, '41', '0.00', '0.00'),
(41, '42', '0.00', '0.00'),
(42, '43', '0.00', '0.14'),
(43, '44', '0.00', '0.00'),
(44, '45', '0.00', '0.00'),
(45, '46', '0.00', '0.00'),
(46, '47', '0.00', '0.00'),
(47, '48', '0.00', '0.00'),
(48, '49', '0.00', '1.85'),
(49, '50', '0.00', '0.00'),
(50, '51', '0.00', '0.00'),
(51, '52', '0.00', '0.12'),
(52, '53', '0.00', '0.00'),
(53, '54', '0.00', '0.00'),
(54, '55', '0.00', '0.00'),
(55, '56', '0.00', '0.00'),
(56, '57', '0.00', '0.10'),
(57, '58', '0.00', '0.00'),
(58, '59', '0.00', '0.00'),
(59, '60', '0.00', '0.00'),
(60, '61', '0.00', '0.00'),
(61, '62', '0.00', '0.00'),
(62, '63', '0.00', '0.00'),
(63, '64', '0.00', '0.00'),
(64, '65', '0.00', '0.00'),
(65, '66', '0.00', '0.00'),
(66, '67', '0.00', '0.00'),
(67, '68', '0.00', '1.12'),
(68, '69', '0.00', '0.00'),
(69, '70', '0.00', '4.26'),
(70, '71', '0.00', '3.68'),
(71, '72', '0.00', '0.00'),
(72, '73', '0.00', '0.00'),
(73, '74', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `type` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `status` int(255) NOT NULL DEFAULT 0,
  `dateCreated` varchar(255) NOT NULL,
  `dateApproved` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawal`
--

INSERT INTO `withdrawal` (`id`, `userid`, `amount`, `type`, `address`, `status`, `dateCreated`, `dateApproved`) VALUES
(1, 1, '135.30', 'bank', '{\"bankName\":\"Gtbank\",\"accName\":\"Oguns\",\"accNo\":\"0124336462\"}', 2, 'Tue 20 April, 2021; 01:08 am', 'Tue 20 April, 2021; 06:18 am'),
(2, 1, '123.00', 'bank', '{\"bankName\":\"Gtbank\",\"accName\":\"Oguns\",\"accNo\":\"0124336462\"}', 1, 'Tue 20 April, 2021; 01:14 am', 'Tue 20 April, 2021; 06:15 am'),
(3, 1, '23.00', 'eth', '{\"wallet\":\"my_eth\"}', 0, 'Tue 20 April, 2021; 01:30 am', NULL),
(4, 1, '21.00', 'edt', '{\"wallet\":\"cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B\"}', 0, 'Wed 21 April, 2021; 01:05 am', NULL),
(5, 2, '0.00', 'edt', '{\"wallet\":\"Rrhgg\"}', 0, 'Wed 21 April, 2021; 11:24 am', NULL),
(6, 1, '500.00', 'bank', '{\"bankName\":\"Gtbank\",\"accName\":\"Oguns\",\"accNo\":\"0124336462\"}', 1, 'Thu 29 April, 2021; 07:09 am', 'Thu 29 April, 2021; 07:10 am'),
(7, 4, '100.00', 'edt', '{\"wallet\":\"dCyDemX4StvuyS1b2ehjYr0VVt1ALKeo\"}', 1, 'Thu 29 April, 2021; 11:58 am', 'Thu 29 April, 2021; 12:03 pm'),
(8, 2, '20.00', 'bank', '{\"bankName\":\"GtB\",\"accName\":\"Komolafe Israel \",\"accNo\":\"0049216793\"}', 0, 'Fri 30 April, 2021; 06:20 pm', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesscreation`
--
ALTER TABLE `businesscreation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `businessreview`
--
ALTER TABLE `businessreview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset`
--
ALTER TABLE `reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesscreation`
--
ALTER TABLE `businesscreation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `businessreview`
--
ALTER TABLE `businessreview`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `reset`
--
ALTER TABLE `reset`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
