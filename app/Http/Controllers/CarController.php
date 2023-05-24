<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct(Car $car)
    {
        $this->car = $car;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = $this->car->with('vehicleModel')->get();

        return response()->json($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->car->validationFields($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $car = $this->car->create($request->all());

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
