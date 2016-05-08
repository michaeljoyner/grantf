<?php

namespace App\Occasions;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Event extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'event_location'
    ];

    protected $dates = ['event_date'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug'
    ];

    public static function upcoming()
    {
        return static::where('event_date', '>=', Carbon::now())->orderBy('event_date')->get();
    }
}
