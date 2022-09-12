<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Exam extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'subjects_id',
        'name',
        'mark'
    ];

    /**
     * Relation with subject table
     *
     * @return BelongsTo
     */
    public function subject(){
        return $this->belongsTo(Subject::class, 'subjects_id');
    }

    /**
     * Relation with user (student) table
     *
     * @return BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
