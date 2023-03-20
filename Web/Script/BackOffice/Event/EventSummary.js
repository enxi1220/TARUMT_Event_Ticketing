//author: Lim En Xi
$(document).ready(function(){
    $('#event-summary').DataTable();
    StatusButton();
});

 // todo: based on status to set hide button 
function StatusButton(){
    if(false){
        // role is staff
        $(`#btn-activate`).hide();
        $(`#btn-deactivate`).hide();
    }else if(true){
        // status is activate
        $(`#btn-activate`).hide();
    }else{
        // status is deactivate
        $(`#btn-deactivate`).hide();
    }
}

function activateEvent(eventId){
    $(`#activateEventModal`).modal('show');
    $(`#btn-activate-event`).click(function () {
        //todo: update db
        console.log(eventId);
        $(`#activateEventModal`).modal('hide');
    });
}

function deactivateEvent(eventId){
    $(`#deactivateEventModal`).modal('show');
    $(`#btn-deactivate-event`).click(function () {
        //todo: update db
        console.log(eventId);
        $(`#deactivateEventModal`).modal('hide');
    });
}