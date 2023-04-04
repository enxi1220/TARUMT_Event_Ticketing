<?php

/**
 * Description of TicketStandard
 *
 * @author enxil
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketDescConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketTypeConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketStatusConstant.php";

class TicketStandard extends Ticket
{

    public function prefix()
    {
        return PrefixConstant::TICKETSTD;
    }

    public function description()
    {
        return TicketDescConstant::TICKETSTD;
    }

    public function type()
    {
        return TicketTypeConstant::STD;
    }

    public function createTicket(): Ticket
    {
        $ticket = new self();
        $ticket->setTicketNo(UniqueNoHelper::RandomCode($ticket->prefix()))
               ->setStatus(TicketStatusConstant::NEW);
        return $ticket;
    }
}
