<?php

namespace Honviettour\Models;

use Honviettour\Contracts\HonviettourModelAbstract;
use Illuminate\Database\Eloquent\Model;

class Schedule extends HonviettourModelAbstract
{
    protected $fillable = [ 'id', 'start_date', 'status', 'url'];

    public function trans()
    {
        return $this->hasMany(ScheduleTranslation::class);
    }

    protected function getModelProperties($request)
    {
    }

    protected function setQuery($builder, $request)
    {
        $lang = $request->get('lang', config('constants.default_language'));
        $builder->join('schedule_translations as trans', 'schedules.id', '=', 'trans.schedule_id')->where('trans.lang', '=', $lang);
    }
}
