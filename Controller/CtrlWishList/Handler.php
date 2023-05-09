<?php

#  Author: Tan Lin Yi

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllWishList/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllWishList/Create.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllWishList/Delete.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/WishList.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Controller/RESTfulAPI.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/LoginUser.php";


$action = $_GET["action"] ?? "";
if ($action !== "Summary" && $action !== "Read"){
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    if (empty($data)) {
        RESTfulAPI::response(404, "No data is submitted");
        exit;
    }
}

switch ($action) {
    case "Read":
        read();
        break;
    case "Create":
        create($data);
        break;
    case "Delete":
        delete($data);
        break;
    default:
        RESTfulAPI::response(400, "Bad Request");
        break;
}



function create($data)
{

    
    $wishlist = new Wishlist();
    $wishlist
                    ->setUserId($data->userId)
                    ->setEventId($data->eventId)
                    ;
    try {
        WishListCreate::Create($wishlist);
        RESTfulAPI::response(200, "Successfully added ");
            
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}


function read()
{
    
        
    $userId = $_GET['userId'] ?? 0;
    $wishlist = new WishList();
    $wishlist->setUserId($userId);
    $result = WishListRead::Read($wishlist);

    if(empty($result)){
        RESTfulAPI::response(404, "Data Not Found", null);
        return;
    }
    
    $output = array_map(
        function ($wishlist) {
            return array(
                'eventId' => $wishlist->getEvent()->getEventId(),
        'eventNo' => $wishlist->getEvent()->getEventNo(),
        'eventName' => $wishlist->getEvent()->getName(),
        'posterPath' => $wishlist->getEvent()->posterPath() . $wishlist->getEvent()->getPoster(),
        'userId' => $wishlist->getUserId(),
        'wishlistId' => $wishlist->getWishlistId()
            );
        },
        $result
    );
    
    RESTfulAPI::response(200, "Data Found", $output);
}


function delete($data){
    $wishlist = new Wishlist();
    $wishlist
                    ->setWishlistId($data->wishlistId) ;
    try {
        WishListDelete::Delete($wishlist);
        RESTfulAPI::response(200, "Successfully delete ");
    } catch (\Throwable $e) {
        RESTfulAPI::response($e->getCode(), $e->getMessage());
    }
}
