<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ABaby;
use Illuminate\Http\Request;

class BabiesController extends Controller
{
    
    /**

    * return a listing of the resource.

    *

    * @return \Illuminate\Http\Response

    */

    public function index()

    {
        
        $babies = auth()->user()->babies()->get();
        
        if(auth()->user()->partner){
            $babies->push(auth()->user()->partner->babies);
        }

        return response()->json($babies);

    }
    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $request->validate([
            'name' => 'required',
        ]);


        ABaby::create([
            'name' => $request->name,
            'parent_id' => auth()->user()->id,
        ]);

        return response()->json(['sucess' => 'baby created successfully']);

    }

     

    /**

     * Display the specified resource.

     *

     * @param  \App\Model\Student  $baby

     * @return \Illuminate\Http\Response

     */

    public function show(ABaby $baby)

    {
        // dd((auth()->user()->partner && auth()->user()->partner->id != $baby->parent_id));
        if(!(auth()->user()->id == $baby->parent_id || (auth()->user()->partner && auth()->user()->partner->id == $baby->parent_id))){
            return response()->json([
                'message' => 'you can only see babies yours or your partner\'s'
            ], 401);
        }

        return response()->json($baby);

    } 
    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Model\ABaby  $baby

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, ABaby $baby)

    {
        if(auth()->user()->id != $baby->parent_id){
            return response()->json([
                'message' => 'you can only update you own baby'
            ], 401);
        }

        $request->validate([

            'name' => 'required',

        ]);

        $baby->update($request->all());

        return response()->json(['sucess' => 'baby updated successfully']);

    }

    

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Model\ABaby  $baby

     * @return \Illuminate\Http\Response

     */

    public function destroy(ABaby $baby)

    {
        if(auth()->user()->id != $baby->parent_id){
            return response()->json([
                'message' => 'you can only delete you own baby'
            ], 401);
        }

        $baby->delete();

        return response()->json(['sucess' => 'baby deleted successfully']);

    }
}
