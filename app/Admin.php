<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens;

    /**
     * Passport 多认证字段
     */
    public function findForPassport($username)
    {
        return self::orWhere('email', $username)->orWhere('username', $username)->first();
    }
}
