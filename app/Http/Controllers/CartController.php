<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Cart_Product;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
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
        
        $product = Product::all();
        $cart = Cart::all();
        $checkUser= Cart::where('user_id', Auth::user()->id)->first();
        $CartProduct = Cart_Product::with('product', 'cart')->where('cart_id', $checkUser->id)->get();
        return view('cart.index', compact('CartProduct','product', 'cart'));
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
                'product_id' => 'required',
            ]
        );

        $checkCart = Cart::where('user_id', Auth::user()->id)->first();
        if($checkCart) {
            $checkProduct = Cart_Product::where('cart_id', $checkCart->id)->where('product_id', $request->product_id)->first();
            if($checkProduct) {
                $checkProduct->qty++;
                $checkProduct->save();
                return redirect()->route('cart.index')->with('success', 'Dimasukkan keranjang');
            } else {
                $input = $request->all();
                $input['cart_id'] = $checkCart->id;
                $input['qty'] = 1;
                Cart_Product::create($input);
                return redirect()->route('cart.index')->with('success', 'Dimasukkan keranjang');
            }
            
            
        } else {
            $inputCart['user_id'] = Auth::user()->id;
            $inputCart['total'] = 0;
            Cart::create($inputCart); 
            $checkCart2 = Cart::where('user_id', Auth::user()->id)->first();
            if($checkCart2) {
                $input = $request->all();
                $input['cart_id'] = $checkCart2->id;
                $input['qty'] = 1;
                Cart_Product::create($input);
                return redirect()->route('cart.index')->with('jsAlert', 'Dimasukkan keranjang');
            } else {
                return Alert::warning('Warning Title', 'Warning Message');
            }

        }     
    }

    public function kurang($id){
        $request->validate(
            [
                'product_id' => 'required',
                'cart_id'
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kurang = Cart_Product::find($id);
        $kurang->qty--;
        
        if ($kurang->qty == 0) {
            return $this->destroy($id);
        } else {
            $kurang->save();
            return redirect()->route('cart.index')->with('jsAlert', 'Dimasukkan keranjang');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart_Product::find($id)->delete();
        return redirect()->route('cart.index')->with('success', 'Dimasukkan keranjang');
    }

    
}
