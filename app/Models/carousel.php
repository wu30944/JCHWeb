<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class carousel extends Model
{
   	protected $table ='carousel';
   	protected $primaryKey = 'id';
   	protected $fillable =['photo_name','photo_path','is_show','show_date'
   							,'created_user','modify_user'];
}
