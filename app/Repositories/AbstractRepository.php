<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function filters(Request $request): void
    {
        $conditions = explode(':', $request->input('filter'));
        $this->model = $this->model->where($conditions[0], $conditions[1], $conditions[2]);
    }

    public function getResult(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->get();
    }
}
