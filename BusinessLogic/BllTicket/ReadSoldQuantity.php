<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";


class ReadSoldQuantity
{
    public static function Read(Event $event, TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
    {
        $dataAccess = DataAccess::getInstance();
        return $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($event, $ticketVIP, $ticketStandard, $ticketBudget) {
                return ReadSoldQuantity::ReadTicketQuantity($dataAccess, $event, $ticketVIP, $ticketStandard, $ticketBudget);
            }
        );
    }

    private static function ReadTicketQuantity(DataAccess $dataAccess, Event $event, TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
    {
        return $dataAccess->Reader(
            "SELECT 
                LEFT(ticket_no, 3) AS ticket_type, 
                COUNT(*) AS ticket_quantity
            FROM ticket 
            WHERE status = :status
            AND event_id = :event_id
            GROUP BY LEFT(ticket_no, 3);
            ",
            function (PDOStatement $pstmt) use ($event, $ticketVIP, $ticketStandard, $ticketBudget) {
                $pstmt->bindValue(":status", TicketStatusConstant::SOLD, PDO::PARAM_STR);
                $pstmt->bindValue(":event_id", $event->getEventId(), PDO::PARAM_INT);
            },
            function ($row) use ($ticketVIP, $ticketStandard, $ticketBudget) {

                if ($row['ticket_type'] == PrefixConstant::TICKETVIP) {
                    $ticket = $ticketVIP;
                } else if ($row['ticket_type'] == PrefixConstant::TICKETSTD) {
                    $ticket = $ticketStandard;
                } else if ($row['ticket_type'] == PrefixConstant::TICKETBGT) {
                    $ticket = $ticketBudget;
                }

                return $ticket->setCount($row['ticket_quantity']);
            }
        );
    }
}
