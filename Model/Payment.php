<?php

/**
 * @author Ong Wi Lin
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPayment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/PaymentDetail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPaymentDetail.php";


class Payment implements IPayment {
    private $paymentId;
    private $paymentNo;
    private $bookingId;
    private $paymentType;
    private $price;
    private $createdDate;
//    private $paymentArray = [];
    
//    private $paymentDetails;
    
    private $paymentDetails = array();
    private $paymentArray = array();
    private User $user;
//    private Payment $payment;
    private Event $event;

    public function __construct() {

    }

    public function addPaymentDetail(PaymentDetail $paymentDetail) {
        $this->paymentDetails[] = $paymentDetail;
    }
    
      public function getUser(): User
    {
        return $this->user;
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }
    
    public function getEvent(): Event 
    {
        return $this->event;
    }
    
    
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setPayment(Payment $payment): self
    {
        $this->payment = $payment;
        return $this;
    }
    
    public function setEvent(Event $event): self
    {
        $this->event = $event;
        return $this;
    }

    
    public function getPaymentId() {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId) {
              $this->paymentId = $paymentId;
              return $this;
    }

    public function getPaymentNo() {
        return $this->paymentNo;
    }

    public function setPaymentNo($paymentNo) {
        $this->paymentNo = $paymentNo;
        return $this;
    }

    public function getBookingId() {
        return $this->bookingId;
    }

    public function setBookingId($bookingId) {
        $this->bookingId = $bookingId;
        return $this;
    }

    public function getPaymentType() {
        return $this->paymentType;
    }

    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
        return $this;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
        return $this;
    }

    public function getPaymentDetails() {
        return $this->paymentDetails;
    }

    public function setPaymentDetails($paymentDetails) {
        $this->paymentDetails = $paymentDetails;
        return $this;
    }

    public function getPaymentArray() {
        return $this->paymentArray;
    }

    public function setPaymentArray($paymentArray) {
        $this->paymentArray= $paymentArray;
        return $this;
    }
}
