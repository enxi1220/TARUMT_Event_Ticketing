<?php

/* 
 * Author : Ong Wi Lin
 */

class PaymentDetail implements IPaymentDetail {
    private $paymentDetailId;
    private $paymentId;
    private $ticketNo;
    private $eventName;
    private $ticketPrice;

    public function __construct($paymentDetailId, $paymentId, $ticketNo, $eventName, $ticketPrice) {
        $this->paymentDetailId = $paymentDetailId;
        $this->paymentId = $paymentId;
        $this->ticketNo = $ticketNo;
        $this->eventName = $eventName;
        $this->ticketPrice = $ticketPrice;
    }

    public function getPaymentDetailId() {
        return $this->paymentDetailId;
    }

    public function setPaymentDetailId($paymentDetailId) {
        $this->paymentDetailId = $paymentDetailId;
    }

    public function getPaymentId() {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId) {
        $this->paymentId = $paymentId;
    }

    public function getTicketNo() {
        return $this->ticketNo;
    }

    public function setTicketNo($ticketNo) {
        $this->ticketNo = $ticketNo;
    }

    public function getEventName() {
        return $this->eventName;
    }

    public function setEventName($eventName) {
        $this->eventName = $eventName;
    }

    public function getTicketPrice() {
        return $this->ticketPrice;
    }

    public function setTicketPrice($ticketPrice) {
        $this->ticketPrice = $ticketPrice;
    }
}