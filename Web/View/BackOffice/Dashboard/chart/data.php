<!--Author : Ong Wi Lin-->

      <?php
           require 'conn.php';
           
           
//      today & current year income
        try{
            $sqlIncome= "SELECT
                SUM(CASE WHEN DATE(created_date) = CURDATE() THEN price ELSE 0 END) AS today_sum,
                SUM(CASE WHEN YEAR(created_date) = YEAR(NOW()) THEN price ELSE 0 END) AS current_year_sum
            FROM tarumt_event_ticketing.payment;";
            
            $result = $pdo->query($sqlIncome);
            if($result->rowCount() > 0){

                $incomeArray = array();

                while($row = $result->fetch()){
                           $incomeArray[] = $row;

                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlIncome.".$ex->getMessage());
        }
        
           
//      today & current year ticket sold
        try{
            $sqlTicketSold= "SELECT
                SUM(CASE WHEN DATE(p.created_date) = CURDATE() THEN 1 ELSE 0 END) AS today_ticket_sold,
                SUM(CASE WHEN YEAR(p.created_date) = YEAR(NOW()) THEN 1 ELSE 0 END) AS current_year_ticket_sold
            FROM tarumt_event_ticketing.payment p 
            JOIN tarumt_event_ticketing.payment_detail pd ON p.payment_id = pd.payment_id;";
            
            $result = $pdo->query($sqlTicketSold);
            if($result->rowCount() > 0){

                $ticketSoldArray = array();

                while($row = $result->fetch()){
                           $ticketSoldArray[] = $row;

                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlTicketSold.".$ex->getMessage());
        }
        
//      user details
        try{
            $sqlUserInfo= "SELECT user_id, name, phone, mail, status, created_date, created_by FROM tarumt_event_ticketing.user;";
            
            $result = $pdo->query($sqlUserInfo);
            if($result->rowCount() > 0){

                $userInfoArray = array();

                while($row = $result->fetch()){
                           $userInfoArray[] = $row;

                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlUser.".$ex->getMessage());
        }
        
//      user status
        try{
            $sqlUser= "SELECT u.status AS userStatus, COUNT(u.status) AS user_status_count FROM tarumt_event_ticketing.user u GROUP BY u.status ORDER BY `user_status_count` DESC;";
            
            $result = $pdo->query($sqlUser);
            if($result->rowCount() > 0){

                $userStatus = array();
                $user_status_count = array();
                $totalUserStatusCount = 0;

                while($row = $result->fetch()){
                    $userStatus[] = $row['userStatus'];
                    $user_status_count[] = $row['user_status_count'];
                    $totalUserStatusCount += $row['user_status_count'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlUser.".$ex->getMessage());
        }
        
//      admin status
        try{
            $sqlAdminStatus= "SELECT a.status AS adminStatus, COUNT(a.status) AS admin_status_count FROM tarumt_event_ticketing.admin a GROUP BY a.status ORDER BY `admin_status_count` DESC;";
            
            $result = $pdo->query($sqlAdminStatus);
            if($result->rowCount() > 0){

                $adminStatus = array();
                $admin_status_count = array();
                $totalAdminStatusCount = 0;

                while($row = $result->fetch()){
                    $adminStatus[] = $row['adminStatus'];
                    $admin_status_count[] = $row['admin_status_count'];
                    $totalAdminStatusCount += $row['admin_status_count'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlAdminStatus.".$ex->getMessage());
        }
        
//      admin role
        try{
            $sqlAdmin = "SELECT a.role, COUNT(a.role) AS role_count FROM tarumt_event_ticketing.admin a WHERE a.status = \"Active\" GROUP BY a.role ORDER BY `role_count` DESC;";
            
            $result = $pdo->query($sqlAdmin);
            if($result->rowCount() > 0){

                $role = array();
                $roleCount = array();
                $totalRoleCount = 0;

                while($row = $result->fetch()){
                    $role[] = $row['role'];
                    $roleCount[] = $row['role_count'];
                    $totalRoleCount += $row['role_count'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlAdmin.".$ex->getMessage());
        }
        
           
//      user role
        try{
            $sqlUser = "SELECT COUNT(u.user_id) AS user_count FROM tarumt_event_ticketing.user u WHERE u.status = \"Active\";";
            
            $result = $pdo->query($sqlUser);
            if($result->rowCount() > 0){

//                $role = array();
//                $roleCount = array();
                $totalUserCount = 0;

                while($row = $result->fetch()){
//                    $role[] = $row['role'];
//                    $roleCount[] = $row['role_count'];
                    $totalUserCount += $row['user_count'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlAdmin.".$ex->getMessage());
        }
        
//        prefered payment
        try{
            $sqlPreferedPayment = "SELECT p.payment_type, COUNT(p.payment_type) AS payment_count FROM tarumt_event_ticketing.payment p GROUP BY p.payment_type ORDER BY `payment_count` DESC;";
            
            $result = $pdo->query($sqlPreferedPayment);
            if($result->rowCount() > 0){

                $payment_type = array();
                $payment_count = array();
                $totalPaymentCount = 0;

                while($row = $result->fetch()){
                    $payment_type[] = $row['payment_type'];
                    $payment_count[] = $row['payment_count'];
                    $totalPaymentCount += $row['payment_count'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlPreferedPayment.".$ex->getMessage());
        }
        
        //Close Connection
        unset($pdo);

      ?>
<script>

    const names = <?php echo json_encode($role); ?>;
    const bookingCount = <?php echo json_encode($roleCount); ?>;
    const totalBookingCount = <?php echo json_encode($totalRoleCount); ?>;

    
    const payment_type = <?php echo json_encode($payment_type); ?>;
    const payment_count = <?php echo json_encode($payment_count); ?>;
    const totalPaymentCount = <?php echo json_encode($totalPaymentCount); ?>;

</script>
