<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subject extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'courses_id',
        'schedules_id',
        'name',
        'color'
    ];

    /**
     * Relation with user (teachers) table
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Relation with schedule table
     *
     * @return BelongsTo
     */
    public function schedule(){
        return $this->belongsTo(Schedule::class, 'schedules_id');
    }

    /**
     * Relation with schedule table
     *
     * @return BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class, 'courses_id');
    }
}
