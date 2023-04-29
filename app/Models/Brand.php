<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'img'];

    public function validationFields(Request $request)
    {
        $fields = $request->all();
        $requestMethod = $request->method();
        $final_rules = null;

        $rules = [
            'brand' => ($requestMethod !== 'POST') ? 'required|string|max:255' : 'required|string|unique:brands',
            'img'   => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ];

        if ($requestMethod === 'PATCH') {
            foreach( $fields as $field => $value) {
                if (array_key_exists($field, $rules)) {
                    $final_rules[$field] = $rules[$field];
                }
            }
        }

        $final_rules = $final_rules ?? $rules;

        return Validator::make($fields, $final_rules);
    }
}
