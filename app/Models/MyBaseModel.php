<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*
 * Adapted from: https://github.com/hillelcoren/invoice-ninja/blob/master/app/models/EntityModel.php
 */

class MyBaseModel extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates whether the model uses soft deletes.
     *
     * @var bool
     */
    protected $softDelete = true;

    /**
     * The validation rules of the model.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * The validation error messages of the model.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * The validation errors of model.
     */
    protected $errors;

    /**
     * Create a new model.
     *
     * @param  int|bool  $account_id
     * @param  int|bool  $user_id
     */
    public static function createNew($account_id = false, $user_id = false, bool $ignore_user_id = false): className
    {
        $className = static::class;
        $entity = new $className();

        if (Auth::check()) {
            if (! $ignore_user_id) {
                $entity->user_id = Auth::id();
            }

            $entity->account_id = Auth::user()->account_id;
        } elseif ($account_id || $user_id) {
            if ($user_id && ! $ignore_user_id) {
                $entity->user_id = $user_id;
            }

            $entity->account_id = $account_id;
        } else {
            App::abort(500);
        }

        return $entity;
    }

    /**
     * Validate the model instance.
     */
    public function validate($data): bool
    {
        $rules = (method_exists($this, 'rules') ? $this->rules() : $this->rules);
        $v = Validator::make($data, $rules, $this->messages, $this->attributes);

        if ($v->fails()) {
            $this->errors = $v->messages();

            return false;
        }

        // validation pass
        return true;
    }

    /**
     * Gets the validation error messages.
     *
     * @return mixed
     */
    public function errors(bool $returnArray = true)
    {
        return $returnArray ? $this->errors->toArray() : $this->errors;
    }

    /**
     * Get a formatted date.
     *
     * @param  bool|null|string  $format
     * @return bool|null|string
     */
    public function getFormattedDate($field, $format = false)
    {
        if (! $format) {
            $format = config('attendize.default_datetime_format');
        }

        return $this->$field === null ? null : $this->$field->format($format);
    }

    /**
     * Ensures each query looks for account_id
     *
     * @return mixed
     */
    public function scopeScope($query, bool $accountId = false)
    {

        /*
         * GOD MODE - DON'T UNCOMMENT!
         * returning $query before adding the account_id condition will let you
         * browse all events etc. in the system.
         * //return  $query;
         */

        if (! $accountId && Auth::check()) {
            $accountId = Auth::user()->account_id;
        }

        if ($accountId !== false) {
            $table = $this->getTable();

            $query->where(function ($query) use ($accountId, $table) {
                $query->whereRaw(\DB::raw('('.$table.'.account_id = '.$accountId.')'));
            });
        }

        return $query;
    }
}
