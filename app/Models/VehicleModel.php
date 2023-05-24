<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'model', 'img', 'num_ports', 'lugares', 'air_bag', 'abs'];

    public function validationFields(Request $request)
    {
        $fields = $request->all();
        $requestMethod = $request->method();
        $final_rules = null;

        $rules = [
            'brand_id'  => 'exists:brands,id',
            'model'     => ($requestMethod !== 'POST') ? 'required|min:3' : 'required|unique:vehicle_models|min:3',
            'img'       => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'num_ports' => 'required|integer|digits_between:1,5',
            'lugares'   => 'required|integer|digits_between:1,20',
            'air_bag'   => 'required|boolean',
            'abs'       => 'required|boolean',
        ];

        if ($requestMethod === 'PATCH') {
            foreach( $fields as $field => $value) {
                if (array_key_exists($field, $rules)) {
                    $final_rules[$field] = $rules[$field];
                }
            }
        }

        $final_rules = $final_rules ?? $rules;

        return  Validator::make($fields, $final_rules);
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // A vehicle model belongs to and only a brand
        return $this->belongsTo(Brand::class);
    }

    public function cars(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Car::class);
    }
}
