<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'questionId',
        'description',
        'explanation',
        'status',
    ];

    /**
     * Get the question related to the answer
     */
    public function question(): BelongsTo {
        return $this->belongsTo(Question::class, 'questionId');
    }
}
