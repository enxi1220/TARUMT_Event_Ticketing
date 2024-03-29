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

//class User extends Person {

    private IPerson $person;
    private $userId;
//    private $username;
//    private $password;
//    private $name;
//    private $phone;
//    private $mail;
//    private $status;
//    private $createdBy;
//    private $createdDate;
//    private $updatedBy;
//    private $updatedDate;
    private $userOtp;
    
      public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

//    public function getUsername() {
//        return $this->username;
//    }
//
//    public function setUsername($username) {
//        $this->username = $username;
//        return $this;
//    }
//
//    public function getPassword() {
//        return $this->password;
//    }
//
//    public function setPassword($password) {
//        $this->password = $password;
//        return $this;
//    }
//
//    public function getName() {
//        return $this->person->name;
//    }
//
//    public function setName($name) {
//        $this->name = $name;
//        return $this;
//    }
//
//    public function getPhone() {
//        return $this->phone;
//    }
//
//    public function setPhone($phone) {
//        $this->phone = $phone;
//        return $this;
//    }
//
//    public function getMail() {
//        return $this->mail;
//    }
//
//    public function setMail($mail) {
//        $this->mail = $mail;
//        return $this;
//    }
//
//    public function getStatus() {
//        return $this->status;
//    }
//
//    public function setStatus($status) {
//        $this->status = $status;
//        return $this;
//    }
//
//    public function getCreatedBy() {
//        return $this->createdBy;
//    }
//
//    public function setCreatedBy($createdBy) {
//        $this->createdBy = $createdBy;
//        return $this;
//    }
//
//    public function getCreatedDate() {
//        return $this->createdDate;
//    }
//
//    public function setCreatedDate($createdDate = null) {
//        $this->createdDate = $createdDate == null ? DateHelper::GetMalaysiaDateTime() : $createdDate;
//        return $this;
//    }
//
//    public function getUpdatedDate() {
//        return $this->updatedDate;
//    }
//
//    public function setUpdatedDate($updatedDate = null) {
//        $args = func_get_args();
//
//        switch (count($args)) {
//            case 0:
//                $this->updatedDate = DateHelper::GetMalaysiaDateTime();
//                break;
//            case 1:
//                $this->updatedDate = $updatedDate;
//                break;
//            default:
//                // Invalid number of arguments
//                break;
//        }
//        return $this;
//    }
//
//    public function getUpdatedBy() {
//        return $this->updatedBy;
//    }
//
//    public function setUpdatedBy($updatedBy) {
//        $this->updatedBy = $updatedBy;
//        return $this;
//    }
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
