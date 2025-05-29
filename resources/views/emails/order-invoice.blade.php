<!DOCTYPE html>
<html>
<head>
    <title>Order Invoice</title>
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
            margin-bottom: 30px;
        }
        .content {
            margin-bottom: 30px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You for Your Order!</h1>
        </div>

        <div class="content">
            <p>Dear {{ $order->first_name }} {{ $order->last_name }},</p>

            <p>Thank you for your order. We're pleased to confirm that we've received your order #{{ $order->order_number }}.</p>

            <p>Your order details:</p>
            <ul>
                <li>Order Number: {{ $order->order_number }}</li>
                <li>Order Date: {{ $order->created_at->format('F d, Y') }}</li>
                <li>Total Amount: ${{ number_format($order->total_amount, 2) }}</li>
                <li>Payment Method: {{ ucfirst($order->payment_method) }}</li>
                <li>Payment Status: {{ ucfirst($order->payment_status) }}</li>
            </ul>

            <p>Please find your invoice attached to this email.</p>

            <p>If you have any questions about your order, please don't hesitate to contact us.</p>

            <p>Best regards,<br>
            {{ config('app.name') }} Team</p>
        </div>

        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 