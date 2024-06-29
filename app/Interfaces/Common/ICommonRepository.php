<?php

namespace App\Interfaces\Common;

use Illuminate\Database\Eloquent\Model;

interface ICommonRepository
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function delete($id);
    public function update(array $data, $id);
}
