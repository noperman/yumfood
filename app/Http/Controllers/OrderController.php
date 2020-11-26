<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\VendorMenu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
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
        /** Validate request data */
            $this->validate($request,[
                "menu"    => "required|array|max:20",
                "menu.*"  => "required|numeric",
                "qty"    => "required|array|max:20",
                "qty.*"  => "required|numeric|not_in:0",
                "note"    => "required|array|max:20",
                "note.*"  => "max:255",
            ]);

            if(count($request['menu']) !== count($request['qty']) || count($request['qty']) !== count($request['note'])){
                return response()->json(['msg'=> 'Items order is not valid!'], 200);
            }
        /** Validate request data */
            
        /** Reindex array */
            $requestOrderDetail['menuid'] = array_combine(range(0, count($request['menu']) + (0-1)), array_values($request['menu']));
            $requestOrderDetail['qty'] = array_combine(range(0, count($request['qty']) + (0-1)), array_values($request['qty']));
            $requestOrderDetail['specialrequest'] = array_combine(range(0, count($request['note']) + (0-1)), array_values($request['note']));
        /** Reindex array */
        
        /** Insert Order Table */
            $order = new Order;
            $order->status = "Open";
            $order->save();
            $orderId = $order->id;
        /** Insert Order Table */

        /** Make final array to insert into table orderdetail */
            $finalArr = [];
            for($i = 0; $i < count($request['menu']); $i++){
                $finalArr[$i] = [
                    'orderid' => $orderId,
                    'menuid' => $requestOrderDetail['menuid'][$i], 
                    'qty' => $requestOrderDetail['qty'][$i],
                    'specialrequest' => $requestOrderDetail['specialrequest'][$i]
                ];
            }
        /** Make final array to insert into table orderdetail */

        $resultOrder = [];
        foreach($finalArr as $key => $item){
            /** Check available menu picked from table vendor_menu */
                $menuCheck = VendorMenu::find($item['menuid']);

                if($menuCheck !== null){
                    $resultOrder[$key] = OrderDetail::create($item);
                }else{
                    $orderedItem = OrderDetail::where('orderid',$item['orderid'])->first();
                    if($orderedItem !== null){
                        return response()->json(['msg'=> 'Menu item is not found'], 404);
                    }else{
                        $data = Order::find($item['orderid']);
                        if($data !== null){
                            $data->delete();
                        }
                        return response()->json(['msg'=> 'Menu item is not found'], 404);
                    }
                    exit();
                }
            /** Check available menu picked from table vendor_menu */
        }
        
        if(count($request['menu']) !== count($resultOrder)){
            return response()->json(['msg' => 'Something went wrong!'], 200);
        }

        return response()->json(['msg' => 'Order submited'],200);
        // echo "Hi, I'am store function ";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $id)
    {
        // echo $id->id;
        $data = Order::with('Orders')->where('id',$id->id)->paginate();

        return response()->json($data,200);
        // echo 'I am lists order';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
