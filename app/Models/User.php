<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Relationship for courses created by the user
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    // Relationship for courses the user is enrolled in
    public function enrolledCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Correct property for type casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationship for progress tracking
    public function progress()
    {
        return $this->hasManyThrough(Progress::class, Enrollment::class, 'student_id', 'enrollment_id');
    }
}
