<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Brand::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand = Brand::create($request->all());
        return $brand;
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return $brand;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());
        return $brand;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return ['cod' => 204, 'msg' => 'Registro deletado com sucesso!'];
    }
}
