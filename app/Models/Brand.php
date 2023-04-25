<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'img'];

    public function validationFields(array $fields)
    {
        $validator = Validator::make($fields, [
            'brand' => 'required|string|unique:brands|max:255',
            'img'   => 'required|string|max:255',
        ]);

        return $validator;
    }
}
