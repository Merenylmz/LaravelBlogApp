<?php

namespace App\Repository\Common;

use Illuminate\Database\Eloquent\Model;

trait CommonRepositoryTrait 
{
    private $model;
    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function getById($id){
        return $this->model->findOrFail($id);
    }

    public function create(array $data){
        return $this->model->create($data); 
    }

    public function update($data, $id){
        $table = $this->model->findOrFail($id);
        return $table->update($data);
    }

    public function delete($id){
        return $this->model->destroy($id);
    }

}
