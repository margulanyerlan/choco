<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule;
use App\taxe;
use App\Fare;
use Illuminate\Support\Facades\DB;
class RuleController extends Controller
{
    public function index()
    {
        return Rule::all();
    }

    public function show($id)
    {
        $rule = Rule::find($id);
        $array['rule'] = $rule;
        $array['taxes'] = DB::table('taxes')->select('name')->where('rull_id','=',$id)->get();
        $array['fares'] = DB::table('fares')->where('rull_id','=',$id)->get();
        return $array;
    }

    public function store(Request $request)
    {
        $rule = new Rule();
        $rule->name = $request->input('name');
        $rule->hashRule = $request->input('hashRule');
        $rule->save();
        $taxes = $request->input('taxes');
        foreach ($taxes as $name) {
        	$taxe = new taxe;
	        $taxe->name = $name;
	        $taxe->rull_id = $rule->id;
	        $taxe->save();
        }

        $reqFare = $request->input('fare');
        $fare = new Fare;
        $fare->name = $reqFare['name'];
        $fare->charge = $reqFare['charge'];
        $fare->type = $reqFare['type'];
        $fare->rull_id = $rule->id;
        $fare->save();

        return response()->json($rule, 201);
    }

    public function update(Request $request)
    {
        $id = $request->input('rule_id');
    	taxe::where('rull_id',$id)->delete();
    	Fare::where('rull_id',$id)->delete();
        Rule::where('id',$id)->delete();

        $rule = new Rule();
        $rule->name = $request->input('name');
        $rule->hashRule = $request->input('hashRule');
        $rule->save();
        $taxes = $request->input('taxes');
        foreach ($taxes as $name) {
        	$taxe = new taxe;
	        $taxe->name = $name;
	        $taxe->rull_id = $rule->id;
	        $taxe->save();
        }

        $reqFare = $request->input('fare');
        $fare = new Fare;
        $fare->name = $reqFare['name'];
        $fare->charge = $reqFare['charge'];
        $fare->type = $reqFare['type'];
        $fare->rull_id = $rule->id;
        $fare->save();

        return response()->json($rule, 200);
    }

    public function delete($id)
    {
        taxe::where('rull_id',$id)->delete();
    	Fare::where('rull_id',$id)->delete();
    	Rule::find($id)->delete();
    	

        return response()->json(null, 204);
    }

    public function check(Request $request)
    {
        $rule = Rule::find($request->input('id'));
        $hashRuleForCheck = $request->input('hashRule');
        $hashRule = $rule->hashRule;

        return (int)($hashRule == $hashRuleForCheck);
    }

    public function calculate(Request $request){
    	$ruleId = $request->input('rule_id');
    	$taxes = $request->input('taxes');
    	$ticketFare = $request -> input('ticket_fare');
    	$fare = DB::table('fares')->where('rull_id','=',$ruleId)->get()[0];
		if($fare->type){
			$ticketFare -= $fare->charge;
    	} else{
    		$ticketFare -= $ticketFare*$fare->charge/100;
    	}
    
    	
    	foreach ($taxes as $taxe => $penalty) {
    		$ticketFare -= $penalty;
    		$res['taxes'][$taxe] = $penalty;
    	}
    	$res['refund_amount'] = $ticketFare;
    	$res['fare'] = $fare;
    	return $res;	

    }
}
