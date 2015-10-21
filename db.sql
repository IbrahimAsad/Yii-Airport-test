
--
-- Database: `yii2basic`
--

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE IF NOT EXISTS `airport` (
  `airport_id` int(11) NOT NULL,
  `airport_name` varchar(200) NOT NULL,
  `airport_code` varchar(200) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`airport_id`),
  UNIQUE KEY `airport_id` (`airport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_id`, `airport_name`, `airport_code`, `country`, `city`) VALUES
(1, 'Dubai Airport', 'DXB', 'UAE', 'Dubai'),
(2, 'Abu dhabi Airport', 'ABD', 'UAE', 'Abu Dhabi');