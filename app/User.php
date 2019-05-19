<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isAdmin', 'isEditor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'isAdmin', 'isEditor'
    ];

    public function isAdmin(){
        return $this->isAdmin || $this->id == 1;
    }

    public function isEditor(){
        return $this->isAdmin() || $this->isEditor;
    }

    public function roles(){
        if ($this->isAdmin()){
            return ['admin','editor'];
        };

        if ($this->isEditor()) return ['editor'];

        return [];
    }
}
