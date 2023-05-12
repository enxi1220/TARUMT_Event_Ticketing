<?php

#  Author: Ong Wi Lin
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/DataAccess/DataAccess.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Payment.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/PaymentDetail.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/User.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

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
    
    public static function ReportRead(Payment $payment)
    {
        $dataAccess = DataAccess::getInstance();
        $result = $dataAccess->BeginDatabase(
            function (DataAccess $dataAccess) use ($payment) {
                return PaymentRead::ReadReportPayment($dataAccess, $payment);
            }
        );

        return $result;
    }

    private static function ReadReportPayment(DataAccess $dataAccess, $payment)
    {
        return $dataAccess->Reader(
            "SELECT DATE(created_date) as date, SUM(price) as total_price
            FROM payment
            WHERE created_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND CURDATE() + INTERVAL 1 DAY
            GROUP BY DATE(created_date)",
            function (PDOStatement $pstmt) {},
            function ($row) { 
                $paymentArray = array();
                foreach ($row as $key => $value) {
                    $payment = new Payment();
                    $payment->setPrice($value['total_price'])
                            ->setCreatedDate($value['date']);

                    $paymentArray[] = $payment;
                }

                return $paymentArray; 
            }
        );
    }

    private static function ReadPayment(DataAccess $dataAccess, $payment)
    {
        return $dataAccess->Reader(

                "SELECT 
                    p.payment_id, 
                    p.payment_no, 
                    p.payment_type, 
                    p.price, 
                    p.created_date, 
                    u.user_id,
                    u.name,
                    u.mail,
                    e.event_id, 
                    e.event_no, 
                    e.name AS event_name, 
                    pd.ticket_prices,
                    pd.ticket_nos
                FROM payment p
                JOIN booking b ON p.booking_id = b.booking_id
                JOIN event e ON b.event_id = e.event_id
                JOIN user u ON b.user_id = u.user_id
                JOIN booking_detail bd ON b.booking_id = bd.booking_id
                JOIN (
                  SELECT 
                    payment_id,
                    GROUP_CONCAT(ticket_price) AS ticket_prices,
                    GROUP_CONCAT(ticket_no) AS ticket_nos
                  FROM payment_detail
                  GROUP BY payment_id
                ) pd ON p.payment_id = pd.payment_id
                WHERE p.payment_id = IF(:payment_id IS NULL, p.payment_id, :payment_id)
                GROUP BY b.booking_id;",
            function (PDOStatement $pstmt) use ($payment) {
                $pstmt->bindValue(":payment_id", $payment->getPaymentId(), PDO::PARAM_INT);
            },
            function ($row) {
                
            //User    
                $user = new User();
                            $user
                                    ->setUserId($row['user_id'])
                                    ->setName($row['name'])
                                    ->setMail($row['mail']);
            //Event    
                $event = new Event();
                            $event->setEventId($row['event_id'])
                                    ->setEventNo($row['event_no'])
                                    ->setName($row['event_name']);
                 
            //ticket
                $ticketNos = explode(',', $row['ticket_nos']);
                $ticketPrices = explode(',', $row['ticket_prices']);

                foreach ($ticketNos as $key => $ticketNo) {
                    $ticketPrice = $ticketPrices[$key];

                    $paymentDetail = new PaymentDetail();
                    $paymentDetail->setTicketNo($ticketNo)
                                  ->setTicketPrice($ticketPrice);

                    $paymentDetails[] = $paymentDetail;
                }

            //Payment
                $payment = new Payment();
                return $payment
                    ->setPaymentId($row['payment_id'])
                    ->setPaymentNo($row['payment_no'])
                    ->setPaymentType($row['payment_type'])
                    ->setPrice($row['price'])
                    ->setCreatedDate($row['created_date'])
//                    ->setBookingId($row['booking_id'])
                    ->setPaymentType($row['payment_type'])
                    ->setPrice($row['price'])
                    ->setPaymentDetails($paymentDetails)
                    ->setEvent($event)
                                    ->setUser($user);
//                                    ->setPayment($payment);
            }
        );
    }
}