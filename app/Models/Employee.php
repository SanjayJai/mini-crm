<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id', 'company_id', 'name', 'email', 'position', 'password','phone'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
