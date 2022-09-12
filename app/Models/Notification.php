<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notification extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'work',
        'exam',
        'continuous_assessment',
        'final_note'
    ];

    /**
     * Relation with user (student) table
     *
     * @return HasOne
     */
    public function user(){
        return $this->hasOne(User::class, 'users_id');
    }
}
