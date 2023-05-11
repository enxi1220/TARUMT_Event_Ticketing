<?php

/* 
 * Ong Wi Lin
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllAdmin/AdminRead.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Admin.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
            $admin = new Admin();
            $admin->setAdminId(null);
            $result = AdminRead::Read($admin);

            if (empty($result)) {
                exit;
            }

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
                        'created_by' => $admin->getCreatedBy(),
                        'updated_date' => $admin->getUpdatedDate(),
                        'updated_by' => $admin->getUpdatedBy()  
                    );
                },
                $result
            );

            // xml
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><admins></admins>');
            foreach ($output as $admin) {
                $adminNode = $xml->addChild('admin');
                foreach ($admin as $key => $value) {
                    if ($key === 'created_date' || $key === 'updated_date') {
                        $value = $value;
//                        $value = $value->format('Y-m-d H:i:s');
                    }
                    $adminNode->addChild($key, $value);
                } 

            }

            $xmlString = $xml->asXML();

            $header = [
                'Name',
                'Username',
                'Role',
                'Phone',
                'Mail',
                'Status',
                'Created Date',
                'Created By',
                'Updated Date',
                'Updated By'
            ]; 

            // xpath 
            $data = [];
            foreach ($xml->xpath('//admin') as $admin) {
                $data[] = [
                    (string) $admin->name,
                    (string) $admin->username,
                    (string) $admin->role,
                    (string) $admin->phone,
                    (string) $admin->mail,
                    (string) $admin->status,
                    (string) $admin->created_date,
                    (string) $admin->created_by,
                    (string) $admin->updated_date,
                    (string) $admin->updated_by
                ];
            }

            // Open a file handle for writing the CSV data
            $fh = fopen('AdminStaffRecord.csv', 'w');

            // Write the CSV header row to the file handle
            fputcsv($fh, $header);

            // Write the CSV data rows to the file handle
            foreach ($data as $row) {
                fputcsv($fh, $row);
            }

            // Close the file handle
            fclose($fh);

            // Check if the file was created successfully
            if (file_exists('AdminStaffRecord.csv')) {
                // Download the file
                header('Content-Type: application/csv');
                header('Content-Disposition: attachment; filename="AdminStaffRecord.csv"');

                exit;
                echo 'The file AdminStaffRecord.csv is downloaded.';

            } else {
                echo 'Error: Unable to create AdminStaffRecord.csv file.';
            }
        } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
//        echo $e;
                    echo "Error! Please try again.";

    }
}
        
