<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->brand->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand = $this->brand->create($request->all());
        return $brand;
    }

    /**
     * Display the specified resource.
     * $id integer
     */
    public function show($id)
    {
        return $this->brand->find($id);
    }

    /**
     * Update the specified resource in storage.
     * integer $id
     */
    public function update(Request $request, $id)
    {
        $brand = $this->brand->find($id);
        $brand->update($request->all());
        return $brand;
    }

    /**
     * Remove the specified resource from storage.
     * $id integer
     */
    public function destroy($id)
    {
        $brand = $this->brand->find($id);
        $brand->delete();
        return ['cod' => 204, 'msg' => 'Registro deletado com sucesso!'];
    }
}
