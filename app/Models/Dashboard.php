<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role'];
    public function attendances()
    {
        return $this->hasMany(Attendances::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
