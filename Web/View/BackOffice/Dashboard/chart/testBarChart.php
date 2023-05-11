
<!--Author : Ong Wi Lin-->


      <?php
      require 'conn.php';
      
        try{
            $sql = "SELECT DATE(created_date) as date
            FROM tarumt_event_ticketing.payment
            WHERE created_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND CURDATE() + INTERVAL 1 DAY
            GROUP BY DATE(created_date)";
            
            $result = $pdo->query($sql);
            if($result->rowCount() > 0){
                $date = array();
                
                while($row = $result->fetch()){
                    $date[] = $row["date"];
                }
                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
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
            die("ERROR : Could not be able to execute $sql.".$e->getMessage());
        }
        
        //Close Connection
        unset($pdo);

      ?>
   
            <canvas id="myChart" width="350" height="350"></canvas>
          <button onclick="downloadPDF()">PDF Version</button>

    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>  
  <script>
    // setup 
    const date = <?php echo json_encode($date); ?>;
    const totalPrice = <?php echo json_encode($ttlPrice); ?>;
    const data = {
      labels: date,
      datasets: [{
        label: 'Weekly Sales',
//        data: [18, 12, 6, 9, 12, 3, 9],
        data: totalPrice,
        backgroundColor: [
          '#4B49AC',
          '#FFC100',
          '#FF4747',
          '#248AFD',
          '#57B657',
          '#4B49AC',
          '#FF4747',
        ],
        
        borderWidth: 1
      }]
    };

    const bgColor = {
        id: 'bgColor',
        beforeDraw: (chart, options) => {
            const{ctx, width, height} = chart;
        }
    };

    // config 
    const config = {
      type: 'bar',
//      data,
data: {
      labels: date,
datasets: [{
        label: 'Weekly Sales',
//        data: [18, 12, 6, 9, 12, 3, 9],
        data: totalPrice,
        backgroundColor: [
          '#4B49AC',
          '#FFC100',
          '#FF4747',
          '#248AFD',
          '#57B657',
          '#4B49AC',
          '#FF4747',
        ],
        borderWidth: 1
      }]
    },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      },
      plugins: [bgColor]
    };

    // render init block
    const barChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    
    function downloadPDF(){
        var pdf = new jsPDF();
        pdf.fromHTML(printWindow.document.body, 15, 15, {'width': 170});
        pdf.save("report.pdf");
    }

    </script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  </body>
