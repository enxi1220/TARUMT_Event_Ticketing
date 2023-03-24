<?php

#  Author: Lim En Xi
// Database with validation & CRUD

class Create 
{
    public static function Create($event)
    {
        $event->setEventNo("EVT/2303/00002");
        $event->setStatus("Open");
        $event->setCreatedDate(date('d-m-y h:i:s'));

        // todo: optimize
        $host = 'localhost:3307';
        $dbname = 'tarumt_event_ticketing';
        $user = 'root';
        $password = '';
        $dsn = "mysql:host=$host; dbname=$dbname"; //dsn=database source name
        $db = new PDO($dsn, $user, $password); //connect to MYSQL using PDO class
        //move above to another file

        $pstmt = $db->prepare(
            "INSERT INTO event(
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
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
        );

        //prepare statements are important feature of PDO which can help to prevent SQL injection attacks by seperating SQL Code from user input
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
        $pstmt->bindValue(16, $event->getDescripton(), PDO::PARAM_STR);
        $pstmt->bindValue(17, $event->getOrganizerName(), PDO::PARAM_STR);
        $pstmt->bindValue(18, $event->getOrganizerPhone(), PDO::PARAM_STR);
        $pstmt->bindValue(19, $event->getOrganizerMail(), PDO::PARAM_STR);
        $pstmt->bindValue(20, $event->getStatus(), PDO::PARAM_STR);
        $pstmt->bindValue(21, $event->getCreatedBy(), PDO::PARAM_STR);
        $pstmt->bindValue(22, $event->getCreatedDate(), PDO::PARAM_STR);
        $pstmt->execute();

        // move_uploaded_file($poster['temp'], $_SERVER['DOCUMENT_ROOT'].$event->getPoster());
        // Undefined array key "temp" in, image from where oh...
    }
}
