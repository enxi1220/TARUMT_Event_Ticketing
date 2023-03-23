<?php

#  Author: Lim En Xi

include $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";

class Create
{
    private $event;
    public static function Create($data)
    {
        $event = new Event(
            $data->categoryId,
            $data->name,
            $data->poster,
            $data->venue,
            $data->registerStartDate,
            $data->registerDuedate,
            $data->eventStartDate,
            $data->eventEndDate,
            $data->descripton,
            $data->vipTicketQty,
            $data->standardTicketQty,
            $data->budgetTicketQty,
            $data->vipTicketPrice,
            $data->standardTicketPrice,
            $data->budgetTicketPrice,
            $data->organizerName,
            $data->organizerPhone,
            $data->organizerMail,
            $data->createdBy
        );

        
    }
}
