<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class HotelTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'description', 'service', 'hotel_id'];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
