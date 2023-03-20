//author: Lim En Xi

function checkQty() {

}

function calcPrice() {
// todo: solve NaN 
    var vipQty = parseInt($(`#txt-vip-ticket-qty`).val());
    var stdQty = parseInt($(`#txt-std-ticket-qty`).val());
    var bgtQty = parseInt($(`#txt-bgt-ticket-qty`).val());
    var vipPrice = 0;
    var stdPrice = 0;
    var bgtPrice = 0;

    if (!isNaN(vipQty)) {
        vipPrice = parseFloat($(`#txt-vip-ticket-price`).val(vipQty)) * 2;
    } else {
        vipPrice =$(`#txt-vip-ticket-price`).val(0);
    }

    if (!isNaN(stdQty)) {
        stdPrice = parseFloat($(`#txt-std-ticket-price`).val(stdQty * 5));
    } else {
        stdPrice = $(`#txt-std-ticket-price`).val(0);
    }

    if (!isNaN(bgtQty)) {
        bgtPrice = parseFloat($(`#txt-bgt-ticket-price`).val(bgtQty * 10));
    } else {
        bgtPrice = $(`#txt-bgt-ticket-price`).val(0);
    }
    console.log(vipQty);
    console.log(vipPrice);

    $(`#txt-total-ticket-price`).val(vipPrice + stdPrice + bgtPrice);
}
