<?php

namespace Web\Model;

use Web\Entities\UserEntity;

class User extends Model{
    protected $FileName = 'users';
    protected $entityClass = UserEntity::class;

    public function authenticatedUser($email , $password){
        $data = $this->database->getData();
        $user = array_filter($data , function($item) use($email , $password){
            if($item->getEmail() == $email and $item->getPassword() == $password)

                return true;

                return false;
        });

        $user = array_values($user);

        return count($user) ? $user[0] : false;
    }
}