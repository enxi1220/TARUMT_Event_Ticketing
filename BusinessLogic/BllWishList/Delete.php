<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Delete
 *
 * @author Tan Lin Yi
 */
class WishListDelete {
      

    public static function Delete($wishlist)
    {

        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($wishlist) {
            self::WishListDelete($dataAccess, $wishlist);
        });
    }

    private static function WishListDelete(DataAccess $dataAccess, $wishlist)
    {
        $dataAccess->NonQuery(
            "DELETE FROM wishlist WHERE wishlist_id = ?",
            function (PDOStatement $pstmt) use ($wishlist) {
                $pstmt->bindValue(1, $wishlist->getWishListId(), PDO::PARAM_STR);
               
            }
        );
    }
}

