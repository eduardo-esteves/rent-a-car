<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_model_id', 'placa', 'available', 'km'];

    public function validationFields(Request $request)
    {
        $fields = $request->all();
        $requestMethod = $request->method();
        $final_rules = null;

        $rules = [
            'km'                => 'required|integer|max:9999999999',
            'placa'             => 'required|string|max:10',
            'available'         => 'required|boolean',
            'vehicle_model_id'  => 'exists:vehicle_models,id',
        ];

        if ($requestMethod === 'PATCH') {
            foreach ($fields as $field => $value) {
                if (array_key_exists($field, $rules)) {
                    $final_rules[$field] = $rules[$field];
                }
            }
        }

        $final_rules = $final_rules ?? $rules;

        return Validator::make($fields, $final_rules);
    }
}
