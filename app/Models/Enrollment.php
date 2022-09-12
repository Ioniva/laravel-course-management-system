<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Enrollment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, int>
     */
    protected $fillable = [
        'users_id',
        'courses_id',
    ];

    /**
     * Relation with subject table
     *
     * @return HasOne
     */
    public function user(){
        return $this->hasOne(User::class, 'users_id');
    }

    /**
     * Relation with course table
     *
     * @return HasOne
     */
    public function course(){
        return $this->hasOne(Course::class, 'courses_id');
    }
}
