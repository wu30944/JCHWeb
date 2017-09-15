<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
/**/
class sc_function extends Model
{
   	protected $table ='sc_function';
   	protected $primaryKey = 'id';
   	protected $fillable =['function_id','function_cname','function_ename',
        'parent_function','visible','route'];
}
