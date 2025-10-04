<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Employee;

class Company extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'website',
        'logo',
    ];

    /**
     * Link company to user (login account)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Link company to its employees
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
