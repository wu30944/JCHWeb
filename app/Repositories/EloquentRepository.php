<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
 
abstract class EloquentRepository
{
    protected $model;
    
    public function __construct($model = null)
    {
        $this->model = $model;
    }
    
    public function getById($id)
    {
        return $this->model->find($id);
    }
    
    public function getAll()
    {
        return $this->model->all();
    }
 
    public function save($data)
    {
        if ($data instanceOf Model) {
            return $this->storeEloquentModel($data);
        }
    }
    
    public function saveMany($collection)
    {
        foreach($collection as $model)
        {
            $this->storeEloquentModel($model);
        }
    }
 
    public function delete($model)
    {
        return $model->delete();
    }
 
    protected function storeEloquentModel($model)
    {        
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }
 
}