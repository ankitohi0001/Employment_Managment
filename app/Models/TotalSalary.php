<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TotalSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'position_id',
        'salary_type_id',
        'salary',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
