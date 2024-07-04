<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;

class LaptopController extends Controller
{
    public function index()
    {
        return Laptop::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'specs' => 'required',
        ]);
    
        $laptop = Laptop::create($validatedData);
        return response()->json($laptop, 201);
    }
    

    public function show($id)
    {
        $laptop = Laptop::find($id);
        if ($laptop) {
            return response()->json($laptop);
        } else {
            return response()->json(['error' => 'Laptop not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $laptop = Laptop::find($id);
        if ($laptop) {
            $laptop->update($request->all());
            return response()->json($laptop);
        } else {
            return response()->json(['error' => 'Laptop not found'], 404);
        }
    }

    public function destroy($id)
    {
        $laptop = Laptop::find($id);
        if ($laptop) {
            $laptop->delete();
            return response()->json(['message' => 'Laptop deleted']);
        } else {
            return response()->json(['error' => 'Laptop not found'], 404);
        }
    }
}
