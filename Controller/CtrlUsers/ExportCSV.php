<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUsers/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $user = new User();
        $result = UsersRead::Read($user);

        if (empty($result)) {
            exit;
        }

        $output = array_map(
            function ($user) {
                return array(
                    'userId' => $user->getUserId(),
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'name' => $user->getName(),
                    'phone' => $user->getPhone(),
                    'mail' => $user->getMail(),
                    'status' => $user->getStatus(),
                    'createdDate' => $user->getCreatedDate(),
                    'createdBy' => $user->getCreatedBy(),
                    'updatedDate' => $user->getUpdatedDate(),
                    'updatedBy' => $user->getUpdatedBy()
                );
            },
            $result
        );

        // xml
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><users></users>');
        foreach ($output as $user) {
            $userNode = $xml->addChild('user');
            foreach ($user as $key => $value) {
                $userNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        $header = [
            'Username',
            'Name',
            'Phone',
            'Mail',
            'Status',
        ]; 

        // xpath 
        $data = [];
        foreach ($xml->xpath('//user') as $user) {
            $data[] = [
                (string) $user->username,
                (string) $user->name,
                (string) $user->phone,
                (string) $user->mail,
                (string) $user->status,
            ];
        }

        // Open a file handle for writing the CSV data
        $fh = fopen('users.csv', 'w');

        // Write the CSV header row to the file handle
        fputcsv($fh, $header);

        // Write the CSV data rows to the file handle
        foreach ($data as $row) {
            fputcsv($fh, $row);
        }

        // Close the file handle
        fclose($fh);

        if (file_exists('users.csv')) {
            echo 'The file users.csv is downloaded to your folder.';
        } 

    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
