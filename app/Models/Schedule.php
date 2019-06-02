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
        $lang = $request->query->get('lang', config('constants.default_language'));
        return [
            'trans' => function($query) use ($lang) {
                $query->where('lang', '=', $lang);
            }
        ];
    }

    protected function setQuery($builder, $request) {

    }
}
