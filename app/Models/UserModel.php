<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}