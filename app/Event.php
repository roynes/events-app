<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'from',
        'to',
        'name'
    ];

    protected $dates = [
        'to',
        'from'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function setToAttribute($value)
    {
        $this->attributes['to'] = Carbon::parse($value)->toDateTimeString();
    }

    public function setFromAttribute($value)
    {
        $this->attributes['from'] = Carbon::parse($value)->toDateTimeString();
    }
}
