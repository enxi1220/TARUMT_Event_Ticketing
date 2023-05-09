<?php

#  Author: Ong Yi Chween

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllCategory/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {

        $category = new Category();
        $result = CategoryRead::Read($category);

        if (empty($result)) {
            exit;
        }

        $output = array_map(
            function ($category) {
                return array(
                    'categoryId' => $category->getCategoryId(),
                    'name' => $category->getName(),
                    'description' => $category->getDescription(),
                    'createdDate' => $category->getCreatedDate(),
                    'createdBy' => $category->getCreatedBy(),
                    'updatedDate' => $category->getUpdatedDate(),
                    'updatedBy' => $category->getUpdatedBy(),
                );
            },
            $result
        );

        // xml
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><categories></categories>');
        foreach ($output as $category) {
            $categoryNode = $xml->addChild('category');
            foreach ($category as $key => $value) {
                $categoryNode->addChild($key, $value);
            }
        }

        $xmlString = $xml->asXML();

        $header = [
            'name',
            'description',
        ]; 

        // xpath 
        $data = [];
        foreach ($xml->xpath('//category') as $category) {
            $data[] = [
                (string) $category->name,
                (string) $category->description,
            ];
        }

        // Open a file handle for writing the CSV data
        $fh = fopen('categories.csv', 'w');

        // Write the CSV header row to the file handle
        fputcsv($fh, $header);

        // Write the CSV data rows to the file handle
        foreach ($data as $row) {
            fputcsv($fh, $row);
        }

        // Close the file handle
        fclose($fh);

        if (file_exists('categories.csv')) {
            echo 'The file categories.csv is downloaded to your folder.';
        } 

    } catch (\Throwable $e) {

        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        // echo $e->getMessage();
        echo $e;
    }
}
