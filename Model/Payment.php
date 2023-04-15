<?php

/**
 * @author Ong Wi Lin
 */


class Payment implements IPayment {
    private $paymentId;
    private $paymentNo;
    private $bookingId;
    private $paymentType;
    private $price;
    private $createdDate;
    private $paymentDetails;

    public function __construct($paymentId, $paymentNo, $bookingId, $paymentType, $price, $createdDate, $paymentDetails) {
        $this->paymentId = $paymentId;
        $this->paymentNo = $paymentNo;
        $this->bookingId = $bookingId;
        $this->paymentType = $paymentType;
        $this->price = $price;
        $this->createdDate = $createdDate;
        $this->paymentDetails = $paymentDetails;
    }

    public function getPaymentId() {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId) {
              $this->paymentId = $paymentId;
    }

    public function getPaymentNo() {
        return $this->paymentNo;
    }

    public function setPaymentNo($paymentNo) {
        $this->paymentNo = $paymentNo;
    }

    public function getBookingId() {
        return $this->bookingId;
    }

    public function setBookingId($bookingId) {
        $this->bookingId = $bookingId;
    }

    public function getPaymentType() {
        return $this->paymentType;
    }

    public function setPaymentType($paymentType) {
        $this->paymentType = $paymentType;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    public function getPaymentDetails() {
        return $this->paymentDetails;
    }

    public function setPaymentDetails($paymentDetails) {
        $this->paymentDetails = $paymentDetails;
    }
}