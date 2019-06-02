<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleTranslation extends Model
{
    protected $fillable = [ 'lang', 'id_schedule', 'tour_name', 'url'];

    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
}
