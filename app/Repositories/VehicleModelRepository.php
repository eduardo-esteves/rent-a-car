<?php

namespace App\Repositories;


class VehicleModelRepository extends AbstractRepository
{
    public function selectVehicleAttributesWithBrands(array $attributes): void
    {
        $this->model = $this->model->selectRaw($attributes['vehicles_attributes']);
        $this->model = $this->model->with($attributes['brands_attributes']);
    }
}
