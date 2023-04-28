<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleModelController extends Controller
{
    public function __construct(VehicleModel $vehicle) {
        $this->vehicle = $vehicle;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->vehicle->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->vehicle->validationFields($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $img = $request->file('img');
        $img_urn = $img->store('imgs/models', 'public');

        $vehicle = $this->vehicle->create([
            'brand_id'  => $request->input('brand_id'),
            'model'     => $request->input('model'),
            'img'       => $img_urn,
            'lugares'   => $request->input('lugares'),
            'num_ports' => $request->input('num_ports'),
            'air_bag'   => $request->input('air_bag'),
            'abs'       => $request->input('abs'),
        ]);

        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $vehicle = $this->vehicle->find($id);

        if(!$vehicle) {
            return response()->json(['cod' => 404, 'msg' => 'Veiculo não encontrada'], 404);
        }

        return response()->json($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $this->vehicle->validationFields($request->all());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vehicle = $this->vehicle->find($id);

        if(!$vehicle) {
            return response()->json(['cod' => 404, 'msg' => 'Veiculo não encontrada'], 404);
        }

        if ($request->file('img')) {
            // delete the old img before update
            Storage::disk('public')->delete($vehicle->img);
        }

        $img = $request->file('img');
        $img_urn = $img->store('imgs/models', 'public');

        $vehicle->update([
            'brand_id'  => $request->input('brand_id'),
            'model'     => $request->input('model'),
            'img'       => $img_urn,
            'num_ports' => $request->input('num_ports'),
            'air_bag'   => $request->input('air_bag'),
            'abs'       => $request->input('abs'),
        ]);

        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $vehicle = $this->vehicle->find($id);

        if(!$vehicle) {
            return response()->json(['cod' => 404, 'msg' => 'Marca não encontrada'], 404);
        }

        // delete the old img before update
        Storage::disk('public')->delete($vehicle->img);

        $vehicle->delete();
        return response()->json(['cod' => 204, 'msg' => 'Registro deletado com sucesso!'], 204);
    }
}
