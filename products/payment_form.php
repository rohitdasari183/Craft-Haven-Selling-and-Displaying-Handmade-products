<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment Form</title>
    <!-- Include Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Add some basic styles for the payment form */
        #payment-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #card-element {
            margin-bottom: 20px;
        }
        #card-errors {
            color: #dc3545;
            margin-top: 10px;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
<header>
        <h1>CraftHaven</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="artisan_profiles.php">Artisan Profiles</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </nav>
    </header>
    <h1>Payment Form</h1>
    <form action="process_payment.php" method="post" id="payment-form">
        <div class="form-row">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit">Submit Payment</button>
    </form>

    <script>
        // Create an instance of Stripe Elements
        var stripe = Stripe('pk_test_51OoK4bSGoC3hK9NMtmcGSDnRv4DPyspgU7KZzhDDBsplJ7AT3ftqfl9lB1EKQqKBCbZL4bE4HU99aKEuCUFms6Li00Vk9GeoE8');

        // Create an instance of Stripe Elements with specific options
        var elements = stripe.elements();

        // Create a card Element and mount it to the card-element div
        var card = elements.create('card');
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting by default

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there's an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Token created successfully, add it to the form and submit
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);
                    form.submit();
                }
            });
        });
    </script>
    <footer> 
        <p>&copy; 2024 CraftHaven</p>
    </footer>
</body>
</html>
