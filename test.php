<?php

class User
{
    private $firstname;
    private $lastname;

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }
    
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}

$user = new User();
$user
    ->setFirstName('test')
    ->setLastName('test')
;

$user = new User();
$user
    ->setFirstName('test')
    ->setLastName('test');

$user = (new User())
    ->setFirstName('test')
    ->setLastName('test')
;

$user = (new User())
    ->setFirstName('test')
    ->setLastName('test');
