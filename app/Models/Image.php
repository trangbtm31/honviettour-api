<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['model_id', 'path', 'model_type', 'status'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'model_id');
    }

    public function plan()
    {
        return $this->belongsTo(Tour::class, 'model_id');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'model_id');
    }

    public function model()
    {
        return $this->morphTo();
    }
}
