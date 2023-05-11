<?php

#  Author: linyi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class WishListCreate {

    public static function Create(WishList $wishList) {
        // start DB transaction
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($wishList) {
    
            self::CreateWishList($dataAccess, $wishList);
        });
    }

    private static function CreateWishList (DataAccess $dataAccess, $wishList) {
     $dataAccess->NonQuery(
                "INSERT INTO wishList (
            user_id,
            event_id
        ) VALUES (?,?)",
                function (PDOStatement $pstmt) use ($wishList) {
                    $pstmt->bindValue(1, $wishList->getUserId(), PDO::PARAM_INT);
                    $pstmt->bindValue(2, $wishList->getEventId(), PDO::PARAM_STR);
                }

        );
    }

}
