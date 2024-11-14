<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddToCartController extends Controller
{
    //
    public $cart = [];

    function __construct()
    {
        $this->cart = Session::get('cart', []);
    }

    public function addToCart(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $this->cart[$product->id] = [
            'id' => $product->id,
            'image' => $product->image,
            'name' => $product->name,
            'price' => $product->price,
            'color' => $request->get('color'),
            'quantity' => $request->get('quantity'),

        ];
        Session::put('cart', $this->cart);
        return response([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cart_count' => count($this->cart),
        ]);
    }

    function destroy($id)
    {
        $cartItems = $this->cart;
        unset($cartItems[$id]);
        Session::put('cart', $cartItems);
        flash()
            ->options([
                'timeout' => 3000, // 2 seconds
                'position' => 'top-center',
            ])
            ->warning('There was an issue receiving your application.');
        //flash()->info('Product deleted from cart successfully!');
        return redirect()->back();
    }

    function updateQuantity(Request $request)
    {
        $cartItems = $this->cart;
        $cartItems[$request->get('id')]['quantity'] = $request->get('quantity');
        Session::put('cart', $cartItems);
        flash('Product Quantity Updated');
        return response(['status' => 'success']);
    }


}
