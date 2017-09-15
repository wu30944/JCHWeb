<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
/**/
class album_d extends Model
{
    protected $table ='album_d';
    protected $primaryKey = 'id';
    protected $fillable =['album_id','photo_name','photo_path'];
}
