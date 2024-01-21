<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/*
  Attendize.com   - Event Management & Ticketing
 */

/**
 * Description of OrderItems.
 *
 * @author Dave
 */
class OrderItem extends MyBaseModel
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'quantity',
        'order_id',
        'unit_price',
    ];
}
