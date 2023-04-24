<?php

#  Author: Ong Wi Lin

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $admin = new Admin();
        $admin->setAdminId(null);
        $result = AdminRead::Read($admin);
        $output = array_map(
            function ($admin) {
                return array(
                    'admin_id' => $admin->getAdminId(),
                    'name' => $admin->getName(),
                    'username' => $admin->getUsername(),
                    'role' => $admin->getRole(),
                    'phone' => $admin->getPhone(),
                    'mail' => $admin->getMail(),
                    'status' => $admin->getStatus(),
                    'created_date' => $admin->getCreatedDate(),
//                    'created_date' => date('Y-m-d H:i:s', strtotime($admin->getCreatedDate())),
//                    'created_date' => $admin->getCreatedDate()->format('Y-m-d H:i:s'),

                    
                    'created_by' => $admin->getCreatedBy(),
                    'updated_date' => $admin->getUpdatedDate(),
//                    'updated_date' => date('Y-m-d H:i:s', strtotime($admin->getUpdatedDate())),
//                    'updated_date' => $admin->getUpdatedDate()->format('Y-m-d H:i:s'),

                    'updated_by' => $admin->getUpdatedBy()                
                        );
            },
            $result
        );

        echo json_encode($output);
    } catch (\Throwable $e) {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
