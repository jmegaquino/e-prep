-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2024 at 01:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eprep`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(4, 'admin222', '$2y$10$DUtdHTss0ZiPSzZzA4SDlezMjx.qmQBuiznZXXEvduE'),
(5, 'admin1234', '$2y$10$bVP5tG8ieXd7520ntbD2Ne9dT5xsfVjmAgBstv31G5T'),
(6, 'mima123', '$2y$10$KImbNpEsP0AX0fVt7Hjbm.40RRxPNg3EzRHS4sX8QAj'),
(7, 'mima123', '$2y$10$/hl.VN6POYWcDdGj5dotGed8DhuY.fApFZwThHpgGBO'),
(8, 'kantong', '$2y$10$LuH4wR2wKQlMRRBwA6LmneFKboIC2ZIIpP7ZlayPB5Mw/MXtsfVC.'),
(9, 'msi123', '$2y$10$FWxrhl4H9ha0gmwqplo0tO8O5mv1Sa7WQpba65he3ufGoZttFa936'),
(10, 'testingadmin123', '$2y$10$mnX9kKYnrrWIY.2NcvEZUeErlOUj5fQJ3Qw..V/myAa6JoCwBnhmC'),
(11, 'admin12345', '$2y$10$1L70xqJ8CEwo1G5tDIpB3er8cGrVSljKb5ONGFz7bmy.1fOMY.1Wm'),
(12, 'royal123', '$2y$10$HrXY2T3UZ7Y7XGIh04RR5Oj7k935vym8OW8VgS2KkkHa22BC2oEM6');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL,
  `time_duration` int(11) NOT NULL,
  `num_questions` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `assessment_id`, `title`, `description`, `due_date`, `time_duration`, `num_questions`, `lesson_id`) VALUES
(21, 1731838178, 'Testing 123', 'Testing 123', '2024-11-20', 2, 1, 1),
(22, 1732096159, '123123', '123123', '2024-11-22', 2, 1, 2),
(23, 1732098131, 'Testing 123', 'Testing 123', '2024-11-20', 2, 5, 3),
(24, 1732102788, 'Testing 123', 'Testing 123', '2024-11-20', 2, 1, 4),
(25, 1732102810, '123', '123213', '2024-11-21', 2, 2, 5),
(26, 1732102830, '123123', '123123', '2024-11-21', 2, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `assessment_questions`
--

CREATE TABLE `assessment_questions` (
  `id` int(11) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `choice_A` varchar(255) NOT NULL,
  `choice_B` varchar(255) NOT NULL,
  `choice_C` varchar(255) NOT NULL,
  `choice_D` varchar(255) NOT NULL,
  `correct_answer` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assessment_questions`
--

INSERT INTO `assessment_questions` (`id`, `assessment_id`, `question`, `choice_A`, `choice_B`, `choice_C`, `choice_D`, `correct_answer`) VALUES
(43, 1731838178, 'testomg', '1', '1', '4', '3', 'B'),
(44, 1732096159, '123', '123', '123', '123', '123', 'B'),
(45, 1732098131, 'testomg', '', '', '', '', 'B'),
(46, 1732098131, '123123', '12312', '3123123', '123123', '123123', 'A'),
(47, 1732098131, '12312', '31231', '23123', '123123', '123123', 'A'),
(48, 1732098131, '123123', '123', '213', '123123', '123123', 'B'),
(49, 1732098131, '123123', '123', '123123', '123', '123123', 'B'),
(50, 1732102788, 'testomg', '', '', '', '', 'B'),
(51, 1732102810, '123', '123', '123', '123', '123', 'B'),
(52, 1732102810, '123', '123', '3123', '123', '123123', 'B'),
(53, 1732102830, '123', '13221', '213123', '3123', '123123', 'A'),
(54, 1732102830, '123123', '3123123', '3123123', '3123123', '3123123', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `bug_reports`
--

CREATE TABLE `bug_reports` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bug_reports`
--

INSERT INTO `bug_reports` (`id`, `name`, `email`, `description`, `created_at`) VALUES
(31, 'Jose Martin Edward testing Aquino', 'theedwardaquino12@gmail.com', 'test', '2024-09-28 14:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `choice_text` varchar(255) DEFAULT NULL,
  `correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `description`, `content`, `created_at`) VALUES
(1, 'Fundamentals of Cookery', 'Lesson 1', '', '2024-11-17 07:19:50'),
(2, 'Food Safety', 'Lesson 2', '', '2024-11-17 07:21:02'),
(3, 'Preparation of Appetizers', 'Lesson 3', '', '2024-11-17 07:25:18'),
(4, 'Preparing Salads and Salad Dressings', 'Lesson 4', '', '2024-11-17 07:27:27'),
(5, 'Preparing Desserts', 'Lesson 5', '', '2024-11-17 07:35:26'),
(8, 'Preparation of Egg Dishes', 'Lesson 6', '', '2024-11-17 07:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_content`
--

CREATE TABLE `lesson_content` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `section_body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_content`
--

INSERT INTO `lesson_content` (`id`, `lesson_id`, `section_title`, `section_body`) VALUES
(46, 1, 'Fundamentals of Cookery', '<p>A kitchen staff is required to have the basic knowledge o fknowing the names of the equipment and tolls used in the kitchen. They should be able to read and convert basic measurements used in serving</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-kitchen\">Common Kitchen Tools, Utensils, and Equipment</h3>\r\n<p><em>Pots and Pans</em></p>\r\n<p>Scales, measuring cup, volume measure, thermometer, ladle, measuring spoons</p>\r\n<p>&nbsp;</p>\r\n<p><em>Measuring Devices</em></p>\r\n<p>Stock pot, saucepan, saucepot, fry pan, brazier, saut&eacute; pan, casserole, cast-iron skillet, double broiler, sheet pan, bake pan, roasting pan, hotel pan, bain-marie insert, steel bowl</p>\r\n<p>&nbsp;</p>\r\n<p><em>Hand Tools</em></p>\r\n<p>Scales, measuring cup, volume measure, thermometer, ladle, measuring spoons Ball cutter, bench scraper, can opener, channel knife, china cap, chopping board, colander, cook\'s fork, fine china cap, food mill, grater, mandoline, offset spatula, pastry bag and tubes, pastry blender, pastry brush, pastry wheel, pie server, rubber spatula, scooper, sieve, sifter, skimmer, spoons, sandwich spreader, steel spatula, straight spatula, strainer, kitchen timer, tongs, wire whisk, zester</p>\r\n<p>&nbsp;</p>\r\n<p><em>Knives</em></p>\r\n<p>Chef\'s knife, santoku knife, utility knife, paring knife, boning knife, scimitar, cleaver, oyster knife, clam knife, vegetable peeler, bread knife, honing rod</p>\r\n<p>&nbsp;</p>\r\n<p><em>Cooking Equipment</em></p>\r\n<p>Range tops: flat tops/ hot tops, induction cook tops</p>\r\n<p>Ovens: conventional oven, convection oven, revolving oven, microwave oven</p>\r\n<p>Grillers: broiler and griller, griddle,</p>\r\n<p>Deep fryers: tilting fry pan, deep fat fryer</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-weights\">Common Weights and Measurement Used in the Kitchen</h3>\r\n<p>A chef is responsible for many computations done in the kitchen. These include recipe yield, ratio for preparing stocks, calculating cost of a dish, budget of food and labor, counting portions, and measurement of ingredients. Measurement conversion is done if the kitchen staff needs to increase or decrease the size of the recipe.</p>\r\n<p>&nbsp;</p>\r\n<p>There is a difference between weight ounces and volume ounces. Weight ounces ar used in measuring dry food while volume ounces are used in measuring fluid substance and food products.</p>\r\n<p>&nbsp;</p>\r\n<p><em>Weight Conversion</em></p>\r\n<p>Ounces to grams (multiply number of ounces to 28.35)</p>\r\n<p>&nbsp;</p>\r\n<p><em>Volume Conversion</em></p>\r\n<p>Fluid ounces to milliliters (multiply the number of fluid ounces by 30)</p>\r\n<p>&nbsp;</p>\r\n<p><em>Dry Measures</em></p>\r\n<div><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_151917835.png\" alt=\"image_2024-11-17_151917835.png\" width=\"757\" height=\"343\"><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_151928720.png\" alt=\"image_2024-11-17_151928720.png\" width=\"1004\" height=\"343\">\r\n<p><em>Temperature Conversion</em></p>\r\n<p><em><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_151948144.png\" alt=\"image_2024-11-17_151948144.png\" width=\"598\" height=\"338\"></em></p>\r\n</div>\r\n<p>&nbsp;</p>'),
(47, 2, 'Food Safety', '<p>The knowledge in tools to use can make cooking easier and safer. It will also make cooking more efficient and safer both for the kitchen staff and for those who will consume the food.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"cleaning-station\">Cleaning the Station</h3>\r\n<p>It is important that the surface we used for the preparation of food are protected from contamination and should be washed and sanitized.</p>\r\n<p>&nbsp;</p>\r\n<p><em>Three-Compartment Sink</em></p>\r\n<p>The dishes must be pre-scraped before it went through the three-compartment sink. The same principles of washing and rinsing apply when washing dishes by hand in a three-compartment sink.</p>\r\n<p>&nbsp;</p>\r\n<p><em>First Compartment-Washing</em></p>\r\n<p>The dishes are washed with the use of detergent dissolved in hot water in thiscompartment.</p>\r\n<p>&nbsp;</p>\r\n<p><em>Second Compartment-Rinsing</em></p>\r\n<p>Rinse the dishes in clean hot water to remove the soap.</p>\r\n<p>&nbsp;</p>\r\n<p><em>Third Compartment- Sanitizing</em></p>\r\n<p>The dishes are sanitized in a solution of sanitizer and room temperature water. The dishes are completely immersed in the solution for at least 30 seconds.</p>\r\n<p>&nbsp;</p>\r\n<p>It is a must that the dishes will be dried on the drain board/rack after the process. Once the dishes are dry, store it in a clean space free from contamination.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"washing-ingredients\">Washing of Ingredients</h3>\r\n<p><em>Washing of Vegetables</em></p>\r\n<p>Washing of ingredients is important specifically for vegetables because of somepesticides and chemicals.</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Gently scrub the fruits and vegetables with smooth surface with a use of vegetablescrub.</li>\r\n<li>Greens should not be soaked for a long period of time to avoid chemicals from sticking harder on the leaves.</li>\r\n<li>Rinse once more in a colander and let it air dry. For root vegetables, peel them first, rinse, and let it dry before cutting it in its shape.</li>\r\n<li>Rinse again after cutting to ensure its cleanliness.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><em>Washing of Meat</em></p>\r\n<p>Meat should be washed thoroughly to avoid bacteria such as E. coli or salmonella whichcould cause diarrhea and dehydration.</p>\r\n<p>&nbsp;</p>\r\n<p>For chicken and pork</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Soak it in a container filled with water that has one to two spoons of salt and lemoncut in halves.</li>\r\n<li>Let it stand for 10 - 15 minutes.</li>\r\n<li>Rinse the meat in running water and let it drip dry in a colander.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>For red meat</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Rinse it in running water and let it drip dry before cooking.</li>\r\n<li>Remember not to soak red meat such as lamb or beef because it will lose a lot of flavor.</li>\r\n<li>Rinse the meat in running water and let it drip dry in a colander.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>For red meat</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Rinse it in running water and let it drip dry before cooking.</li>\r\n<li>Remember not to soak red meat such as lamb or beef because it will lose a lot of flavor.</li>\r\n<li>Rinse the meat in running water and let it drip dry in a colander.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><em>Washing Seafood</em></p>\r\n<p>For mussels and clams</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Wash it in slow running water and put in a spoon of salt.</li>\r\n<li>Scrub the outside shell and rinse before cooking. Newly bought shellfish must becleaned and cooked right away or cook and preserve it on the next day. This is done to avoid food poisoning and to lessen the chance of food allergy from shellfish.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>For crabs and lobster</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Scrub the shell first and rinse it in running water.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>For slippery food</p>\r\n<p>These include shrimps, squids, oysters, with removed shelis and many other.</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Use salt and wash it once.</li>\r\n<li>Use a spoon of cornstarch or potato starch to wash once again and then rinsethoroughly.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"food-temperature\">Food Temperature</h3>\r\n<p><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_152034779.png\" alt=\"image_2024-11-17_152034779.png\" width=\"460\" height=\"371\"></p>\r\n<h3 id=\"occupational-health\">Occupational Health and Safety Procedure</h3>\r\n<p>Everyone in the kitchen must practice occupational health and safety procedure to avoid accidents and problems in a workstation.</p>\r\n<p>&nbsp;</p>\r\n<p><em>Persobal Protective Equipment (PPEs)</em></p>\r\n<p>This is a specialized equipment worn by the employees to protect themselves from health and safety hazards they may encounter while working.</p>\r\n<p><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_152051715.png\" alt=\"image_2024-11-17_152051715.png\" width=\"636\" height=\"387\"></p>\r\n<div>\r\n<h3 id=\"handwashing\">Handwashing</h3>\r\n<p>The most important among all hygienic practices in providing safe food to the customers. The kitchen staff must always consider that the faucet, sink, and its surrounding may be contaminated when starting the handwashing procedure. Use the handwashing sink and not the food preparation sink.</p>\r\n<br>\r\n<p><em>Hygienic Practices</em></p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Bathe daily and wear clean clothes.</p>\r\n</li>\r\n<li>\r\n<p>Make it a habit to wash your hands before preparing food.</p>\r\n</li>\r\n<li>\r\n<p>Never go to work if you are sick, especially if you have symptoms of diarrhea, vomiting, fever, or if you have discharge from your nose and eyes.</p>\r\n</li>\r\n<li>\r\n<p>Notify your supervisor when you are sick and certain illnesses will require you to stay home until your doctor has cleared you.</p>\r\n</li>\r\n<li>\r\n<p>Make sure that your nails are short, clean, and free from nail polish.</p>\r\n</li>\r\n<li>\r\n<p>Remove all jewelries when handling food.</p>\r\n</li>\r\n<li>\r\n<p>Wear hairnet.</p>\r\n</li>\r\n<li>\r\n<p>Never eat or smoke in food preparation or food storage areas.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<p><em>Safety Measures in the Kitchen</em></p>\r\n<br>\r\n<p>Always ensure safety in the kitchen. Take note of these extra measures.</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Keep potholders nearby and use them.</p>\r\n</li>\r\n<li>\r\n<p>Turn pot handles away from the front of the stove.</p>\r\n</li>\r\n<li>\r\n<p>Do not let temperature-sensitive foods sit out in the kitchen.</p>\r\n</li>\r\n<li>\r\n<p>Wipe up spills immediately.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<h3 id=\"knife-skills\">Knife Skills</h3>\r\n<p>Knife skills are one of the basic requirements in performing mise en place. It is also important to learn how to properly hold the chef\'s knife. A good grip will give you control over the knife to prevent accidents and improve your efficiency and accuracy. Holding the blade with the thumb and forefinger is the best position for handling the knife.</p>\r\n<br>\r\n<p>Remember that in holding the knife:</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>hold firmly to the item you are cutting so it will not slip.</p>\r\n</li>\r\n<li>\r\n<p>guide the knife so that the knife blade slides along the fingers since the position of your hand will control the cut.</p>\r\n</li>\r\n<li>\r\n<p>curl your fingertips to avoid accidents.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<h3 id=\"basic-cuts\">Basic Cuts</h3>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Coarse - refers to rough cuts used for many vegetables and irregularly-shaped food items such as mushrooms and rhubarbs.</p>\r\n</li>\r\n<li>\r\n<p>Slice - refers to cutting food into broad or flat thin pieces.</p>\r\n</li>\r\n<li>\r\n<p>Mirepoix - refers to roughly cutting vegetables equally usually done to mirepoix vegetables such as the carrot, onion, and celery.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<h3>Cube Cuts</h3>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Dice - refers to cutting food items into small uniform, cube-shaped pieces of 1/8- 1/4 inches in sizes.</p>\r\n</li>\r\n<li>\r\n<p>Macedoine - refers to a diced cut of fruit or vegetable, usually small dice measuring 1/4 inch on sides, 5 mm diced cube.</p>\r\n</li>\r\n<li>\r\n<p>Brunoise - refers to very small diced cube cuts; usually by 1/8 x 1/8 x 1/8 inches.</p>\r\n</li>\r\n<li>\r\n<p>Matignon - evenly cut root vegetable.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<h3>Strip Cuts</h3>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Julienne - refers to progressively cutting thinner and thinner lengthwise strips of food.</p>\r\n</li>\r\n<li>\r\n<p>Chiffonade - refers to cut on leafy vegetables; usually at 1/8\" wide into thin strips and ribbons.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<h3>Fancy Cuts</h3>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Paysanne - 1&frasl;2 x 1&frasl;2 x 1/8 inch either round, square, or rectangle.</p>\r\n</li>\r\n<li>\r\n<p>Tournee - refers to cutting vegetables into a football shape with seven equal sides and ends left flat.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h1 id=\"appetizers\">PREPARATION OF APPETIZER OR HORS D\'OEUVRES</h1>\r\n<p>An appetizer or hors d\'oeuvres is a small food item intended to stimulate one\'s appetite which is usually served first in a sit-down or multi-course meal. This is usually prepared by the garde manger or the pantry chef. It is now also being served as an individual dish that is not connected to the meal during events and gatherings.</p>\r\n<br>\r\n<h3>Common Types of Appetizer</h3>\r\n<p>They are classified according to the ingredients they are made up of and the method they are prepared and presented. The specific components of an appetizer make them unique with one another.</p>\r\n<br>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Canape - open-faced, bite-sized sandwiches that are usually served cold.</p>\r\n</li>\r\n<li>\r\n<p>Tapas - small portion of Spanish dishes usually served with wine or other.</p>\r\n</li>\r\n<li>\r\n<p>Antipasti - any traditional Italian appetizer dish including canapes, bruschetta, and others.</p>\r\n</li>\r\n<li>\r\n<p>Cocktails - usually served cold and with an acidic sauce.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<br>\r\n<h3>Common Items Used in Preparing Appetizer</h3>\r\n<div>\r\n<div>\r\n<p><em>Baked Items</em></p>\r\n<ol>\r\n<li>\r\n<p>Crackers</p>\r\n</li>\r\n<li>\r\n<p>Biscuit</p>\r\n</li>\r\n<li>\r\n<p>Pita Bread</p>\r\n</li>\r\n<li>\r\n<p>Tortilla</p>\r\n</li>\r\n<li>\r\n<p>Pastry Shell</p>\r\n</li>\r\n<li>\r\n<p>Bread and Toasts</p>\r\n</li>\r\n<li>\r\n<p>Blinis</p>\r\n</li>\r\n</ol>\r\n</div>\r\n<div>\r\n<p><em>Protein-Rich Products</em></p>\r\n<ol>\r\n<li>\r\n<p>Cured Meat</p>\r\n</li>\r\n<li>\r\n<p>Eggs</p>\r\n</li>\r\n<li>\r\n<p>Seafood</p>\r\n</li>\r\n<li>\r\n<p>Cheeses</p>\r\n</li>\r\n<li>\r\n<p>Meat and Poultry</p>\r\n</li>\r\n</ol>\r\n</div>\r\n<div>\r\n<p><em>Fresh and Pickled Vegetables</em></p>\r\n<ol>\r\n<li>\r\n<p>Celery and Cucumber</p>\r\n</li>\r\n<li>\r\n<p>Cauliflower and Broccoli</p>\r\n</li>\r\n<li>\r\n<p>Lettuce and Radish</p>\r\n</li>\r\n<li>\r\n<p>Carrots and Zucchini</p>\r\n</li>\r\n<li>\r\n<p>Bell peppers and Tomato</p>\r\n</li>\r\n<li>\r\n<p>Microgreens and Scallions</p>\r\n</li>\r\n<li>\r\n<p>Pickled olives</p>\r\n</li>\r\n<li>\r\n<p>Chutneys</p>\r\n</li>\r\n<li>\r\n<p>Pickled/ Dill cucumber</p>\r\n</li>\r\n</ol>\r\n</div>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>'),
(48, 3, 'Preparation of Appetizers', '<h1 id=\"appetizers\">PREPARATION OF APPETIZER OR HORS D\'OEUVRES</h1>\r\n<p>An appetizer or hors d\'oeuvres is a small food item intended to stimulate one\'s appetite which is usually served first in a sit-down or multi-course meal. This is usually prepared by the garde manger or the pantry chef. It is now also being served as an individual dish that is not connected to the meal during events and gatherings.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-types\">Common Types of Appetizer</h3>\r\n<p>They are classified according to the ingredients they are made up of and the method they are prepared and presented. The specific components of an appetizer make them unique with one another.</p>\r\n<p>&nbsp;</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Canape - open-faced, bite-sized sandwiches that are usually served cold.</p>\r\n</li>\r\n<li>\r\n<p>Tapas - small portion of Spanish dishes usually served with wine or other.</p>\r\n</li>\r\n<li>\r\n<p>Antipasti - any traditional Italian appetizer dish including canapes, bruschetta, and others.</p>\r\n</li>\r\n<li>\r\n<p>Cocktails - usually served cold and with an acidic sauce.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-items\">Common Items Used in Preparing Appetizer</h3>\r\n<div>\r\n<div>\r\n<table style=\"border-collapse: collapse; width: 100.048%;\" border=\"1\"><colgroup><col style=\"width: 33.3333%;\"><col style=\"width: 33.3333%;\"><col style=\"width: 33.3333%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td><em>Baked Items</em></td>\r\n<td><em>Protein-Rich Products</em></td>\r\n<td><em>Fresh and Pickled Vegetables</em></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<ol>\r\n<li>\r\n<p>Crackers</p>\r\n</li>\r\n<li>\r\n<p>Biscuit</p>\r\n</li>\r\n<li>\r\n<p>Pita Bread</p>\r\n</li>\r\n<li>\r\n<p>Tortilla</p>\r\n</li>\r\n<li>\r\n<p>Pastry Shell</p>\r\n</li>\r\n<li>\r\n<p>Bread and Toasts</p>\r\n</li>\r\n<li>\r\n<p>Blinis</p>\r\n</li>\r\n</ol>\r\n</td>\r\n<td>\r\n<ol>\r\n<li>\r\n<p>Cured Meat</p>\r\n</li>\r\n<li>\r\n<p>Eggs</p>\r\n</li>\r\n<li>\r\n<p>Seafood</p>\r\n</li>\r\n<li>\r\n<p>Cheeses</p>\r\n</li>\r\n<li>\r\n<p>Meat and Poultry</p>\r\n</li>\r\n</ol>\r\n</td>\r\n<td>\r\n<div>\r\n<div>\r\n<ol>\r\n<li>\r\n<p>Celery and Cucumber</p>\r\n</li>\r\n<li>\r\n<p>Cauliflower and Broccoli</p>\r\n</li>\r\n<li>\r\n<p>Lettuce and Radish</p>\r\n</li>\r\n<li>\r\n<p>Carrots and Zucchini</p>\r\n</li>\r\n<li>\r\n<p>Bell peppers and Tomato</p>\r\n</li>\r\n<li>\r\n<p>Microgreens and Scallions</p>\r\n</li>\r\n<li>\r\n<p>Pickled olives</p>\r\n</li>\r\n<li>\r\n<p>Chutneys</p>\r\n</li>\r\n<li>\r\n<p>Pickled/ Dill cucumber</p>\r\n</li>\r\n</ol>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div>&nbsp;</div>\r\n</div>\r\n<h3 id=\"canapes\">Preparing Canapes</h3>\r\n<p>Canap&eacute;s are considered as one of the most varied and common types of hors d\'oeuvres today. They are usually served in bite-sized portions which allow easy handling and eating.</p>\r\n<p>This type of&nbsp;hors d\'oeurve consists of three components:</p>\r\n<div><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_152443942.png\" alt=\"image_2024-11-17_152443942.png\" width=\"704\" height=\"318\"></div>\r\n<p>The following are important reminders for preparing canap&eacute;s:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Prepare all the base, spread and garnish ahead of time especially when preparing hors d\'oeuvres for large events or functions.</li>\r\n<li>Assemble canap&eacute;s as close to serving time as possible to avoid bases from getting soggy and spread and garnishes from getting dry.</li>\r\n<li>As soon as you have finished a tray of appetizers, cover it, and refrigerate for a short time.</li>\r\n<li>Choose spreads and garnishes with complimentary flavors. Examples of appealing spread and garnish combinations are:\r\n<ul style=\"list-style-type: none;\">\r\n<li>● Mustard butter and ham</li>\r\n<li>● Lemon butter and caviar</li>\r\n<li>● Pimiento cream cheese and sardine</li>\r\n<li>● Horseradish butter and smoked salmon/tongue</li>\r\n<li>● Tuna salad and capers</li>\r\n<li>● Anchovy butter and hard-cooked egg slice and/or olive</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>At least one of your ingredients should be savory.</li>\r\n<li>Leftover food to be used as garnish should be handled properly and safely to maintain quality.</li>\r\n<li>Avoid making too elaborate arrangements. It is more important for the canap&eacute; to stand and hold even when taken by the diners.</li>\r\n<li>Arrange the canap&eacute;s neatly on the tray.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"tapas\">Preparing Tapas</h3>\r\n<p>These food items were traditionally served accompanied with wines or any beverage in Spanish local bars. Back then, tapas were served to give local pub-goers something to eat with their drinks while letting the time pass.</p>\r\n<p>&nbsp;</p>\r\n<p>There are various recipes of tapas today. These can be classified into two types:</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Hot Tapas - calamari, croquettes, patatas bravas</p>\r\n</li>\r\n<li>\r\n<p>Cold Tapas - gazpacho, pan con tomate, spanish tortilla</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3 id=\"antipasti\">Preparing Antipasti</h3>\r\n<p><em>Antipasti</em>&nbsp;is the Italian term for appetizers. The common type of antipasto are bruschetta and cold antipasto platters.</p>\r\n<p>Bruschetta is the larger version of canapes. The traditional&nbsp;bruschetta is a piece of bread rubbed with crushed garlic and drizzled with olive oil but today there are several different varieties of bruschetta as it became popular around the world.</p>\r\n<p>A cold antipasto platter is made of assorted flavorful items arranged in a platter. It may include the following items:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Cured meats (salami, prosciutto, bologna and boiled ham);</li>\r\n<li>Canned or processed seafood items (sardines, anchovies and tune);</li>\r\n<li>Cheeses (mozarella and provolone);</li>\r\n<li>Eggs (hard-cooked and stuffed);</li>\r\n<li>Relishes and pickled vegetables;</li>\r\n<li>Mushrooms and vegetables cooked a la Grecque (in vinegar/ lemon juice and olive oil); and</li>\r\n<li>Cooked dried beans and other firm vegetables soaked in a flavorful vinaigrette.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>A cold antipasto platter is made of assorted flavorful items arranged in a platter. It may include the following items:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Prepare all the base, spread, and garnish for bruschetta ahead of time especially when preparing antipasti for large events or functions.</li>\r\n<li>Assemble bruschetta as close to serving time as possible to avoid bases from getting soggy and spread and garnishes from getting dry.</li>\r\n<li>Put in thin slices of bread or bread sticks.</li>\r\n<li>Add garnish like honey drizzled figs and other sweet spreads.</li>\r\n<li>Include preserved vegetables and ripe fruits for color and added sweetness.</li>\r\n<li>Individual food items should be easy to pick up.</li>\r\n<li>You can use a platter with an interesting design</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"cocktails\">Preparing Cocktails</h3>\r\n<p>Cocktails are usually served cold with a tangy sauce. Its ingredients include fruits, vegetables, and seafood. The following are important reminder in preparing cocktails:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Open oysters and clams just before they are served and arrange them on a flat plate or on a bed of ice.</li>\r\n<li>Dips can be put in a separate container and placed in the middle or on the side of the plate.</li>\r\n<li>Cocktail dips may be added on the same glass before putting the seafood in or as a topping.</li>\r\n<li>Fruits should have a desirable sourness and not too sweet. You can add lemon juice to fruit mixtures to add tangy or acidic flavor.</li>\r\n<li>Liqueur can be used to heighten the flavor of cocktail dishes especially those with fruit mixes.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-plating\">Common Plating Styles for Appetizers</h3>\r\n<p>Plating appetizers and hors d\'oeuvres give the kitchen staff an avenue to express their creativity and artistry. The following are the most common ways of plating or presenting appetizers.</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Stacked - toppings are stacked on the base (slice of bread, cracker, or toast) and secured in place by the spread or by a pick.</p>\r\n</li>\r\n<li>\r\n<p>Wrapped - fillings are wrapped or rolled securely and sliced for individual servings.</p>\r\n</li>\r\n<li>\r\n<p>Balls - fruits are carved into balls and mashed root crops are shaped, fried, and served in bowls with other items.</p>\r\n</li>\r\n<li>\r\n<p>Skewered - marinated meats and vegetables are skewered and often grilled and served on sticks.</p>\r\n</li>\r\n<li>\r\n<p>Placed in cups</p>\r\n</li>\r\n<li>\r\n<p>Arranged in platters - raw and cooked items arranged on trays or platters.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3 id=\"guidelines-plating\">Guidelines for Plating</h3>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li><em>Uniformity</em>\r\n<p>Same dishes should be the same in terms of color, size, shape and portion size. Another way of making the dishes uniform is by presenting same dishes with the same utensils and made from the same materials.</p>\r\n</li>\r\n<li><em>Simplicity and Stability</em>\r\n<p>Hors d\'oeuvres such as canap&eacute;s and bruschetta should be assembled as simple as possible without compromising their visual appeal. Too elaborate arrangements should be avoided to keep the stability of the dish. The more toppings you put into the base results to higher chances that the hors d\'oeuvres will fall out when taken by the diners.</p>\r\n</li>\r\n<li>SHIFT<em>(Shape, Height, Interest, Flavor and Taste)</em>\r\n<p>This five-letter mnemonic means making sure that:</p>\r\n</li>\r\n<li>Choose spreads and garnishes with complimentary flavors. Examples of appealing spread and garnish combinations are:\r\n<ul style=\"list-style-type: none;\">\r\n<li>● the plate shows various shapes which can be in uniform or varying sizes;</li>\r\n<li>● height is considered as another dimension in arranging the elements on the plate;</li>\r\n<li>● colors and texture are put into and set up effectively enough for the plate to be appealing and enticing; and</li>\r\n<li>● the flavor and taste of the dish is made sure to be pleasing to the diners the same way as they were satisfied by the visuals of the plate.</li>\r\n</ul>\r\n</li>\r\n<li><em>Portion</em>\r\n<p>Generally, hors d\'oeuvres should be kept bite-size. Meanwhile, in terms of appetizer platters, there should be at least 2 tablespoon of each item per person. Cheeses should come with knives and a few cut pieces to serve as guides for the diners. Sauces and other accompaniments should also be enough per serving.</p>\r\n</li>\r\n<li><em>Safety and Sanitation</em>\r\n<p>When plating, you should make sure that all the utensils are clean and safe to be used by the guests. Ceramic crockery and cutlery items should be free from cracks. Stainless or iron tableware should not have dents and rust. More importantly, the doneness and freshness of food should be checked before serving. It should be made sure that cooked food items will be served cooked and raw items will be served fresh.</p>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"holding-storing\">Holding and Storing of Appetizer</h3>\r\n<p>The freshness and doneness of food is one of the main aspects of food service that the kitchen staff needs to closely monitor. As said earlier, it should be made sure that cooked food items will be served cooked and raw items will be served fresh. This poses a challenge for the kitchen staff especially when preparing meals for a large gathering.</p>\r\n<p>The following are important reminders for maintaining the quality of appetizers during holding and storing.</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Assemble appetizers with spread or sauces as close to serving time as possible. This is to avoid other components of the dish such as the base from being soggy.</li>\r\n<li>Avoid stacking an item on top of another item without using a cover. Hold hot food in 135&deg;F or 57&deg;C using steam tables and place cold food on a refrigerated table.</li>\r\n<li>Arrange items on a tray and put each tray into the refrigerator covered. Store sauces, dips, crackers, and chips in air-tight container.</li>\r\n<li>Use opened packages of cold cuts as soon as possible. Wrap cheeses in plastic wrap or wax paper and refrigerate. Wash and dry fruits and vegetables before storing them in a crisper drawer.</li>\r\n<li>Read and follow the manufacturer\'s instructions for storing pickled fruits and vegetables and other processed items. Make sure that items are cooled to room temperature before storing.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>'),
(49, 4, 'Preparing Salads and Salad Dressings', '<h1>Preparing Salads and Salad Dressings</h1>\r\n<p>A salad is a mixture of raw or cooked ingredients that are usually seasoned with oil, vinegar or other dressing and sometimes accompanied by meat, fish, and other ingredients.</p>\r\n<p>Salads can be served as:</p>\r\n<p><strong>Appetizers -&nbsp;</strong>made of fresh and crisp ingredients with palette-stimulating flavors arranged attractively and served in small portions;</p>\r\n<p><strong>Accompaniments -&nbsp;</strong>composed of starch-rich or sweet food items served as a side dish for the main course;</p>\r\n<p><strong>Main course -&nbsp;</strong>large servings of salad containing protein-rich ingredients in balance proportion with the variety of other food items used; and</p>\r\n<p><strong>Separate course -&nbsp;</strong>fruit salads or other light green salads served to after the main course intended to cleanse the pallet before the dessert is served.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"types-components\">Types and Components of Salad</h3>\r\n<p>Salads can be served plated or in a tray during buffets or gatherings. Salads in a platter contain all the components while buffet-style salad have only the body and the dressing.</p>\r\n<div><img style=\"width: 728px; height: 323px; display: block; margin: 0px auto;\" src=\"uploads/images/image_2024-11-17_152647823.png\" alt=\"image_2024-11-17_152647823.png\" width=\"881\" height=\"362\"><em>Base -&nbsp;</em>this is the main part of the salad which is a mixture of raw or cooked ingredients.</div>\r\n<p><em>Body -&nbsp;</em>serves as the bed for the main part of the salad. It is usually a green-leafy vegetable.</p>\r\n<p><em>Dressing -&nbsp;</em>are seasoned liquid or semi-liquid ingredients intended to add flavor, moisture, and visual appeal to the body of the salad.</p>\r\n<p><em>Garnish -&nbsp;</em>a decorative item use to add eye appeal and sometimes flavor to the dish which should be edible and must compliment the salad.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-salad\">Common Salad Ingredients</h3>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Salad Greens - are leafy vegetables that are usually served raw</p>\r\n</li>\r\n<li>\r\n<p>Vegetables - examples of vegetables used in salad are root, green, fruit vegetables and legumes</p>\r\n</li>\r\n<li>\r\n<p>Fruits - can be classified as soft, stone, hard, citrus, and tropical. It can be used fresh, cooked, pickled, and canned or frozen.</p>\r\n</li>\r\n<li>\r\n<p>Protein-rich products - these ingredients add nutrients and flavor to the salad. Most of these are cooked or processed before added.</p>\r\n</li>\r\n<li>\r\n<p>Starch-rich products - examples of these are pasta, lentils, beans, and grains.</p>\r\n</li>\r\n<li>\r\n<p>Herbs - these ingredients provide aroma, flavor, and texture but should not be used in excessive amount because it may overpower the taste of the salad.</p>\r\n</li>\r\n<li>\r\n<p>Acids and oils - these are usually used in making salad dressings which should be fresh.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3 id=\"preparing-salad-dressings\">Preparing Salad Dressings</h3>\r\n<p>Dressings are used to add flavor, moisture, and visual appeal to the salad to make it more appetizing.</p>\r\n<p>You must consider the following in choosing the type of dressing to be used:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Type of salad to be prepared;</li>\r\n<li>Purpose of the dressing (vinaigrette is used to add flavor while mayonnaise are often used to hold the ingredient together);</li>\r\n<li>Service sequence (if serving in or next to the salad); and</li>\r\n<li>the Compatibility of the dressing to the flavor of the salad.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>Most salad dressings are made of fat and acid combined together through the process of <strong><em>emulsification</em></strong>. In this method, fats and acids, such as vinegars and oils, are mixed or shaken vigorously to mix the two unmixables. The harder the ingredients are beaten or shaken, the longer they will stay combined.</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>Oil and Acid-Based Dressings - these dressings are known for not being too thick and long lasting even at room temperature. Examples are vinaigrette, sauce gribiche, and tomato French dressings. Acids may come in a form of vinegars and citrus juices. However, common oil and acid-based dressings are made of vinegar and oil that are combined into a&nbsp;<strong><em>temporary emulsion</em></strong>. In this type of mixture combined items separate after some time. For this reason, oil and acid-based dressings need to be shaken or beaten from time to time or before using them fo service to keep the ingredients evenly mixed.</li>\r\n<li>\r\n<p>Mayonnaise-based Dressings - Mayonnaise is a permanent emulsion mainly made of egg yolks, vinegar, and oil. This mixture does not separate because the ingredients are bound by the protein and fat in the egg yolk. Though mayonnaise is readily available in the market, some establishments still make their own mayonnaise to be used for dressings, spreads, and dips. Mayonnaise can be used by itself. Common mayonnaise-based dressings are thousand island, ranch, and Caesar dressing.</p>\r\n</li>\r\n<li>\r\n<p>Cream and fruits - examples are sour cream, whipped cream, yoghurt, and fruit purees.</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3 id=\"preparing-salads\">Preparing Salads</h3>\r\n<p><em><strong>Green Salads</strong></em></p>\r\n<p>Salads of this type are mainly made of salad greens such as lettuce, cabbage, endives, spinach, arugula, sprouts and microgreens. Green salads are often tossed with a vinaigrette. Common examples of this salad type are:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Mixed green salad Caesar salad</li>\r\n<li>Garden salad</li>\r\n<li>Caesar salad</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><em><strong>Vegetable and Starch Salads</strong></em></p>\r\n<p>Vegetable salads have bodies that are mainly made of vegetables other than salad greens. Some vegetables such as celery, cucumber, tomatoes and green peppers are used raw. Artichokes, beets and asparagus, on the other hand, are cooked and chilled first before being added into the salad.</p>\r\n<p>Meanwhile, starch salads are those that have bodies that are mainly made of starch-rich ingredients such as grains, pastas and dried legumes. The mild flavor of these ingredients are often tossed and enhanced using a flavorful sourish dressing.</p>\r\n<p>Raw or cooked vegetables are also commonly added to starch salads to add color, flavor and nutrients. For this reason, it is sometimes difficult to differentiate vegetable from starch salads.</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong>Compound Salads</strong></em></p>\r\n<p>These are salads composed of cooked protein, starch and vegetable ingredients held together by a thick mayonnaise dressing. Compound salads can be prepared early before serving time. Common examples of compound salads are:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Chicken salad</li>\r\n<li>Tuna salad</li>\r\n<li>Egg salad</li>\r\n<li>Potato salad</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>A compound salad may be made of vegetable, starch, seafood, poultry and meat ingredients.</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong>Fruit Salads</strong></em></p>\r\n<p>These are salad dishes that have fruits as their main ingredient. Fruit salads are usually served as appetizers or desserts, with a cottage cheese or any mild-flavored protein item accompaniment.</p>\r\n<p>Most fruit salads are arranged and not tossed because of the delicate texture of fruits often used.</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong>Composed Salads</strong></em></p>\r\n<p>These are salads with two or more components arranged separately on a plate and not mixed together. The elements of composed salads may also include mixed or tossed salads. These components are prepared beforehand and arranged on the plate together with the other ingredients only upon serving.</p>\r\n<p>Composed salads are usually served as main course due to their elaborate and filling servings. Common examples of composed salad are:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Chef\'s Salad</li>\r\n<li>Salad Ni&ccedil;oise&nbsp;<em>(nee-swaz)</em></li>\r\n<li>Taco Salad</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>Composed salads may include other types of salad and elements prepared differently from each other. For this reason, each element should be prepared separately beforehand.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"plating-storing\">Plating and Storing Salad</h3>\r\n<p>Salads and their dressings can be arranged and plated in many different ways. Several factors need to be considered when determining how salads will presented. The most common ones as the following:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li><strong>Salad type.&nbsp;</strong>Some salad types have distinct arrangements and presentations. Tradionally, composed salads look different from a bound salads.</li>\r\n<li><strong>Ingredients used.&nbsp;</strong>he quality of ingredients need to kept until the salad is taken by the diners. Some element may affect the texture, color and flavor of other items when added too early or arranged improperly.</li>\r\n<li><strong>Service style.&nbsp;</strong>The way meals are served also affect how salads are presented. In a buffet set-up, salads may be arranged on serving dishes for the guests to serve themselves. In a French or a spoon and fork service, salads are commonly arranged in front of the guests.</li>\r\n<li><strong>Function.&nbsp;</strong>What the salad is being served and when it will be served also affects the presentation of a salad. Appetizer salads need to be arranged in small portions while salads to be served as the main course or a separate dish should be served in a filling portion.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>');
INSERT INTO `lesson_content` (`id`, `lesson_id`, `section_title`, `section_body`) VALUES
(50, 5, 'Preparing Desserts', '<h1 id=\"pastry-chef\">What is a P&acirc;tissier/ Pastry Chef?</h1>\r\n<p>Required skills in preparing desserts should be mastered to produce high quality products that the customers would enjoy. To be able to concentrate on creating appetizing dishes, each kitchen staff is tasked to prepare specific types of dishes.</p>\r\n<p>A pastry chef, also known as a&nbsp;p&acirc;tissier, is a chef that is dedicated to creating desserts and baked goods. He/she oversees the baking facet of the kitchen and restaurants. He/she works with a team of bakers to prepare, cook, and decorate food. He/she must be organized and motivated to do the daily work.</p>\r\n<p>The pastry chef may work alone or with a group of cooks and bakers to prepare, cook, and present food to the customers. They must be motivated and organized to be able to prepare the finest desserts.</p>\r\n<p>He/she not only prepares the desserts but also work with the head chef to pair breads and desserts, order supplies, and hire staff. The pastry chef also creates recipes to offer a variety of dishes to the customers. He/she does all of these together with maintaining records, ordering food, and enforcing food safety standards.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"common-ingredients\">Common Ingredients in Making Desserts</h3>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>\r\n<p>Sugar</p>\r\n</li>\r\n<li>\r\n<p>Syrup</p>\r\n</li>\r\n<li>\r\n<p>Eggs</p>\r\n</li>\r\n<li>\r\n<p>Dairy Products</p>\r\n</li>\r\n<li>\r\n<p>Oil</p>\r\n</li>\r\n<li>\r\n<p>Cheese</p>\r\n</li>\r\n<li>\r\n<p>Nuts</p>\r\n</li>\r\n<li>\r\n<p>Vanilla</p>\r\n</li>\r\n<li>\r\n<p>Thickening Agents</p>\r\n</li>\r\n<li>\r\n<p>Fruits</p>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3>Classification of Refined Sugar</h3>\r\n<p><em>Caster Sugar</em></p>\r\n<p>It is finer than regular granulated sugar. It supports the quantities of fat and dissolves relatively quickly into doughs and batter. It is the premier sugar to use in producing quality desserts and pastries.</p>\r\n<p><em>Regular Granulated Sugar</em></p>\r\n<p>It is also known as table sugar or A1 and is the most known sugar. It has a coarse grain. In production, the coarse grains leave undissolved grains, even after long mixing. After baking these show up as dark spots on crusts, irregular texture, and syrupy spots. Coarse sugars are less refined and results in clearer syrup.</p>\r\n<p><em>Brown Sugar</em></p>\r\n<p>It contains 85-92% sucrose and varying amounts of caramel, molasses, and other impurities. Darker grades contain more of these impurities. Brown sugar is regular cane sugar that has not been completely refined.</p>\r\n<p><em>Icing Sugar</em></p>\r\n<p>It is also known as confectioners\' sugar which is a sugar ground to a fine powder.</p>\r\n<p><em>Soft Icing Mixture</em></p>\r\n<p>It is an icing sugar mixed with a small amount of starch (3%) to prevent caking. It is also available in a pure form without this anti-caking starch.</p>\r\n<p><em>Invert Sugar</em></p>\r\n<p>It is a product of sugar refining. It is chemically processed heavy syrup where a sucrose solution is heated with an acid. Invert sugar resists crystallization, promoting smoothness in candies, icings, and syrups. It also holds moisture especially well, retaining freshness and moisture in products.</p>\r\n<p><em>Molasses</em></p>\r\n<p>It is a concentrated sugar cane juice. It contains large amounts of sucrose and other sugars including invert sugar. It also contains acids, moisture and other constituents that give it flavor and color. Darker grades are stronger in flavor and contain less sugar than lighter grades. Molasses retains moisture in baked goods, prolonging their freshness.</p>\r\n<p>&nbsp;</p>\r\n<h3>Syrup</h3>\r\n<p><em>Corn Syrup</em></p>\r\n<p>It is a liquid sweetener consisting of water, a vegetable gum called dextrin and variou sugars, primarily dextrose, also called glucose. Corn syrup is made by convertin cornstarch into simpler compounds using enzymes. Corn syrup aids in retainin moisture and is used in some icings, sweets, and sugar boiling. It keeps other sugal from recrystallizing. It is added to marzipan to improve elasticity. It has a mild flavor ar is not as sweet as sucrose.</p>\r\n<p><em>Glucose Syrup</em></p>\r\n<p>It is a viscous colorless syrup (44&deg; Baume). Glucose has a stabilizing effect to help prevent re-crystallizations when sugar is boiled to high temperatures, pulled, and blown sugar making the boiled sugar more elastic. It is also used in cakes and biscuits. Glucose should not be stored at temperatures above 20&deg;C because it will change in color. Glucose can be replaced with light corn syrup.</p>\r\n<p><em>Honey</em></p>\r\n<p>It was the first sugar to be used by man. It is the nectar collected from bees and deposited in their honeycomb. Nectar contains about 80% water and 20% sugar together with essential oils and aromatic compounds that are responsible for the bouquet of honey, the flavor varying from the flowers from which the nectar was gathered. The darker the color of the honey the stronger its flavor; it is a natural sugar syrup consisting largely of glucose, fructose and other compounds that give it is flavors. Flavor is the main reason for using honey. Honey contains invert sugar which helps retain moisture in baked goods and gives a soft chewy texture to cakes and cookies and is baked at a lower temperature so the invert sugars can caramelize. Honey contains acid which enables it to be used with baking soda as a leavening.</p>\r\n<p>&nbsp;</p>\r\n<h3>Functions of Egg for Dessert Production</h3>\r\n<table style=\"border-collapse: collapse; width: 100.048%; height: 512px;\" border=\"1\"><colgroup><col style=\"width: 49.8801%;\"><col style=\"width: 49.8801%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 36px;\">\r\n<td>Technique</td>\r\n<td>Description</td>\r\n</tr>\r\n<tr style=\"height: 80.8px;\">\r\n<td>Thicken</td>\r\n<td>When heated, egg coagulates and holds liquid in a suspension</td>\r\n</tr>\r\n<tr style=\"height: 103.2px;\">\r\n<td>Bind</td>\r\n<td>When wet, the food items stick together. When cooked, the egg sets and keeps the food together</td>\r\n</tr>\r\n<tr style=\"height: 58.4px;\">\r\n<td>Glaze</td>\r\n<td>Beaten egg gives a shiny appearance</td>\r\n</tr>\r\n<tr style=\"height: 125.6px;\">\r\n<td>Aerate</td>\r\n<td>When whipped, the egg traps millions of tiny air cells within itself. Air bubbles help to raise other ingredients</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Emulsify&nbsp;</td>\r\n<td>Yolks can bind together to un-mixable ingredients</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Clarify</td>\r\n<td>Whites are used to clarify stocks</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Enrich</td>\r\n<td>Adds flavor and nutrition</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>Dairy Products</h3>\r\n<p><em>Milk</em></p>\r\n<p>It may form the foundation of many dishes irrespective if it is whole, skim or fat reduced, long life, evaporated, condensed, or even powdered. It is often used in cakes to thin the cake batter and create steam during the baking process, acting as a raising agent.</p>\r\n<p><em>Buttermilk</em></p>\r\n<p>It produces very light, delicious results in scones, pancakes, pikelets muffins etc. Buttermilk has a fresh, slightly sharp, acid flavor and is used to counteract the bitter, soapy alkaline flavor, bicarbonate of soda leaves in many baked goods.</p>\r\n<p><em>Cream</em></p>\r\n<p>It is the fat component of milk and varies enormously in richness, texture, and lusciousness.</p>\r\n<p><em>Clotted cream</em></p>\r\n<p>It is the thickest cream is at 55% fat.</p>\r\n<p><em>Pure Cream</em></p>\r\n<p>It is at 48% fat. Pure cream and clotted cream may be served in dollop form accompanying berry fruits, scones etc. These creams do not aerate when whipped.</p>\r\n<p><em>Thickened cream</em></p>\r\n<p>It is 35% fat content. This cream may be whipped to trap air because it contains a gelling agent, \"vegetable gum\", gelatin has also been used but has been replaced to appeal to a broader market. Chilled thickened cream whips until it stands in peaks; there are soft peaks to fold into mousses, bavarois, and firm peaks for piping rosettes of cream on to a gateau. The over whipping of cream will result in the product \"splitting\" (separation of the fat and water). Cream with a high fat content is more susceptible to this occurring. Thickened cream needs to be kept chilled at 4&deg;C until required to be whipped. The warmer the cream, the greater the possibility of its \"splitting\".</p>\r\n<p><em>Reduced and light cream</em></p>\r\n<p>It ranges from 25%-18% fat and it will not whip because there is insufficient fat to trap air bubbles and thicken it. It is used as a pouring cream; it can replace milk in desserts to enrich them and is useful for people on fat reduced diets.</p>\r\n<p><em>Yoghurt</em></p>\r\n<p>It is a very healthy alternative to cream. It has many health properties as it contains a culture and usually contains very little saturated fat. It may be used in a yoghurt based bavarois, sorbet, Panna cotta, ice-cream or as a cream substitute. It is available plain, flavored, or frozen.</p>\r\n<p><em>Cr&egrave;me Fraiche</em></p>\r\n<p>In France this is standard fresh French cream. However, in Australia it contains a culture. The cream is naturally thick due to lactic acid bacteria in it which also produces a nutty flavor. It has a butter fat content of approx. 35% fat. The higher fat content makes it ideal for cooking; it may be used in some sauces without the risk of separating. It is often served as a dollop form with fresh sweetened berries.</p>\r\n<p><em>Butters</em></p>\r\n<p>Butter, available in salted or unsalted forms, is preferred unsalted for greater control over salt content. Originally used as a preservative, it has a sweeter flavor than salted butter. Composed mainly of fat, water, protein, and sugars, it plays a crucial role in baking. In cake making, it traps air with sugar during creaming, providing lightness, flavor, and richness. In puff pastry, butter creates layers by trapping air, resulting in crispness. It also tenderizes baked goods by coating gluten strands. Butter enhances sauces, batters, and acts as a lubricant to prevent sticking in baking. Clarified butter is best for this purpose.</p>\r\n<p>&nbsp;</p>\r\n<h3>Oil</h3>\r\n<p>It is often used in baked goods as a healthy alternative to butter. This results in a moister product which lengthens their shelf life. Many delicately flavored oils like almond oil may also be used for lubrication purposes. One of the benefits of this is it leaves the baked goods/dessert with sheen. Cooking sprays are very convenient to use because it is easier to spray a fancy cake form than to brush with clarified butter. However, these products are expensive and extremely flammable.</p>\r\n<p><em>Storage</em></p>\r\n<p>Both oils and sprays should be kept in very dry cool conditions away from UV light and warmth which will facilitate rancidity, especially in oils. Oils are best kept in airtight, colored glass containers. Spray oils should not be used on non-stick surfaces and the chemical propellant has a detrimental effect on the surface coating.</p>\r\n<p>&nbsp;</p>\r\n<h3>Cheese</h3>\r\n<p><em>Bakers Cheese</em></p>\r\n<p>A fresh (unripen) cheese with a low-fat content, it is like cottage cheese, but it does not have curds and its flavor is a bit sourer. Baker\'s cheese is used in cheesecakes and cheese fillings for pastries. It can be frozen.</p>\r\n<p><em>Cottage Cheese</em></p>\r\n<p>It is a lumpy, soft white cheese that can be purchased with small or large curds. It is often made with skimmed pasteurized cow\'s milk. It can be used as a low-fat alternative to cream cheese as well as for pancake and crepe fillings. It is also known as curd cheese.</p>\r\n<p><em>Ricotta Cheese</em></p>\r\n<p>It is from Italy. The word means re-cooked and its origins are in Rome and connected to the making of Romano and Mozzarella. Ricotta was first made from the whey that was left after the curds from these cheeses had been strained. Until about a century ago, this whey was discarded. It is now produced commercially made with whole milk rather than whey.</p>\r\n<p><em>Cream Cheese</em></p>\r\n<p>It has a mildly tangy, spreadable cheese with a smooth, creamy texture. This soft, unripen cheese is made from cow\'s milk cultured with bacteria. It is a popular ingredient for many types of cheesecakes, pastry doughs, tarts, and cookies.</p>\r\n<p><em>Goats Milk Cheese</em></p>\r\n<p>Known as Ch&egrave;vre in French, goat\'s milk cheese can range in texture from very dry and crumbly to moist and creamy. There are also fresh and ripened varieties.</p>\r\n<p><em>Mascarpone</em></p>\r\n<p>This product is traditionally a triple cream Italian cheese made from cow\'s milk. It originates from Tuscany and Lombardy; these days it is made in Australia and readily available in Italian specialty shops and large supermarket chains. This is a very rich cheese made from fresh cream derived from cow\'s milk. The cream is reduced to near triple cr&egrave;me consistency to give the cheese its soft, smooth, rich texture, with an extremely rich fat content of 25- 60%, depending on the manufacturer. It is best stored in the containers it is purchased in, refrigerated under 5&deg;C, ensuring the containers are tightly sealed. When opened it has a shelf life of only 1 week. Traditionally it was served sweetened, sprinkled with cinnamon, and served with fruit. Today, it is best known for its use in tiramisu, gelatin, for filling crepes, served with fresh figs, and makes beautifully rich cheesecakes. Mascarpone has the potential to separate very easily due to its very high fat content. For this reason, minimum mechanical agitation should be applied when working with mascarpone.</p>\r\n<p>&nbsp;</p>\r\n<h3>Nuts</h3>\r\n<p>Nuts are good source of protein, fiber, vitamins, and minerals. While nuts are high in fat, the fatty acids in nuts (except coconuts) are mostly polyunsaturated. This type of fat is considered desirable in our diets. Nuts vary in composition, but most nuts contain more fat than anything else. Nuts are most versatile in cooking. Varieties most used in hot and cold desserts include almonds, chestnuts, coconuts, hazelnuts, macadamias, peanuts, pecans, pistachios, and walnuts. They can be purchased in many forms including: fresh, in its kernel, salted or unsalted, loose or pre-packaged, whole, blanched, roasted, chopped, crushed, slivered, ground/meal, kibbled, paste or oil.</p>\r\n<p>&nbsp;</p>\r\n<h3>Types of Nuts</h3>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li><em>Almonds -&nbsp;</em>available natural (skin on) and blanched (skin off) in many forms: whole, split, silvered, chopped and ground / meal.</li>\r\n<li><em>Chestnuts -&nbsp;</em>must be cooked. They are available whole, frozen, glace and puree.</li>\r\n<li><em>Coconut -&nbsp;</em>available in many forms. Usually for the pastry kitchen, it is purchased as desiccated, shredded or flaked. Coconut can also be purchased fresh and is used for its milk, cream, or fresh shaved flakes for garnishes.</li>\r\n<li><em>Hazelnuts -&nbsp;</em>available natural (skin on) and blanched (skin off) in many forms: whole, split, chopped and ground / meal.</li>\r\n<li><em>Macadamias -&nbsp;</em>usually purchased whole or chopped with no skin.</li>\r\n<li><em>Pecans -&nbsp;</em>available whole with the skin on or chopped.</li>\r\n<li><em>Pecans -&nbsp;</em>available whole with the skin on or chopped.</li>\r\n<li><em>Peanuts -&nbsp;</em>available whole and crushed. They can be sold roasted and salted.</li>\r\n<li><em>Pistachios -&nbsp;</em>available in their skin whole and chopped, as well as blanched and then silvered. Blanched pistachios are bright green.</li>\r\n<li><em>Walnuts -&nbsp;</em>available whole, as halves, chopped and crushed. Many nuts are also available as a paste (e.g. almond, hazelnut and pistachio). These pastes are used in the pastry kitchen to produce many ice creams, mousses, cream desserts, petit fours and in cake production. The pastes tend to be quite expensive, however the flavor is very intense and only small amounts are required to achieve the desired taste.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3>Vanilla</h3>\r\n<p>Vanilla, sometimes called the orchid of flavor, is the most widely used flavoring agent in the pastry kitchen. Its uses are endless because its taste compliments just about every other flavor and improves many of them. Vanilla also has the distinction of being more expensive than any other flavoring or spice, except for saffron.</p>\r\n<p>Authentic vanilla bean is really the dried stamen from an exotic orchid grown in Mexico and parts of South America. The bean is also known as a pod. It should be dry, soft, a little ribbed and pointed at one end. When spilt open, the deliciously fragrant and sweet seeds are exposed and ready to be scrapped out. They may be used to infuse and perfume cr&egrave;me Anglaise, cr&egrave;me caramel, brulee, and many others.</p>\r\n<p>The pod, once used, may be washed, dried, and stored in sugar to again, impart its delightful heady perfume. The longer the vanilla is left in the sugar, the stronger the flavor (minimum 1 week).</p>\r\n<p>Vanilla may also be purchased in other forms, including:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li><em>Pure vanilla essence -&nbsp;</em>a flavoring agent made by aging a mixture of vanilla beans and alcohol. To be labelled as pure, it must contain a specified ratio of vanilla to alcohol.</li>\r\n<li><em>Imitation vanilla essence -&nbsp;</em>this is an inferior product to pure vanilla essence. It is made using vanillin.</li>\r\n<li><em>Vanillin -&nbsp;</em>fragrant, powdery white crystals that form on the outside of vanilla bean pods during their curing process. It is used to flavor artificial vanilla extract.</li>\r\n<li><em>Pure vanilla paste -&nbsp;</em>an intensely flavored thick paste made from vanilla beans.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3>Thickening Agents</h3>\r\n<p><em>Gelatin</em></p>\r\n<p>Gelatin is a setting agent made from the tendons and bones of calves, cows, and pigs, with most food grade gelatin being extracted from pigskin. Gelatin is a clear. Gelatin has many uses. It is a necessary ingredient in bavarois, fruit mousses, and cold souffl&eacute;s. It is a good stabilizer for whipped cream and many cake fillings and provides the characteristic texture of marshmallows and gummy confections. Gelatin is available in leaf (sheet) or powered form.</p>\r\n<p>To use gelatin, the required quantity must first be \"softened\" in cold water, and then added to a hot liquid to dissolve. If gelatin is boiled it may lose its setting qualities. Gelatin needs to be chilled to set the liquid; it will not set at room temperature.</p>\r\n<p>The various brands of gelatin require differing amounts to set an amount of liquid. Always follow the instructions on the packet; do not rely on the quantities set out in the recipe. Some fruits such as pineapple and pawpaw contain enzymes that affect the protein in gelatin, and it will not set.</p>\r\n<p>&nbsp;</p>\r\n<h3>Setting Strength of Gelatin</h3>\r\n<p>The setting strength of gelatin is referred to as \"bloom\".</p>\r\n<p>Silver - 150-160 bloom.</p>\r\n<p>Gold - 180-200 bloom.</p>\r\n<p>Bloom is not marked on the packet when you purchase. You will need to contact the manufacturer to get correct setting strength.</p>\r\n<p><em>Agar Agar</em></p>\r\n<p>Agar agar is a natural vegetable-based substance extracted from a type of Japanese seaweed and is used in the pastry kitchen to thicken and jell products in the same way as gelatin. It is available in its natural form of greenish strips, or as a fine white powder. The strips must be soaked for a minimum of 12 hours prior to use. The powder must be heated close to boiling point to dissolve fully and will set strongly when cooled. It is suitable for vegetarians and in kosher preparations. It has almost triple the strength of gelatin. Agar agar is principally used in the pastry industry for cream desserts, ice creams and sauces. Products set with agar agar will remain firm at room temperature, unlike those set with gelatin.</p>\r\n<p><em>Pectin</em></p>\r\n<p>Pectin is present in all fruits, but fruits vary in the amounts they contain. Fruits high in pectin include apples, plums, cranberries, raspberries, and citrus peel. These fruits can be made into jams and jellies without any added pectin. Pectin thickens, and in the presence of acid and high amounts of sugar, it gels. Pectin gels are clear, not cloudy and have an attractive sheen and clean flavor. Pectin is commonly used in glazes, jams and jellies, bakery fillings and fruit confections. It can be purchased as a dry powder, which is typically extracted and purified from citrus peel or apple skins.</p>\r\n<p><em>Tapioca</em></p>\r\n<p>Tapioca is virtually pure starch. It is extracted from the root of the tropical cassava or manioc plant. The word tapioca comes from a term used by the Brazilian natives meaning to press or squeeze out residue, about the way the starch (tapioca) is extracted. The roots are crushed and stepped in water, and the liquid is then pressed out. Tapioca is available in several forms, including pure starch or flour, quick cooking granules, flakes, and pearls. When the pearls are cooked, the tapioca does not dissolve completely; instead, the small particles become translucent and soft. Pearl tapioca must be soaked before cooking and is often used for tapioca pudding - a custard like dessert. Tapioca pudding is commonly found on Asian influenced dessert menus.</p>\r\n<table style=\"border-collapse: collapse; width: 100.048%; height: 341.6px;\" border=\"1\"><colgroup><col style=\"width: 49.976%;\"><col style=\"width: 49.976%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 36px;\">\r\n<td>Fruits</td>\r\n<td>Classification of Fruits</td>\r\n</tr>\r\n<tr style=\"height: 125.6px;\">\r\n<td>Soft fruits</td>\r\n<td>Strawberries, raspberries, blackberries, boysenberries, blueberries, gooseberries, grapes, currants</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Stone fruits</td>\r\n<td>Apricots, peaches, nectarines, plums, mangoes, cherries</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Hard fruits</td>\r\n<td>Apples, pears, quinces</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Citrus</td>\r\n<td>Lemons, oranges, grapefruit, mandarins, cumquats, limes, pomelo, tangelo</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Tropical</td>\r\n<td>Bananas, pineapple, lychee, rambutan, jackfruit, dragon fruit, guava, tamarillo, pawpaw, custard apple</td>\r\n</tr>\r\n<tr style=\"height: 36px;\">\r\n<td>Miscellaneous</td>\r\n<td>Rhubarb, kiwifruit, persimmon, passionfruit, pomegranate, fig, watermelon, cantaloupe, honeydew</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"border-collapse: collapse; width: 100.048%;\" border=\"1\"><colgroup><col style=\"width: 49.8801%;\"><col style=\"width: 49.8801%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>Fruits</td>\r\n<td>Quality of Fruits</td>\r\n</tr>\r\n<tr>\r\n<td>Soft fruits</td>\r\n<td>Mold free, Dirt free</td>\r\n</tr>\r\n<tr>\r\n<td>Stone fruits</td>\r\n<td>No bruising</td>\r\n</tr>\r\n<tr>\r\n<td>Hard fruits</td>\r\n<td>Mold free, Skin to be firm, not soft</td>\r\n</tr>\r\n<tr>\r\n<td>Citrus</td>\r\n<td>No bruising, Good color, Firm to touch</td>\r\n</tr>\r\n<tr>\r\n<td>Tropical</td>\r\n<td>Mold free, No bruising, Skin to be firm, not soft</td>\r\n</tr>\r\n<tr>\r\n<td>Miscellaneous</td>\r\n<td>Mold free, Not bruised, Melons should be heavier than they look</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><em>Purchasing of Fruits</em></p>\r\n<p>Fruits can be purchased in many forms as listed below with some examples:</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li><em>Fresh -&nbsp;</em>by variety, such as fuji apples, corella pears. Individually, kilo, punnets, tray, box, or case.</li>\r\n<li><em>Pre-prepared -&nbsp;</em>fruit salad, sliced mango, pineapple slices.</li>\r\n<li><em>Dried -&nbsp;</em>apple, apricot, banana, blueberry, cherry, citrus peel, cranberry, currant, date, fig, ginger, kiwifruit, mango, melon, mixed peel, muscatel, pawpaw, peach, pear, pineapple, plum, prune, raisin, sultana.</li>\r\n<li><em>Candied -&nbsp;</em>orange, cherries, pineapple, apricot.</li>\r\n<li><em>Canned -&nbsp;</em>apple, apricot, cherry, grapefruit, lychee, mandarin, mango, passion fruit, peach, pear, pineapple.</li>\r\n<li><em>Crystallized -&nbsp;</em>citrus peel.</li>\r\n<li><em>Frozen -&nbsp;</em>strawberries, raspberries, blackberries, boysenberries, blueberries, currants, and some Asian fruits.</li>\r\n<li><em>Bottled -&nbsp;</em>apricot, peach, plum, boysenberry, quince, cumquats.</li>\r\n<li><em>Freeze Dried -&nbsp;</em>intense flavor no moisture, difficult to store over time.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><em>Storage of Fruits</em></p>\r\n<p>Fruits contain a lot of sugar and have a soft cell structure. If the cell walls and skin of fruits are damaged, they are susceptible to an attack from airborne yeast and molds, which results in bruising. To retard yeast and mold attack, it is necessary for us to handle fruits carefully and cool store them.</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>The shelf life of most fresh fruit is prolonged through storage at 6 - 8&deg;C.</li>\r\n<li>Soft fruits and some stone fruits do not like prolonged periods in the fridge, as they are sensitive to chilling.</li>\r\n<li>Some fruits like banana are susceptible to discoloring when chilled and require storage at a warmer temperature such as the dry store. Some fruits such as citrus and hard fruits can be stored in the dry store; however, the shelf life is shortened.</li>\r\n<li>Some fruits such as citrus and hard fruits can be stored in the dry store; however, the shelf life is shortened.</li>\r\n<li>Fruits that need to ripen naturally can also be stored in the dry store in brown paper bags to increase the ripening process, e.g. stone fruits.</li>\r\n<li>Fruits should be stored away from strong smelling ingredients e.g. basil, parmesan cheese, garlic.</li>\r\n<li>It is best to eat fruits at room temperature as their flavors are more pronounced.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"what-desserts\">What are Desserts?</h3>\r\n<p>Desserts are considered as the grand finale of a meal. A dessert that is well presented and tastes delicious will leave a lasting impression of a great meal with a customer. Desserts are prepared by a pastry chef.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"importance-desserts\">Importance of Desserts</h3>\r\n<p>It is a sweet dish served at the end of the meal to balance out and give closure to the meal. It is an opportunity to taste different flavor and texture that other foods do not have. There is no such thing as fattening food. Desserts are not fattening. Eating desserts will make you feel like a kid again and it is romantic.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"classification-types\">Classification/Types of Desserts</h3>\r\n<p>Being familiar with the different categories of desserts will assist you in creating a well- balanced meal.</p>\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li style=\"list-style-type: none;\">\r\n<ol>\r\n<li>Fruit Desserts - poached, candied, caramelized or baked, marinated or macerated, and crispy dried.</li>\r\n<li>Pastry Desserts - puff, choux, short, filo/phyllo, and rough puff.</li>\r\n<li>Batters and Dumplings - crepes, pancakes, and fritters.</li>\r\n<li>Chocolate Desserts - mousse, souffle, tart, pudding, ice cream, chocolate pot, and garnishes.</li>\r\n<li>Frozen Desserts - bombes, parfaits, coupes, bombe Alaska, semi-freddo, ice cream, sherbets, sorbets, cr&egrave;me anglaise, granita, souffle glace, and frozen mousses.</li>\r\n<li>Cream Desserts - bavarois, pannacotta, and tiramisu.</li>\r\n<li>Baked Custards - cr&egrave;me brulee</li>\r\n<li>Pudding Desserts - starch-thickened and baked.</li>\r\n<li>Jelly Desserts</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<h3 id=\"types-sauce\">Types of Dessert Sauce</h3>\r\n<p><em>Caramel Sauces</em></p>\r\n<p>Caramel sauces are prepared by melting and caramelizing sugar to the desired color, then by adding a liquid (in most cases water) to thin it to a sauce like consistency. For the most basic caramel sauce nothing else is added. For a richer caramel sauce, cream and/or butter are incorporated (referred to as a butterscotch sauce). Other flavorings can be added to a basic caramel including spirits such as calvados and rum.</p>\r\n<p><em>Chocolate Sauces</em></p>\r\n<p>Chocolate sauces are of course, used extensively. They may be hot or cold, and either thin for masking a plate or very thick and rich, as a fudge sauce. A basic chocolate sauce is made from chocolate and/or cocoa powder, sugar and water cooked together. Richer versions contain the additions of cream and/or butter.</p>\r\n<p><em>Coulis</em></p>\r\n<p>In the pastry kitchen, the term coulis is used for berry juices and fruit purees that are sweetened as needed, usually strained, then served as sauces. The term coulis has been used for as long as 600 years to refer to strained gravy or broth served with savory dishes. It comes from an old French word \"coleis\", meaning straining, pouring, flowing, or sliding. Traditionally, coulis was neither thickened nor bound, however today it is common practice for them to be slightly thickened. A coulis most made from berries, usually raspberry as they are high in pectin. Pectin is an enzyme found in some fruits which assists in the thickening or setting of products. Raspberries are cooked with sugar and water then strained to remove the seeds and cooled. Coulis are usually served cold, as a sauce or part of a compote. A well-made coulis should not separate when poured on a plate, the sauce should be cooked sufficiently to enact the pectin and therefore thicken the sauce.</p>\r\n<p><em>Custard Sauces</em></p>\r\n<p>The foundational custard sauce is also known as vanilla custard sauce. It is considered the mother sauce of the pastry kitchen. Not only can many other custard sauces, such as chocolate or coffee flavored sauce, be prepared from this base, but the ingredients and method of preparation for cr&egrave;me Anglaise are the starting point for many other dessert preparations. Custard sauces are made by thickening milk, cream, sugar, and eggs using either direct heat or a Bain Marie.</p>\r\n<p><em>Fresh Cream or Sour Cream Sauces</em></p>\r\n<p>Cr&egrave;me fraiche, clotted cream and sour cream are all used as dessert sauces and toppings, sometimes thinned, and/or sweetened. They most frequently accompany fresh fruit but are also served with warm baked fruit desserts. These may be flavored with vanilla or a spice such as cinnamon. Fresh cream is used as a sauce both in the form of a heavy cream that is lightly thickened by whipping and whipped cream, or Chantilly cream, which is more of a topping.</p>\r\n<p><em>Sabayon Sauces</em></p>\r\n<p>Sabayon sauces can be hot or cold and are made by thickening wine by whipping it overheat together with egg yolks and sugar. Sabayon sauces are served with fruit and with souffl&eacute;s. Sabayon is also served as a dessert by itself. The Italian version of sabayon, zabaglione, is made with Marsala.</p>\r\n<p><em>Starch Thickened Sauces</em></p>\r\n<p>Most fruit sauces are thickened with starch. This can include cornstarch and arrowroot. They are generally cooked quickly to allow the starch to gelatinize and eliminate the raw starch taste. Fruit juice sauces thickened with corn flour will be cloudy. If made with arrowroot, they will be clearer and softer. Starches are also used to thicken sauces made of cream or milk and sauces based.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"techniques\">Techniques Used to Produce Quality Hot and Cold Desserts</h3>\r\n<p><em>Caramel Sauces</em></p>\r\n<p>Caramel sauces are prepared by melting and caramelizing sugar to the desired color, then by adding a liquid (in most cases water) to thin it to a sauce like consistency. For the most basic caramel sauce nothing else is added. For a richer caramel sauce, cream and/or butter are incorporated (referred to as a butterscotch sauce). Other flavorings can be added to a basic caramel including spirits such as calvados and rum.</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Beating - Mixing vigorously to incorporate air into an ingredient or mixture</li>\r\n<li>Whisking - using a whisk to incorporate air into liquids like cream and egg whites into meringues.</li>\r\n<li>Folding - gentle movement that incorporates one product into another. Fold nuts into cream. Fold sugar into meringue.</li>\r\n<li>Baking - subjecting unbaked product to heat in an enclosed area such as an oven</li>\r\n<li>Whipping - same as whisking</li>\r\n<li>Blending - combining two or more ingredients</li>\r\n<li>Boiling - subjecting food to heat while being completely submerged in liquid</li>\r\n<li>Poaching - subjecting food to heat in liquid that is hot, but not moving; food needs to be totally submerged at a temperature of 90 to 93&deg;C</li>\r\n<li>Steaming - subjecting food to heat in vapor of boiling liquid from below</li>\r\n<li>Enrobing - completely covering product; pouring ganache over the top, allowing ganache to flow down the side to completely cover the cake; to dip in chocolate to completely cover all sides</li>\r\n<li>Churning - continual mixing of a liquid until an outcome is achieved</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>'),
(83, 8, 'Preparation of Egg Dishes', '<p>Among all the ingredients that you can find in the kitchen, egg is the most versatile one because it can be prepared and cooked in so many ways. Chicken eggs is the most used because of its blandness, availability, and variety of size. It contains a large amount of protein which coagulated when heated. Eggs should be cooked slowly with moderate</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"functions-eggs\">Functions of Eggs</h3>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Aerating - for sponges, cakes, meringue</li>\r\n<li>Clarifying - for consomm&eacute;</li>\r\n<li>Emulsifying - for mayonnaise, hollandaise</li>\r\n<li>Thickening - for cr&egrave;me anglaise</li>\r\n<li>Binding - for patties</li>\r\n<li>Glazing - for egg wash</li>\r\n<li>Enriching - as a liaison</li>\r\n<li>Setting - for cr&egrave;me Brulee</li>\r\n<li>Coating - for paner a l\'anglaise</li>\r\n<li>Garnishing - for nicoise and Caesar salads</li>\r\n<li>Egg dishes - such as an omelet, eggs benedict; and</li>\r\n<li>Sous vide - various</li>\r\n<li>Other - shakes and smoothies, eggnog, egg-milk punch.</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p><br><br></p>\r\n<h3 id=\"composition-egg\">Composition of an Egg</h3>\r\n<h3 id=\"boiling-eggs\">Boiling Eggs</h3>\r\n<p>The porous quality of the eggshell makes it possible to be cooked by boiling them. The doneness of the eggs depends on the preferred cooking time.</p>\r\n<table style=\"border-collapse: collapse; width: 100.048%;\" border=\"1\"><colgroup><col style=\"width: 49.8801%;\"><col style=\"width: 49.8801%;\"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center;\"><strong>Cooking Time </strong></td>\r\n<td style=\"text-align: center;\"><strong>Doneness </strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\">2 to 3 minutes</td>\r\n<td style=\"text-align: center;\">Soft Boiled</td>\r\n</tr>\r\n<tr style=\"text-align: center;\">\r\n<td>5 to 6 minutes</td>\r\n<td>Medium Boiled</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\">8 to 10 minutes</td>\r\n<td style=\"text-align: center;\">Hard Boiled</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3 id=\"poaching-eggs\">Poaching Eggs</h3>\r\n<p>We can consider poaching eggs healthier in terms of preparation because it does not use fat. A well-poached egg is compact, round-shaped, firm but tender white, and has bright and shiny appearance.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"frying-eggs\">Frying Eggs</h3>\r\n<p>We can consider poaching eggs healthier in terms of preparation because it does not use fat. A well-poached egg is compact, round-shaped, firm but tender white, and has bright and shiny appearance.</p>\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li style=\"list-style-type: none;\">\r\n<ul>\r\n<li>Sunny side Up - slowly cooked without flipping the egg until white is completely set and the yolk is still soft and yellow</li>\r\n<li>French - fry and flip over until the white is just set and the yolk is still liquid</li>\r\n<li>Emulsifying - for mayonnaise, hollandaise</li>\r\n<li>Over-easy - cook until the edges of the egg are brown without flipping</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h3 id=\"shirred-eggs\">Shirred Eggs</h3>\r\n<p>These eggs are baked in individual serving dishes and garnished with different meats and sauces.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"scrambled-eggs\">Scrambled Eggs</h3>\r\n<p>Scrambled eggs when overcooked becomes tough, watery, and turns green when hold for a long time. This should be soft and moist unless the request from the customer is scrambled hard.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"omelet\">Omelet</h3>\r\n<p>This is a dish from beaten egg, cooked until set, and folded with filling.</p>\r\n<p>&nbsp;</p>\r\n<h3 id=\"souffle\">Souffle</h3>\r\n<p>Souffle is a dish made with eggs and combined with other ingredients that can be served as savory dish or a sweet dessert. This is an important egg preparation that one should be familiar of.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_progress`
--

CREATE TABLE `lesson_progress` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `progress` varchar(100) NOT NULL DEFAULT 'incomplete',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lesson_progress`
--

INSERT INTO `lesson_progress` (`id`, `lesson_id`, `user_id`, `progress`, `updated_at`) VALUES
(28, 1, 112, 'complete', '2024-11-23 18:24:20'),
(29, 2, 112, 'complete', '2024-11-23 18:24:28'),
(30, 2, 75, 'complete', '2024-11-23 18:25:12'),
(32, 5, 75, 'complete', '2024-11-23 18:49:45'),
(33, 4, 75, 'complete', '2024-11-23 18:49:49'),
(43, 8, 75, 'complete', '2024-11-24 22:21:50'),
(44, 4, 112, 'complete', '2024-11-25 17:26:31'),
(45, 5, 112, 'complete', '2024-11-25 18:24:29'),
(46, 8, 112, 'complete', '2024-11-25 18:25:45'),
(47, 1, 114, 'complete', '2024-11-25 20:24:24'),
(48, 4, 114, 'complete', '2024-11-25 20:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_results`
--

CREATE TABLE `lesson_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `progress_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `user_id`, `lesson_id`, `progress_status`) VALUES
(4, 112, 3, 'completed'),
(5, 112, 4, 'completed'),
(6, 112, 5, 'completed'),
(7, 75, 4, 'completed'),
(8, 75, 5, 'completed'),
(9, 114, 4, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `progress123`
--

CREATE TABLE `progress123` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'NOT TAKEN',
  `status_vlab` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `assessment_id` int(11) DEFAULT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_appetizers`
--

CREATE TABLE `quiz_appetizers` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(5) NOT NULL,
  `quiz_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_appetizers`
--

INSERT INTO `quiz_appetizers` (`id`, `questions`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `quiz_name`) VALUES
(9, 'What are canapés?', 'Small portions of Spanish dishes', 'Traditional Italian appetizers', 'Open-faced, bite-sized sandwiches', 'Cold seafood appetizers', '3', 'Appetizers'),
(10, 'What should you do to prevent canapés from becoming soggy?', 'Use dry bread as a base', 'Assemble as close to serving time as possible', 'Use thicker spreads', 'Store them at room temperature', '2', 'Appetizers'),
(11, 'Which of the following is a common ingredient for preparing appetizers?', ' Fresh fruit juice', 'Pita bread', 'Sweetened condensed milk', 'Steamed vegetables', '2', 'Appetizers'),
(12, 'What are the three main components of a canapé?', 'Base, sauce, filling', 'Bread, filling, garnish', 'Base, spread, garnish', 'Spread, protein, vegetable', '3', 'Appetizers'),
(13, 'What should be considered when plating appetizers?', 'The base should be large enough for multiple bites', 'The visual appeal of the dish is more important than its flavor', 'Spreads and garnishes should have complementary flavors', 'Canapés should be arranged in a stacked presentation only', '3', 'Appetizers'),
(14, 'What is the main difference between hot and cold tapas?', 'Hot tapas are always grilled', 'Cold tapas include dishes like gazpacho and Spanish tortilla', 'Hot tapas are always seafood-based', 'Cold tapas are served with bread only', '2', 'Appetizers'),
(15, 'Which of the following is an example of a spread and garnish combination for canapés?', 'Tuna salad and grapes', 'Lemon butter and caviar', 'Horseradish butter and smoked turkey', 'Cream cheese and olives', '2', 'Appetizers'),
(16, 'Which plating style refers to marinated meats and vegetables served on sticks?', 'Balls', 'Stacked', 'Skewered', 'Arranged in cups', '3', 'Appetizers'),
(17, 'What does the acronym SHIFT stand for in appetizer plating?', 'Size, Height, Interest, Flavor, Temperature', 'Shape, Height, Interest, Flavor, Taste', 'Simplicity, Height, Ingredient, Flavor, Taste', 'Stability, Height, Ingredient, Freshness, Taste', '2', 'Appetizers'),
(18, 'What is important when storing appetizers with spreads or sauces?', 'Store them at room temperature', 'Assemble and store appetizers well in advance', 'Use airtight containers for storage', 'Avoid using fresh vegetables', '3', 'Appetizers');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `selected_option` int(11) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_desserts`
--

CREATE TABLE `quiz_desserts` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(5) NOT NULL,
  `quiz_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_desserts`
--

INSERT INTO `quiz_desserts` (`id`, `questions`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `quiz_name`) VALUES
(14, 'What is vanilla also known as?', 'The spice of life', 'The bean of sweetness', 'The orchid of flavor', 'The flower of sweetness', '3', 'Desserts'),
(15, 'What is vanilla bean really?', 'The dried leaves of a plant', 'The dried stamen from an exotic orchid', 'The seeds from a tropical tree', 'The sap from a fruit', '2', 'Desserts'),
(16, 'Where is the vanilla bean grown?', 'Madagascar and India', 'Hawaii and Brazil', 'Mexico and parts of South America', 'Indonesia and Africa', '3', 'Desserts'),
(17, 'What is imitation vanilla essence made from?', 'Natural vanilla beans', 'Vanillin', 'Alcohol and water', 'Pure vanilla extract', '2', 'Desserts'),
(18, 'What does pure vanilla paste consist of?', 'Vanilla extract and sugar', 'Vanilla beans and water', 'Vanilla beans and thickening agents', 'An intensely flavored thick paste made from vanilla beans', '4', 'Desserts'),
(19, 'What is gelatin made from?', 'Fish bones and shells', 'Seaweed', 'Tendons and bones of calves, cows, and pigs', 'Coconut milk and sugar', '3', 'Desserts'),
(20, 'What must be done to gelatin before use?', 'It must be boiled', 'It must be blended with oil', 'It must be softened in cold water', 'It must be frozen', '3', 'Desserts'),
(21, 'What happens to gelatin if boiled?', 'It thickens quickly', 'It loses its setting qualities', 'It becomes sweeter', 'It turns into a syrup', '2', 'Desserts'),
(22, 'What is agar agar?', 'A type of plant-based sugar', 'A natural vegetable-based substance extracted from seaweed', 'A synthetic thickening agent', 'A protein found in dairy products', '2', 'Desserts'),
(23, 'What is the setting strength of gelatin called?', 'Bloom', 'Firmness level', 'Starch level', 'Gel point', '1', 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_egg`
--

CREATE TABLE `quiz_egg` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(5) NOT NULL,
  `quiz_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_egg`
--

INSERT INTO `quiz_egg` (`id`, `questions`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `quiz_name`) VALUES
(12, 'Why are chicken eggs the most commonly used in the kitchen?', 'They are colorful and small', 'They contain less protein', 'They are bland, widely available, and come in various sizes', 'They are harder to cook than other eggs', '3', 'Egg'),
(13, 'What happens to the protein in eggs when they are heated?', 'It evaporates', 'It coagulates', 'It dissolves', 'It ferments', '2', 'Egg'),
(14, 'Which cooking method involves using no fat and results in a compact, firm white with a tender texture?', 'Frying', 'Poaching', 'Scrambling', 'Shirring', '2', 'Egg'),
(15, 'Which egg preparation technique is used to make mayonnaise and hollandaise sauce?', 'Thickening', 'Emulsifying', 'Clarifying', 'Glazing', '2', 'Egg'),
(16, 'What is the proper cooking time for medium-boiled eggs?', '2 to 3 minutes', '4 to 5 minutes', '5 to 6 minutes', '8 to 10 minutes', '3', 'Egg'),
(17, 'What happens when scrambled eggs are overcooked?', 'They become fluffy and moist', 'They turn green and become tough and watery', 'They solidify but stay soft', 'They develop a crust', '2', 'Egg'),
(18, 'What is the term for using eggs to add a shiny coating to food, such as for baking?', 'Aerating', 'Glazing', 'Garnishing', 'Enriching', '2', 'Egg'),
(19, 'What is the setting time for a hard-boiled egg?', '2 to 3 minutes', '5 to 6 minutes', '8 to 10 minutes', '12 to 15 minutes', '3', 'Egg'),
(20, 'What is a souffle made from?', 'Whipped egg whites combined with cheese', 'Beaten eggs and other ingredients, served as savory or sweet', 'Scrambled eggs with vegetables', 'Soft boiled eggs served in a sauce', '2', 'Egg'),
(21, 'What type of egg dish is an omelet?', 'A dish of beaten eggs, cooked and folded with filling', 'A dish made with poached eggs served with sauce', 'A type of hard-boiled egg cooked in spices', 'A scrambled egg cooked for a long time', '1', 'Egg');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_food_safety`
--

CREATE TABLE `quiz_food_safety` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(5) NOT NULL,
  `quiz_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_food_safety`
--

INSERT INTO `quiz_food_safety` (`id`, `questions`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `quiz_name`) VALUES
(15, 'What is the purpose of a chef\'s toque?', 'To keep hair out of food ', 'To protect hands from heat ', 'To keep the uniform clean', 'To measure ingredients', '1', 'Food Safety'),
(16, 'According to the Food Temperature Danger Zone, at which temperature range does bacteria multiply rapidly?', '-18°C to 0°C', '4°C to 60°C', '60°C to 74°C ', '0°C to 4°C', '2', 'Food Safety'),
(17, 'In a three-compartment sink, what is the purpose of the third compartment?', 'Washing with detergent', 'Rinsing with hot water', 'Sanitizing with a solution', 'Air drying dishes', '3', 'Food Safety'),
(18, 'What should you avoid doing when washing red meat such as lamb or beef?', 'Rinsing in running water', 'Soaking the meat', 'Letting it drip dry', 'Using salt', '2', 'Food Safety'),
(19, 'How should mussels and clams be cleaned?', 'Rinse in cold water with lemon', 'Soak in water with cornstarch', 'Scrub the shell and rinse in slow running water', 'Clean with salt and vinegar solution', '3', 'Food Safety'),
(20, 'Which of the following is NOT an essential hygienic practice in the kitchen?', 'Bathe daily and wear clean clothes', 'Always wear jewelry while handling food', 'Wash hands before preparing food', 'Remove all jewelry when handling food', '2', 'Food Safety'),
(21, 'What is the best practice for cleaning utensils before plating food?\r\n', 'Rinse them under cold water only', 'Wash them with warm water and soap, then sanitize', 'Wipe them with a damp cloth', 'Soak them in vinegar', '2', 'Food Safety'),
(22, 'What should you do if you have symptoms like diarrhea or vomiting?', 'Wash your hands thoroughly and continue working', ' Wear gloves and continue cooking', 'Notify your supervisor and stay home until cleared by a doctor', 'Only avoid working with raw ingredients', '3', 'Food Safety'),
(23, 'Which personal protective equipment (PPE) is specifically used to protect hands from heat?', 'Apron', 'Chef\'s Uniform', 'Gloves', 'Oven Mitts', '4', 'Food Safety'),
(24, 'What is the primary reason for storing raw and cooked foods separately?', 'To prevent cross-contamination', 'To preserve the flavor of each type of food', 'To keep cooked food warm', 'To ensure proper seasoning', '1', 'Food Safety');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_funda_cookery`
--

CREATE TABLE `quiz_funda_cookery` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(5) NOT NULL,
  `quiz_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_funda_cookery`
--

INSERT INTO `quiz_funda_cookery` (`id`, `questions`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `quiz_name`) VALUES
(135, 'What is the difference between weight ounces and volume ounces?', 'Weight ounces are used for fluids, and volume ounces for dry goods.', 'Weight ounces are for dry goods, and volume ounces are for fluids.', 'Both are the same and can be used interchangeably.', 'Weight ounces are larger than volume ounces.', '2', 'Fundamentals of Cookery'),
(136, 'How many tablespoons (tbsp) are in 1 cup?', '8 tbsp', '16 tbsp', '12 tbsp', '32 tbsp', '2', 'Fundamentals of Cookery'),
(137, 'Which of the following is NOT a measuring device used in the kitchen?', 'Ladle', 'Saucepan', 'Thermometer', 'Measuring Spoons', '2', 'Fundamentals of Cookery'),
(138, 'Convert 50°C to Fahrenheit', '122°F', '86°F', ' 104°F', '72°F', '2', 'Fundamentals of Cookery'),
(139, 'Which of the following tools is used to cut vegetables with precision and uniformity?', 'Mandoline', 'Skimmer', 'Pie server', 'Wire whisk', '1', 'Fundamentals of Cookery'),
(140, 'A recipe calls for 500 milliliters of water. How many cups would this be?', '2 cups', '4 cups', '1 ½ cups', '1 cup', '1', 'Fundamentals of Cookery'),
(141, 'What is the proper tool to use when peeling fruits and vegetables?', 'Clam knife', 'Boning knife', 'Chef\'s knife', 'Vegetable peeler', '4', 'Fundamentals of Cookery'),
(142, 'What is the name of the cooking tool used to separate solid food from liquids or finer particles?', 'Strainer', 'Sifter', 'Rubber spatula', 'Ball cutter', '1', 'Fundamentals of Cookery'),
(143, 'If a kitchen staff needs to increase a recipe size, what skill should they have?', 'Measuring ingredients', 'Using different types of ovens', 'Knife skills', 'Measurement conversion', '4', 'Fundamentals of Cookery'),
(145, 'How many fluid ounces are in 1  cup?', '16 fl oz', '8 fl oz', '12 fl oz', '4 fl oz', '2', 'Fundamentals of Cookery');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lesson` varchar(255) DEFAULT NULL,
  `total_questions` int(11) DEFAULT NULL,
  `correct_answers` int(11) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `quiz_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `lesson`, `total_questions`, `correct_answers`, `score`, `quiz_date`) VALUES
(141, 67, 'quiz_food_safety', 10, 9, 90.00, '2024-09-17 14:42:30'),
(142, 67, 'quiz_appetizers', 10, 6, 60.00, '2024-09-17 14:42:51'),
(143, 72, 'quiz_appetizers', 10, 0, 0.00, '2024-09-27 16:35:15'),
(144, 72, 'quiz_funda_cookery', 10, 2, 20.00, '2024-09-27 16:37:26'),
(145, 69, 'quiz_funda_cookery', 10, 5, 50.00, '2024-09-28 07:10:38'),
(146, 73, 'quiz_funda_cookery', 10, 3, 30.00, '2024-10-08 05:06:31'),
(147, 75, 'quiz_funda_cookery', 10, 3, 30.00, '2024-10-11 10:43:42'),
(148, 75, 'quiz_salads', 10, 2, 20.00, '2024-10-17 15:24:58'),
(149, 76, 'quiz_food_safety', 10, 2, 20.00, '2024-10-22 14:09:32'),
(150, 104, 'quiz_funda_cookery', 10, 3, 30.00, '2024-10-28 05:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_salads`
--

CREATE TABLE `quiz_salads` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(5) NOT NULL,
  `quiz_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_salads`
--

INSERT INTO `quiz_salads` (`id`, `questions`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `quiz_name`) VALUES
(8, 'What is the primary function of a salad served as an appetizer?', 'To cleanse the palate after a meal', 'To accompany the main course', 'To stimulate the appetite before the meal', 'To serve as a dessert', '3', 'Salads'),
(9, 'Which salad component is used as the base of the dish?', 'Protein', 'Salad greens', 'Garnish', 'Dressing', '2', 'Salads'),
(10, 'What kind of salad is designed to cleanse the palate before dessert is served?', 'Appetizer', 'Separate course', 'Main course', 'Accompaniment', '2', 'Salads'),
(11, 'Which type of salad dressing is made from a permanent emulsion?', 'Vinaigrette', 'Oil and vinegar-based dressing', 'Mayonnaise-based dressing', 'Cream-based dressing', '3', 'Salads'),
(12, 'Which of the following is an example of a compound salad?', 'Caesar salad', 'Mixed green salad', 'Chef\'s salad', 'Potato salad', '4', 'Salads'),
(13, 'What is the primary reason for shaking an oil and vinegar-based dressing before serving?', 'To enhance flavor', 'To mix the separated ingredients', 'To create a creamy texture', 'To reduce acidity', '2', 'Salads'),
(14, 'Which salad is known for using cooked protein, starch, and vegetables held together by mayonnaise?', 'Caesar salad', 'Compound salad', 'Fruit salad', 'Composed salad', '2', 'Salads'),
(15, 'What type of dressing is typically used for green salads?', 'Mayonnaise-based dressing', 'Cream-based dressing', 'Vinaigrette', 'Fruit puree', '3', 'Salads'),
(16, 'What is the role of a garnish in a salad?', 'To add texture and moisture', 'To provide a base for the body', 'To add visual appeal and enhance flavor', 'To replace the dressing', '3', 'Salads'),
(17, 'What is a composed salad characterized by?', 'All components are tossed together before serving', 'Components are arranged separately on the plate', 'Only raw ingredients are used', 'It is served only as a side dish', '2', 'Salads');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_number` bigint(20) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(64) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_number`, `last_name`, `first_name`, `username`, `email`, `password`, `reg_date`, `reset_token`, `token_expiry`) VALUES
(70, 2018130117, 'Villarias', 'Ian Howell', 'Naaaiii', 'naitaixD.132@gmail.com', '$2y$10$vV3m7ajWMMKG6xJYdSPhXOoejnhfzByrq37xb1l6na7vONuw39loK', '2024-09-25 03:41:36', NULL, NULL),
(73, 2020000505, 'Magbanua', 'Rhaicel Anne', 'rhaicelanne', 'magbanuarhaicelanne@gmail.com', '$2y$10$xJXKoasHhkowPZo25n0gFu1l5WKu2sqwCxMok9Ui6SYznt.e.Od1i', '2024-10-08 05:02:22', NULL, NULL),
(74, 2018137916, 'Aquino', 'Jose Martin Edward', 'edwardaquino12', 'theedwardaquino12@gmail.com', '$2y$10$JJ6dV2gdk4UR35cy3spTHelT7djk9LZMwRC9P43zEpjTYL.MvdxkC', '2024-10-11 06:44:39', NULL, NULL),
(75, 2019136078, 'Sosa', 'jermaine isaiah', 'jerm', 'jermaineisaiah@gmail.com', '$2y$10$3f0fATzghDLWK79.6dl49uCLotMUA2iocYVnrBIWSRgt1V.O0zFx2', '2024-10-11 10:14:57', NULL, NULL),
(76, 2020101601, 'Ponce', 'Carlos', 'caponce21', 'caponce90@gmail.com', '$2y$10$30kXubGhgAGcK2xXSHa3BOMCYxURdLGM4h3iuYw7AwqUuPYB0HIaC', '2024-10-11 10:31:29', NULL, NULL),
(77, 2020000506, 'Flores', 'Marcus', 'marcusflor', 'marcusflor280@gmail.com', '$2y$10$rjq4g3Xa38auNequnyT1Ou8rrzgnsuAfr1V.26C60V2CIM.JLEZE.', '2024-10-15 12:36:06', NULL, NULL),
(78, 2020000515, 'Gines', 'Sean Harley', 'seanharley', 'ginesseanharley@gmail.com', '$2y$10$.RJkFXi9VnlJnseuR88veujs84BDPlccqIeLhF7rJdhpuublUbL5u', '2024-10-15 12:49:39', NULL, NULL),
(79, 2020000510, 'Calderon', 'Kevin Durell', 'KDCalderon', 'calderonkevindurell@gmail.com', '$2y$10$gVClo7rGAW4w0bNpYbhHWOS4dP.DKwmzQi0u2ir/x22bN7yukp/vi', '2024-10-15 12:51:52', NULL, NULL),
(80, 2020000518, 'bolanos', 'ethan', 'ethanbolanos12', 'bolanosethanneil@gmail.com', '$2y$10$DLHvdJMtd2.MgPi6rX7oXe.w6ZbpT1FUPp8B/Kfs3uRE2.rSZ2dCG', '2024-10-15 13:02:24', NULL, NULL),
(81, 2020000512, 'Vizcarra', 'Gabby', 'vizcarragabby19', 'vizcarragabby19@gmail.com', '$2y$10$PSMJym3XcG/70O6vuiPxOetEAIgDAGG691qk9BVGTaPD/BPpHvRiK', '2024-10-15 13:07:52', NULL, NULL),
(82, 2020000519, 'Sanga', 'Gabriel Cody', 'GCS2007', 'sgabrielcody@gmail.com', '$2y$10$3hOI.cafghtdGTcBSgnTOuh1zmzV2s74w5tgxP3n1OrXSAyXV3GMm', '2024-10-15 13:11:43', NULL, NULL),
(83, 2020000520, 'Quijamo', 'Stressa Eir', 'StresseirQ', 'quijamostressaeir@gmail.com', '$2y$10$R0hkRutQ4r35JypC/kjFGem8ItcYDQzHSzt6UmV7g3NCaE8eUSX1a', '2024-10-15 13:17:26', NULL, NULL),
(84, 2020000507, 'Luna', 'Mico Antonio', 'micaluna', 'micoantonioluna007@gmail.com', '$2y$10$KfLiOaB2OLBUgxiLwUDPXOXIP/3TQfzt6Unt6VkonvFcMoayJ0Qi6', '2024-10-15 13:21:22', NULL, NULL),
(85, 2020000508, 'Manzano', 'Alexandra', 'alexmzooo', 'manzanoalexandra21@gmail.com', '$2y$10$trRn3.va/02/bgDoy3AOLuvXWJatFB9OzU548RYKmiUKEdYAkxWqK', '2024-10-15 13:35:52', NULL, NULL),
(86, 2020000509, 'villaflor', 'raine', 'rainegoaway', 'raine8086@gmail.com', '$2y$10$F1uiH7wB7OnceKTQPnnJlOvfgUC6UaVrvs2Y/kVyLg6aQ42mplFGa', '2024-10-15 13:37:28', NULL, NULL),
(87, 2020000511, 'Sarmiento', 'Julio Miguelito', 'jmsarmiento', 'sarmientojulio146@gmail.com', '$2y$10$0paPvo/aPcEeyQRiY67Mn.AkMqXlnvsN3vgrOnx9gMSzHhGgVcN3G', '2024-10-15 13:40:11', NULL, NULL),
(88, 2020000513, 'Velasquez', 'Vince Dominic', 'vincedom', 'dominicvelasquez111@gmail.com', '$2y$10$3MFIKdVov3UXRSqyOshSieYqnJKmDR6vDeAvltNXSTqxrMJrir5Zi', '2024-10-15 13:42:14', NULL, NULL),
(89, 2020000514, 'Geolagon', 'mykaella adrienne', 'mykadreigeolagon', 'mykaellageolagon@gmail.com', '$2y$10$FTcZVAx4p0wJkT6rBvUzveupqmSqCgMohgQK/N.DzKVTseNtESyHW', '2024-10-15 13:44:01', NULL, NULL),
(90, 2020000516, 'Burgos', 'Alexis Maey Michelin', 'alexmmb', 'burgosalexis637@gmail.com', '$2y$10$F4L0QWrRdWVGciskm67R/O7N5h94GaWcHrsRiDw1N0g9EDaKq7lFq', '2024-10-15 13:47:51', NULL, NULL),
(91, 2020000517, 'Mejorada', 'Milena Naomi', 'milenamejo', 'mejoradamilena@gmail.com', '$2y$10$GVbmAoO890W3J00p4eraFe42me4pX9e2rQITPYwGmJ7gdLgkFczTi', '2024-10-15 13:52:13', NULL, NULL),
(92, 2020000534, 'Ong', 'Maria Johanna', 'mjong', 'mariajohannaong@gmail.com', '$2y$10$SQrtEdNkNFNayx8DgNGfSuA0hK3D/J.NXmUTIFUi/QbNg0lQYy/s2', '2024-10-15 13:57:47', NULL, NULL),
(93, 2020000540, 'Sanchez', 'Micaella Cathlyn', 'mcsanchez', 'micaellasanchez043@gmail.com', '$2y$10$7Fxv7lST8/xh5dK6Dr9bBudTV0.DwCGcauPCZLLaV4aHZhNwk7AKy', '2024-10-15 14:08:42', NULL, NULL),
(94, 2020000541, 'Santiago', 'Aurve', 'aurvesanti', 'aurvesantiago@gmail.com', '$2y$10$GObqYoKNRdV1SJxwuvWW9uKaQqic9pFDoFJzo2CuWsTTSLsiF289i', '2024-10-15 14:53:36', NULL, NULL),
(95, 2020000542, 'Payumo', 'Ixcheldin', 'pixmaru', 'pixcheldin@gmail.com', '$2y$10$dRWIvG.GpQewG28hmHo4vesp3PIssnudguIgqxhFajqGTpO.u5UUi', '2024-10-15 14:55:41', NULL, NULL),
(96, 2020000555, 'Gabrang', 'Bhonkyrie', 'bkgabrang', 'bhonky123@gmail.com', '$2y$10$hVqKlUquGHqRXTw4evJHueqgh9MHmktrbbg/aYy714JAyzbBXe1xa', '2024-10-15 14:57:47', NULL, NULL),
(97, 2020000612, 'Santos', 'Noah siddharta', 'siddhartasantos', 'santosnoahsid@gmail.com', '$2y$10$Eqfm2iknh2XGhfSkY3JfQuNk9qWR.JkMEVt6pz.ROgSVNQZsxRwt.', '2024-10-15 15:01:12', NULL, NULL),
(98, 2020000553, 'Villacrusis', 'Gian Vince', 'gianvivi', 'gvillacrusis3@gmail.com', '$2y$10$YULPGdcPZSghxyhK9p9WyOJ8lYOpq4G0yRB4ME86.oga9VlKM1.Eu', '2024-10-15 17:11:30', NULL, NULL),
(99, 2020000552, 'aquino', 'john martin', 'jmaqui', 'johnmartinaquino12@gmail.com', '$2y$10$ppisI7oqsfnHTf2UeUvICe94pq0cGOOEGxGX2uhaeppZsSqK6G6Aq', '2024-10-15 17:13:22', NULL, NULL),
(100, 2020000602, 'modeloso', 'vangie', 'vangieso', 'modelosovangie9@gmail.com', '$2y$10$b5ASOkma6frdprXKVexPt.A.4o2/P08FY.Q5hVYT5iulJaXtj1ZFO', '2024-10-15 17:14:40', NULL, NULL),
(101, 2020000627, 'Santos', 'Mikhail', 'vicmiksan', 'santosvicentemikhail@gmail.com', '$2y$10$5iYjcikE6pbEOQtCrHWKB.o7cG7.zp0Uz6DSNJOz3wSOfTztrZ/CO', '2024-10-15 17:16:34', NULL, NULL),
(102, 2020000623, 'Pitogo', 'Joana', 'jnics', 'nicsjoana@gmail.com', '$2y$10$Ysj3B5llg9lhbobXDi24DOViXsofYoxT2kR2xx/jgmXQy3vGRYUQ6', '2024-10-15 17:57:32', NULL, NULL),
(103, 2020000622, 'Villamarin', 'Farrell Kyle', 'fkylevllmrn', 'farellkyle@gmail.com', '$2y$10$XX1P8cDLxaL3FDnK2tvMVORuINJ0DeaObZTAhZ5d71RVtgIrIUu6W', '2024-10-15 17:59:05', NULL, NULL),
(104, 2019136074, 'Sosa', 'Jermaine', 'Jermaine123', 'edwardaquino12@yahoo.com', '$2y$10$9jaDTMOgSrz8Y3d.r3v6D.X0wdVQVpgyQodaYb9ixrTv55JaGLeeS', '2024-10-28 05:48:35', NULL, NULL),
(106, 2119136070, 'sosa', 'qwe', 'admin', 'jer@gmail.com', '$2y$10$qEYoOvCJcNf0jTommP6r6evNrqwhoapH3g3vdwHvljIax.IFX/Mwi', '2024-11-11 18:20:02', NULL, NULL),
(107, 2019136070, 'sosa', 'sosa', 'jermaine123435', 'jermaineis@gmail.com', '$2y$10$TQ1a7zwgZ32k4typ.ulG0eP7ZitOrFmnzdBIOS7NeBGmqsOFhB.be', '2024-11-12 14:29:06', NULL, NULL),
(108, 2222222252, 'sosa', 'sosa', 'AC', 'AC123@gmail.com', '$2y$10$UuQgH3Rc6C2eKswxLPTai.CM9hluXwxkOnrRONAFxlxGdaH2Ucv6K', '2024-11-12 14:31:47', NULL, NULL),
(109, 2019136098, 'jermaine', 'sosa', 'jermaine', 'jermaineisaih@gmail.com', '$2y$10$1MVW9KByLhaxa2Ui1QtCg./TRbEcAaTKhwmYTP1EJsL8gxfFEfuKC', '2024-11-12 14:44:43', NULL, NULL),
(110, 2221222122, '123', '123', '123', 'jermaineih@gmail.com', '$2y$10$ov/x8vOh446geHvvMsUY2.zSdQDuN/KMlB5zVcmjax7yCE8cnLEUi', '2024-11-12 15:44:17', NULL, NULL),
(111, 2233222222, '123123', '123123', 'admin432', 'jer42242@gmail.com', '$2y$10$8TXK2G3bi.BWsRWwNHSSd.gI5PMWhMZhRgrpjZDy9D7cLGix8Y7pW', '2024-11-12 15:48:50', NULL, NULL),
(112, 2019136021, 'bap', 'bap', 'bap123', 'bap@gmail.com', '$2y$10$NOs4ueLkxW8IL6CkIfd/reLkRXZKQFCOpmMntbSt..x7DJMnsgR5q', '2024-11-20 13:46:20', NULL, NULL),
(113, 2019136041, 'admin', 'admin', 'admin1234', 'admin@admin.com', '$2y$10$ujIYO9fkMF0TWQJ9aT4J5.HqJfdjBDMZ7vg3BExPpRaQIkjRe7J7y', '2024-11-23 17:25:48', NULL, NULL),
(114, 2019136055, 'SOSA123', 'SOSA123', 'SOSA123', 'jermongsosi@gmail.com', '$2y$10$YAms83VBMBXEQmldH9U4dO4eIjQxo1fkcowK27JN5lXKBDgnTZZu2', '2024-11-25 20:23:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` char(1) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `assessment_id`, `question_id`, `answer`, `submitted_at`) VALUES
(1, 75, 1732098131, 45, 'A', '2024-11-20 10:36:13'),
(2, 75, 1732098131, 46, 'C', '2024-11-20 10:36:13'),
(3, 75, 1732098131, 47, 'D', '2024-11-20 10:36:13'),
(4, 75, 1732098131, 48, 'A', '2024-11-20 10:36:13'),
(5, 75, 1732098131, 49, 'A', '2024-11-20 10:36:13'),
(6, 75, 1732098131, 45, 'A', '2024-11-20 10:41:20'),
(7, 75, 1732098131, 46, 'C', '2024-11-20 10:41:20'),
(8, 75, 1732098131, 47, 'B', '2024-11-20 10:41:20'),
(9, 75, 1732098131, 48, 'D', '2024-11-20 10:41:20'),
(10, 75, 1732098131, 49, 'A', '2024-11-20 10:41:20'),
(11, 75, 1732098131, 45, 'A', '2024-11-20 11:06:39'),
(12, 75, 1732098131, 46, 'C', '2024-11-20 11:06:39'),
(13, 75, 1732098131, 47, 'D', '2024-11-20 11:06:39'),
(14, 75, 1732098131, 48, 'B', '2024-11-20 11:06:39'),
(15, 75, 1732098131, 49, 'A', '2024-11-20 11:06:39'),
(16, 75, 1731838178, 43, 'B', '2024-11-20 11:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `login_time`) VALUES
(14, 75, '2024-11-25 01:14:06'),
(15, 76, '2024-10-24 06:30:12'),
(16, 77, '2024-09-23 00:45:00'),
(17, 75, '2024-08-22 10:15:30'),
(18, 78, '2024-07-21 05:00:00'),
(19, 79, '2024-06-20 08:20:10'),
(20, 80, '2024-05-19 01:00:00'),
(21, 75, '2024-04-18 03:45:00'),
(22, 81, '2024-03-17 09:30:25'),
(23, 76, '2024-02-16 06:05:18'),
(24, 77, '2024-01-15 00:10:05'),
(25, 75, '2023-12-14 04:00:00'),
(26, 82, '2023-11-13 11:22:11'),
(27, 83, '2023-10-11 23:35:45'),
(28, 84, '2023-09-11 03:12:59'),
(29, 85, '2023-08-10 07:28:20'),
(30, 76, '2023-07-09 02:45:35'),
(31, 86, '2023-06-08 08:08:03'),
(32, 87, '2023-05-07 01:59:21'),
(33, 88, '2023-04-06 12:42:15'),
(34, 89, '2023-03-05 06:55:33'),
(35, 75, '2023-02-04 03:08:50'),
(36, 112, '2024-11-25 01:42:17'),
(37, 75, '2024-11-25 01:55:56'),
(38, 112, '2024-11-25 02:26:27'),
(39, 75, '2024-11-25 03:27:04'),
(40, 112, '2024-11-25 03:33:55'),
(41, 75, '2024-11-25 03:34:28'),
(42, 112, '2024-11-25 03:37:36'),
(43, 114, '2024-11-25 05:24:19'),
(44, 114, '2024-11-25 05:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_scores`
--

CREATE TABLE `user_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_scores`
--

INSERT INTO `user_scores` (`id`, `user_id`, `assessment_id`, `score`, `total_questions`, `submitted_at`) VALUES
(1, 75, 1732098131, 0, 5, '2024-11-20 10:41:20'),
(2, 75, 1732098131, 1, 5, '2024-11-20 11:06:39'),
(3, 75, 1731838178, 1, 1, '2024-11-20 11:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `virtual_labs`
--

CREATE TABLE `virtual_labs` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `lab_type` varchar(50) NOT NULL,
  `lab_data` varchar(255) NOT NULL,
  `launch_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `virtual_labs`
--

INSERT INTO `virtual_labs` (`id`, `lesson_id`, `lab_type`, `lab_data`, `launch_file`) VALUES
(51, 3, 'uploadFolder', '../user/uploads/labs/CANAPES/', 'index.php'),
(52, 3, 'uploadFolder', '../user/uploads/labs/TAPAS/', 'index.php'),
(53, 4, 'uploadFolder', '../user/uploads/labs/BEETPOT/', 'index.php'),
(54, 4, 'uploadFolder', '../user/uploads/labs/MESCLUN/', 'index.php'),
(55, 5, 'uploadFolder', '../user/uploads/labs/PANCAKE/', 'index.php');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_links`
--

CREATE TABLE `youtube_links` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `youtube_links`
--

INSERT INTO `youtube_links` (`id`, `url`, `date_added`) VALUES
(1, 'www.youtube.com/embed/tB_faksM0cA?si=QirbUPMwUP8PjF8d', '2024-07-13 07:06:20'),
(6, 'https://www.youtube.com/embed/tB_faksM0cA?si=QirbUPMwUP8PjF8d', '2024-07-13 08:43:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lesson_id` (`lesson_id`),
  ADD KEY `idx_assessment_id` (`assessment_id`);

--
-- Indexes for table `assessment_questions`
--
ALTER TABLE `assessment_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_id` (`assessment_id`);

--
-- Indexes for table `bug_reports`
--
ALTER TABLE `bug_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_content`
--
ALTER TABLE `lesson_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `lesson_progress`
--
ALTER TABLE `lesson_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lesson` (`lesson_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `lesson_results`
--
ALTER TABLE `lesson_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `progress123`
--
ALTER TABLE `progress123`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_progress` (`user_id`,`chapter_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_id` (`assessment_id`);

--
-- Indexes for table `quiz_appetizers`
--
ALTER TABLE `quiz_appetizers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quiz_desserts`
--
ALTER TABLE `quiz_desserts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_egg`
--
ALTER TABLE `quiz_egg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_food_safety`
--
ALTER TABLE `quiz_food_safety`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_funda_cookery`
--
ALTER TABLE `quiz_funda_cookery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quiz_salads`
--
ALTER TABLE `quiz_salads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `assessment_id` (`assessment_id`);

--
-- Indexes for table `virtual_labs`
--
ALTER TABLE `virtual_labs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`);

--
-- Indexes for table `youtube_links`
--
ALTER TABLE `youtube_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assessment_questions`
--
ALTER TABLE `assessment_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `bug_reports`
--
ALTER TABLE `bug_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lesson_content`
--
ALTER TABLE `lesson_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `lesson_progress`
--
ALTER TABLE `lesson_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `lesson_results`
--
ALTER TABLE `lesson_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `progress123`
--
ALTER TABLE `progress123`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_appetizers`
--
ALTER TABLE `quiz_appetizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_desserts`
--
ALTER TABLE `quiz_desserts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quiz_egg`
--
ALTER TABLE `quiz_egg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `quiz_food_safety`
--
ALTER TABLE `quiz_food_safety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `quiz_funda_cookery`
--
ALTER TABLE `quiz_funda_cookery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `quiz_salads`
--
ALTER TABLE `quiz_salads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_scores`
--
ALTER TABLE `user_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `virtual_labs`
--
ALTER TABLE `virtual_labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `youtube_links`
--
ALTER TABLE `youtube_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `fk_lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Constraints for table `assessment_questions`
--
ALTER TABLE `assessment_questions`
  ADD CONSTRAINT `assessment_questions_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`assessment_id`) ON DELETE CASCADE;

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `lesson_content`
--
ALTER TABLE `lesson_content`
  ADD CONSTRAINT `lesson_content_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`);

--
-- Constraints for table `lesson_progress`
--
ALTER TABLE `lesson_progress`
  ADD CONSTRAINT `fk_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `virtual_labs` (`lesson_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`assessment_id`),
  ADD CONSTRAINT `user_answers_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `assessment_questions` (`id`);

--
-- Constraints for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD CONSTRAINT `user_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_scores`
--
ALTER TABLE `user_scores`
  ADD CONSTRAINT `user_scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_scores_ibfk_2` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`assessment_id`);

--
-- Constraints for table `virtual_labs`
--
ALTER TABLE `virtual_labs`
  ADD CONSTRAINT `virtual_labs_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
