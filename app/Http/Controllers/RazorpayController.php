<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get()->toArray();
        
        $data = [];
        $data['items'] = array_map(function ($item) use($cart) {
            $name = Product::where('id', $item['product_id'])->pluck('title');
            return [
                'name' => $name,
                'price' => $item['price'],
                'qty' => $item['quantity']
            ];
        }, $cart);

        $data['invoice_id'] = 'ORD-' . strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('razorpay.success');
        $data['cancel_url'] = route('razorpay.cancel');

        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;
        if(session('coupon')){
            $data['shipping_discount'] = session('coupon')['value'];
        }

        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);

        // Initialize Razorpay
        $api = new \Razorpay\Api\Api(config('razorpay.key'), config('razorpay.secret'));

        // Create Razorpay Order
        $razorpayOrder = $api->order->create([
            'receipt'         => $data['invoice_id'],
            'amount'          => $data['total'] * 100, // amount in smallest currency unit
            'currency'        => 'INR',
            'payment_capture' => 1
        ]);

        $razorpayOrderId = $razorpayOrder['id'];
        session()->put('razorpay_order_id', $razorpayOrderId);

        $displayAmount = $data['total'];

        $data = [
            "key"               => config('razorpay.key'),
            "amount"           => $data['total'] * 100,
            "name"             => config('app.name'),
            "description"      => $data['invoice_description'],
            "image"            => asset('frontend/img/logo.png'),
            "prefill"          => [
                "name"              => auth()->user()->name,
                "email"             => auth()->user()->email,
                "contact"           => auth()->user()->phone,
            ],
            "notes"            => [
                "merchant_order_id" => $data['invoice_id'],
            ],
            "theme"            => [
                "color"             => "#F7941D"
            ],
            "order_id"         => $razorpayOrderId,
        ];

        return view('frontend.pages.razorpay', compact('data'));
    }

    public function success(Request $request)
    {
        $input = $request->all();
        $api = new \Razorpay\Api\Api(config('razorpay.key'), config('razorpay.secret'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        $order = Order::where('id', session()->get('id'))->first();

        if($payment['status'] == 'captured') {
            $order->payment_status = 'paid';
            $order->save();

            request()->session()->flash('success', 'You successfully pay from Razorpay! Thank You');
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->route('home');
        }

        request()->session()->flash('error', 'Something went wrong please try again!!!');
        return redirect()->back();
    }

    public function cancel()
    {
        request()->session()->flash('error', 'Your payment is canceled. You can try again.');
        return redirect()->route('home');
    }
} 