<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our E-commerce Platform</title>
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
            <h1>Welcome to Our E-commerce Platform!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for signing up with our e-commerce platform. We're excited to have you on board!</p>
            <p>With your account, you can:</p>
            <ul>
                <li>Browse our extensive product catalog</li>
                <li>Place orders easily</li>
                <li>Track your order status</li>
                <li>Manage your profile and preferences</li>
            </ul>
            <p>If you have any questions or need assistance, our customer support team is always here to help.</p>
            <p>Happy shopping!</p>
            <p>Best regards,<br>The E-commerce Team</p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html> 