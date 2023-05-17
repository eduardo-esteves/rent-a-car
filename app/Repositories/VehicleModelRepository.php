<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class VehicleModelRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectBrandAttributesWithVehicles(array $attributes): void
    {
        $this->model = $this->model->selectRaw($attributes['vehicles_attributes']);
        $this->model = $this->model->with($attributes['brands_attributes']);
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
