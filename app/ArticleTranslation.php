<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    protected $fillable = ['title', 'description'];
    public $timestamps = false;
}