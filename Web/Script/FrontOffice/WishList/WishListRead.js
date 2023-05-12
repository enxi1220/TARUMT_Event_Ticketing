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
                                       

        
                                        <p class="card-text">
                                            ${item.eventNo} 
                                        <i class="fa-solid fa-trash-can fs-2 position-absolute top-1 end-0 ms-2 me-2" onclick="deleteWishlist(${item.wishlistId})"></i>
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
                     location.reload();  
                }
            );
   
}
