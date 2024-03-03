# CraftHaven - Handcrafted Goods Marketplace

CraftHaven is an online marketplace for handcrafted goods, connecting artisans with customers who appreciate unique and artisanal products. This web application allows artisans to showcase their creations and sell them directly to consumers.

## Features

- **Product Listings**: Browse through a wide range of handcrafted products listed by artisans.
- **User Authentication**: Create an account or log in to an existing account to access additional features.
- **Shopping Cart**: Add products to your cart and proceed to checkout for payment.
- **Payment Integration**: Securely pay for your purchases using Stripe payment gateway.
- **Order Management**: View and manage your orders, including order history and order status.
- **Profile Management**: Update personal information and manage account settings.

## Technologies Used

- **Frontend**:
  - HTML
  - CSS (with Bootstrap for styling)
  - JavaScript (with Stripe.js for payment integration)

- **Backend**:
  - PHP
  - MySQL (for database management)

## Getting Started

1. Clone the repository: `git clone <repository-url>`
2. Set up a local web server environment (e.g., XAMPP, WAMP, or MAMP).
3. Import the database schema (`database.sql`) into your MySQL database.
4. Configure the database connection in `includes/db.php`.
5. Replace the placeholder values with your Stripe API keys in `payment_form.php` and `process_payment.php`.
6. Start the local web server and navigate to the project directory.
7. Access the application through your web browser.

## Usage

- Browse through the product listings and click on items to view details.
- Add products to your cart and proceed to checkout.
- Enter payment details securely using Stripe payment form.
- After successful payment, receive confirmation and order details.
- Manage your orders and profile settings as needed.




## Acknowledgements

- Stripe API Documentation
- Bootstrap Documentation
