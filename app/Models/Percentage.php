<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Percentage extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'courses_id',
        'subjects_id',
        'continuous_assessment',
        'exams'
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
     * Relation with course table
     *
     * @return BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class, 'courses_id');
    }
}
