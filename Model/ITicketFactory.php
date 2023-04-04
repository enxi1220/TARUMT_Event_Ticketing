<?php

/**
 * Description of ITicketFactory
 * @author enxil
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";

interface ITicketFactory
{
    public function createTicket(): Ticket;
}