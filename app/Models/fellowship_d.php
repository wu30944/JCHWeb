<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class fellowship_d extends Model
{
   	protected $table ='fellowship_d';
   	protected $primaryKey = 'id';
   	protected $fillable =['introduction_title','introduction_content','page_one_title','page_two_title','page_three_title','page_four_title','page_one_content','page_two_content','page_three_content','page_four_content'];
}
