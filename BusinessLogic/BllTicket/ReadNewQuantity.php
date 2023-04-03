<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";


class ReadNewQuantity
{
    public static function Read(TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($ticketVIP, $ticketStandard, $ticketBudget) {
                return ReadNewQuantity::ReadTicketQuantity($dataAccess, $ticketVIP, $ticketStandard, $ticketBudget);
            }
        );

        $requestedTickets = [$ticketVIP, $ticketStandard, $ticketBudget];
        ReadNewQuantity::QuantityValidation($requestedTickets, $result);
    }

    private static function ReadTicketQuantity(DataAccess $dataAccess, TicketVIP $ticketVIP, TicketStandard $ticketStandard, TicketBudget $ticketBudget)
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
            function (PDOStatement $pstmt) use ($ticketVIP, $ticketStandard, $ticketBudget) {
                $pstmt->bindValue(":status", TicketStatusConstant::NEW, PDO::PARAM_STR);
                $pstmt->bindValue(":event_id", $ticketVIP->getEventId(), PDO::PARAM_INT);
            },
            function ($row) use ($ticketVIP, $ticketStandard, $ticketBudget) {

                if ($row['ticket_type'] == PrefixConstant::TICKETVIP) {
                    $ticket = $ticketVIP;
                } else if ($row['ticket_type'] == PrefixConstant::TICKETBGT) {
                    $ticket = $ticketStandard;
                } else if ($row['ticket_type'] == PrefixConstant::TICKETSTD) {
                    $ticket = $ticketBudget;
                }

                return $ticket
                    ->setCount($row['ticket_quantity']);
            }
        );
    }

    private static function QuantityValidation($requestedTickets, $result)
    {
        $err = "";
        if (empty($result)) {
            throw new Exception("Sorry, all tickets are sold.\n");
        }

        //get request ticket class
        $ticketClasses = [];
        foreach ($requestedTickets as $requestedTicket) {
            if ($requestedTicket->getRequestedAmount() > 0) {
                $ticketClasses[] = get_class($requestedTicket);
            }
        }

        // loop requested ticket class 
        foreach ($ticketClasses as $className) {
            $isFound = false;
            foreach ($result as $ticket) {
                if (get_class($ticket) == $className) {
                    $isFound = true;
                    break;
                }
            }

            if (!$isFound) {
                $missingTicketClass = new $className();
                $err .= "All {$missingTicketClass->type()} tickets are sold.\n";
            }
        }

        foreach ($result as $ticket) {
            if (!$ticket->isAvailable($ticket)) {
                $err .= "There are only {$ticket->getCount()} {$ticket->type()} tickets left.\n";
            }
        }

        if (!empty($err)) {
            throw new Exception("Sorry. $err");
        }
    }
}
