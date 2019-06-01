<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [ 'id', 'tour_name', 'start_date', 'status'];
}
