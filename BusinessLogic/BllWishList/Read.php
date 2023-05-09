<?php

#  Author: Tan Lin Yi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

class WishListRead {

    public static function Read(WishList $wishList)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($wishList) {
                return self::ReadWishList($dataAccess, $wishList);
            }
        );

        return $result;
    }

    private static function ReadWishList(DataAccess $dataAccess, $wishList) {
     return $dataAccess->Reader(
                "SELECT
                    w.wishlist_id,
            w.user_id,
            w.event_id,
            e.event_no,
            e.name,
            e.poster
            FROM wishlist w
            JOIN event e ON w.event_id = e.event_id 
            WHERE w.user_id = IF(:user_id IS NULL, w.user_id, :user_id)
",
                function (PDOStatement $pstmt) use ($wishList) {
                    $pstmt->bindValue(":user_id", $wishList->getUserId(), PDO::PARAM_STR);
                },
                function ($row) {
                 $event = new Event();
                 $event
                    ->setEventId($row['event_id'])
                    ->setEventNo($row['event_no'])
                    ->setName($row['name'])
                    ->setPoster($row['poster']);

                $wishList = new WishList();
                return $wishList
                    ->setUserId($row['user_id'])
                    ->setWishlistId($row['wishlist_id'])
                    ->setEventId($row['event_id'])
                    ->setEvent($event);
                
                
                }
        );
    }

}
