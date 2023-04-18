<?php

/**
 * Composite pattern
 * @author ONG WI LIN
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPerson.php";


class Person implements IPerson {
    protected string $username;
    protected string $password;
    protected string $name;
    protected string $phone;
    protected string $mail;
    protected string $status;
    protected DateTime $created_date;
    protected string $created_by;
    protected DateTime $updated_date;
    protected string $updated_by;
    protected string $profilePic;
//
//    public function __construct(string $username, string $password, string $name, string $phone, string $mail, string $status, DateTime $created_date, string $created_by, DateTime $updated_date, string $updated_by) {
//        $this->username = $username;
//        $this->password = $password;
//        $this->name = $name;
//        $this->phone = $phone;
//        $this->mail = $mail;
//        $this->status = $status;
//        $this->created_date = $created_date;
//        $this->created_by = $created_by;
//        $this->updated_date = $updated_date;
//        $this->updated_by = $updated_by;
//    }

    public function __construct(string $name, string $username, string $phone, string $mail, string $created_by, string $status) {
        $this->name = $name;
        $this->username = $username;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->created_date = new DateTime();
        $this->created_by = $created_by;
        $this->status = $status;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getName(): string {
        return $this->name;
    }
    
//    public function setUsername($username = null)
//    {
//        $this->username = $username == null ? UniqueNoHelper::generateUsername($name, $role()) : $username;
//        return $this;
//    }

    
    public function setUsername($name, $role, $username = null)
    {
        $this->username = $username == null ? UniqueNoHelper::generateUsername($name, $role) : $username;
        return $this;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }
        
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
        
//    public function setStatus($status)
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

//    public function setUpdatedDate($updatedDate = null)
//    {
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

    
    public function setUpdatedDate($updatedDate = null)
    {
        $this->updated_date = $updatedDate == null ? DateHelper::GetMalaysiaDateTime() : $updatedDate;
        return $this;
    }
    
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }
    
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;
        return $this;
    }
    
    public function getPhone(): string {
        return $this->phone;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getCreatedDate(): DateTime {
        return $this->created_date;
    }

    public function getCreatedBy(): string {
        return $this->created_by;
    }

    public function getUpdatedDate(): DateTime {
        return $this->updated_date;
    }

    public function getUpdatedBy(): string {
        return $this->updated_by;
    }
    
}