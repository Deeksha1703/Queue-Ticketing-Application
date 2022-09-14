
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*Creating database it it doesn't already exist */
CREATE DATABASE IF NOT EXISTS `ticketdatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ticketdatabase`;


/* Table to store counter details */
CREATE TABLE `counter` (
  `counter` varchar(20) NOT NULL,
  `counter_status` varchar(20) DEFAULT NULL CHECK (`counter_status` = 'on' or `counter_status` = 'off' or `counter_status` = 'busy')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Inserting data into counter table */
INSERT INTO `counter` (`counter`, `counter_status`) VALUES
('Counter 1', 'busy'),
('Counter 2', 'on'),
('Counter 3', 'off'),
('Counter 4', 'off');

/* Table to store ticket details */
CREATE TABLE `ticket` (
  `ticketno` int(11) NOT NULL,
  `ticket_status` varchar(20) DEFAULT NULL CHECK (`ticket_status` = 'pending' or `ticket_status` = 'serving' or `ticket_status` = 'complete'),
  `counter` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Inserting data into ticket table */
INSERT INTO `ticket` (`ticketnum`, `ticket_status`, `counter`) VALUES
(1, 'complete', 'Counter 1'),
(2, 'complete', 'Counter 1'),
(3, 'complete', 'Counter 1'),
(4, 'complete', 'Counter 1'),
(5, 'complete', 'Counter 3'),
(6, 'complete', 'Counter 4'),
(7, 'complete', 'Counter 3'),
(8, 'complete', 'Counter 3'),
(9, 'complete', 'Counter 1'),
(10, 'complete', 'Counter 4'),
(11, 'complete', 'Counter 1'),
(12, 'complete', 'Counter 1'),
(13, 'serving', 'Counter 1'),
(14, 'complete', 'Counter 2'),
(15, 'complete', 'Counter 2'),
(16, 'pending', NULL),
(17, 'pending', NULL),
(18, 'pending', NULL),
(19, 'pending', NULL),
(20, 'pending', NULL),
(21, 'pending', NULL),
(22, 'pending', NULL),
(23, 'pending', NULL),
(24, 'pending', NULL),
(25, 'pending', NULL),
(26, 'pending', NULL),
(27, 'pending', NULL),
(28, 'pending', NULL),
(29, 'pending', NULL),
(30, 'pending', NULL),
(31, 'pending', NULL),
(32, 'pending', NULL),
(33, 'pending', NULL),
(34, 'pending', NULL),
(35, 'pending', NULL),
(36, 'pending', NULL),
(37, 'pending', NULL),
(38, 'pending', NULL),
(39, 'pending', NULL),
(40, 'pending', NULL)


ALTER TABLE `counter`
  ADD PRIMARY KEY (`counter`);


ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketnum`),
  ADD KEY `ticket_counter_FK` (`counter`);


ALTER TABLE `ticket`
  MODIFY `ticketnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;


ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_counter_FK` FOREIGN KEY (`counter`) REFERENCES `counter` (`counter`);
COMMIT;

