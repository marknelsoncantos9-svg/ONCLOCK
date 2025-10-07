<?php
session_start();
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Checkout | Onclock</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .navbar {
            background: #263238;
            padding: 20px 40px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .nav-links a {
            margin-left: 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .container {
            max-width: 600px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .btn {
            background: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
        }

        .btn:hover {
            background: #00796B;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🧾 Onclock Checkout</h1>
        <div class="nav-links">
            <a href="cart.php">BACK</a>
        </div>
    </div>

    <div class="container">
        <h2>Enter Your Details</h2>
        <form action="payment_form.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" name="address" required>
            </div>
            <button type="submit" class="btn">Confirm Payment</button>
        </form>
    </div>
</body>
</html>
