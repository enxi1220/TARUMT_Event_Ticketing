<?php

/** 
 * @author linyi
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

class WishList {

    private $userId;
    private $wishlistId;
    private $eventId;
        private $event;
 
    public function getUserId() {
        return $this->userId;
    }

    public function getWishlistId() {
        return $this->wishlistId;
    }
    
        public function getEvent() {
        return $this->event;
    }


    public function getEventId() {
        return $this->eventId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function setWishlistId($wishlistId) {
        $this->wishlistId = $wishlistId;
        return $this;
    }

    public function setEventId($eventId) {
        $this->eventId = $eventId;
        return $this;
    }
    
    public function setEvent($event) {
        $this->event = $event;
        return $this;
    }


}
