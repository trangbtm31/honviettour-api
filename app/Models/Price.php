<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['value', 'type', 'description', 'from', 'to', 'model_id', 'model_type'];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'model_id');
    }
}