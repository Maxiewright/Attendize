<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/*
  Attendize.com   - Event Management & Ticketing
 */

/**
 * Description of DateFormat.
 *
 * @author Dave
 */
class DateFormat extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    /**
     * Indicates whether the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates whether the model should use soft deletes.
     *
     * @var bool
     */
    protected $softDelete = false;
}
