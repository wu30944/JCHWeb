<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class jch_info extends Model
{
   	protected $table ='jch_info';
   	protected $primaryKey = 'id';
   	protected $fillable =['cname','ename','phone','email','address','fex','create',
       'recreate','uniform_number','map'];
}
