<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'images';
    protected $fillable = ['imageable_id','imageable_type','photo','created_at','updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('assets/images/article/' . $val) : "";

    }
}
