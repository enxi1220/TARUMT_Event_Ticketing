<?php

#  Author: Lim En Xi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Update
{
    public static function Update($event)
    {
        $event->setUpdatedDate();

        // todo: poster 

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($event) {
            Update::UpdateEvent($dataAccess, $event);
        });

        return $event->getEventNo();
    }

    private static function UpdateEvent(DataAccess $dataAccess, $event)
    {
        $dataAccess->NonQuery(
            "UPDATE event
                SET category_id = ?, 
                    name = ?, 
                    poster = ?, 
                    venue = ?, 
                    register_start_date = ?, 
                    register_end_date = ?, 
                    event_start_date = ?, 
                    event_end_date = ?, 
                    vip_ticket_price = ?, 
                    standard_ticket_price = ?, 
                    budget_ticket_price = ?, 
                    description = ?, 
                    organizer_name = ?, 
                    organizer_phone = ?, 
                    organizer_mail = ?, 
                    status = ?, 
                    updated_by = ?, 
                    updated_date = ?
                WHERE event_id = ?",
            function (PDOStatement $pstmt) use ($event) {
                $pstmt->bindValue(1, $event->getCategoryId(), PDO::PARAM_INT);
                $pstmt->bindValue(2, $event->getName(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $event->getPoster(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $event->getVenue(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $event->getRegisterStartDate(), PDO::PARAM_STR);
                $pstmt->bindValue(6, $event->getRegisterEndDate(), PDO::PARAM_STR);
                $pstmt->bindValue(7, $event->getEventStartDate(), PDO::PARAM_STR);
                $pstmt->bindValue(8, $event->getEventEndDate(), PDO::PARAM_STR);
                $pstmt->bindValue(9, $event->getVipTicketPrice(), PDO::PARAM_STR);
                $pstmt->bindValue(10, $event->getStandardTicketPrice(), PDO::PARAM_STR);
                $pstmt->bindValue(11, $event->getBudgetTicketPrice(), PDO::PARAM_STR);
                $pstmt->bindValue(12, $event->getDescription(), PDO::PARAM_STR);
                $pstmt->bindValue(13, $event->getOrganizerName(), PDO::PARAM_STR);
                $pstmt->bindValue(14, $event->getOrganizerPhone(), PDO::PARAM_STR);
                $pstmt->bindValue(15, $event->getOrganizerMail(), PDO::PARAM_STR);
                $pstmt->bindValue(16, $event->getStatus(), PDO::PARAM_STR);
                $pstmt->bindValue(17, $event->getUpdatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(18, $event->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(19, $event->getEventId(), PDO::PARAM_INT);

            }
        );
    }
}
