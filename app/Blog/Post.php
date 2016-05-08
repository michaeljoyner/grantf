<?php

namespace App\Blog;

use App\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Post extends Model implements HasMediaConversions, SluggableInterface
{
    use HasMediaTrait, SluggableTrait;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'description',
        'body'
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $dates = ['published_at'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 200, 'h' => 200, 'fit' => 'crop'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 800, 'h' => 600, 'fit' => 'max'])
            ->performOnCollections('default');
    }

    /**
     * Determines whether the model needs slugging.
     *
     * @return bool
     */
    protected function needsSlugging()
    {
        $config = $this->getSluggableConfig();
        $save_to = $config['save_to'];
        $on_update = $config['on_update'];

        if (empty($this->attributes[$save_to])) {
            return true;
        }

        if ($this->isDirty($save_to)) {
            return false;
        }

        return (!$this->exists || $on_update || !$this->hasBeenPublished());
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addImage($file)
    {
        return $this->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }

    public function getImages()
    {
        return $this->getMedia();
    }

    public function setPublishedStatus($shouldPublish)
    {
        $this->published = $shouldPublish;
        return $this->save();
    }

    public function publish()
    {
        $this->published = true;
        $this->ensurePublishedPostHasPublishedDate();
        return $this->save();
    }

    public function hasBeenPublished()
    {
        return ! is_null($this->published_at);
    }

    protected function ensurePublishedPostHasPublishedDate()
    {
        if(is_null($this->published_at)) {
            $this->published_at = Carbon::now()->format('Y-m-d');
        }
    }
}
