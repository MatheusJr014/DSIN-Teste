<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Model
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
        'userstatus'
    ];
    
}
