<?php

/**
 * Description of TicketBudget
 *
 * @author enxil
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";

class TicketBudget extends Ticket
{

    public function prefix()
    {
        return PrefixConstant::TICKETBGT;
    }
}
