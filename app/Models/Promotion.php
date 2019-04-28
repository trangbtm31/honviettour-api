<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['content', 'code', 'image', 'expire_date'];

}
