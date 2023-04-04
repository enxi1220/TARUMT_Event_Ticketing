<?php

#  Author: Lim En Xi
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Booking.php";

class Read
{
    public static function Read(Booking $booking)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($booking) {
                return Read::ReadBooking($dataAccess, $booking);
            }
        );

        return $result;
    }

    private static function ReadBooking(DataAccess $dataAccess, $booking)
    {
        return $dataAccess->Reader(
            "SELECT 
                b.booking_id, 
                b.booking_no, 
                b.event_id, 
                b.user_id, 
                b.created_by, 
                b.created_date,
                e.event_no, 
                e.name, 
                e.poster, 
                e.venue, 
                e.event_start_date, 
                e.event_end_date
            FROM booking b
            JOIN event e ON b.event_id = e.event_id
            WHERE e.event_id = IF(:event_id IS NULL, e.event_id, :event_id)
            AND b.user_id = IF(:user_id IS NULL, b.user_id, :user_id)
            AND b.created_by = IF(:created_by IS NULL, b.created_by, :created_by)",
            function (PDOStatement $pstmt) use ($booking) {
                $pstmt->bindValue(":event_id", $booking->getEventId(), PDO::PARAM_INT);
                $pstmt->bindValue(":user_id", $booking->getUserId(), PDO::PARAM_INT);
                $pstmt->bindValue(":created_by", $booking->getCreatedBy(), PDO::PARAM_STR);
            },
            function ($row) {
                $event = new Event();
                $event->setEventId($row['event_id'])
                    ->setEventNo($row['event_no'])
                    ->setName($row['name'])
                    ->setPoster($row['poster'])
                    ->setVenue($row['venue'])
                    ->setEventStartDate($row['event_start_date'])
                    ->setEventEndDate($row['event_end_date']);

                $booking = new Booking();
                return $booking
                    ->setBookingId($row['booking_id'])
                    ->setBookingNo($row['booking_no'])
                    ->setEventId($row['event_id'])
                    ->setUserId($row['user_id'])
                    ->setCreatedBy($row['created_by'])
                    ->setCreatedDate($row['created_date'])
                    ->setEvent($event);
            }
        );
    }
}
