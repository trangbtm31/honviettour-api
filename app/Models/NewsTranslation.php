<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $fillable = ['title', 'lang', 'content',  'promotion_id'];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
