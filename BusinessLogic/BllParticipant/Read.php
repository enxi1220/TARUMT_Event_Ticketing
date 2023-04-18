<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Participant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
/**
 * Description of Read
 *
 * @author Tan Lin Yi
 */
class Read {
    public static function Read(Participant $participant)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($participant) {
                return Read::ReadParticipant($dataAccess, $participant);
            }
        );

        return $result;
    }
    
    private static function ReadParticipant(DataAccess $dataAccess, Participant $participant)
    {
        return $dataAccess->Reader(
           "SELECT DISTINCT 
               u.username, 
               u.name, 
               u.phone, 
               u.mail
            FROM user u
            JOIN booking b ON b.user_id = u.user_id 
            WHERE b.event_id = IF(:event_id IS NULL, b.event_id, :event_id)",
            function (PDOStatement $pstmt) use ($participant) {
                $pstmt->bindValue(":event_id", $participant->getEventId(), PDO::PARAM_INT);
            },
            function ($row) {
                $participant = new Participant();
                $participant ->setUsername($row['username'])
                    ->setName($row['name'])
                    ->setPhone($row['phone'])
                    ->setMail($row['mail']);
//                    ->setEventId($row['event_id']);

                return $participant;
            }
        );
    }
}
