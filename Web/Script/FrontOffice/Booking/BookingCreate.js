//author: Lim En Xi

function placeOrder() {
    // check qty
}

function ticketChange(){
    calcPrice();
    toggleOrderButton();
}

function calcPrice() {
    var vipQty = parseInt($(`#txt-vip-ticket-qty`).val());
    var stdQty = parseInt($(`#txt-std-ticket-qty`).val());
    var bgtQty = parseInt($(`#txt-bgt-ticket-qty`).val());
    let vipPrice = 0;
    let stdPrice = 0;
    let bgtPrice = 0;
    var vipUnitPrice = 10;
    var stdUnitPrice = 5;
    var bgtUnitPrice = 3;

    if (!isNaN(vipQty)) {
        vipPrice = vipQty * vipUnitPrice;
        $(`#txt-vip-ticket-price`).val(vipPrice);
    } else {
        vipPrice = 0;
        $(`#txt-vip-ticket-price`).val(0);
    }

    if (!isNaN(stdQty)) {
        stdPrice = stdQty * stdUnitPrice;
        $(`#txt-std-ticket-price`).val(stdPrice);
    } else {
        stdPrice = 0;
        $(`#txt-std-ticket-price`).val(0);
    }

    if (!isNaN(bgtQty)) {
        bgtPrice = bgtQty * bgtUnitPrice;
        $(`#txt-bgt-ticket-price`).val(bgtPrice);
    } else {
        bgtPrice = 0;
        $(`#txt-bgt-ticket-price`).val(0);
    }

    $(`#txt-total-ticket-price`).val(vipPrice + stdPrice + bgtPrice);
}

function toggleOrderButton(){
    // if price != 0 => remove disabled class
    // else add disabled class
    if(parseFloat($(`#txt-total-ticket-price`).val()) == 0){
        $(`#btn-place-order`).addClass('disabled');
    }else{
        $(`#btn-place-order`).removeClass('disabled');
    }
}
