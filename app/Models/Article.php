<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function article_files()
    {
        return $this->hasMany('App\Models\ArticleFile');
    }
}
