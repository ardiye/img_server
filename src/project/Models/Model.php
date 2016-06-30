<?php

namespace Project\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


abstract class Model extends Eloquent
{
    // ===================================================
    // ELOQUENT ATTRIBUTES
    // ===================================================

    protected $table;

    protected $fillable = [];

    protected $hidden = [];

    protected $casts = [];

    protected $appends = [];

    // ===================================================
    // MODEL ATTRIBUTES
    // ===================================================

    //..

    // ===================================================
    // MODEL METHODS
    // ===================================================

    public function __construct ()
    {
        parent::__construct();

        if (!static::$booted) {
            static::boot();
        }
    }

    // ===================================================
    // RELATIONSHIPS
    // ===================================================

    //...

    // ===================================================
    // QUERY SCOPES
    // ===================================================

    public function scopeOrdered ($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }

    // ===================================================
    // ACCESSORS & MUTATORS
    // ===================================================

    //..

    // ===================================================
    // BOOT & EVENTS
    // ===================================================

    //..

}
