<?php

#  Author: Ong Yi Chween
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";

class PaymentsRead
{

    public static function Read(Payment $payment)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($payment) {
                return self::ReadPayment($dataAccess, $payment);
                
            }
        );
        return $result;
    }
    
    private static function ReadPayment(DataAccess $dataAccess, $payment)
    {
        return $dataAccess->Reader(
                "SELECT 
                    p.payment_id, 
                    p.payment_no, 
                    p.payment_type, 
                    p.price, 
                    p.created_date
                FROM payment p
                WHERE p.booking_id = :booking_id;",
            
                function (PDOStatement $pstmt) use ($payment) {
                $pstmt->bindValue(":booking_id", $payment->getBookingId(), PDO::PARAM_INT);
                },
                
                function ($row) {
                    
                    $payment = new Payment();
                    return $payment
                        ->setPaymentId($row['payment_id'])
                        ->setPaymentNo($row['payment_no'])
                        ->setPaymentType($row['payment_type'])
                        ->setPrice($row['price'])
                        ->setCreatedDate($row['created_date']);
                }
        );
    }
}