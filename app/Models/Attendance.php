<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',          
        'date',
        'check_in_time',
        'check_out_time',
        'status',
    ];

public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

public function attendances(): HasMany
{
    return $this->hasMany(Attendances::class);
}
}
