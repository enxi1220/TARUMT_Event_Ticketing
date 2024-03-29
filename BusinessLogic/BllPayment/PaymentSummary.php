<?php

#  Author: Ong Wi Lin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/PaymentDetail.php";

class PaymentRead
{

    public static function Read(Payment $payment)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($payment) {
                return PaymentRead::ReadPayment($dataAccess, $payment);
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
                        p.booking_id, 
                        p.payment_type, 
                        p.price, 
                        p.created_date
                    FROM payment p
                    WHERE p.payment_id = IF(:payment_id IS NULL, p.payment_id, :payment_id)
                    ORDER BY p.payment_id DESC",
            function (PDOStatement $pstmt) use ($payment) {
                $pstmt->bindValue(":payment_id", $payment->getPaymentId(), PDO::PARAM_INT);
            },
            function ($row) {

                $payment = new Payment();
                return $payment
                    ->setPaymentId($row['payment_id'])
                    ->setPaymentNo($row['payment_no'])
                    ->setBookingId($row['booking_id'])
                    ->setPaymentType($row['payment_type'])
                    ->setPrice($row['price'])
                    ->setCreatedDate($row['created_date']);
            }
        );
    }
}