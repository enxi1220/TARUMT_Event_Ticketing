<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";

class Update 
{
    public static function Update($category)
    {
        $category->setUpdatedDate();
        
        //database
        $dataAccess = DataAccess::getInstance();
        $dataAccess->BeginDatabase(function ($dataAccess) use ($category){
            //update category
            Update::UpdateCategory($dataAccess, $category);
        });
        
        return $category->getName(); 
    }
    
    private static function UpdateCategory(DataAccess $dataAccess, $category)
    {
        $dataAccess->NonQuery(
            "UPDATE category
                SET name = ?, 
                    description = ?, 
                    updated_by = ?, 
                    updated_date = ?
                WHERE category_id = ?",
            function (PDOStatement $pstmt) use ($category) {
                $pstmt->bindValue(1, $category->getName(), PDO::PARAM_STR);
                $pstmt->bindValue(2, $category->getDescription(), PDO::PARAM_STR);
                $pstmt->bindValue(3, $category->getUpdatedBy(), PDO::PARAM_STR);
                $pstmt->bindValue(4, $category->getUpdatedDate(), PDO::PARAM_STR);
                $pstmt->bindValue(5, $category->getCategoryId(), PDO::PARAM_INT);
            }
        );
    }
}

