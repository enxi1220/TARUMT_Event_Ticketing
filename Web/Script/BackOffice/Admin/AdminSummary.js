/* 
 * AUTHOR : ONG WI LIN
 */

//<a class="btn btn-secondary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?admin_id=${row.admin_id}" role="button">
//                        <i class="fas fa-ticket"></i>
//                    </a>
//                    <a class="btn btn-secondary btn-floating" title="View Participant" href="../Participant/ParticipantSummary.php?admin_id=${row.admin_id}" role="button">
//                        <i class="fas fa-users"></i>
//                    </a>

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Summary.php',
        null,
        function (success) {
//            console.log(success);
            var admins = JSON.parse(success);
            buildDataTable(admins);
        }
    )
});

function exportAdminInCSV(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/ExportCSV.php',
    );
}

function exportAdminInPDF(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/ExportPDF.php',
    );
}

function activateAdmin(admin_id) {
    $(`#modal-activate-admin`).modal('show');
    $(`#btn-activate-admin`).click(function () {
        var admin = preparePostData(admin_id);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Activate.php',
            [submitData('admin', admin)],
            null,
            function (){
                location.reload();  
            }
        );
        $(`#modal-activate-admin`).modal('hide');
    });
}

function deactivateAdmin(admin_id) {
    $(`#modal-deactivate-admin`).modal('show');
    $(`#btn-deactivate-admin`).click(function () {
        var admin = preparePostData(admin_id);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/Deactivate.php',
            [submitData('admin', admin)],
            null,
            function (){
                location.reload();  
            }
        );
        $(`#modal-deactivate-admin`).modal('hide');
    });
}

function preparePostData(admin_id) {
    var admin = JSON.stringify({
        admin_id: admin_id
    });
    return admin;
}

function buildDataTable(admins){
    $('#admin-summary').DataTable({
        //show in desc according to column[0] event no
        order: [[0, 'desc']],
        data: admins,
        columns: 
        [
//            { data: "eventNo" },
            { data: "name" },
            { data: "mail" },
            { data: "role" },
            { data: "status" },
            { data: "created_by" },
            { data: "created_date" },
            { data: "updated_by" },
            { data: "updated_date" },
            {
               render: function (data, type, row, meta) {
                var html = `
                    <a class="btn btn-secondary btn-floating" title="View" href="AdminRead.php?admin_id=${row.admin_id}" role="button">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" title="Update" href="AdminUpdate.php?admin_id=${row.admin_id}" role="button">
                        <i class="fas fa-pen-to-square"></i>
                    </a>`;
                if (row.status == AdminStatus.Deactivate) {
                    html += `<button id="btn-activate" class="btn btn-secondary btn-floating" title="Activate" onclick="activateAdmin(${row.admin_id})">
                        <i class="fas fa-check"></i>
                    </button>`;
                } else if (row.status == AdminStatus.Active) {
                    html += `<button id="btn-deactivate" class="btn btn-secondary btn-floating" title="Deactivate" onclick="deactivateAdmin(${row.admin_id})">
                        <i class="fas fa-times"></i>
                    </button>`;
                }
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

