<!-- resources/views/payment-success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Successful!</h1>
    <p>Thank you for your payment. Your transaction was successful.</p>
    <p><strong>Order ID:</strong> {{ $orderId }}</p>
    <p><strong>Payment ID:</strong> {{ $paymentId }}</p>
</body>
</html>
