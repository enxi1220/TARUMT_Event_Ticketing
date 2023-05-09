<?php


#  Author: Ong Yi Chween
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

class CategoryRead {

    public static function Read(Category $category) {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
                function (DataAccess $dataAccess) use ($category) {
                    return self::ReadCategory($dataAccess, $category);
                }
        );

        return $result;
    }

    private static function ReadCategory(DataAccess $dataAccess, $category) {
        return $dataAccess->Reader(
                        "SELECT 
                        c.category_id,
                        c.name,
                        c.description,
                        c.created_by,
                        c.created_date,
                        c.updated_by,
                        c.updated_date
                        FROM category c
                        WHERE c.category_id = IF(:category_id IS NULL, c.category_id, :category_id)
                        AND c.name = IF(:name IS NULL, c.name, :name)
                        ORDER BY c.category_id DESC",
                
                function (PDOStatement $pstmt) use ($category) {
                    $pstmt->bindValue(":category_id", $category->getCategoryId(), PDO::PARAM_INT);
                    $pstmt->bindValue(":name", $category->getName(), PDO::PARAM_STR);

                },
                function ($row) {
                    $category = new Category();

                    return $category
                            ->setCategoryId($row['category_id'])
                            ->setName($row['name'])
                            ->setDescription($row['description'])
                            ->setCreatedBy($row['created_by'])
                            ->setCreatedDate($row['created_date'])
                            ->setUpdatedBy($row['updated_by'])
                            ->setUpdatedDate($row['updated_date'])
                    ;
                }
        );
    }

}
