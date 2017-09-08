<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
   	protected $table ='news';
   	protected $primaryKey = 'id';
   	protected $fillable =['action_date','action_time','action_postion','title'
   							,'content','image','para_1','para_2','para_3'];
}
