<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseId',
        'title',
        'description',
        'image'
    ];

    /**
     * Get the course the certificate is associated with
     */
    public function course(): HasOne {
        return $this->hasOne(Course::class, 'courseId');
    }

    /**
     * Get the users that have the certificate
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
