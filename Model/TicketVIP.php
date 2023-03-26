<?php

/**
 * Description of TicketVIP
 *
 * @author enxil
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
class TicketVIP extends Ticket
{

    public function prefix()
    {
        return PrefixConstant::TICKETVIP;
    }
}
