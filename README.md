# Laravel E-commerce Platform

A full-featured e-commerce platform built with Laravel 10.x, featuring user authentication, product management, shopping cart, payment processing, and more.

## Features

- 🔐 User Authentication & Authorization
- 🛍️ Product Management
- 🛒 Shopping Cart System
- 💳 Multiple Payment Gateways (PayPal, Razorpay)
- 📧 Newsletter Integration
- 📦 Order Management
- 🎟️ Coupon System
- 📱 Responsive Design
- 🔍 Advanced Search
- 📊 Admin Dashboard

## Requirements

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM
- XAMPP (or similar local development environment)

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd Ecommerce
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env` file:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run database migrations and seeders:
```bash
php artisan migrate --seed
```

8. Create storage link:
```bash
php artisan storage:link
```

9. Start the development server:
```bash
php artisan serve
```

## Default Login Credentials

### Admin
- Email: admin@gmail.com
- Password: 1111

### User
- Email: user@gmail.com
- Password: 1111

## Payment Gateways

The application supports multiple payment gateways:
- PayPal
- Razorpay

Configure your payment gateway credentials in the `.env` file:

```
PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_SECRET=your_paypal_secret
RAZORPAY_KEY=your_razorpay_key
RAZORPAY_SECRET=your_razorpay_secret
```

## Additional Features

- File Management System
- Newsletter Integration
- PDF Generation
- Social Authentication
- Real-time Notifications

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, email [your-email] or open an issue in the repository. 