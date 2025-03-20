<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable; 

    protected $table = 'users'; 

    protected $fillable = [
        'username',
        'usercpf', 
        'useremail', 
        'password', 
        'userphone', 
        'usercreationdate',
        'userstatus',
        'role'
    ];

    public function getAuthPassword(){
        return $this->password; 
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'id'=> $this->id,
            'username'=>$this->username,
            'usercpf'=>$this->usercpf,
            'useremail'=>$this->useremail,
            'userphone'=>$this->userphone,
            'userstatus'=>$this->userstatus
        ];
    }
}
