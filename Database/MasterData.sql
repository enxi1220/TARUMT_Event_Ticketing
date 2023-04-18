USE `tarumt_event_ticketing`;
INSERT INTO `user` (`username`, `password`, `name`, `phone`, `mail`, `status`, `created_by`, `created_date`) VALUES
('user1', 'pass1', 'John Doe', '1234567890', 'user1@test.com', 'Active', 'admin', NOW()),
('user2', 'pass2', 'Jane Smith', '0987654321', 'user2@test.com', 'Active', 'admin', NOW()),
('user3', 'pass3', 'Bob Johnson', '1112223333', 'user3@test.com', 'Active', 'admin', NOW()),
('user4', 'pass4', 'Sally Brown', '4445556666', 'user4@test.com', 'Active', 'admin', NOW()),
('user5', 'pass5', 'David Lee', '7778889999', 'user5@test.com', 'Active', 'admin', NOW()),
('user6', 'pass6', 'Emily Jones', '5554443333', 'user6@test.com', 'Active', 'admin', NOW());

INSERT INTO `tarumt_event_ticketing`.`admin` 
(`username`, `password`, `role`, `name`, `phone`, `mail`, `status`, `created_by`, `created_date`) 
VALUES 
('admin01', 'password01', 'admin', 'John Doe', '555-1234', 'admin01@example.com', 'active', 'system', NOW()),
('admin02', 'password02', 'admin', 'Jane Smith', '555-5678', 'admin02@example.com', 'active', 'system', NOW()),
('admin03', 'password03', 'admin', 'Bob Johnson', '555-9012', 'admin03@example.com', 'active', 'system', NOW()),
('admin04', 'password04', 'admin', 'Lisa Nguyen', '555-3456', 'admin04@example.com', 'active', 'system', NOW()),
('admin05', 'password05', 'admin', 'Mark Davis', '555-7890', 'admin05@example.com', 'active', 'system', NOW()),
('admin06', 'password06', 'admin', 'Sarah Lee', '555-1234', 'admin06@example.com', 'active', 'system', NOW());

INSERT INTO category (name, description, created_by, created_date)
VALUES
('Concert', 'Live music performance', 'admin', NOW()),
('Sports', 'Sports event', 'admin', NOW()),
('Theater', 'Drama and acting performance','admin', NOW()),
('Exhibition', 'Art exhibition and showcase', 'admin', NOW()),
('Conference', 'Meeting or discussion of experts', 'admin', NOW()),
('Seminar', 'Educational and instructional event', 'admin', NOW());

INSERT INTO event (event_no, category_id, name, poster, venue, register_start_date, register_end_date, event_start_date, event_end_date, vip_ticket_qty, standard_ticket_qty, budget_ticket_qty, vip_ticket_price, standard_ticket_price, budget_ticket_price, description, organizer_name, organizer_phone, organizer_mail, status, created_by, created_date)
VALUES
('EV000001', 1, 'Summer Concert', '642d963a3e83f_i.jpg', 'Stadium A', '2023-06-01', '2023-06-30', '2023-08-01', '2023-08-01', 100, 500, 1000, 500.00, 250.00, 100.00, 'Summer concert featuring famous bands', 'Music Promotion Company', '1234567890', 'musicpromo@company.com', 'active', 'admin', NOW()),
('EV000002', 2, 'Football Match', '642d963a3e83f_i.jpg', 'Stadium B', '2023-04-01', '2023-05-31', '2023-07-01', '2023-07-01', 50, 200, 500, 100.00, 50.00, 25.00, 'Football match between rival teams', 'Sports Management Agency', '0987654321', 'sportsmgmt@agency.com', 'active', 'admin', NOW()),
('EV000003', 3, 'Theater Play', '642d963a3e83f_i.jpg', 'Theater C', '2023-08-01', '2023-09-30', '2023-11-01', '2023-11-01', 25, 100, 200, 200.00, 100.00, 50.00, 'Classic drama play performed by renowned actors', 'Theater Production House', '1122334455', 'theaterph@house.com', 'active', 'admin', NOW()),
('EV000004', 4, 'Art Exhibition', '642d963a3e83f_i.jpg', 'Art Gallery D', '2023-09-01', '2023-10-31', '2023-12-01', '2023-12-01', 0, 0, 0, 0.00, 0.00, 0.00, 'Contemporary art exhibition showcasing various artists', 'Art Management Company', '4433221100', 'artmgmt@company.com', 'active', 'admin', NOW()),
('EV000005', 5, 'Tech Conference', '642d963a3e83f_i.jpg', 'Convention Center E', '2023-10-01', '2023-11-30', '2023-12-31', '2024-01-01', 100, 500, 1000, 150.00, 100.00, 50.00, 'The Tech Conference is the leading technology conference for developers, IT professionals, and entrepreneurs.', 'Tech Events Inc.', '+1 (555) 555-5555', 'info@techevents.com', 'Open', 'admin', NOW()),
('EV000006', 6, 'Music Festival', '642d963a3e83f_i.jpg', 'Central Park', '2023-06-01', '2023-07-30', '2023-08-31', '2023-09-01', 500, 5000, 10000, 250.00, 100.00, 50.00, 'The Music Festival features top artists from a range of music genres and is held annually in Central Park.', 'Music Festivals LLC', '+1 (555) 555-5555', 'info@musicfestivals.com', 'Open', 'admin', NOW()),
('EV000007', 1, 'Jazz Festival', '642d963a3e83f_i.jpg', 'City Park', '2023-08-01', '2023-09-30', '2023-10-15', '2023-10-16', 200, 1000, 2000, 200.00, 100.00, 50.00, 'Annual jazz festival featuring top musicians and bands', 'Jazz Music Productions', '+1 (555) 555-5555', 'info@jazzmusicpro.com', 'Closed', 'admin', NOW()),
('EV000008', 2, 'Basketball Game', '642d963a3e83f_i.jpg', 'Arena F', '2023-05-01', '2023-06-30', '2023-08-01', '2023-08-01', 75, 300, 750, 50.00, 25.00, 10.00, 'Exciting basketball game between two top teams', 'Sports Entertainment LLC', '+1 (555) 555-5555', 'info@sportsentertainment.com', 'Open', 'admin', NOW()),
('EV000009', 3, 'Comedy Show', '642d963a3e83f_i.jpg', 'Comedy Club G', '2023-07-01', '2023-08-31', '2023-10-01', '2023-10-01', 20, 100, 200, 75.00, 50.00, 25.00, 'Hilarious comedy show featuring top comedians', 'Comedy Central Live', '+1 (555) 555-5555', 'info@comedycentrallive.com', 'Open', 'admin', NOW()),
('EV000010', 4, 'Art Fair', '642d963a3e83f_i.jpg', 'Convention Center H', '2023-10-01', '2023-11-30', '2023-12-15', '2023-12-17', 0, 0, 0, 0.00, 0.00, 0.00, 'Annual art fair showcasing works from renowned artists and galleries', 'Art Expo Inc.', '+1 (555) 555-5555', 'info@artexpo.com', 'Open', 'admin', NOW()),
('EV000011', 5, 'Blockchain Conference', '642d963a3e83f_i.jpg', 'Conference Center I', '2023-11-01', '2023-12-31', '2024-01-15', '2024-01-16', 200, 1000, 2000, 500.00, 250.00, 100.00, 'Conference focused on blockchain technology and its impact on various industries', 'Blockchain Events LLC', '+1 (555) 555-5555', 'info@blockchainevents.com', 'Open', 'admin', NOW()),
('EV000012', 6, 'Food Festival', '642d963a3e83f_i.jpg', 'City Square J', '2023-07-01', '2023-08-31', '2023-09-15', '2023-09-17', 200, 1000, 2000, 500.00, 250.00, 100.00, 'Conference focused on blockchain technology and its impact on various industries', 'Blockchain Events LLC', '+1 (555) 555-5555', 'info@blockchainevents.com', 'Open', 'admin', NOW());

INSERT INTO tarumt_event_ticketing.ticket (ticket_no, event_id, owner, status, updated_by, updated_date)
VALUES
('VIP000001', 1, 'John Doe', 'Sold', NULL, NULL),
('STD000002', 1, 'Jane Smith', 'New', NULL, NULL),
('BGT000003', 2, 'John Doe', 'New', NULL, NULL),
('STD000004', 2, 'Jane Smith', 'New', NULL, NULL),
('VIP000005', 3, 'John Doe', 'New', NULL, NULL),
('BGT000006', 3, 'Jane Smith', 'New', NULL, NULL),
('STD000007', 4, 'John Doe', 'New', NULL, NULL),
('VIP000008', 4, 'Jane Smith', 'New', NULL, NULL),
('BGT000009', 5, 'John Doe', 'New', NULL, NULL),
('STD000010', 5, 'Jane Smith', 'New', NULL, NULL),
('VIP000011', 6, 'John Doe', 'New', NULL, NULL),
('BGT000012', 6, 'Jane Smith', 'New', NULL, NULL),
('STD000013', 7, 'John Doe', 'New', NULL, NULL);

INSERT INTO tarumt_event_ticketing.wishlist (event_id, user_id)
VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2);


INSERT INTO tarumt_event_ticketing.booking (booking_no, event_id, user_id, created_by, created_date)
VALUES
('B000001', 1, 1, 'John Doe', NOW()),
('B000002', 2, 2, 'Jane Smith', NOW()),
('B000003', 3, 3, 'Mike Johnson', NOW()),
('B000004', 4, 4, 'Sarah Lee', NOW()),
('B000005', 5, 5, 'David Kim', NOW()),
('B000006', 1, 6, 'Emily Chen', NOW());

INSERT INTO tarumt_event_ticketing.booking_detail (booking_detail_id, booking_id, ticket_id)
VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 5),
(4, 4, 2),
(5, 5, 6),
(6, 6, 4);

INSERT INTO tarumt_event_ticketing.payment (payment_no, booking_id, payment_type, price, created_date)
VALUES
('P000001', 1, 'Credit Card', 150.00, NOW()),
('P000002', 2, 'PayPal', 80.00, NOW()),
('P000003', 3, 'Debit Card', 120.00, NOW()),
('P000004', 4, 'Credit Card', 50.00, NOW()),
('P000005', 5, 'PayPal', 60.00, NOW()),
('P000006', 6, 'Debit Card', 70.00, NOW());

INSERT INTO tarumt_event_ticketing.payment_detail (payment_id, ticket_no, event_name, ticket_price)
VALUES
(1, 'VIP000001', 'Concert A', 50.00),
(1, 'STD000002', 'Concert A', 50.00),
(1, 'BGT000003', 'Concert A', 50.00),
(2, 'STD000004', 'Concert B', 40.00),
(2, 'VIP000005', 'Concert B', 40.00),
(3, 'BGT000006', 'Musical C', 40.00),
(3, 'STD000007', 'Musical C', 40.00),
(3, 'VIP000008', 'Musical C', 40.00),
(4, 'BGT000009', 'Conference D', 50.00),
(5, 'STD000010', 'Exhibition E', 30.00),
(5, 'VIP000011', 'Exhibition E', 30.00),
(6, 'BGT000012', 'Seminar F', 35.00),
(6, 'STD000013', 'Seminar F', 35.00);


-- INSERT INTO `category` (
-- 	`category_id`, 
-- 	`name`, 
-- 	`description`, 
-- 	`status`, 
-- 	`created_by`, 
-- 	`created_date`, 
-- 	`updated_by`, 
-- 	`updated_date`) 
-- VALUES (
-- 	NULL, 
-- 	'Competition', 
-- 	'Competition ', 
-- 	'Activate', 
-- 	'Kuma', 
-- 	'2023-03-26 12:14:17.000000', 
-- 	NULL, 
-- 	NULL);
--     
-- INSERT INTO `event` (`event_id`, `event_no`, `category_id`, `name`, `poster`, `venue`, `register_start_date`, `register_end_date`, `event_start_date`, `event_end_date`, `vip_ticket_qty`, `standard_ticket_qty`, `budget_ticket_qty`, `vip_ticket_price`, `standard_ticket_price`, `budget_ticket_price`, `description`, `organizer_name`, `organizer_phone`, `organizer_mail`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
-- (1, 'EVT2023/0405/23:39:38.256016', 1, 'Voice Of Rahman', '642d963a3e83f_i.jpg', 'Arte S', '2023-04-05 23:39:00', '2023-04-05 23:39:00', '2023-04-05 23:39:00', '2023-04-05 23:39:00', 2, 4, 5, 10, 7, 5, 'Sing! Vote! ', 'En En', '0123456789', 'enen@event.com', 'Open', 'Kuma', '2023-04-05 23:39:38', NULL, NULL);
