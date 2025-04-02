<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: {{ $isAdmin ? '#333333' : '#007BFF' }};
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: {{ $isAdmin ? '#555555' : '#007BFF' }};
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $isAdmin ? 'New Order Received' : 'Thank You for Your Order!' }}</h1>
        </div>
        <div class="content">
            <p>Order Details:</p>
            <ul>
                <li>Order ID: {{ $order->id }}</li>
                <li>Total Amount: ₹{{ $order->total }}</li>
                <li>Date: {{ $order->created_at->format('d M Y H:i') }}</li>
            </ul>
            <a href="{{ url('/orders/'.$order->id) }}" class="button">View Order Details</a>
        </div>
    </div>
</body>
</html>