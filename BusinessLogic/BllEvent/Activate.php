<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/EventStatusConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Activate
{
    public static function Activate(Event $event)
    {
        $event->setUpdatedDate();

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($event) {
            Activate::ActivateEvent($dataAccess, $event);
        });
    }

    private static function ActivateEvent(DataAccess $dataAccess, $event)
    {
        $dataAccess->NonQuery(
            "UPDATE event
                SET status = ?, 
                    updated_by = ?, 
                    updated_date = ?
                WHERE event_id = ?",
            function (PDOStatement $pstmt) use ($event) {
                $pstmt->bindValue(1, EventStatusConstant::OPEN, PDO::PARAM_STR);
                $pstmt->bindValue(2, $event->getUpdatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $event->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $event->getEventId(), PDO::PARAM_INT);
            }
        );
    }
}
