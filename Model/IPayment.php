<?php

/* 
 * Factory
 * Author : Ong Wi Lin
 */

interface IPayment {
    public function getPaymentId();
    public function setPaymentId($paymentId);
    public function getPaymentNo();
    public function setPaymentNo($paymentNo);
    public function getBookingId();
    public function setBookingId($bookingId);
    public function getPaymentType();
    public function setPaymentType($paymentType);
    public function getPrice();
    public function setPrice($price);
    public function getCreatedDate();
    public function setCreatedDate($createdDate);
    public function getPaymentDetails();
    public function setPaymentDetails($paymentDetails);
}