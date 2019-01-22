<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fare;

class FareController extends Controller
{
    public function index()
    {
        return Fare::all();
    }

    public function getByRullId($rull_id)
    {
        return Fare::all()->where('rull_id','=',$rull_id);
    }

    public function store(Request $request)
    {
        
        $fare = Fare::create($request->all());

        return response()->json($fare, 201);
    }

    public function update(Request $request, $id)
    {
        $fare = Fare::find($id);
        $fare->update($request->all());

        return response()->json($fare, 200);
    }

    public function delete($id)
    {
        $fare = Fare::find($id);
        $fare->delete();

        return response()->json(null, 204);
    }
}
