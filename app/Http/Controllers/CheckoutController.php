<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function __construct(Order $model)
    {
        // parent::__construct($model);
        $this->model = $model;
    }

    public function getCheckout()
    {
        return view('checkout');
    }

    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           =>  0,
            'status'            =>  'CREATED',
            'grand_total'       =>  Cart::getSubTotal(),
            'item_count'        =>  Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'first_name'        =>  $request->first_name,
            'last_name'         =>  $request->last_name,
            'address'           =>  $request->address,
            'city'              =>  $request->city,
            'country'           =>  $request->country,
            'post_code'         =>  $request->post_code,
            'phone_number'      =>  $request->phone_number,
            'notes'             =>  $request->notes
        ]);
    
        if ($order) {
    
            $items = Cart::getContent();
    
            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('name', $item->name)->first();
    
                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
                ]);
    
                $order->items()->save($orderItem);
            }
        }
    
        return redirect()->route('cart.list');
    }
}
