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
                'img'   => 'string|max:255',
            ];
        } else if ($method === 'PUT') {
            $brand = [
                'brand' => "required|string|unique:brands,brand,0|max:255",
                'img'   => 'required|string|max:255',
            ];
        } else {
            $brand = [
                'brand' => "required|string|unique:brands|max:255",
                'img'   => 'required|string|max:255',
            ];
        }


        $validator = Validator::make($fields, $brand);

        return $validator;
    }
}
