<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class staffs_d extends Model
{
   	protected $table ='staffs_d';
   	protected $primaryKey = 'id';
   	protected $fillable =['name','cod_id','staff_id','content','create_date'];
}
