<?php
session_start();
$conn = new mysqli("localhost", "root", "", "tracking");

$tracking_code = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $tracking_code = 'TRK' . strtoupper(substr(md5(uniqid()), 0, 8));

    // Insert into tracking table
    $conn->query("INSERT INTO tracking (customer_name, email, tracking_code, status) 
                  VALUES ('$name', '$email', '$tracking_code', 'Pending')");

    // Clear cart after checkout
    unset($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation | Onclock</title>
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
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .tracking-code {
            font-size: 20px;
            font-weight: 600;
            color: #009688;
            margin-top: 20px;
        }

        .btn {
            background: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 30px;
        }

        .btn:hover {
            background: #00796B;
        }

        form {
            text-align: left;
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
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Onclock Payment</h1>
        <div class="nav-links">
            <a href="store.php">STORE</a>
            <a href="cart.php">CART</a>
        </div>
    </div>

    <div class="container">
        <?php if ($tracking_code): ?>
            <h2>Thank You for Your Order!</h2>
            <p>Your payment has been received.</p>
            <div class="tracking-code">
                Your Tracking Code: <strong><?= $tracking_code ?></strong>
            </div>
            <a href="track.php" class="btn">Track Your Parcel</a>
        <?php else: ?>
            <h2>Enter Your Details</h2>
            <form method="POST">
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
        <?php endif; ?>
    </div>
</body>
</html>
