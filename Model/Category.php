<?php
/**
 * Description of Category
 *
 * @author enxil
 */
class Category {
    private $categoryId;
    private $name;
    private $description;
    private $status;
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

    public function getStatus() {
        return $this->status;
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

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
        return $this;
    }

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
        return $this;
    }

    public function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
        return $this;
    }


}
