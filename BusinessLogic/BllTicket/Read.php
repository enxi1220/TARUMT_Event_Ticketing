<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketVIP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketStandard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/TicketBudget.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";

class Read
{
    public static function Read(Ticket $ticket)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($ticket) {
                return Read::ReadTicket($dataAccess, $ticket);
            }
        );

        return $result;
    }

    private static function ReadTicket(DataAccess $dataAccess, $ticket)
    {
        return $dataAccess->Reader(
            "SELECT 
                t.ticket_id,
                t.event_id,
                t.ticket_no,
                t.owner,
                t.status,
                t.updated_date,
                t.updated_by,
                e.event_no,
                e.name,
                e.event_start_date,
                e.poster
            FROM ticket t
            JOIN event e ON t.event_id = e.event_id 
            WHERE t.event_id = IF(:ticket_id IS NULL, t.ticket_id, :ticket_id)
            AND   t.ticket_no = IF(:ticket_no IS NULL, t.ticket_no, :ticket_no)
            AND   e.event_no = IF(:event_no IS NULL, e.event_no, :event_no)",
            function (PDOStatement $pstmt) use ($ticket) {
                $pstmt->bindValue(":ticket_id", $ticket->getEventId(), PDO::PARAM_INT);
                $pstmt->bindValue(":ticket_no", $ticket->getTicketNo(), PDO::PARAM_INT);
                $pstmt->bindValue(":event_no", $ticket->getEventNo(), PDO::PARAM_STR);
            },
            function ($row) {
                $event = new Event();
                if(substr($row['ticket_no'], 0, 3) == PrefixConstant::TICKETVIP){
                    $ticket = new TicketVIP();
                }else if(substr($row['ticket_no'], 0, 3) == PrefixConstant::TICKETBGT){
                    $ticket = new TicketBudget();
                }else if(substr($row['ticket_no'], 0, 3) == PrefixConstant::TICKETSTD){
                    $ticket = new TicketStandard();
                }

                $event
                    ->setEventId($row['event_id'])
                    ->setEventNo($row['event_no'])
                    ->setName($row['name'])
                    ->setEventStartDate($row['event_start_date'])
                    ->setPoster($row['poster']);

                return $ticket
                    ->setTicketId($row['ticket_id'])
                    ->setEventId($row['event_id'])
                    ->setTicketNo($row['ticket_no'])
                    ->setOwner($row['owner'])
                    ->setStatus(($row['status']))
                    ->setUpdatedDate($row['updated_date'])
                    ->setUpdatedBy($row['updated_by'])
                    ->setEvent($event)
                    ;
            }
        );
    }
}
