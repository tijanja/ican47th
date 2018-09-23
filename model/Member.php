<?php
include_once 'Connection.php';

class Member extends Connection
{
    var $memberId,$registrationNum,$fname,$lastName,$email,$phone;
    function __construct() {
        if(!$result = $db->query($sql))
        {
            die('There was an error running the query [' . $db->error . ']');
        }
    }
    
    function getMemberId() {
        return $this->memberId;
    }

    function getRegistrationNum() {
        return $this->registrationNum;
    }

    function getFname() {
        return $this->fname;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhone() {
        return $this->phone;
    }

    function setMemberId($memberId) {
        $this->memberId = $memberId;
    }

    function setRegistrationNum($registrationNum) {
        $this->registrationNum = $registrationNum;
    }

    function setFname($fname) {
        $this->fname = $fname;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }


}
