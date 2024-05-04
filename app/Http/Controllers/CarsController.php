<?php

namespace App\Http\Controllers;

use App\Models\cars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return cars::paginate(10);
    }
   
    public function store(Request $request)
    {
        return cars::created($request->validate());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return cars::findOrFail($id);
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cars $cars)
    {
        $cars->fall($request->validate());
        return $cars->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cars $cars)
    {
        if($cars->delete())
        {
            return response(null, 404);
        }
        return null;
    }
}
