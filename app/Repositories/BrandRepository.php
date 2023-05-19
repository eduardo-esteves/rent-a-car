<?php

namespace App\Repositories;


class BrandRepository extends AbstractRepository
{
    public function selectBrandAttributesWithVehicles(array $attributes): void
    {
        $this->model = $this->model->selectRaw($attributes['brands_attributes']);
        $this->model = $this->model->with($attributes['vehicles_attributes']);
    }
}
