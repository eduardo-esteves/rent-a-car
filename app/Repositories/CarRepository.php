<?php

namespace App\Repositories;


class CarRepository extends AbstractRepository
{
    public function selectCarAttributesWithVehiclesModels(array $attributes): void
    {
        $this->model = $this->model->selectRaw($attributes['cars_attributes']);
        $this->model = $this->model->with($attributes['vehicles_models_attributes']);
    }
}
