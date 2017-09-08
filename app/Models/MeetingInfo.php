<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class MeetingInfo extends Model
{
   	protected $table ='meeting_infos';
   	protected $primaryKey = 'id';
   	protected $fillable =['name','meeting_time','day','floor'];
}
