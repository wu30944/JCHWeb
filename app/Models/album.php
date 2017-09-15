<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
/**/
class album extends Model
{
    protected $table ='album';
    protected $primaryKey = 'id';
    protected $fillable =['album_name','position','isvisible'];
}
