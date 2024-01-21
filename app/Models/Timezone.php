<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/*
  Attendize.com   - Event Management & Ticketing
 */

/**
 * Description of Timezone.
 *
 * @author Dave
 */
class Timezone extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the model should use soft deletes.
     *
     * @var bool
     */
    protected $softDelete = false;
}
