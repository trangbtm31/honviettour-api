<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    protected $fillable = ['title', 'lang', 'description', 'plan_id'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
