<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleFile extends Model
{
    protected $table = 'article_files';
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
