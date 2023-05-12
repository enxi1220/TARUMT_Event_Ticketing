<?php

/**
 * Description of ICategory
 * @author Ong Yi Chween
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";

interface ICategory
{
    public static function createCategory(): Category;
    
}

