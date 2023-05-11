<?php
    $username = "root";
    $password = "";
    $database="tarumt_event_ticketing";
    
    try{
        $pdo = new PDO("mysql:host=localhost:3307;database=$database", $username, $password);
    } catch (Exception $ex) {
        die ("ERROR : Could not connect.".$e->getMessage());
    }
?>