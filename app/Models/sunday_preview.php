<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class sunday_preview extends Model
{
   	protected $table ='sunday_preview';
   	protected $primaryKey = 'id';
   	protected $fillable =['subject','speaker','date','language_type'];
}
