//author: Tan Lin Yi 

$(document).ready(function () {
    get(
            '/TARUMT_Event_Ticketing/Controller/CtrlWishList/Read.php',
            null,
            function (success) {
//                console.log(success);
                var wishlist = JSON.parse(success);
                display(wishlist);
            }
    );
});

function display(wishlist) {
    var template = '';
    wishlist.forEach(item => {

        template += `
            <div class="card rounded-3 mb-4  w-75">
                            <div class="card-body p-4">
                                <div class="row ">
                                    <div class="col-md-5">
                                        <img src="${item.posterPath}" class="card-img-top" alt="" />
                                    </div>

                                    <div class="col-md-7 ">
                                        <i class="fa-regular fa-trash"></i>
                                        <i class="fa-regular fa-heart fs-3" onclick="deleteWishlist(${item.wishlistId})"></i>

        
                                        <p class="card-text">
                                            ${item.eventNo} 
                                        </p>
                                        <p class="card-text">
                                            ${item.eventName}
                                        </p>
        

                                    </div>
                                </div>
                            </div>
                        </div>
        `;



    });
    $('#wishlist').append(template);
}

function deleteWishlist(wishlistId) {

    
    var wishlist = JSON.stringify({
       
        wishlistId: wishlistId
   
    });
    
    
     post(
                '/TARUMT_Event_Ticketing/Controller/CtrlWishList/Delete.php',
                [
                    submitData('wishlist', wishlist)
                  
                ],
                null,
                function () {
                    location.href = "EventSummary.php";
                }
            );
   
}