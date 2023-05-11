
<!--Author : Ong Wi Lin-->

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

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Total income for the past 7 days</title>
    
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        margin-top: -8px;
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(33, 40, 50, 0.06);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 400px;
        padding: 20px;
        border-radius: 20px;
          border: 1.33px solid #999;
        background: white;
      }
      .report-title {
        background: rgba(33, 40, 50, 0.06);
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        padding-top: 20px;
        color: #333;
        text-transform: uppercase;
      }

    </style>
    	
  </head>
  <body  style="background: rgba(33, 40, 50, 0.06);">
      <?php
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
                $ttlPrice = array();
                
                while($row = $result->fetch()){
                    $ttlPrice[] = $row["total_price"];
                }
                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlTtlPrice.".$e->getMessage());
        }
        
        //Close Connection
        unset($pdo);

      ?>
      
    <h3 class="report-title">Total income for the past 7 days</h3>
    <div class="chartCard">
        
        <div class="chartBox">
            <canvas id="myChart" width="175" height="175"></canvas>
          <button onclick="downloadPDF()">PDF Version</button>
        </div>
    </div>

    
    <div class="col-lg-12 grid-margin stretch-card" style="width:101%;">
              <div class="card" style="background: rgba(33, 40, 50, 0.06); ">
                <div class="card-body">
                  <h4 class="card-title"  style=" padding-bottom: 70px;">Total Income For The Past 7 Days Table</h4>

                  <div class="table-responsive">
                    <table class="table table-striped"  style="background: white; margin:auto; width:60%;">
                      <thead>
                        <tr>
                          <th>
                            Date
                          </th>
                          <th>
                            Total Price
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($date as $key => $value) { ?>
                        <tr>
                          <td><?php echo $value; ?></td>
                          <td><?php echo "RM ".$ttlPrice[$key]; ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>  
  <script>
    // setup 
    const date = <?php echo json_encode($date); ?>;
    const totalPrice = <?php echo json_encode($ttlPrice); ?>;
    const data = {
//      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      labels: date,
        //labels: [`$ {dateLabel}`],
      datasets: [{
        label: 'Weekly Sales',
//        data: [18, 12, 6, 9, 12, 3, 9],
        data: totalPrice,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
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
      type: 'doughnut',
      data,
      options: {
        cutout: '80%',
        scales: {
          y: {
            beginAtZero: true
          }
        }
      },
      plugins: [bgColor]
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    
    function downloadPDF(){
        var pdf = new jsPDF();
        pdf.fromHTML(printWindow.document.body, 15, 15, {'width': 170});
        pdf.save("report.pdf");
    }
    
//    function downloadPDF(){
//        const canvas = document.getElementById('myChart');
//        const canvasImage = canvas.toDataURL('image/jpeg, 1.0');
//        console.log(canvasImage);
//        
//        let pdf = new jsPDF('landscape');
//        pdf.setFontSize(20);
////        pdf.addImage(canvasImage, 'JPEG', 15, 15, 280, 150);
// 
//        pdf.addImage(canvasImage, 'JPEG', 55, 20, 180, 100);
//        pdf.text(85, 15, "Sales Record");
//        pdf.save('mychart.pdf');
//    }

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
    </script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  </body>
</html>