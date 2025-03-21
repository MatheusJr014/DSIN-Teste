<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Services extends Model
{
    use HasFactory, HasApiTokens;

    
    protected $table = "services";  
    
    protected $fillable = [
        'servicetype',
        'serviceprice',
        'serviceimage',
        'servicedescription'
    ];
}
