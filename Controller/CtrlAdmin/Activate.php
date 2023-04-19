<?php

/* 
 * Author : Ong Wi Lin
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/Activate.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (!isset($_POST['admin'])) {
            throw new Exception("No admin is selected.");
        }

        $data = json_decode($_POST['admin']);
        // todo: rm hard code
        $data->updated_by = "Kuma";
        
        $admin = new Admin();
        $admin
            ->setAdminId($data->admin_id)
//            ->setEventNo($data->eventNo)
            ->setUpdatedBy($data->updated_by);   

        Activate::Activate($admin);
        
        echo "The account is activated.";
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
