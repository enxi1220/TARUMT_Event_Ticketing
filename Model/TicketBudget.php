<?php

/**
 * Description of TicketBudget
 *
 * @author enxil
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketDescConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketTypeConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/TicketStatusConstant.php";

class TicketBudget extends Ticket 
{

    public function prefix()
    {
        return PrefixConstant::TICKETBGT;
    }

    public function description(){
        return TicketDescConstant::TICKETBGT;
    }

    public function type() {
        return TicketTypeConstant::BGT;
    }

    public function createTicket(): Ticket
    {
        $ticket = new self();
        $ticket->setTicketNo(UniqueNoHelper::RandomCode($ticket->prefix()))
               ->setStatus(TicketStatusConstant::NEW);
        return $ticket;
    }
}

