<?php 

namespace Web\Entities;

class UserEntity{

    private $id;
    private $FirstName;
    private $LastName;
    private $email;
    private $password;
    private $date;

    public function __construct($array){
        $this->id = $array['id'];
        $this->FirstName = $array['first_name'];
        $this->LastName = $array['last_name'];
        $this->email = $array['email'];
        $this->password = $array['password'];
        $this->date = $array['date'];
    }

    public function toArray(){
        return[
            'id' => $this->id,
            'first_name' => $this->FirstName,
            'last_name' => $this->LastName,
            'email' => $this->email,
            'password' => $this->password,
            'date' => $this->date
        ];
    }

    public function getId(){
        return $this->id;
    }

    public function getFirstName(){
        return $this->FirstName;
    }

    public function getLastName(){
        return $this->LastName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getDate(){
        return $this->date;
    }
}