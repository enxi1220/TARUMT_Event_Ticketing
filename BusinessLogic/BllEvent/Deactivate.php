<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/EventStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Deactivate
{
    public static function Deactivate(Event $event)
    {
        $event->setUpdatedDate(DateHelper::GetMalaysiaDateTime());

        $dataAccess = new DataAccess();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($event) {
            Deactivate::DeactivateEvent($dataAccess, $event);
        });
    }

    private static function DeactivateEvent(DataAccess $dataAccess, $event)
    {
        $dataAccess->NonQuery(
            "UPDATE event
                SET status = ?, 
                    updated_by = ?, 
                    updated_date = ?
                WHERE event_id = ?",
            function (PDOStatement $pstmt) use ($event) {
                $pstmt->bindValue(1, EventStatusConstant::CLOSED, PDO::PARAM_STR);
                $pstmt->bindValue(2, $event->getUpdatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $event->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $event->getEventId(), PDO::PARAM_INT);
            }
        );
    }
}
