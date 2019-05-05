<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $fillable = ['title', 'lang', 'content',  'news_id'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
