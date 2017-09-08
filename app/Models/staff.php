<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
   	protected $table ='staffs';
   	protected $primaryKey = 'id';
   	protected $fillable =['name','cod_id','introduction','image_link','para_1','para_2','para_3'];
}
