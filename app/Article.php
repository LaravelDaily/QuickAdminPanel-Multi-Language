<?php
namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $fillable = ['title', 'description'];
    protected $hidden = [];

    public $translatedAttributes = ['title', 'description'];
}
