USE `tarumt_event_ticketing`;

INSERT INTO `category` (
	`category_id`, 
	`name`, 
	`description`, 
	`status`, 
	`created_by`, 
	`created_date`, 
	`updated_by`, 
	`updated_date`) 
VALUES (
	NULL, 
	'Competition', 
	'Competition ', 
	'Activate', 
	'Kuma', 
	'2023-03-26 12:14:17.000000', 
	NULL, 
	NULL);
    
INSERT INTO `event` (`event_id`, `event_no`, `category_id`, `name`, `poster`, `venue`, `register_start_date`, `register_end_date`, `event_start_date`, `event_end_date`, `vip_ticket_qty`, `standard_ticket_qty`, `budget_ticket_qty`, `vip_ticket_price`, `standard_ticket_price`, `budget_ticket_price`, `description`, `organizer_name`, `organizer_phone`, `organizer_mail`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'EVT2023/0405/23:39:38.256016', 1, 'Voice Of Rahman', '642d963a3e83f_i.jpg', 'Arte S', '2023-04-05 23:39:00', '2023-04-05 23:39:00', '2023-04-05 23:39:00', '2023-04-05 23:39:00', 2, 4, 5, 10, 7, 5, 'Sing! Vote! ', 'En En', '0123456789', 'enen@event.com', 'Open', 'Kuma', '2023-04-05 23:39:38', NULL, NULL);
