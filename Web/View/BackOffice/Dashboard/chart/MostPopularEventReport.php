<!--Author : Ong Wi Lin-->

      <?php
           require 'conn.php';
      
        try{
            $sqlMostPopEvent = "SELECT e.name, COUNT(p.booking_id) AS booking_count
                FROM tarumt_event_ticketing.payment p
                JOIN tarumt_event_ticketing.booking b ON p.booking_id = b.booking_id
                JOIN tarumt_event_ticketing.event e ON e.event_id = b.event_id
                GROUP BY e.name  
                ORDER BY `booking_count` DESC;";
            
            $result = $pdo->query($sqlMostPopEvent);
            if($result->rowCount() > 0){

                $eventnames = array();
                $bookingCount = array();
                $totalBookingCount = 0;

                while($row = $result->fetch()){
                    $eventnames[] = $row['name'];
                    $bookingCount[] = $row['booking_count'];
                    $totalBookingCount += $row['booking_count'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlMostPopEvent.".$ex->getMessage());
        }
        
        //Close Connection
        unset($pdo);

      ?>
<script>
        console.log(<?php echo json_encode($eventnames); ?>)



</script>


<div class="row">
                              <div class="col-md-6 border-right"  style="width: 60%;">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                    <table class="table table-borderless report-table">
                                       <?php foreach($eventnames as $key => $value) { ?>
                                    <tr>
                                      <td class="text-muted"><?php echo $value; ?></td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $bookingCount[$key]/$totalBookingCount *100 ?>" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0"><?php echo $bookingCount[$key]?></h5></td>
                                    </tr>
                                    <?php } ?>

                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">
                                <!--<canvas id="north-america-chart"></canvas>-->
                                  <canvas id="mostPopEventChart" height="200"></canvas>
<!--                                  <button onclick="downloadPDF()">PDF Version</button>-->
                                <div id="north-america-legend"></div>
                              </div>
                            </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>  
  <script>
    // setup 

    const eventnames = <?php echo json_encode($eventnames); ?>;
    const bookingCounts = <?php echo json_encode($bookingCount); ?>;
    const totalBookingCounts = <?php echo json_encode($totalBookingCount); ?>;
    
    const mostPopEventData = {
      labels: eventnames,
      datasets: [{
        label: 'Event',
        data: bookingCounts,
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
//        const doughnutConfig = {
//      type: 'doughnut',
//      dataDoughnut,
//      options: {
//        cutout: '80%',
//        scales: {
//          y: {
//            beginAtZero: true
//          }
//        }
//      },
//      plugins: [bgColor]
//    };

    const mostPopEventConfig = {
      type: 'bar',
      data: {
        labels: eventnames,
        datasets: [{
          label: 'Event',
          data: bookingCounts,
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
    const mostPopEventChart = new Chart(
      document.getElementById('mostPopEventChart'),
      mostPopEventConfig
    );
    
    function downloadPDF(){
        var pdf = new jsPDF();
        pdf.fromHTML(printWindow.document.body, 15, 15, {'width': 170});
        pdf.save("report.pdf");
    }

    </script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  </body>
