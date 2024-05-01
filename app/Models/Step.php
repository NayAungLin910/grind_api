<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'sectionId',
        'type',
        'title',
        'video', // video if the the step type is video
        'description',
        'readingContent', // reading content based  if the step type is reading
        'status',
        'timeGiven' // the time given to take the quiz, if the step type is quiz
    ];

    /**
     * Get the section of the step
     */
    public function section(): BelongsTo {
        return $this->belongsTo(Section::class, 'sectionId');
    }
}
