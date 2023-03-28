<?php

#  Author: Lim En Xi

class Update
{
    public static function Update($event)
    {
        $event->setUpdatedDate(DateHelper::GetMalaysiaDateTime());

        $dataAccess = new DataAccess();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($event) {
            Update::UpdateEvent($dataAccess, $event);
        });
    }

    private static function UpdateEvent(DataAccess $dataAccess, $event)
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
