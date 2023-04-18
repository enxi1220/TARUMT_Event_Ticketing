<?php

/* 
 * Author : Ong Wi Lin
 */

interface IPaymentDetail {
    public function getPaymentDetailId();
    public function setPaymentDetailId($paymentDetailId);
    public function getPaymentId();
    public function setPaymentId($paymentId);
    public function getTicketNo();
    public function setTicketNo($ticketNo);
    public function getEventName();
    public function setEventName($eventName);
    public function getTicketPrice();
    public function setTicketPrice($ticketPrice);
}