<?php

/**
 * Description of Event
 *
 * @author enxil
 */
class Event
{
    private $eventId;
    private $categoryId;
    private $eventNo;
    private $name;
    private $poster;
    private $venue;
    private $registerStartDate;
    private $registerDuedate;
    private $eventStartDate;
    private $eventEndDate;
    private $descripton;
    private $vipTicketQty;
    private $standardTicketQty;
    private $budgetTicketQty;
    private $vipTicketPrice;
    private $standardTicketPrice;
    private $budgetTicketPrice;
    private $organizerName;
    private $organizerPhone;
    private $organizerMail;
    private $status;
    private $createdDate;
    private $createdBy;
    private $updatedDate;
    private $updatedBy;

    private $category;
    private $tickets;
    
    public function __construct($categoryId, $name, $poster, $venue, $registerStartDate, $registerDuedate, $eventStartDate, $eventEndDate, $descripton, $vipTicketQty, $standardTicketQty, $budgetTicketQty, $vipTicketPrice, $standardTicketPrice, $budgetTicketPrice, $organizerName, $organizerPhone, $organizerMail, $createdBy) {
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->poster = $poster;
        $this->venue = $venue;
        $this->registerStartDate = $registerStartDate;
        $this->registerDuedate = $registerDuedate;
        $this->eventStartDate = $eventStartDate;
        $this->eventEndDate = $eventEndDate;
        $this->descripton = $descripton;
        $this->vipTicketQty = $vipTicketQty;
        $this->standardTicketQty = $standardTicketQty;
        $this->budgetTicketQty = $budgetTicketQty;
        $this->vipTicketPrice = $vipTicketPrice;
        $this->standardTicketPrice = $standardTicketPrice;
        $this->budgetTicketPrice = $budgetTicketPrice;
        $this->organizerName = $organizerName;
        $this->organizerPhone = $organizerPhone;
        $this->organizerMail = $organizerMail;
        $this->createdBy = $createdBy;
    }
    
    public function getEventId() {
        return $this->eventId;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getEventNo() {
        return $this->eventNo;
    }

    public function getName() {
        return $this->name;
    }

    public function getPoster() {
        return $this->poster;
    }

    public function getVenue() {
        return $this->venue;
    }

    public function getregisterStartDate() {
        return $this->registerStartDate;
    }

    public function getRegisterDuedate() {
        return $this->registerDuedate;
    }

    public function getEventStartDate() {
        return $this->eventStartDate;
    }

    public function getEventEndDate() {
        return $this->eventEndDate;
    }

    public function getDescripton() {
        return $this->descripton;
    }

    public function getVipTicketQty() {
        return $this->vipTicketQty;
    }

    public function getStandardTicketQty() {
        return $this->standardTicketQty;
    }

    public function getBudgetTicketQty() {
        return $this->budgetTicketQty;
    }

    public function getVipTicketPrice() {
        return $this->vipTicketPrice;
    }

    public function getStandardTicketPrice() {
        return $this->standardTicketPrice;
    }

    public function getBudgetTicketPrice() {
        return $this->budgetTicketPrice;
    }

    public function getOrganizerName() {
        return $this->organizerName;
    }

    public function getOrganizerPhone() {
        return $this->organizerPhone;
    }

    public function getOrganizerMail() {
        return $this->organizerMail;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getTickets() {
        return $this->tickets;
    }

    public function setEventId($eventId): void {
        $this->eventId = $eventId;
    }

    public function setCategoryId($categoryId): void {
        $this->categoryId = $categoryId;
    }

    public function setEventNo($eventNo): void {
        $this->eventNo = $eventNo;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setPoster($poster): void {
        $this->poster = $poster;
    }

    public function setVenue($venue): void {
        $this->venue = $venue;
    }

    public function setregisterStartDate($registerStartDate): void {
        $this->registerStartDate = $registerStartDate;
    }

    public function setRegisterDuedate($registerDuedate): void {
        $this->registerDuedate = $registerDuedate;
    }

    public function setEventStartDate($eventStartDate): void {
        $this->eventStartDate = $eventStartDate;
    }

    public function setEventEndDate($eventEndDate): void {
        $this->eventEndDate = $eventEndDate;
    }

    public function setDescripton($descripton): void {
        $this->descripton = $descripton;
    }

    public function setVipTicketQty($vipTicketQty): void {
        $this->vipTicketQty = $vipTicketQty;
    }

    public function setStandardTicketQty($standardTicketQty): void {
        $this->standardTicketQty = $standardTicketQty;
    }

    public function setBudgetTicketQty($budgetTicketQty): void {
        $this->budgetTicketQty = $budgetTicketQty;
    }

    public function setVipTicketPrice($vipTicketPrice): void {
        $this->vipTicketPrice = $vipTicketPrice;
    }

    public function setStandardTicketPrice($standardTicketPrice): void {
        $this->standardTicketPrice = $standardTicketPrice;
    }

    public function setBudgetTicketPrice($budgetTicketPrice): void {
        $this->budgetTicketPrice = $budgetTicketPrice;
    }

    public function setOrganizerName($organizerName): void {
        $this->organizerName = $organizerName;
    }

    public function setOrganizerPhone($organizerPhone): void {
        $this->organizerPhone = $organizerPhone;
    }

    public function setOrganizerMail($organizerMail): void {
        $this->organizerMail = $organizerMail;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    public function setCreatedDate($createdDate): void {
        $this->createdDate = $createdDate;
    }

    public function setCreatedBy($createdBy): void {
        $this->createdBy = $createdBy;
    }

    public function setUpdatedDate($updatedDate): void {
        $this->updatedDate = $updatedDate;
    }

    public function setUpdatedBy($updatedBy): void {
        $this->updatedBy = $updatedBy;
    }

    public function setCategory($category): void {
        $this->category = $category;
    }

    public function setTickets($tickets): void {
        $this->tickets = $tickets;
    }

}
