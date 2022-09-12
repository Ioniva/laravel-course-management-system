<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'id_student',
        'id_course',
    ];

    /**
     * Relation with subject table
     *
     * @return HasOne
     */
    public function student(){
        return $this->hasOne(Student::class);
    }

    /**
     * Relation with course table
     *
     * @return HasOne
     */
    public function course(){
        return $this->hasOne(Course::class);
    }
}
