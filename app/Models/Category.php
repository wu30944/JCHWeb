<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $fillable = ['title','parent_id'];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function childs() {
        return $this->hasMany('Models\Category','parent_id','id') ;
    }
}
