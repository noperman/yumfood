<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        if($_GET && is_array($_GET['tags'])){
            $tags = $_GET['tags'];

            $data = Vendor::whereHas('tags', function($query) use($tags){
                $query->select('id','name')->whereIn('name', $tags);              
            })->paginate();

            // $data = VendorResource::collection(Vendor::whereHas('tags', function($query) use($tags){
            //     $query->select('id','name')->whereIn('name', $tags);              
            // })->paginate());

            // echo 'this is array tags';
        }else{
            $data = VendorResource::collection(Vendor::paginate());
        }

        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required','max:128'],
            'logo' => 'required'
        ]);

        $data = new Vendor;
        $data->name = $request['name'];
        $data->logo = $request['logo'];
        
        if($data->save()){
            return response()->json(['msg'=> 'Data is stored'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id && is_numeric($id)){
            $data = Vendor::findOrFail($id);
            return response()->json($data, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id && is_numeric($id)){
            $this->validate($request,[
                'name' => ['required','max:128'],
                'logo' => 'required'
            ]);

            $data = Vendor::find($id);
            if($data !== null){
                $data->name = $request['name'];
                $data->logo = $request['logo'];
    
                if($data->save()){
                    return response()->json(['msg'=>'Data updated'],200);
                }
            }else{
                return response()->json(['msg'=> 'Data is not found'], 404);
            }
        }else{
            return response()->json(['msg' => 'Unique request is not valid'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id && is_numeric($id)){
            $data = Vendor::find($id);
            if($data !== null){
                if($data->delete()){
                    return response()->json(['msg'=> 'Delete successfull'], 200);
                }
            }else{
                return response()->json(['msg'=> 'Data is not found'], 404);
            }
        }else{
            return response()->json(['msg' => 'Unique request is not valid'], 403);
        }
    }
}
