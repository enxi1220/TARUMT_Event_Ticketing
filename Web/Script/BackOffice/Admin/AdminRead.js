/* 
 * Author : Ong Wi Lin
 */

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlAdmin/AdminRead.php',
        { admin_id: new URLSearchParams(window.location.search).get('admin_id') },
        function (success) {
//            console.log(success)
            var admin = JSON.parse(success);
            display(admin);
        }
    )
});
//
//function display(admin) {
//    
//    console.log(admin.name)
//    $(`#name`).val(admin.name);
//    $(`#name2`).val(admin.name);
//    $(`#username`).val(admin.username);
//    $(`#mail`).val(admin.mail);
//    $(`#phone`).val(admin.phone);
//    $(`#role`).val(admin.role);
//    $(`#role2`).val(admin.role);
//    $(`#status`).val(admin.status);
//    $(`#created_date`).val(admin.created_date);
//    $(`#created_by`).val(admin.created_by);
//    $(`#updated_date`).val(admin.updated_date);
//    $(`#updated_by`).val(admin.updated_by);
//    
//}

function display(admin) {
    
    console.log(admin[0].status);
    $(`#name`).text(admin[0].name);
    $(`#name2`).text(admin[0].name);
    $(`#username`).text(admin[0].username);
    $(`#username2`).text(admin[0].username);
    $(`#mail`).text(admin[0].mail);
    $(`#phone`).text(admin[0].phone);
    $(`#role`).text(admin[0].role);
    $(`#role2`).text(admin[0].role);
    $(`#status`).text(admin[0].status);
    
    $(`#name`).val(admin[0].name);
    $(`#username`).val(admin[0].username);
    $(`#mail`).val(admin[0].mail);
    $(`#phone`).val(admin[0].phone);
    $(`#status`).val(admin[0].status);
  
//  if (admin[0].role == "Staff") {
  if (admin[0].role == AdminRole.Staff) {
    // Code to execute if role is "Staff"
        var dropdownList = $('#roleDdl');

        // Add new options to the dropdown list
        dropdownList.append($('<option>', { 
            value: 'Staff',
            text : 'Staff' 
        }));
        dropdownList.append($('<option>', { 
            value: 'Admin',
            text : 'Admin' 
        }));
    } else {
          // Code to execute if role is not "Staff"
          // Get the dropdown list element
        var dropdownList = $('#roleDdl');

        // Add new options to the dropdown list
        dropdownList.append($('<option>', { 
            value: 'Admin',
            text : 'Admin' 
        }));
        dropdownList.append($('<option>', { 
            value: 'Staff',
            text : 'Staff' 
        }));
    }

//status
        var dropdownList = $('#statusDdl');

  if (admin[0].status == AdminStatus.Active) {
//        var dropdownList = $('#statusDdl');

        // Add new options to the dropdown list
        dropdownList.append($('<option>', { 
            value: 'Active',
            text : 'Active' 
        }));
        dropdownList.append($('<option>', { 
            value: 'Deactivate',
            text : 'Deactivate' 
        }));
    } else if(admin[0].status == AdminStatus.Pending){
//        var dropdownList = $('#statusDdl');

        // Add new options to the dropdown list
        dropdownList.append($('<option>', { 
            value: 'Pending',
            text : 'Pending' 
        }));
//        dropdownList.append($('<option>', { 
//            value: 'Deactivate',
//            text : 'Deactivate' 
//        }));
        dropdownList.prop('disabled', true);
    }
    else {
          // Get the dropdown list element
//        var dropdownList = $('#statusDdl');

        // Add new options to the dropdown list
        dropdownList.append($('<option>', { 
            value: 'Deactivate',
            text : 'Deactivate' 
        }));
        dropdownList.append($('<option>', { 
            value: 'Active',
            text : 'Active' 
        }));
    }

  
  

  
//  $(document).ready(function() {
//  // Call the display function here
//     var roleValue = admin[0].role == "Staff" ? "Staff" : "Admin";
//$('#role').val(roleValue.charAt(0).toUpperCase() + roleValue.slice(1));
//
// 
//});

    
//    var roleValue = admin[0].role == "Staff" ? "Staff" : "Admin";
//    $(`#role`).val(roleValue);
    
//    document.getElementById("role").value = admin[0].role;

    
//    $(`#created_date`).text(admin[0].created_date);
//    $("#created_date").val(moment(admin[0].created_date).format("YYYY-MM-DD HH:mm:ss"));
 
//console.log($("#created_date"));
//$("#created_date").text(moment(admin[0].created_date).format("YYYY-MM-DD HH:mm:ss"));
//
// 
//    $(`#created_by`).text(admin[0].created_by);
//    $(`#updated_date`).text(admin[0].updated_date);
//    $(`#updated_by`).text(admin[0].updated_by);
//    
}


