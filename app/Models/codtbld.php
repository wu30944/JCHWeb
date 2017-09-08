<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class codtbld extends Model
{
   	protected $table ='codtbld';
   	protected $primaryKey = 'id';
   	protected $fillable =['cod_type','cod_id','cod_val','para_1','para_2','para_3','sdate','edate'];
}
