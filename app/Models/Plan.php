<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Contracts\HonviettourModelAbstract;

class Plan extends HonviettourModelAbstract
{
    public $timestamps = true;

    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function trans()
    {
        return $this->hasMany(PlanTranslation::class);
    }

    public function delete()
    {
        $this->trans()->delete();
        $this->images()->delete();
        return parent::delete();
    }

    protected function _getModelProperties($request)
    {
        $lang = $request->query->get('lang', config('constants.default_language'));
        return [
            'trans' => function($query) use ($lang) {
                $query->where('lang', '=', $lang);
            }
        ];
    }

}
