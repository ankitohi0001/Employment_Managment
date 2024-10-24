<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary_Type extends Model
{
    use HasFactory;
    protected $fillable = ['type_name'];
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
