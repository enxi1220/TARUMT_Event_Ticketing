<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/FoTicket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";






class FoTicketRead {

    public static function Read(FoTicket $FoTicket) {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
                function (DataAccess $dataAccess) use ($FoTicket) {
                    return self::FoReadTicket($dataAccess, $FoTicket);
                }
        );

        return $result;
    }

    private static function FoReadTicket(DataAccess $dataAccess, FoTicket $FoTicket) {
        return $dataAccess->Reader(
                        "SELECT 
                            bd.booking_detail_id, 
                            bd.booking_id, 
                            bd.ticket_id, 
                            e.event_no, 
                            e.poster,
                            e.name, 
                            e.event_start_date,
                            t.ticket_no 
                            FROM booking_detail bd 
                            JOIN ticket t ON bd.ticket_id = t.ticket_id 
                            JOIN booking b ON b.booking_id = bd.booking_id 
                            JOIN event e ON e.event_id = b.event_id 
                            WHERE bd.booking_id = IF(:booking_id IS NULL, bd.booking_id, :booking_id)",
                        function (PDOStatement $pstmt) use ($FoTicket) {
                            $pstmt->bindValue(":booking_id", $FoTicket->getBookingId(), PDO::PARAM_INT);

                        },
                        function ($row) {
                            
                             $event = new Event();
                            $event
                                    ->setEventNo($row['event_no'])
                                    ->setName($row['name'])
                                    ->setPoster($row['poster'])
                                    ->setEventStartDate($row['event_start_date']);
                            
                            $FoTicket = new FoTicket();
                            
                            $ticket = new TicketVIP();
                            $ticket ->setTicketNo($row['ticket_no']);

                            return $FoTicket
                  
                                    ->setBookingDetailId($row['booking_detail_id'])
                                ->setBookingId($row['booking_id'])
                                ->setTicketId($row['ticket_id'])
                                ->setEvent($event)
                                    ->setTicket($ticket)
                                   
                            ;
                        }
        );
    }

}
