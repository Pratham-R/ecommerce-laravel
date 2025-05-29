<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #f8f9fa;
        }
        .content {
            padding: 20px 0;
        }
        .order-details {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .order-items {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .order-items th, .order-items td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .order-items th {
            background-color: #f8f9fa;
        }
        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmation</h1>
        </div>
        <div class="content">
            <p>Dear {{ $order->first_name }} {{ $order->last_name }},</p>
            <p>Thank you for your order! We're pleased to confirm that we've received your order #{{ $order->order_number }}.</p>
            
            <div class="order-details">
                <h3>Order Details:</h3>
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p><strong>Shipping Address:</strong><br>
                {{ $order->address1 }}<br>
                @if($order->address2){{ $order->address2 }}<br>@endif
                {{ $order->country }}<br>
                {{ $order->post_code }}</p>
            </div>

            <h3>Order Items:</h3>
            <table class="order-items">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->cart_info as $item)
                    <tr>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <p>Subtotal: ${{ number_format($order->sub_total, 2) }}</p>
                <p>Shipping: ${{ number_format($order->delivery_charge, 2) }}</p>
                @if($order->coupon)
                <p>Discount: -${{ number_format($order->coupon, 2) }}</p>
                @endif
                <p>Total: ${{ number_format($order->total_amount, 2) }}</p>
            </div>

            <p>We'll notify you when your order ships.</p>
            <p>If you have any questions about your order, please don't hesitate to contact us.</p>
            <p>Best regards,<br>The E-commerce Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html> 