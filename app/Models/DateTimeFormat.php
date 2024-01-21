<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/*
  Attendize.com   - Event Management & Ticketing
 */

/**
 * Description of DateTimeFormat.
 *
 * @author Dave
 */
class DateTimeFormat extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    /**
     * Indicates whether the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'datetime_formats';

    /**
     * Indicates whether the model should use soft deletes.
     *
     * @var bool
     */
    protected $softDelete = false;
}
