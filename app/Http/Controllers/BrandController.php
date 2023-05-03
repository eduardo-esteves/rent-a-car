<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json($this->brand->with('vehicleModels')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->brand->validationFields($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $img = $request->file('img');
        $img_urn = $img->store('imgs', 'public');

        $brand = $this->brand->create([
            'brand' => $request->input('brand'),
            'img'   => $img_urn
        ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id the ID of the brand to be showed
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $brand = $this->brand->with('vehicleModels')->find($id);

        if(!$brand) {
            return response()->json(['cod' => 404, 'msg' => 'Marca não encontrada'], 404);
        }

        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  the ID of the brand to be updated
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = $this->brand->validationFields($request);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $brand = $this->brand->find($id);

        if(!$brand) {
            return response()->json(['cod' => 404, 'msg' => 'Marca não encontrada'], 404);
        }

        if($request->file('img')) {
            // delete the old img before update
            Storage::disk('public')->delete($brand->img);
        }

        $img = $request->file('img');
        $img_urn = $img->store('imgs', 'public');

        $brand->update([
            'brand' => $request->input('brand'),
            'img'   => $img_urn
        ]);
        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id the ID of the brand to be deleted
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $brand = $this->brand->find($id);

        if(!$brand) {
            return response()->json(['cod' => 404, 'msg' => 'Marca não encontrada'], 404);
        }

        // delete the old img before update
        Storage::disk('public')->delete($brand->img);

        $brand->delete();
        return response()->json(['cod' => 204, 'msg' => 'Registro deletado com sucesso!'], 204);
    }
}
