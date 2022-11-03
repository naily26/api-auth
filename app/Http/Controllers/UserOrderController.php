<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Cart;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware('auth');
    }
    
     public function index()
    {
        $order = Order::all();
        return view('user.order', compact('order'));
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
        $request->validate(
            [
                'total' => 'required',
            ]
        );
        $inputOrder['user_id'] = Auth::user()->id;
        $inputOrder['shipping_total'] = 20000;
        $makeOrder = Order::create($inputOrder);
        $idCart = Cart::where('user_id', Auth::user()->id);
        $idOrder = $makeOrder->id;

    }

    public function LookFor($idCart, $makeOrder) {
        $checkCart = Cart_Product::find($id)->first;
        if ($checkCart){
            $orderDetail['order_id'] = $makeOrder->id;
            $orderDetail['product_id'] = $checkCart->product_id;
            $orderDetail['qty'] = $checkCart->qty;
            Order_Product::create($orderDetail);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
