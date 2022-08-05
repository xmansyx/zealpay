<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AParent;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    public function getPartner(){

       $partner = auth()->user()->partner;

       if(!$partner){

            return response()->json([
                'message' => 'this parent is single; hook him up?'
            ], 400);

        }

        return response()->json($partner, 200);
    }

    public function addPartner(Request $request){
        if(auth()->user()->name == $request->name){

            return response()->json([
                'message' => 'Parents Cann\'t partner with themselves; that\'s not healthy'
            ], 400);

        }

        $partner = AParent::where('name', $request->name)->first();

        if(!$partner){
            return response()->json([
                'message' => 'this parent doesn\'nt exist'
            ], 400);
        }

        if(auth()->user()->partner_id == $partner->parnter_id && $partner->parnter_id){

            return response()->json([
                'message' => 'they\'re already partners'
            ], 400);

        }

        if(auth()->user()->partner_id || $partner->parnter_id){

            return response()->json([
                'message' => 'one of these parents already have a partner. you will break their partner hearts'
            ], 400);

        }

        auth()->user()->partner_id = $partner->id;
        $partner->partner_id = auth()->user()->id;

        auth()->user()->save();
        $partner->save();

        return response()->json([
                'message' => 'partner added succefully'
            ], 200);
    }
}
