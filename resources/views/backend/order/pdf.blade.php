<!DOCTYPE html>
<html>
<head>
  <title>Order @if($order)- {{$order->order_number}} @endif</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      line-height: 1.4;
    }
    .invoice-header {
      background: #f7f7f7;
      padding: 10px 20px;
      border-bottom: 1px solid #ccc;
      margin-bottom: 20px;
    }
    .site-logo {
      margin-top: 20px;
    }
    .site-logo img {
      max-width: 150px;
    }
    .invoice-right-top h3 {
      padding-right: 20px;
      margin-top: 20px;
      color: #28a745;
      font-size: 24px;
      font-family: serif;
    }
    .invoice-left-top {
      border-left: 4px solid #28a745;
      padding-left: 20px;
      padding-top: 20px;
    }
    .invoice-left-top p {
      margin: 0;
      line-height: 20px;
      font-size: 14px;
      margin-bottom: 3px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th {
      background: #28a745;
      color: #FFF;
      padding: 8px;
      text-align: left;
    }
    td {
      padding: 8px;
      border: 1px solid #ddd;
    }
    .text-right {
      text-align: right;
    }
    .float-left {
      float: left;
    }
    .float-right {
      float: right;
    }
    .clearfix {
      clear: both;
    }
    .thanks h4 {
      color: #28a745;
      font-size: 20px;
      font-weight: normal;
      font-family: serif;
      margin-top: 20px;
    }
    .authority h5 {
      margin-top: -10px;
      color: #28a745;
    }
  </style>
</head>
<body>
@if($order)
  <div class="invoice-header">
    <div class="float-left site-logo">
      <img src="{{ public_path('backend/img/logo.png') }}" alt="Logo">
    </div>
    <div class="float-right site-address">
      <h4>{{ config('app.name') }}</h4>
      <p>{{ config('app.address', 'Your Company Address') }}</p>
      <p>Phone: {{ config('app.phone', 'Your Phone Number') }}</p>
      <p>Email: {{ config('app.email', 'your@email.com') }}</p>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="invoice-description">
    <div class="invoice-left-top float-left">
      <h6>Invoice to</h6>
      <h3>{{$order->first_name}} {{$order->last_name}}</h3>
      <div class="address">
        <p><strong>Country:</strong> {{$order->country}}</p>
        <p><strong>Address:</strong> {{ $order->address1 }} {{ $order->address2 ? 'OR ' . $order->address2 : '' }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
      </div>
    </div>
    <div class="invoice-right-top float-right">
      <h3>Invoice #{{$order->order_number}}</h3>
      <p>{{ $order->created_at->format('D d M Y') }}</p>
    </div>
    <div class="clearfix"></div>
  </div>

  <section class="order_details">
    <h5>Order Details</h5>
    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->cart_info as $cart)
          @php 
            $product = DB::table('products')->select('title')->where('id', $cart->product_id)->first();
          @endphp
          <tr>
            <td>{{ $product ? $product->title : 'N/A' }}</td>
            <td>x{{$cart->quantity}}</td>
            <td>${{number_format($cart->price, 2)}}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" class="text-right"><strong>Subtotal:</strong></td>
          <td>${{number_format($order->sub_total, 2)}}</td>
        </tr>
        @if($order->coupon)
          <tr>
            <td colspan="2" class="text-right"><strong>Discount:</strong></td>
            <td>-${{number_format($order->coupon, 2)}}</td>
          </tr>
        @endif
        <tr>
          <td colspan="2" class="text-right"><strong>Shipping:</strong></td>
          <td>${{number_format($order->delivery_charge, 2)}}</td>
        </tr>
        <tr>
          <td colspan="2" class="text-right"><strong>Total:</strong></td>
          <td>${{number_format($order->total_amount, 2)}}</td>
        </tr>
      </tfoot>
    </table>
  </section>

  <div class="thanks">
    <h4>Thank you for your business!</h4>
  </div>
  <div class="authority float-right">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
  </div>
  <div class="clearfix"></div>
@else
  <h5 class="text-danger">Invalid Order</h5>
@endif
</body>
</html>