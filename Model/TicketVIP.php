<?php

/**
 * Description of TicketVIP
 *
 * @author enxil
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketDescConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketTypeConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketStatusConstant.php";

class TicketVIP extends Ticket
{

    public function prefix()
    {
        return PrefixConstant::TICKETVIP;
    }

    public function description()
    {
        return TicketDescConstant::TICKETVIP;
    }

    public function type()
    {
        return TicketTypeConstant::VIP;
    }

    public function createTicket(): Ticket
    {
        $ticket = new self();
        $ticket->setTicketNo(UniqueNoHelper::RandomCode($ticket->prefix()))
               ->setStatus(TicketStatusConstant::NEW);
        return $ticket;
    }
}
