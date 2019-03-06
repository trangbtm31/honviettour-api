<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Models\Tour;

class Price extends Model
{
    protected $fillable = ['value', 'description', 'note', 'tour_id'];
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}