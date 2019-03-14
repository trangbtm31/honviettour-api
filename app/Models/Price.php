<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['value', 'type', 'description', 'note', 'tour_id'];
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}