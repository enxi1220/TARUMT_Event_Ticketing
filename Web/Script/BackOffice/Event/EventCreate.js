//author: Lim En Xi

$(document).ready(function () {

});

$(`#form-add-event`).submit(function (event) {
    event.preventDefault();
    if($(`#form-add-event`)[0].checkValidity() && checkQty()){
        //back end
    }
});

// validation 
function checkQty() {
    var qty =
        parseInt($(`#txt-vip-ticket-qty`).val()) +
        parseInt($(`#txt-std-ticket-qty`).val()) +
        parseInt($(`#txt-bgt-ticket-qty`).val());
        console.log(qty);

    if (qty <= 0 || isNaN(qty)) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "Total ticket quantity must be more than 0"
        });
        return false;
    }
    return true;
}

// for multiple forms, maybe useless 
// $(function(){
//     $('.needs-validation').on('submit', function(event){
//         if(!event.target.checkValidity()){
//             // Form didn't pass validation
//             event.preventDefault();
//             $(this).addClass('was-validated');
//         }
//     })
// })