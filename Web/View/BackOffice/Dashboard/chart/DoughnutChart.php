<!--Author : Ong Wi Lin-->

      <?php
           require 'conn.php';
      
        try{
            $sqlEvent = "SELECT  
                e.name AS event_name,
                e.vip_ticket_qty,
                e.standard_ticket_qty,
                e.budget_ticket_qty,
                SUM(e.vip_ticket_qty + e.standard_ticket_qty + e.budget_ticket_qty) as remaining_ticket_qty
            FROM tarumt_event_ticketing.event e
            WHERE e.status = \"Open\"
            GROUP BY e.name;";
            
            $result = $pdo->query($sqlEvent);
            if($result->rowCount() > 0){

                $eventNames = array();
                $vip_ticket_qty = array();
                $standard_ticket_qty = array();
                $budget_ticket_qty = array();
                $remainingQtys = array();

                while($row = $result->fetch()){
                    $eventNames[] = $row['event_name'];
                    $vip_ticket_qty[] = $row['vip_ticket_qty'];
                    $standard_ticket_qty[] = $row['standard_ticket_qty'];
                    $budget_ticket_qty[] = $row['budget_ticket_qty'];
                    $remainingQtys[] = $row['remaining_ticket_qty'];
                }

                unset($result);
            }else{
                echo "No records matching your query were found.";
            }
            
        } catch (Exception $ex) {
            die("ERROR : Could not be able to execute $sqlEvent.".$ex->getMessage());
        }
        
        //Close Connection
        unset($pdo);

      ?>
<script>
        console.log(<?php echo json_encode($eventNames); ?>)

    const eventNames = <?php echo json_encode($eventNames); ?>;
    const remainingQtys = <?php echo json_encode($remainingQtys); ?>;
    const vip_ticket_qty = <?php echo json_encode($vip_ticket_qty); ?>;
    const standard_ticket_qty = <?php echo json_encode($standard_ticket_qty); ?>;
    const budget_ticket_qty = <?php echo json_encode($budget_ticket_qty); ?>;
</script>

<table class="table table-striped table-borderless" style="width:85%;">
                        <thead>
                        <tr>
                          <th>Event</th>
                          <th>VIP</th>
                          <th>Standard</th>
                          <th>Budget</th>
                          <th>Total</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <?php foreach($eventNames as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value; ?></td>
                                <td><?php echo $vip_ticket_qty[$key] ?></td>
                                <td><?php echo $standard_ticket_qty[$key] ?></td>
                                <td><?php echo $budget_ticket_qty[$key] ?></td>
                                <td class="font-weight-bold"><?php echo $remainingQtys[$key] ?></td>

                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                           
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">

<!--            <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">-->
                                
                                <div style="margin-right: -260px; margin-left: 260px;">
                            
                                  
            <canvas id="doughnutChart" width="350" height="350"></canvas>
          <button onclick="downloadPDF()">PDF Version</button>
</div>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>  
  <script>
    // setup 

    
    const dataDoughnut = {
      labels: eventNames,
      datasets: [{
        label: 'Event',
        data: remainingQtys,
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
//
//    const bgColor = {
//        id: 'bgColor',
//        beforeDraw: (chart, options) => {
//            const{ctx, width, height} = chart;
//        }
//    };

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

    const doughnutConfig = {
      type: 'doughnut',
      data: {
        labels: eventNames,
        datasets: [{
          label: 'Event',
          data: remainingQtys,
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
        cutout: '80%'
//        scales: {
//          y: {
//            beginAtZero: true
//          }
//        }
      },
      plugins: [bgColor]
    };


    // render init block
    const doughnutChart = new Chart(
      document.getElementById('doughnutChart'),
      doughnutConfig
    );
    
    function downloadPDF(){
        var pdf = new jsPDF();
        pdf.fromHTML(printWindow.document.body, 15, 15, {'width': 170});
        pdf.save("report.pdf");
    }

    </script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
  </body>
