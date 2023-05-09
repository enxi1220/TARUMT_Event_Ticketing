<?php

/**
 * Description of User
 *
 * @author vinnie
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Person.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/MailSenderHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/BusinessLogic/BllUser/Read.php";
require_once 'Observer.php';
require_once 'Subject.php';

class User extends Person implements Observer{

    private $userId;
    private $userOtp;
    
      public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function getUserOtp() {
        return $this->userOtp;
    }

    public function setUserOtp($userOtp) {
        $this->userOtp = $userOtp;
        return $this;
    }

    public function update(\Subject $subject) {
        
        $users = Read::Read(new User());
        
        foreach ($users as $user) {
            $userMail = $user->getMail();
            MailSenderHelper::sendMail($userMail, 'New event created', 'A new event has been created. Check it out with the link: http://localhost/TARUMT_Event_Ticketing/Web/View/FrontOffice/Event/EventRead.php?eventId='.$subject->getEventId(), 'newEvent');
        }
        
    }

}
