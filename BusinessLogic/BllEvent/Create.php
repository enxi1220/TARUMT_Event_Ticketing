<?php

#  Author: Lim En Xi
// Validation that requried Database & CRUD

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/EventStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Create
{
    public static function Create(Event $event)
    {
        // complete event object and tickets object 
        $event->setEventNo();
        $event->setStatus(EventStatusConstant::OPEN);
        $event->setCreatedDate();
        $event->createTickets();

        $tickets = $event->getTickets();

        // todo: optimize?. currently, $event->poster = $_FILES['poster']
        $fileName = uniqid() . "_". basename($event->getPoster()['name']); // generate new filename
        $targetPath = $_SERVER['DOCUMENT_ROOT'] . $event->posterPath() . $fileName; // specify store location
        
        $posterTemp = $event->getPoster()['tmp_name'];
        $event->setPoster($fileName); //store filename only

        // start database
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($event, $tickets) {
            // insert event & tickets 
            $eventId = Create::CreateEvent($dataAccess, $event);
            Create::CreateTickets($dataAccess, $tickets, $eventId);
        });

        move_uploaded_file($posterTemp, $targetPath);

        return $event->getEventNo();
    }

    //private func for database
    private static function CreateEvent(DataAccess $dataAccess, $event)
    {
        $eventId = $dataAccess->NonQuery(
            "INSERT INTO event (
                event_no,
                category_id,
                name,
                poster,
                venue,
                register_start_date,
                register_end_date,
                event_start_date,
                event_end_date,
                vip_ticket_qty,
                standard_ticket_qty,
                budget_ticket_qty,
                vip_ticket_price,
                standard_ticket_price,
                budget_ticket_price,
                description,
                organizer_name,
                organizer_phone,
                organizer_mail,
                status,
                created_by,
                created_date
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
            function (PDOStatement $pstmt) use ($event) {
                $pstmt->bindValue(1, $event->getEventNo(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $event->getCategoryId(), PDO::PARAM_INT);
                $pstmt->bindValue(3, $event->getName(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $event->getPoster(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $event->getVenue(), PDO::PARAM_STR);
                $pstmt->bindValue(6, $event->getRegisterStartDate(), PDO::PARAM_STR);
                $pstmt->bindValue(7, $event->getRegisterEndDate(), PDO::PARAM_STR);
                $pstmt->bindValue(8, $event->getEventStartDate(), PDO::PARAM_STR);
                $pstmt->bindValue(9, $event->getEventEndDate(), PDO::PARAM_STR);
                $pstmt->bindValue(10, $event->getVipTicketQty(), PDO::PARAM_INT);
                $pstmt->bindValue(11, $event->getStandardTicketQty(), PDO::PARAM_INT);
                $pstmt->bindValue(12, $event->getBudgetTicketQty(), PDO::PARAM_INT);
                $pstmt->bindValue(13, $event->getVipTicketPrice(), PDO::PARAM_INT);
                $pstmt->bindValue(14, $event->getStandardTicketPrice(), PDO::PARAM_INT);
                $pstmt->bindValue(15, $event->getBudgetTicketPrice(), PDO::PARAM_INT);
                $pstmt->bindValue(16, $event->getDescription(), PDO::PARAM_STR);
                $pstmt->bindValue(17, $event->getOrganizerName(), PDO::PARAM_STR);
                $pstmt->bindValue(18, $event->getOrganizerPhone(), PDO::PARAM_STR);
                $pstmt->bindValue(19, $event->getOrganizerMail(), PDO::PARAM_STR);
                $pstmt->bindValue(20, $event->getStatus(), PDO::PARAM_STR);
                $pstmt->bindValue(21, $event->getCreatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(22, $event->getCreatedDate(), PDO::PARAM_STR);
            },
            function (Exception $ex) {
                if (str_contains($ex, 'Duplicate entry') && str_contains($ex, 'event_no_UNIQUE')) {
                    echo "Duplicate event no is generated. Please try again.";
                }
                echo $ex;
            }
        );
        return $eventId;
    }

    private static function CreateTickets(DataAccess $dataAccess, $tickets, $eventId)
    {
        foreach ($tickets as $ticket) {
            $dataAccess->NonQuery(
                "INSERT INTO ticket (
                    ticket_no,
                    event_id, 
                    status
                    ) VALUES (?,?,?)",
                function (PDOStatement $pstmt) use ($ticket, $eventId) {
                    $pstmt->bindValue(1, $ticket->getTicketNo(), PDO::PARAM_STR);
                    $pstmt->bindValue(2, $eventId, PDO::PARAM_INT);
                    $pstmt->bindValue(3, $ticket->getStatus(), PDO::PARAM_STR);
                }

            );
        }
    }
}
