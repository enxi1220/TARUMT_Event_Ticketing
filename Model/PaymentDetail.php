<?php

/* 
 * Author : Ong Wi Lin
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPaymentDetail.php";

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
        return $this;
    }

    public function getPaymentId() {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId) {
        $this->paymentId = $paymentId;
        return $this;
    }

    public function getTicketNo() {
        return $this->ticketNo;
    }

    public function setTicketNo($ticketNo) {
        $this->ticketNo = $ticketNo;
        return $this;
    }

    public function getEventName() {
        return $this->eventName;
    }

    public function setEventName($eventName) {
        $this->eventName = $eventName;
        return $this;
    }

    public function getTicketPrice() {
        return $this->ticketPrice;
    }

    public function setTicketPrice($ticketPrice) {
        $this->ticketPrice = $ticketPrice;
        return $this;
    }
}