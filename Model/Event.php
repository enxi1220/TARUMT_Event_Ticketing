<?php

/**
 * Description of Event
 * Design pattern: Creational -> Factory
 * @author enxil
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Observer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Subject.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Category.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Ticket.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PosterPathConstant.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/UniqueNoHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Read.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllEvent/Deactivate.php";

class Event extends Subject implements Observer
{
    private $eventId;
    private $categoryId;
    private $eventNo;
    private $name;
    private $poster;
    private $venue;
    private $registerStartDate;
    private $registerEndDate;
    private $eventStartDate;
    private $eventEndDate;
    private $description;
    private $vipTicketQty;
    private $standardTicketQty;
    private $budgetTicketQty;
    private $vipTicketPrice;
    private $standardTicketPrice;
    private $budgetTicketPrice;
    private $organizerName;
    private $organizerPhone;
    private $organizerMail;
    private $status;
    private $createdDate;
    private $createdBy;
    private $updatedDate;
    private $updatedBy;

    private Category $category;
    private $tickets = array();
    private $posterPath;
    private $ticketQtySold;

    public function __construct()
    {
    }

    public function getEventId()
    {
        return $this->eventId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getEventNo()
    {
        return $this->eventNo;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPoster()
    {
        return $this->poster;
    }

    public function getVenue()
    {
        return $this->venue;
    }

    public function getRegisterStartDate()
    {
        return $this->registerStartDate;
    }

    public function getRegisterEndDate()
    {
        return $this->registerEndDate;
    }

    public function getEventStartDate()
    {
        return $this->eventStartDate;
    }

    public function getEventEndDate()
    {
        return $this->eventEndDate;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getVipTicketQty()
    {
        return $this->vipTicketQty;
    }

    public function getStandardTicketQty()
    {
        return $this->standardTicketQty;
    }

    public function getBudgetTicketQty()
    {
        return $this->budgetTicketQty;
    }

    public function getVipTicketPrice()
    {
        return $this->vipTicketPrice;
    }

    public function getStandardTicketPrice()
    {
        return $this->standardTicketPrice;
    }

    public function getBudgetTicketPrice()
    {
        return $this->budgetTicketPrice;
    }

    public function getOrganizerName()
    {
        return $this->organizerName;
    }

    public function getOrganizerPhone()
    {
        return $this->organizerPhone;
    }

    public function getOrganizerMail()
    {
        return $this->organizerMail;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getTickets()
    {
        return $this->tickets;
    }

    public function getPosterPath()
    {
        return $this->posterPath;
    }

    public function getTicketQtySold()
    {
        return $this->ticketQtySold;
    }

    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
        return $this;
        
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setEventNo($eventNo = null)
    {
        $this->eventNo = $eventNo == null ? UniqueNoHelper::RandomCode($this->prefix()) : $eventNo;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPoster($poster)
    {
        $this->poster = $poster;
        return $this;
    }

    public function setVenue($venue)
    {
        $this->venue = $venue;
        return $this;
    }

    public function setRegisterStartDate($registerStartDate)
    {
        $this->registerStartDate = $registerStartDate;
        return $this;
    }

    public function setRegisterEndDate($registerEndDate)
    {
        $this->registerEndDate = $registerEndDate;
        return $this;
    }

    public function setEventStartDate($eventStartDate)
    {
        $this->eventStartDate = $eventStartDate;
        return $this;
    }

    public function setEventEndDate($eventEndDate)
    {
        $this->eventEndDate = $eventEndDate;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setVipTicketQty($vipTicketQty)
    {
        $this->vipTicketQty = $vipTicketQty;
        return $this;
    }

    public function setStandardTicketQty($standardTicketQty)
    {
        $this->standardTicketQty = $standardTicketQty;
        return $this;
    }

    public function setBudgetTicketQty($budgetTicketQty)
    {
        $this->budgetTicketQty = $budgetTicketQty;
        return $this;
    }

    public function setVipTicketPrice($vipTicketPrice)
    {
        $this->vipTicketPrice = $vipTicketPrice;
        return $this;
    }

    public function setStandardTicketPrice($standardTicketPrice)
    {
        $this->standardTicketPrice = $standardTicketPrice;
        return $this;
    }

    public function setBudgetTicketPrice($budgetTicketPrice)
    {
        $this->budgetTicketPrice = $budgetTicketPrice;
        return $this;
    }

    public function setOrganizerName($organizerName)
    {
        $this->organizerName = $organizerName;
        return $this;
    }

    public function setOrganizerPhone($organizerPhone)
    {
        $this->organizerPhone = $organizerPhone;
        return $this;
    }

    public function setOrganizerMail($organizerMail)
    {
        $this->organizerMail = $organizerMail;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setCreatedDate($createdDate = null)
    {
        $this->createdDate = $createdDate == null ? DateHelper::GetMalaysiaDateTime() : $createdDate;
        return $this;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setUpdatedDate($updatedDate = null)
    {
        $args = func_get_args();

        switch (count($args)) {
            case 0:
                $this->updatedDate = DateHelper::GetMalaysiaDateTime();
                break;
            case 1:
                $this->updatedDate = $updatedDate;
                break;
            default:
                // Invalid number of arguments
                break;
        }
        return $this;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
        return $this;
    }

    public function setTicketQtySold($ticketQtySold)
    {
        $this->ticketQtySold = $ticketQtySold;
        return $this;
    }

    public function posterPath()
    {
        return PosterPathConstant::PATH;
    }

    public function prefix()
    {
        return PrefixConstant::EVENT;
    }

    public function createTickets(ITicketFactory $vipFactory, ITicketFactory $standardFactory, ITicketFactory $budgetFactory)
    {
        for ($i = 0; $i < $this->vipTicketQty; $i++) {
            $ticket = $vipFactory->createTicket();
            array_push($this->tickets, $ticket);
        }

        for ($i = 0; $i < $this->standardTicketQty; $i++) {
            $ticket = $standardFactory->createTicket();
            array_push($this->tickets, $ticket);
        }

        for ($i = 0; $i < $this->budgetTicketQty; $i++) {
            $ticket = $budgetFactory->createTicket();
            array_push($this->tickets, $ticket);
        }
        
    }

    public function update(\Subject $subject)
    {
        $event = new Event();
        $event->setEventEndDate(DateHelper::GetMalaysiaDateTimeWithoutSecond());
        $result = Read::Read($event);

        foreach ($result as $event) {
            $event->setUpdatedBy("System");
            Deactivate::Deactivate($event);
        }
    }

}