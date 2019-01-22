<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\taxe;

class TaxeController extends Controller
{
    public function index()
    {
        return taxe::all();
    }

      public function getByRullId($rull_id)
    {
        return DB::table('taxes')->select('name')->where('rull_id','=',$rull_id)->get();
    }

    public function store($name, $rull_id)
    {
        $taxe = new taxe;
        $taxe->name = $name;
        $taxe->rull_id = $rull_id;
        $taxe->save();
        return response()->json($taxe, 201);
    }

    public function delete($id)
    {
        $taxe = taxe::find($id);
        $taxe->delete();

        return response()->json(null, 204);
    }


}
