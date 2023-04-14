<?php
/**
 * Description of Category
 *
 * @author Ong Yi Chween
 */


require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Helper/DateHelper.php";
class Category {
    private $categoryId;
    private $name;
    private $description;
    private $createdDate;
    private $createdBy;
    private $updatedDate;
    private $updatedBy;
    
    public function __construct() {
        
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCreatedDate() {
        return $this->createdDate;
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setCreatedDate($createdDate = null) {
        $this->createdDate = $createdDate == null ? DateHelper::GetMalaysiaDateTime() : $createdDate;
        return $this;
    }

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setUpdatedDate($updatedDate = null) {
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

    public function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
        return $this;
    }


}
