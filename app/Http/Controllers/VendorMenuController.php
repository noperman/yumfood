<?php

namespace App\Http\Controllers;

use App\VendorMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use DB;

class VendorMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $data = DB::table('vendor_menus')
        //     ->join('vendors', function ($query) use($id){
        //         $query->on('vendors.id', '=', 'vendor_menus.vendorid')
        //         ->where('vendors.id', $id);
        //     })
        //     ->paginate();

        $data = VendorMenu::whereHas('Vendor', function($query) use($id){
            $query->where('id', $id);              
        })->where('status',1)->paginate();

        return response()->json($data,200);
        // echo "Hai, I'am Index function of OrderController class ".$id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VendorMenu  $vendorMenu
     * @return \Illuminate\Http\Response
     */
    public function show(VendorMenu $vendorMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VendorMenu  $vendorMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorMenu $vendorMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VendorMenu  $vendorMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorMenu $vendorMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VendorMenu  $vendorMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorMenu $vendorMenu)
    {
        //
    }
}
