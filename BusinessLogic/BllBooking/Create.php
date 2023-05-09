<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/EventStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/BookingDetail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllTicket/ReadNewQuantity.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";

class Create
{
    public static function Create(Booking $booking, TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
    {
        $booking->setBookingNo();
        $booking->setCreatedDate();

        ReadNewQuantity::Read($booking->getEvent(), $ticketVIP, $ticketStandard, $ticketBudget);
        $event = Read::Read($booking->getEvent()->setStatus(EventStatusConstant::CLOSED));
        
        if (!empty($event)) {
            throw new Exception("The event has been closed.");
        }

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($booking, $ticketVIP, $ticketStandard, $ticketBudget) {
            // insert booking & update tickets & insert booking detail & 
            // insert payment & insert payment detail
            $bookingId = Create::CreateBooking($dataAccess, $booking);

            $tickets = Create::UpdateTickets($dataAccess, $booking, $ticketVIP, $ticketStandard, $ticketBudget);

            $booking->setBookingId($bookingId);
            Create::CreateBookingDetail($dataAccess, $booking, $tickets);

            // todo: yc continue payment

        });

        return $booking->getBookingNo();
    }

    private static function CreateBooking(DataAccess $dataAccess, $booking)
    {
        $bookingId = $dataAccess->NonQuery(
            "INSERT INTO booking (
                booking_no, 
                event_id, 
                user_id, 
                created_by, 
                created_date) 
            VALUES (?, ?, ?, ?, ?)",
            function (PDOStatement $pstmt) use ($booking) {
                $pstmt->bindValue(1, $booking->getBookingNo(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $booking->getEventId(), PDO::PARAM_INT);
                $pstmt->bindValue(3, $booking->getUserId(), PDO::PARAM_INT);
                $pstmt->bindValue(4, $booking->getCreatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $booking->getCreatedDate(), PDO::PARAM_STR);
            },
            function (Exception $ex) {
                if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'booking_no_UNIQUE')) {
                    echo "Duplicate booking no is generated. Please try again.";
                }
                echo $ex;
            }
        );
        return $bookingId;
    }

    private static function UpdateTickets(DataAccess $dataAccess, Booking $booking, TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
    {
        $tickets = array(
            array('prefix' => PrefixConstant::TICKETVIP, 'amount' => $ticketVIP->getRequestedAmount()),
            array('prefix' => PrefixConstant::TICKETSTD, 'amount' => $ticketStandard->getRequestedAmount()),
            array('prefix' => PrefixConstant::TICKETBGT, 'amount' => $ticketBudget->getRequestedAmount())
        );

        $allTickets = array();

        foreach ($tickets as $ticket) {
            $result = $dataAccess->Reader(
                "SELECT ticket_id
                 FROM ticket 
                 WHERE status = ?
                 AND LEFT(ticket_no, 3) = ?
                 AND event_id = ?
                 LIMIT ?",
                function (PDOStatement $pstmt) use ($booking, $ticket) {
                    $pstmt->bindValue(1, TicketStatusConstant::NEW, PDO::PARAM_STR);
                    $pstmt->bindValue(2, $ticket['prefix'], PDO::PARAM_STR);
                    $pstmt->bindValue(3, $booking->getEventId(), PDO::PARAM_INT);
                    $pstmt->bindValue(4, $ticket['amount'], PDO::PARAM_INT);
                },
                function ($row) {
                    $ticket = new TicketVIP();
                    return $ticket->setTicketId($row['ticket_id']);
                }
            );
            foreach ($result as $ticket) {
                array_push($allTickets, $ticket);
            }
        }

        foreach ($allTickets as $ticket) {
            $dataAccess->NonQuery(
                "UPDATE ticket SET 
                    status = ?, 
                    updated_by = ?, 
                    updated_date = ?,
                    owner = ?
                WHERE ticket_id = ?",
                function (PDOStatement $pstmt) use ($booking, $ticket) {
                    $pstmt->bindValue(1, TicketStatusConstant::SOLD, PDO::PARAM_STR);
                    $pstmt->bindValue(2, $booking->getCreatedBy(), PDO::PARAM_STR);
                    $pstmt->bindValue(3, $booking->getCreatedDate(), PDO::PARAM_STR);
                    $pstmt->bindValue(4, $booking->getCreatedBy(), PDO::PARAM_STR);
                    $pstmt->bindValue(5, $ticket->getTicketId(), PDO::PARAM_STR);
                }
            );
        }

        return $allTickets;
    }

    private static function CreateBookingDetail(DataAccess $dataAccess, Booking $booking, $tickets)
    {
        foreach ($tickets as $ticket) {
            $dataAccess->NonQuery(
                "INSERT INTO booking_detail (
                    booking_id,
                    ticket_id)
                VALUES (?, ?)",
                function (PDOStatement $pstmt) use ($booking, $ticket) {
                    $pstmt->bindValue(1, $booking->getBookingId(), PDO::PARAM_INT);
                    $pstmt->bindValue(2, $ticket->getTicketId(), PDO::PARAM_INT);
                }
            );
        }
    }
}
