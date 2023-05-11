<?php

/**
 * @author Ong Wi Lin
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPayment.php";


class Payment implements IPayment {
    private $paymentId;
    private $paymentNo;
    private $bookingId;
    private $paymentType;
    private $price;
    private $createdDate;
//    private $paymentDetails;
    
    private $paymentDetails = array();

    public function __construct() {
    }
//    public function __construct($paymentId, $paymentNo, $bookingId, $paymentType, $price, $createdDate, $paymentDetails) {
//        $this->paymentId = $paymentId;
//        $this->paymentNo = $paymentNo;
//        $this->bookingId = $bookingId;
//        $this->paymentType = $paymentType;
//        $this->price = $price;
//        $this->createdDate = $createdDate;
//        $this->paymentDetails = $paymentDetails;
//    }

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

    public function setPaymentNo($paymentNo = null): self {
        $this->paymentNo = $paymentNo == null ? UniqueNoHelper::RandomCode($this->prefix()) : $paymentNo;
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

    public function setCreatedDate($createdDate = null): self {
        $this->createdDate = $createdDate == null ? DateHelper::GetMalaysiaDateTime() : $createdDate;
        return $this;
    }

    public function getPaymentDetails() {
        return $this->paymentDetails;
    }

    public function setPaymentDetails($paymentDetails) {
        $this->paymentDetails = $paymentDetails;
        return $this;
    }

    public function prefix()
    {
        return PrefixConstant::PAYMENT;
    }
}