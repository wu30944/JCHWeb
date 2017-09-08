<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class verse extends Model
{
   	protected $table ='verses';
   	protected $primaryKey = 'id';
   	protected $fillable =['content','chapter'];
}
