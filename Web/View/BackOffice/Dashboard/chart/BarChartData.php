
<!--Author : Ong Wi Lin-->

<?php
    require 'conn.php';
?>

      <?php
        try{
            
            $sqlTtlPrice = "SELECT SUM(price) as total_price FROM tarumt_event_ticketing.payment WHERE created_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND CURDATE() + INTERVAL 1 DAY GROUP BY DATE(created_date)";
            
            $result = $pdo->query($sqlTtlPrice);
            if($result->rowCount() > 0){
                
                $ttlPrice7days = 0;
                
                $ttlPrice = array();
                
                while($row = $result->fetch()){
                    $ttlPrice[] = $row["total_price"];
                    $ttlPrice7days += $row["total_price"];

                }
                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlTtlPrice.".$e->getMessage());
        }
        
        //Close Connection
//        unset($pdo);

     