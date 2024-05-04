<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'stepId',
        'description',
    ];

    /**
     * Get the quiz step related to the question
     */
    public function step(): BelongsTo {
        return $this->belongsTo(Step::class, 'stepId');
    }

    /**
     * Get the related answers for the question
     */
    public function answers(): HasMany {
        return $this->hasMany(Answer::class, 'questionId');
    }
  }
