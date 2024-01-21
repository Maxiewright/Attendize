<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Description of Questions.
 *
 * @author Dave
 */
class Question extends MyBaseModel
{
    use SoftDeletes;

    /**
     * The events associated with the question.
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Event::class);
    }

    /**
     * The type associated with the question.
     */
    public function question_type(): HasOne
    {
        return $this->belongsTo(\App\Models\QuestionType::class);
    }

    public function answers()
    {
        return $this->hasMany(\App\Models\QuestionAnswer::class);
    }

    /**
     * The options associated with the question.
     */
    public function options(): HasOne
    {
        return $this->hasMany(\App\Models\QuestionOption::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(\App\Models\Ticket::class);
    }

    /**
     * Scope a query to only include active questions.
     */
    public function scopeIsEnabled($query): Builder
    {
        return $query->where('is_enabled', 1);
    }
}
