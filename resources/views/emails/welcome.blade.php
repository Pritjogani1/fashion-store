<!DOCTYPE html>
<html>
<head>
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
        }
        .content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Fashion Store!</h1>
        </div>
        <div class="content">
            <h2>Hello {{ $user->name }},</h2>
            <p>Thank you for creating an account with Fashion Store. We're excited to have you as a member of our community!</p>
            <p>You can now:</p>
            <ul>
                <li>Browse our latest collections</li>
                <li>Save your favorite items</li>
                <li>Track your orders</li>
                <li>Get exclusive offers</li>
            </ul>
            <a href="{{ url('/') }}" class="button">Start Shopping</a>
            <p>If you have any questions, feel free to contact our support team.</p>
            <p>Best regards,<br>The Fashion Store Team</p>
        </div>
    </div>
</body>
</html>