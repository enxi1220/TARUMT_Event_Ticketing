<?php
/**
 * Composite pattern
 * @author ONG WI LIN
 */
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/UniqueNoHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Person.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Constant/PrefixConstant.php";

class Admin extends Person {
    private IPerson $person;
    private $admin_id = null;
    private $adminNo;
    private string $role;

//    public function __construct()
//    {
//    }
//    
//    public function __construct($name = '', $phone = '', $mail = '', $createdBy = '', $role = '') {
//        parent::__construct($name, $phone, $mail);
//        $this->person = new Person($name, $phone, $mail);
//        $this->createdBy = $createdBy;
//        $this->role = $role;
//    }
//    
    public function __construct($name = '', $username = '', $phone = '', $mail = '', $created_date = '', $created_by = '', $status = '', $role = '', $adminNo = '') {
    parent::__construct($name, $username, $phone, $mail, $created_date, $created_by, $status);
    $this->person = new Person($name, $username, $phone, $mail, $created_date, $created_by, $status);
//    $this->createdBy = $createdBy;
//    $this->$created_date = '';
    $this->adminNo = $adminNo;
    $this->role = $role;
    $this->admin_id = ''; 
}

    
//    public function __construct(IPerson $person, string $admin_id, string $role) {
//        $this->person = $person;
//        $this->admin_id = $admin_id;
//        $this->adminNo = $adminNo;
//        $this->role = $role;
//    }

    public function getAdminId() {
        return $this->admin_id;
    }
    
    public function getAdminNo(){
        return $this->adminNo;
    }

    public function getRole(): string {
        return $this->role;
    }
//
//    public function getUsername(): string {
//        return $this->person->getUsername();
//    }

//    public function getPassword(): string {
//        return $this->person->getPassword();
//    }
//
//    public function getName(): string {
//        return $this->person->name;
//    }
//
//    public function getPhone(): string {
//        return $this->person->phone;
//    }
//
//    public function getMail(): string {
//        return $this->person->mail;
//    }
//
//    public function getStatus(): string {
//        return $this->person->status;
//    }
//
//    public function getCreatedDate(): DateTime {
//        return $this->person->created_date;
//    }
//
//    public function getCreatedBy(): string {
//        return $this->person->created_by;
//    }
//
//    public function getUpdatedDate(): DateTime {
//        return $this->person->updated_date;
//    }
//
//    public function getUpdatedBy(): string {
//        return $this->person->updated_by;
//    }
//        
//    Setter
    
    public function setRole(string $role)
    {
        $this->role = $role;
        return $this;
    }
    
    public function setAdminId($admin_id){
        $this->admin_id = $admin_id;
        return $this;
    }
//
//    
//    public function setName($name)
//    {
//        $this->person->name = $name;
//        return $this;
//    }
//    
//    public function setRandomUsername($name, $role, $username = null)
//    {
//        $helper = new UniqueNoHelper();
//        $this->person->username = $username == null ? $helper->generateUsername($name, $role) : $username;
////        $this->person->username = $username == null ? UniqueNoHelper::generateUsername($name, $role) : $username;
//        return $this;
//    }
    
//    public function setUsername($username)
//    {
//        $this->person->username = $username;
//        return $this;
//    }
//    
//    public function setPhone($phone)
//    {
//        $this->person->phone = $phone;
//        return $this;
//    }
//    
//    public function setMail($mail)
//    {
//        $this->person->mail = $mail;
//        return $this;
//    }
//        
//    public function setPassword($password)
//    {
//        $this->person->password = $password;
//        return $this;
//    }
//        
//    public function setStatus($status)
//    {
//        $this->person->status = $status;
//        return $this;
//    }
//
//    public function setCreatedDate($createdDate = null)
//    {
//        $this->person->createdDate = $createdDate == null ? DateHelper::GetMalaysiaDateTime() : $createdDate;
//        return $this;
//    }
//
//    public function setCreatedBy($createdBy)
//    {
//        $this->person->createdBy = $createdBy;
//        return $this;
//    }
//
//    public function setUpdatedDate($updatedDate = null)
//    {
//        $this->person->updatedDate = $updatedDate == null ? DateHelper::GetMalaysiaDateTime() : $updatedDate;
//        return $this;
        
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
//    public function setUpdatedBy($updatedBy)
//    {
//        $this->updatedBy = $updatedBy;
//        return $this;
//    }
//    
//    public function setProfilePic($profilePic)
//    {
//        $this->person->profilePic = $profilePic;
//        return $this;
//    }

    public function setAdminNo($adminNo = null)
    {
        $this->adminNo = $adminNo == null ? UniqueNoHelper::RandomCode($this->prefix()) : $adminNo;
        return $this;
    }

    public function prefix()
    {
        return PrefixConstant::ADMIN;
    }

//    public function setRandomUsername($name, $role, $username = null) {
//        
//    }

}