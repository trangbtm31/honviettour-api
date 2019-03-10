<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class TourTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'description', 'service', 'note', 'detail', 'tour_id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}