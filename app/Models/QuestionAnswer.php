<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAnswer extends MyBaseModel
{
    protected $fillable = [
        'question_id',
        'event_id',
        'attendee_id',
        'account_id',
        'answer_text',
        'questionable_id',
        'questionable_type',
    ];

    public function event(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Event::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Question::class)->withTrashed();
    }

    public function attendee(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Attendee::class);
    }
}
