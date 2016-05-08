<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/7/16
 * Time: 6:06 PM
 */

namespace App\Writeups;


abstract class WriteupRepository
{
    protected $model;

    public function __construct($attributes = [])
    {
        if($attributes instanceof Writeup) {
            $this->model = $attributes;
        } else {
            $this->model = new Writeup(array_merge($attributes, ['category' => static::CATEGORY]));
        }
        return $this;
    }


    public static function create($attributes)
    {
        return Writeup::create(array_merge($attributes, ['category' => static::CATEGORY]));
    }

    public static function all()
    {
        return Writeup::where('category', static::CATEGORY)->get();
    }

    public function __get($property)
    {
        if(property_exists($this, $property)) {
            return $property;
        }

        return $this->model->{$property};
    }

    public static function findOrFail($id)
    {
        return new static(Writeup::findOrFail($id));
    }
}