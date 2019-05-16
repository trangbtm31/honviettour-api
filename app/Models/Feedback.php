<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = 'feedbacks';
    protected $fillable = ['first_name', 'last_name', 'content'];
}
