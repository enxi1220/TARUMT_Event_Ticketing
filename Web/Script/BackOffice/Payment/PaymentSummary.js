/* 
 * AUTHOR : ONG WI LIN
 */

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/Summary.php',
        null,
        function (success) {
            console.log(success);
            var payments = JSON.parse(success);
            buildDataTable(payments);
        }
    )
});

function exportPaymentInCSV(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ExportCSV.php',
    );
}

function exportPaymentInPDF(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ExportPDF.php',
    );
}

//function activatePayment(payment_id) {
//    $(`#modal-activate-payment`).modal('show');
//    $(`#btn-activate-payment`).click(function () {
//        var admin = preparePostData(payment_id);
//        post(
//            '/TARUMT_Event_Ticketing/Controller/CtrlPayment/Activate.php',
//            [submitData('admin', admin)],
//            null,
//            function (){
//                location.reload();  
//            }
//        );
//        $(`#modal-activate-admin`).modal('hide');
//    });
//}

//function deactivateAdmin(admin_id) {
//    $(`#modal-deactivate-admin`).modal('show');
//    $(`#btn-deactivate-admin`).click(function () {
//        var admin = preparePostData(admin_id);
//        post(
//            '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Deactivate.php',
//            [submitData('admin', admin)],
//            null,
//            function (){
//                location.reload();  
//            }
//        );
//        $(`#modal-deactivate-admin`).modal('hide');
//    });
//}

function preparePostData(payment_id) {
    var payment = JSON.stringify({
        payment_id: payment_id
    });
    return payment;
}

function buildDataTable(payments){
    $('#payment-summary').DataTable({
        //show in desc according to column[0] event no
        order: [[0, 'desc']],
        data: payments,
        columns: 
        [
            { data: "payment_id" },
            { data: "payment_no" },
            { data: "booking_id" },
            { data: "payment_type" },
            { data: "price" },
            { data: "created_date" },
            {
               render: function (data, type, row, meta) {
                var html = `
                    <a class="btn btn-secondary btn-floating" title="View" href="PaymentRead.php?payment_id=${row.payment_id}" role="button">
                        <i class="fas fa-eye"></i>
                    </a>`;

                return html;
            },

                
//                render: function (data, type, row, meta) {
//                    var html = `
//                            <a class="btn btn-secondary btn-floating" title="View" href="AdminRead.php?admin_id=${row.admin_id}" role="button">
//                                <i class="fas fa-eye"></i>
//                            </a>
//                            <a class="btn btn-secondary btn-floating" title="Update" href="AdminUpdate.php?admin_id=${row.admin_id}" role="button">
//                                <i class="fas fa-pen-to-square"></i>
//                            </a>
//                            <a class="btn btn-secondary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?admin_id=${row.admin_id}" role="button">
//                                <i class="fas fa-ticket"></i>
//                            </a>
//                            <a class="btn btn-secondary btn-floating" title="View Participant" href="../Participant/ParticipantSummary.php?admin_id=${row.admin_id}" role="button">
//                                <i class="fas fa-users"></i>
//                            </a>`;
//                    if (row.status == AdminStatus.Deactivate) {
//                        html +=
//                            `<button id="btn-activate" class="btn btn-secondary btn-floating" title="Activate" onclick="activateAdmin(${row.admin_id}, '${row.admin_id}')">
//                                <i class="fas fa-check"></i>
//                            </button>`;
//                    } else if (row.status == AdminStatus.Activate) {
//                        html += `<button id="btn-deactivate" class="btn btn-secondary btn-floating" title="Deactivate" onclick="deactivateAdmin(${row.admin_id}, '${row.admin_id}')">
//                                    <i class="fas fa-times"></i>
//                                </button>`;
//                    }
//                    return html;
//                },
                orderable: false
            }
        ]
    });
}

