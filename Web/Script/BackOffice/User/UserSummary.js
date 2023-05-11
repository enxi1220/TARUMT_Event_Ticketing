//author: Ong Yi Chween

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlUsers/Summary.php',
        null,
        function (success) {
            // console.log(success);
            var users = JSON.parse(success);
            buildDataTable(users);
        }
    )
});

function exportUserInCSV(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlUsers/ExportCSV.php',
    );
}

function exportUserInPDF(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlUsers/ExportPDF.php',
    );
}

function activateUser(userId, username) {
    $(`#modal-activate-user`).modal('show');
    $(`#btn-activate-user`).click(function () {
        var user = preparePostData(userId, username);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlUsers/Activate.php',
            [submitData('user', user)],
            null,
            function (){
                location.reload();  
            }
        );
        $(`#modal-activate-user`).modal('hide');
    });
}

function deactivateUser(userId, username) {
    $(`#modal-deactivate-user`).modal('show');
    $(`#btn-deactivate-user`).click(function () {
        var user = preparePostData(userId, username);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlUsers/Deactivate.php',
            [submitData('user', user)],
            null,
            function (){
                location.reload();  
            }
        );
        $(`#modal-deactivate-user`).modal('hide');
    });
}

function preparePostData(userId, username) {
    var user = JSON.stringify({
        userId: userId,
        username: username
    });
    return user;
}

function buildDataTable(users){
    $('#user-summary').DataTable({
        //show in desc according to column[0] user no
        order: [[0, 'desc']],
        data: users,
        columns: 
        [
            { data: "username" },
            { data: "name" },
            { data: "phone" },
            { data: "mail" },
            { data: "status" },
            { data: "createdBy" },
            { data: "createdDate" },
            { data: "updatedBy" },
            { data: "updatedDate" },
            {
                render: function (data, type, row, meta) {
                    var html = `
                            <a class="btn btn-secondary btn-floating" title="View" href="UserRead.php?userId=${row.userId}" role="button">
                                <i class="fas fa-eye"></i>
                            </a>`;
//                            <a class="btn btn-secondary btn-floating" title="Update" href="UserUpdate.php?userId=${row.userId}" role="button">
//                                <i class="fas fa-pen-to-square"></i>
//                            </a>
                            
                            
                    if (row.status == UserStatus.Inactive) {
                        html +=
                            `<button id="btn-activate" class="btn btn-secondary btn-floating" title="Activate" onclick="activateUser(${row.userId}, '${row.username}')">
                                <i class="fas fa-check"></i>
                            </button>`;
                    } else if (row.status == UserStatus.Active) {
                        html += `<button id="btn-deactivate" class="btn btn-secondary btn-floating" title="Deactivate" onclick="deactivateUser(${row.userId}, '${row.username}')">
                                    <i class="fas fa-times"></i>
                                </button>`;
                    }
                    return html;
                },
                orderable: false
            }
        ]
    });
}


