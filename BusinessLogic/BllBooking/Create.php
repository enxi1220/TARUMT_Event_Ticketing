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
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/PaymentDetail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllTicket/ReadNewQuantity.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";

class BookingCreate
{
    public static function Create(Booking $booking, Payment $payment, TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
    {
        $booking->setBookingNo();
        $booking->setCreatedDate();
        $payment->setPaymentNo();
        $payment->setCreatedDate();

        ReadNewQuantity::Read($booking->getEvent(), $ticketVIP, $ticketStandard, $ticketBudget);
        $event = EventRead::Read($booking->getEvent());

        if (empty($event)) {
            throw new Exception("The event is not exist.", 500);
        }

        $event = $event[0];

        if($event->getStatus() == EventStatusConstant::CLOSED){
            throw new Exception("The event has been closed.", 500);
        }

        $payment->setPrice(
            ((int)$ticketVIP->getRequestedAmount() * $event->getVipTicketPrice()) +
            ((int)$ticketStandard->getRequestedAmount() * $event->getStandardTicketPrice()) +
            ((int)$ticketBudget->getRequestedAmount() * $event->getBudgetTicketPrice())
        );

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($booking, $payment, $ticketVIP, $ticketStandard, $ticketBudget, $event) {
            $bookingId = self::CreateBooking($dataAccess, $booking);

            $tickets = self::UpdateTickets($dataAccess, $booking, $ticketVIP, $ticketStandard, $ticketBudget);

            $booking->setBookingId($bookingId);
            self::CreateBookingDetail($dataAccess, $booking, $tickets);

            $paymentId = self::CreatePayment($dataAccess, $payment, $booking);

            $payment->setPaymentId($paymentId);
            self::CreatePaymentDetail($dataAccess, $payment, $event, $tickets);
        });

        return ($booking->getBookingNo() . " ". $payment->getPaymentNo());
    }

    private static function CreateBooking(DataAccess $dataAccess, Booking $booking)
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
                    throw new Exception("Duplicate booking no is generated. Please try again.", 500);
                }
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
                "SELECT 
                    ticket_id,
                    ticket_no
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
                    return $ticket->setTicketId($row['ticket_id'])
                                  ->setTicketNo($row['ticket_no'])
                    ;
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

    private static function CreatePayment(DataAccess $dataAccess, Payment $payment, Booking $booking)
    {
        $paymentId = $dataAccess->NonQuery(
            "INSERT INTO payment (
                payment_no, 
                booking_id, 
                payment_type, 
                price, 
                created_date) 
            VALUES (?, ?, ?, ?, ?)",
            function (PDOStatement $pstmt) use ($payment, $booking) {
                $pstmt->bindValue(1, $payment->getPaymentNo(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $booking->getBookingId(), PDO::PARAM_INT);
                $pstmt->bindValue(3, $payment->getPaymentType(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $payment->getPrice(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $payment->getCreatedDate(), PDO::PARAM_STR);
            },
            function (Exception $ex) {
                if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'payment_no_UNIQUE')) {
                    throw new Exception("Duplicate payment no is generated. Please try again.", 500);
                }
            }
        );
        return $paymentId;
    }

    private static function CreatePaymentDetail(DataAccess $dataAccess, Payment $payment, Event $event, $tickets)
    {
        foreach ($tickets as $ticket) {
            $price = "";
            if (substr($ticket->getTicketNo(), 0, 3) == PrefixConstant::TICKETVIP) {
                $price = $event->getVipTicketPrice();
            } else if (substr($ticket->getTicketNo(), 0, 3) == PrefixConstant::TICKETSTD) {
                $price = $event->getStandardTicketPrice();
            } else if (substr($ticket->getTicketNo(), 0, 3) == PrefixConstant::TICKETBGT) {
                $price = $event->getBudgetTicketPrice();
            }

            $dataAccess->NonQuery(
                "INSERT INTO payment_detail (
                    payment_id,
                    ticket_no,
                    event_name,
                    ticket_price)
                VALUES (?, ?, ?, ?)",
                function (PDOStatement $pstmt) use ($payment, $ticket, $event, $price) {
                    $pstmt->bindValue(1, $payment->getPaymentId(), PDO::PARAM_INT);
                    $pstmt->bindValue(2, $ticket->getTicketNo(), PDO::PARAM_STR);
                    $pstmt->bindValue(3, $event->getName(), PDO::PARAM_STR);
                    $pstmt->bindValue(4, $price, PDO::PARAM_STR);
                }
            );
        }
    }
}
