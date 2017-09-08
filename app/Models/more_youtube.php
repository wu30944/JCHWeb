<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class more_youtube extends Model
{
   	protected $table ='youtube_link';
   	protected $primaryKey = 'id';
   	protected $fillable =['name','link','theme'];
}
