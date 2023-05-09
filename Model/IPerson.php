<?php

/**
 * Composite pattern
 * @author ONG WI LIN
 * 
 * Reasons of using composite pattern : 
 * 1. it provides a way to represent a hierarchical structure of objects, where individual objects or composite objects can be treated uniformly. 

2. In your scenario, you have a Person class which can have two types of roles: User and Admin. Both User and Admin inherit from the Person class and have their own set of properties.

3. By using the composite pattern, you can create a composite object that represents a Person with a particular role, whether it's User or Admin. This composite object can be treated as a single object, regardless of whether it contains User or Admin properties. This allows you to write code that operates on Persons without needing to differentiate between Users and Admins.

4. For example, you can have a method that takes a Person object as an argument and performs some operation on it. This method can be called with a composite object that represents either a User or an Admin, and it will work correctly in either case. This makes your code more flexible and easier to maintain, because you don't need to write separate code for handling Users and Admins.

5. Overall, the composite pattern provides a way to create a tree-like structure of objects, where each object can be either a leaf node or a composite node. In your scenario, the Person object is the composite node, and the User and Admin objects are the leaf nodes. This allows you to create a flexible and extensible system for representing people with different roles.
 */


interface IPerson {
    function getUsername();
    function getPassword();
    function getName();
    function getPhone();
    function getMail();
    function getStatus();
    function getCreatedDate();
    function getCreatedBy();
    function getUpdatedDate();
    function getUpdatedBy();
//    
//    function setStatus($status): void;
//    function setCreatedDate($createdDate = null): void;
//    function setCreatedBy($createdBy): void;
//    function setUpdatedDate($updatedDate = null): void;
//    function setUpdatedBy($updatedBy): void;
//    function setProfilePic($profilePic): void;
//    
    
    function setStatus($status);
    function setCreatedDate($createdDate = null);
    function setCreatedBy($createdBy);
    function setUpdatedDate($updatedDate = null);
    function setUpdatedBy($updatedBy);
    function setProfilePic($profilePic);
    function setRandomUsername($name, $role, $username = null);
    function setUsername($username);
    function setName($name);
    function setPhone($phone);
    function setMail($mail);
    function setPassword($password);

}

