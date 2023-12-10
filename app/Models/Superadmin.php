<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Superadmin extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'superadmins'; // Replace with your actual table name

    // Implement the methods required by the Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id'; // Replace with the name of your unique identifier column (usually 'id').
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    // Your model's properties and additional methods go here
}
