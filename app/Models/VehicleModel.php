<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'model', 'img', 'num_ports', 'lugares', 'air_bag', 'abs'];

    public function validationFields($fields)
    {
        $validator = Validator::make($fields, [
            'brand_id'  => 'exists:brands,id',
            'model'     => 'required|unique:vehicle_models|min:3',
            'img'       => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'num_ports' => 'required|integer|digits_between:1,5',
            'lugares'   => 'required|integer|digits_between:1,20',
            'air_bag'   => 'required|boolean',
            'abs'       => 'required|boolean',
        ]);

        return $validator;
    }
}
