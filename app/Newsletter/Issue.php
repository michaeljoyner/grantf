<?php

namespace App\Newsletter;

use App\Blog\Post;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issues';

    protected $fillable = ['send_count'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'issue_id');
    }

}
