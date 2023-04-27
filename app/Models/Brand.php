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
        $method = $request->method();

        if ($method === 'PATCH') {
            $brand = [
                'brand' => "string|max:255",
                'img' => 'file|mimes:png,jpg,jpeg',
            ];
        } else {
            $brand = [
                'brand' => "required|string|unique:brands",
                'img'   => 'required|file|mimes:png,jpg,jpeg|max:2048',
            ];
        }


        $validator = Validator::make($fields, $brand);

        return $validator;
    }
}
