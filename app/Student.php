<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['std_id','std_name','std_class','std_age','std_address'];
}
