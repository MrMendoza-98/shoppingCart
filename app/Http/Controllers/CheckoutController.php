<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Services\PlaceToPayService;

class CheckoutController extends Controller
{
    protected $placeToPay;
    public function __construct(Order $model, PlaceToPayService $placeToPay)
    {
        // parent::__construct($model);
        $this->placeToPay = $placeToPay;
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
            'email'             =>  $request->email,
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

            // return $this->placeToPay->createRequest($request, $order->id);
            $response = $this->placeToPay->createRequest($request, $order->id);
            if ($response['status']['status'] == 'OK') {
                $order->request_id = $response['requestId'];
                $order->process_url = $response['processUrl'];
                $order->save();
                return redirect()->away($response['processUrl']);
            }else{
                $response->status()->message();
            }
            
        }
        
        // return redirect()->back()->with('message','Order not placed');
    }

    public function response($orderID)
    {
        $order =  Order::find($orderID);
        $response = PlaceToPayService::getRequestInfo($orderID);
        // $order->status = $response['status']['status'];
        switch ($order->status) {
            case 'PENDING':
                $order->status = 'CREATED';
                break;
            
            case 'APPROVED':
                $order->status = 'PAYED';
                break;

            case 'REJECTED':
                $order->status = 'REJECTED';
                break;
        }
        $order->payment_status = 1;
        $order->payment_method = 'PlacetoPay Sandbox';
        $order->save();

        Cart::clear();
        return view('status', compact('order'));
    }
}
