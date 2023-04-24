DROP DATABASE IF EXISTS `tarumt_event_ticketing`;

CREATE DATABASE `tarumt_event_ticketing`;
USE `tarumt_event_ticketing`;

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`user`(
	`user_id` int NOT NULL AUTO_INCREMENT, 
	`username` varchar(20) NOT NULL,
	`password` varchar(256) NOT NULL,
	`name` varchar(150) NOT NULL,
	`phone` varchar(15) NOT NULL,
	`mail` varchar(50) NOT NULL,
	`otp` int(6) NULL,
	`status` varchar(50) NOT NULL,
	`created_by` varchar(20) NOT NULL,
	`created_date` datetime NOT NULL,
	`updated_by` varchar(20) DEFAULT NULL,
	`updated_date` datetime DEFAULT NULL,
	PRIMARY KEY (`user_id`),
	UNIQUE KEY `email_UNIQUE` (`mail`),
	UNIQUE KEY `username_UNIQUE` (`username`)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`admin`(
	`admin_id` int NOT NULL AUTO_INCREMENT, 
	`username` varchar(20) NOT NULL,
	`password` varchar(256) NOT NULL,
	`role` varchar(20) NOT NULL,
	`name` varchar(150) NOT NULL,
	`phone` varchar(15) NOT NULL,
	`mail` varchar(50) NOT NULL,
	`status` varchar(50) NOT NULL,
	`created_by` varchar(20) NOT NULL,
	`created_date` datetime NOT NULL,
	`updated_by` varchar(20) DEFAULT NULL,
	`updated_date` datetime DEFAULT NULL,
	PRIMARY KEY (`admin_id`),
	UNIQUE KEY `email_UNIQUE` (`mail`),
	UNIQUE KEY `username_UNIQUE` (`username`)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`category`(
	`category_id` int NOT NULL AUTO_INCREMENT, 
	`name` varchar(150) NOT NULL,
	`description` varchar(250) NOT NULL,
	`created_by` varchar(20) NOT NULL,
	`created_date` datetime NOT NULL,
	`updated_by` varchar(20) DEFAULT NULL,
	`updated_date` datetime DEFAULT NULL,
	PRIMARY KEY (`category_id`),
	UNIQUE KEY `name_UNIQUE` (`name`)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`event`(
	`event_id` int NOT NULL AUTO_INCREMENT, 
	`event_no` varchar(30) NOT NULL,
	`category_id` int NOT NULL,
	`name` varchar(150) NOT NULL,
	`poster` varchar(200) NOT NULL,
	`venue` varchar(100) NOT NULL,
	`register_start_date` datetime NOT NULL,
	`register_end_date` datetime NOT NULL,
	`event_start_date` datetime NOT NULL,
	`event_end_date` datetime NOT NULL,
	`vip_ticket_qty` int NOT NULL,
	`standard_ticket_qty` int NOT NULL,
	`budget_ticket_qty` int NOT NULL,
	`vip_ticket_price` double NOT NULL,
	`standard_ticket_price` double NOT NULL,
	`budget_ticket_price` double NOT NULL,
	`description` text NOT NULL,
	`organizer_name` varchar(100) NOT NULL,
	`organizer_phone` varchar(15) NOT NULL,
	`organizer_mail` varchar(100) NOT NULL,
	`status` varchar(50) NOT NULL,
	`created_by` varchar(20) NOT NULL,
	`created_date` datetime NOT NULL,
	`updated_by` varchar(20) DEFAULT NULL,
	`updated_date` datetime DEFAULT NULL,
	PRIMARY KEY (`event_id`),
	UNIQUE KEY `event_no_UNIQUE` (`event_no`),
	FOREIGN KEY (category_id) REFERENCES category(category_id)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`ticket`(
	`ticket_id` int NOT NULL AUTO_INCREMENT,
	`ticket_no` varchar(30) NOT NULL,
	`event_id` int NOT NULL,
	`owner` varchar(20) NOT NULL,
	`status` varchar(50) NOT NULL,
	`updated_by` varchar(20) DEFAULT NULL,
	`updated_date` datetime DEFAULT NULL,
	PRIMARY KEY (`ticket_id`),
	UNIQUE KEY `ticket_no_UNIQUE` (`ticket_no`),
	FOREIGN KEY (event_id) REFERENCES event(event_id)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`wishlist`(
	`wishlist_id` int NOT NULL AUTO_INCREMENT,
	`event_id` int NOT NULL,
	`user_id` int NOT NULL,
	PRIMARY KEY (`wishlist_id`),
	FOREIGN KEY (event_id) REFERENCES event(event_id),
	FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`booking`(
	`booking_id` int NOT NULL AUTO_INCREMENT,
	`booking_no` varchar(30) NOT NULL,
	`event_id` int NOT NULL,
	`user_id` int NOT NULL,
	`created_by` varchar(20) NOT NULL,
	`created_date` datetime NOT NULL,
	PRIMARY KEY (`booking_id`),
	UNIQUE KEY `booking_no_UNIQUE` (`booking_no`),
	FOREIGN KEY (event_id) REFERENCES event(event_id),
	FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`booking_detail`(
	`booking_detail_id` int NOT NULL AUTO_INCREMENT,
	`booking_id` int NOT NULL,
	`ticket_id` int NOT NULL,
	PRIMARY KEY (`booking_detail_id`),
	FOREIGN KEY (booking_id) REFERENCES booking(booking_id),
	FOREIGN KEY (ticket_id) REFERENCES ticket(ticket_id)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`payment`(
	`payment_id` int NOT NULL AUTO_INCREMENT,
	`payment_no` varchar(30) NOT NULL,
	`booking_id` int NOT NULL,
	`payment_type` varchar(50) NOT NULL,
	`price` double NOT NULL,
	`created_date` datetime NOT NULL,
	PRIMARY KEY (`payment_id`),
	UNIQUE KEY `payment_no_UNIQUE` (`payment_no`),
	FOREIGN KEY (booking_id) REFERENCES booking(booking_id)
);

CREATE TABLE IF NOT EXISTS `tarumt_event_ticketing`.`payment_detail`(
	`payment_detail_id` int NOT NULL AUTO_INCREMENT,
	`payment_id` int NOT NULL,
	`ticket_no` varchar(30) NOT NULL,
	`event_name` varchar(150) NOT NULL,
	`ticket_price` double NOT NULL,
	PRIMARY KEY (`payment_detail_id`),
	FOREIGN KEY (payment_id) REFERENCES payment(payment_id)
);