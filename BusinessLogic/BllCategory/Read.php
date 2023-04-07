<?php

#  Author: Vinnie Chin Loh Xin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PosterPathConstant.php";

class Read {

    public static function Read(Event $event) {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
                function (DataAccess $dataAccess) use ($event) {
                    return Read::ReadCategory($dataAccess, $event);
                }
        );

        return $result;
    }

    private static function ReadCategory(DataAccess $dataAccess, $event) {
        return $dataAccess->Reader(
                        "SELECT 
                    c.category_id,
                    c.name,
                    c.description,
                    c.status,
                    c.created_by,
                    c.created_date,
                    c.updated_by,
                    c.updated_date
                FROM category c
                WHERE c.category_id = IF(:category_id IS NULL, c.category_id, :category_id)
                    AND c.name = IF(:name IS NULL, c.name, :name)
                    AND c.status = IF(:status IS NULL, c.status, :status)
                ORDER BY c.category_id DESC",
                        function (PDOStatement $pstmt) use ($event) {
                            $pstmt->bindValue(":category_id", $event->getCategoryId(), PDO::PARAM_INT);
                            $pstmt->bindValue(":name", $event->getCategory()->getName(), PDO::PARAM_STR);
                            $pstmt->bindValue(":status", $event->getCategory()->getStatus(), PDO::PARAM_STR);
                        },
                        function ($row) {
                            $category = new Category();

                            return $category
                                    ->setCategoryId($row['category_id'])
                                    ->setName($row['name'])
                                    ->setDescription($row['description'])
                                    ->setStatus($row['status'])
                                    ->setCreatedBy($row['created_by'])
                                    ->setCreatedDate($row['created_date'])
                                    ->setUpdatedBy($row['updated_by'])
                                    ->setUpdatedDate($row['updated_date'])
                            ;
                        }
        );
    }

}
