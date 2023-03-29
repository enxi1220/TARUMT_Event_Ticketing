<?php

/**
 * Description of TicketVIP
 *
 * @author enxil
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketDescConstant.php";

class TicketVIP extends Ticket
{

    public function prefix()
    {
        return PrefixConstant::TICKETVIP;
    }

    public function description(){
        return TicketDescConstant::TICKETVIP;
    }
}
