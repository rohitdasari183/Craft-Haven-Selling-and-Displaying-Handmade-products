<?php
require_once('config.php');
require_once('init.php');

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Assuming $amount is dynamically generated
$amount = 2000; // Example amount in cents

$charge = \Stripe\Charge::create([
    'amount' => $amount, // Dynamic amount in cents
    'currency' => 'usd',
    'source' => 'tok_visa', // Token representing the card to charge
    'description' => 'Example charge',
]);
?>
