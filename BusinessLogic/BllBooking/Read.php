<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/BookingDetail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";

class Read {

    public static function Read(Booking $booking) {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
                function (DataAccess $dataAccess) use ($booking) {

                    return Read::ReadBooking($dataAccess, $booking);
                }
        );

        return $result;
    }

//
//    private static function ReadBooking(DataAccess $dataAccess, $booking)
//    {
//        return $dataAccess->Reader(
//            "SELECT 
//                b.booking_id, 
//                b.booking_no, 
//                b.event_id, 
//                b.user_id, 
//                b.created_by, 
//                b.created_date,
//                e.event_no, 
//                e.name, 
//                e.poster, 
//                e.venue, 
//                e.event_start_date, 
//                e.event_end_date
//            FROM booking b
//            JOIN event e ON b.event_id = e.event_id
//            WHERE e.event_id = IF(:event_id IS NULL, e.event_id, :event_id)
//            AND b.user_id = IF(:user_id IS NULL, b.user_id, :user_id)
//            AND b.created_by = IF(:created_by IS NULL, b.created_by, :created_by)",
//            function (PDOStatement $pstmt) use ($booking) {
//                $pstmt->bindValue(":event_id", $booking->getEventId(), PDO::PARAM_INT);
//                $pstmt->bindValue(":user_id", $booking->getUserId(), PDO::PARAM_INT);
//                $pstmt->bindValue(":created_by", $booking->getCreatedBy(), PDO::PARAM_STR);
//            },
//            function ($row) {
//                $event = new Event();
//                $event->setEventId($row['event_id'])
//                    ->setEventNo($row['event_no'])
//                    ->setName($row['name'])
//                    ->setPoster($row['poster'])
//                    ->setVenue($row['venue'])
//                    ->setEventStartDate($row['event_start_date'])
//                    ->setEventEndDate($row['event_end_date']);
//
//                $booking = new Booking();
//                return $booking
//                    ->setBookingId($row['booking_id'])
//                    ->setBookingNo($row['booking_no'])
//                    ->setEventId($row['event_id'])
//                    ->setUserId($row['user_id'])
//                    ->setCreatedBy($row['created_by'])
//                    ->setCreatedDate($row['created_date'])
//                    ->setEvent($event);
//            }
//        );
//    }
    private static function ReadBooking(DataAccess $dataAccess, $booking) {

        $bookingDetails = array();

        return $dataAccess->Reader(
                        "SELECT 
    b.booking_id, 
    b.booking_no, 
    b.event_id, 
    b.user_id, 
    b.created_by, 
    b.created_date,
    u.user_id,
    u.mail,
    u.phone,
    e.event_no, 
    e.name AS event_name, 
    e.poster, 
    e.venue, 
    e.event_start_date, 
    e.event_end_date,
    GROUP_CONCAT(t.ticket_no) AS ticket_no
FROM booking b
JOIN event e ON b.event_id = e.event_id
JOIN user u ON b.user_id = u.user_id
JOIN booking_detail bd ON b.booking_id = bd.booking_id
JOIN ticket t ON bd.ticket_id = t.ticket_id
WHERE b.booking_id = IF(:booking_id IS NULL, b.booking_id, :booking_id)
    AND b.user_id = IF(:user_id IS NULL, b.user_id, :user_id)
    AND b.created_by = IF(:created_by IS NULL, b.created_by, :created_by)
GROUP BY b.booking_id
",
                        function (PDOStatement $pstmt) use ($booking) {
                            $pstmt->bindValue(":booking_id", $booking->getBookingId(), PDO::PARAM_INT);
                            $pstmt->bindValue(":user_id", $booking->getUserId(), PDO::PARAM_INT);
                            $pstmt->bindValue(":created_by", $booking->getCreatedBy(), PDO::PARAM_STR);
                        },
                        function ($row) {
                            $event = new Event();
                            $event->setEventId($row['event_id'])
                                    ->setEventNo($row['event_no'])
                                    ->setName($row['event_name'])
                                    ->setPoster($row['poster'])
                                    ->setVenue($row['venue'])
                                    ->setEventStartDate($row['event_start_date'])
                                    ->setEventEndDate($row['event_end_date']);
                            
                            $user = new User();
                            $user->setUserId($row['user_id'])
                                    ->setMail($row['mail'])
                                    ->setPhone($row['phone']);
//
                            $ticketNos = explode(',', $row['ticket_no']);

                            foreach ($ticketNos as $ticketNo) {
                                $ticketNo = trim($ticketNo);
                                if (substr($ticketNo, 0, 3) == PrefixConstant::TICKETVIP) {
                                    $ticket = new TicketVIP();
                                } else if (substr($ticketNo, 0, 3) == PrefixConstant::TICKETBGT) {
                                    $ticket = new TicketBudget();
                                } else if (substr($ticketNo, 0, 3) == PrefixConstant::TICKETSTD) {
                                    $ticket = new TicketStandard();
                                }

                                $ticket->setTicketNo($ticketNo);

                                $bookingDetail = new BookingDetail();
                                $bookingDetail->setTicket($ticket);

                                $bookingDetails[] = $bookingDetail;
                            }


                            $booking = new Booking();
                            return $booking
                                    ->setBookingId($row['booking_id'])
                                    ->setBookingNo($row['booking_no'])
                                    ->setEventId($row['event_id'])
                                    ->setUserId($row['user_id'])
                                    ->setCreatedBy($row['created_by'])
                                    ->setCreatedDate($row['created_date'])
                                    ->setTicketCount(count($ticketNos))
                                    ->setBookingDetails($bookingDetails)
                                    ->setEvent($event)
                                    ->setUser($user);
                        }
        );
    }

}

//
//                            $bookingDetails = array();
//                            $ticketNos = explode('|', $row['ticket_no']);
//
//                            foreach ($ticketNos as $ticketNo) {
//                                $ticketNo = trim($ticketNo);
//                                if (substr($ticketNo, 0, 3) == PrefixConstant::TICKETVIP) {
//                                    $ticket = new TicketVIP();
//                                } else if (substr($ticketNo, 0, 3) == PrefixConstant::TICKETBGT) {
//                                    $ticket = new TicketBudget();
//                                } else if (substr($ticketNo, 0, 3) == PrefixConstant::TICKETSTD) {
//                                    $ticket = new TicketStandard();
//                                }
//
//                                $ticket->setTicketNo($ticketNo);
//
//                                $bookingDetail = new BookingDetail();
//                                $bookingDetail->setTicket($ticket);
//
//                                array_push($bookingDetails, $bookingDetail);
//                            }


//                            for ($i = 0; $i < $row['booking_count']; $i++) {
//
//                                if (substr($row['ticket_no'], 0, 3) == PrefixConstant::TICKETVIP) {
//                                    $ticket = new TicketVIP();
//                                } else if (substr($row['ticket_no'], 0, 3) == PrefixConstant::TICKETBGT) {
//                                    $ticket = new TicketBudget();
//                                } else if (substr($row['ticket_no'], 0, 3) == PrefixConstant::TICKETSTD) {
//                                    $ticket = new TicketStandard();
//                                }
//
//                                $ticket->setTicketNo($row['ticket_no']);
//
//                                $bookingDetail = new BookingDetail();
//                                
//                                array_push($bookingDetails, $bookingDetail
//                                                ->setTicket($ticket));
//                            }

//                LEFT JOIN payment p ON b.booking_id = p.booking_id
//                $payment = new Payment();
//                return $booking
//                    ->setBookingId($row['booking_id'])
//                    ->setBookingNo($row['booking_no'])
//                    ->setEventId($row['event_id'])
//                    ->setUserId($row['user_id'])
//                    ->setCreatedBy($row['created_by'])
//                    ->setCreatedDate($row['created_date'])
//                    ->setEvent($event);