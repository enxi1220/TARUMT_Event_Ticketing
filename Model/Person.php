<?php

/**
 * Composite pattern
 * @author ONG WI LIN
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/IPerson.php";


class Person implements IPerson {
    protected $username;
    protected $password;
    protected $name;
    protected $phone;
    protected $mail;
    protected $status;
    protected $created_date;
    protected $created_by;
    protected $updated_date;
    protected $updated_by;
    protected $profilePic;

//    public function __construct(string $name, string $username, string $phone, string $mail, string $created_by, string $status) {
//        $this->name = $name;
//        $this->username = $username;
//        $this->phone = $phone;
//        $this->mail = $mail;
//        $this->created_date = new DateTime();
//        $this->created_by = $created_by;
//        $this->status = $status;
//    }
    
    public function __construct() {
        
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getName(){
        return $this->name;
    }
    
//    public function setUsername($username = null)
//    {
//        $this->username = $username == null ? UniqueNoHelper::generateUsername($name, $role()) : $username;
//        return $this;
//    }

    
    public function setRandomUsername($name, $role, $username = null)
    {
        $uniqueNoHelper = new UniqueNoHelper();
        $this->username = $username == null ? $uniqueNoHelper->generateUsername($name, $role) : $username;
        return $this;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
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
        
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setCreatedDate($created_date = null)
    {
        $this->created_date = $created_date == null ? DateHelper::GetMalaysiaDateTime(): $created_date;

        return $this;
    }
    
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
        return $this;
    }
    
    public function setUpdatedDate($update_date = null)
    {
        $this->updated_date = $update_date == null ? DateHelper::GetMalaysiaDateTime() : $update_date;
        return $this;
    }
    
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
        return $this;
    }
    
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;
        return $this;
    }
    
    public function getPhone() {
        return $this->phone;
    }

    public function getMail(){
        return $this->mail;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedDate() {
        return $this->created_date;
    }

    public function getCreatedBy(){
        return $this->created_by;
    }

    public function getUpdatedDate(){
        return $this->updated_date;
    }

    public function getUpdatedBy() {
        return $this->updated_by;
    }
    
}
