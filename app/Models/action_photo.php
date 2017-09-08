<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class action_photo extends Model
{
   	protected $table ='action_photos';
   	protected $primaryKey = 'id';
   	protected $fillable =['title','photo_link','content','para_1','para_2','para_3'];
}
