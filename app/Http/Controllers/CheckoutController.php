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

            
            return $this->placeToPay->createRequest($request, $order->id);
        }
        
        // return redirect()->back()->with('message','Order not placed');
    }

    public function response($orderID)
    {
        $data = (object)[];
        $order = Order::find($orderID);
        $response = PlaceToPayService::getRequestInfo($orderID);
        // $order->status = $response['status']['status'];
        // $order->save();
        // switch ($order->status) {
        //     case 'CREATED':
        //         $data->estado_compra = "Creada";
        //         break;
            
        //     case 'PAYED':
        //         $data->estado_compra = "Aprovada";
        //         break;

        //     case 'REJECTED':
        //         $data->estado_compra = "Rechazada";
        //         break;
        // }
        // $data->order = $order;
        // return $orderID;
        return view('success', compact('order'));
        // return redirect()->route('response.order');
    }
}
