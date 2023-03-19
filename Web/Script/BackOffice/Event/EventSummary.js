//author: Lim En Xi
$(document).ready(function(){
    $('#event-summary').DataTable();
    StatusButton();
});

 // todo: based on status to set hide button 
function StatusButton(){
    if(true){
        $(`#btn-activate`).hide();
    }else{
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