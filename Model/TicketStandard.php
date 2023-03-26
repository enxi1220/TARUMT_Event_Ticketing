<?php

/**
 * Description of TicketStandard
 *
 * @author enxil
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";

class TicketStandard extends Ticket
{

    public function prefix()
    {
        return PrefixConstant::TICKETSTD;
    }
}
