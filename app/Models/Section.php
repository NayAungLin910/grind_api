<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseId',
        'title',
        'description'
    ];

    /**
     * Get the course related to the section
     */
    public function course(): BelongsTo {
        return $this->belongsTo(Course::class, 'courseId');
    }

    /**
     * Get the section of the step
     */
    public function steps(): HasMany {
        return $this->hasMany(Step::class, 'sectionId');
    }
}
