<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";


class Read
{

    public static function Read(Event $event)
    {
        $dataAccess = new DataAccess();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($event) {
                return Read::ReadEvent($dataAccess, $event);
            }
        );

        return $result;
    }

    private static function ReadEvent(DataAccess $dataAccess, $event){
        return $dataAccess->Reader(
                    "SELECT 
                        e.event_id, 
                        e.category_id,
                        e.event_no, 
                        e.name AS event_name, 
                        e.poster, 
                        e.venue, 
                        e.register_start_date, 
                        e.register_end_date, 
                        e.event_start_date, 
                        e.event_end_date, 
                        e.description, 
                        e.vip_ticket_qty, 
                        e.standard_ticket_qty, 
                        e.budget_ticket_qty, 
                        e.vip_ticket_price, 
                        e.standard_ticket_price, 
                        e.budget_ticket_price, 
                        e.organizer_name, 
                        e.organizer_mail, 
                        e.organizer_phone, 
                        e.status, 
                        e.created_by, 
                        e.created_date, 
                        e.updated_by, 
                        e.updated_date,
                        c.name AS category_name
                    FROM event e
                    JOIN category c ON e.category_id = c.category_id
                    WHERE e.event_id = ?
                    ORDER BY e.event_id DESC",
                    function (PDOStatement $pstmt) use ($event) {
                        $pstmt->bindValue(1, $event->getEventId(), PDO::PARAM_INT);
                        // $pstmt->bindValue(2, $event->getStatus(), PDO::PARAM_STR);
                    },
                    function ($row) {
                        $event = new Event();
                        $category = new Category();

                        $category
                            ->setCategoryId($row['category_id'])
                            ->setName($row['category_name']);

                        return $event
                            ->setEventId($row['event_id'])
                            ->setCategoryId($row['category_id'])
                            ->setEventNo($row['event_no'])
                            ->setName($row['event_name'])
                            ->setPoster($row['poster'])
                            ->setVenue($row['venue'])
                            ->setRegisterStartDate($row['register_start_date'])
                            ->setRegisterEndDate($row['register_end_date'])
                            ->setEventStartDate($row['event_start_date'])
                            ->setEventEndDate($row['event_end_date'])
                            ->setDescription($row['description'])
                            ->setVipTicketQty($row['vip_ticket_qty'])
                            ->setStandardTicketQty($row['standard_ticket_qty'])
                            ->setBudgetTicketQty($row['budget_ticket_qty'])
                            ->setVipTicketPrice($row['vip_ticket_price'])
                            ->setStandardTicketPrice($row['standard_ticket_price'])
                            ->setBudgetTicketPrice($row['budget_ticket_price'])
                            ->setOrganizerName($row['organizer_name'])
                            ->setOrganizerMail($row['organizer_mail'])
                            ->setOrganizerPhone($row['organizer_phone'])
                            ->setStatus($row['status'])
                            ->setCreatedBy($row['created_by'])
                            ->setCreatedDate($row['created_date'])
                            ->setUpdatedBy($row['updated_by'])
                            ->setUpdatedDate($row['updated_date'])
                            ->setCategory($category)
                            ;
                    }
                );
    }
}
