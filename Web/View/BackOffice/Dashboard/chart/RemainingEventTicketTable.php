
<?php foreach($eventNames as $key => $value) { ?>
<!--    <tr>  
        <td class="text-muted"><?php echo $value; ?></td>
            <td class="w-100 px-0">
                <div class="progress progress-md mx-4">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $ttlPrice[$key] / $ttlPrice7days *100; ?>" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        <td><h5 class="font-weight-bold mb-0">RM <?php echo $ttlPrice[$key]; ?></h5></td>
    </tr>-->
                    
    
    <tr>
        <td><?php echo $value; ?></td>
        <td><?php echo $vip_ticket_qty[$key] ?></td>
        <td><?php echo standard_ticket_qty[$key] ?></td>
        <td><?php echo budget_ticket_qty[$key] ?></td>
        <td class="font-weight-bold"><?php echo $remainingQtys[$key] ?></td>

    </tr>
<?php } ?>