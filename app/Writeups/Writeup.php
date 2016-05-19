<?php

namespace App\Writeups;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Writeup extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected $table = 'writeups';

    protected $defaultImageSrc = '/images/assets/logo_lg.png';

    protected $fillable = [
        'title',
        'content',
        'category',
        'link'
    ];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 500, 'h' => 400, 'fit' => 'max'])
            ->performOnCollections('default');
        $this->addMediaConversion('wide')
            ->setManipulations(['w' => 1000, 'h' => 600, 'fit' => 'max'])
            ->performOnCollections('default');
    }

    public function setImage($image)
    {
        $this->clearMediaCollection();

        return $this->addMedia($image)->preservingOriginal()->toMediaLibrary();
    }

    public function getImageSrc($conversion = 'web')
    {
        $images = $this->getMedia();

        return $images->count() > 0 ? $images->first()->getUrl($conversion) : $this->defaultImageSrc;
    }
}
