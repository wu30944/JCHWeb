<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class fellowship extends Model
{
   	protected $table ='fellowships';
   	protected $primaryKey = 'id';
   	protected $fillable =['NAME','PARA_1','PARA_2'];
}
