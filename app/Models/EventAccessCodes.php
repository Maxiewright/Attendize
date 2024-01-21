<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventAccessCodes extends MyBaseModel
{
    use HasFactory;
    use SoftDeletes;

    public static function logUsage(int $event_id, string $accessCode): void
    {
        (new static)::where('event_id', $event_id)
            ->where('code', $accessCode)
            ->increment('usage_count');
    }

    public static function findFromCode($code, $event_id): Collection
    {
        return (new static())
            ->where('code', $code)
            ->where('event_id', $event_id)
            ->get();
    }

    /**
     * The validation rules.
     *
     * @return array $rules
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string',
        ];
    }

    /**
     * The Event associated with the event access code.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(
            Ticket::class,
            'ticket_event_access_code',
            'event_access_code_id',
            'ticket_id'
        )->withTimestamps();
    }
}
