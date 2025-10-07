<?php
session_start();

// Product list
$products = [
     1 => ["name" => "ONCLOCK TIME (BLACK/RED)", "price" => 599, "image" => "images/2.FRONT.jpg", "category" => "Clothing"],
    2 => ["name" => "ONCLOCK TIME (WHITE/RED)", "price" => 599, "image" => "images/3.FRONT.jpg", "category" => "Clothing"],
    3 => ["name" => "ONCLOCK MINIMAL (BLACK/GRAY)", "price" => 650, "image" => "images/4.FRONT.jpg", "category" => "Clothing"],
    4 => ["name" => "ONCLOCK MINIMAL (WHITE/GREEN)", "price" => 650, "image" => "images/5.FRONT.jpg", "category" => "Clothing"]
];

// Cancel single item
if (isset($_POST['remove_item'])) {
    $id = (int) $_POST['remove_item'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: cart.php");
    exit();
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #7b7b7bff;
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

        .nav-links a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: center;
        }

        th {
            background: #009688;
            color: white;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #e0f2f1;
        }

        td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn.remove {
            background: #d32f2f;
            color: white;
        }

        .btn.remove:hover {
            background: #b71c1c;
        }

        .btn.checkout {
            background: #009688;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 8px;
            display: block;
            margin: 30px auto 0;
        }

        .btn.checkout:hover {
            background: #00796B;
        }

        .total {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-align: right;
            margin-top: 10px;
        }

        .empty {
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #666;
        }

        .warning {
            color: #d32f2f;
            text-align: center;
            font-weight: 500;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>YOUR CART</h1>
        <div class="nav-links">
            <a href="store.php">BACK</a>
        </div>
    </div>

    <div class="container">
        <h2>Shopping Cart Details</h2>
        <table>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $id => $qty): 
                    $subtotal = $products[$id]['price'] * $qty;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td>
                            <img src="<?= $products[$id]['image'] ?>" alt="<?= $products[$id]['name'] ?>">
                            <?= $products[$id]['name'] ?>
                        </td>
                        <td><?= $qty ?></td>
                        <td>₱<?= number_format($products[$id]['price'], 2) ?></td>
                        <td>₱<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form action="checkout.php" method="POST">
                                <button type="submit" name="remove_item" value="<?= $id ?>" class="btn remove">❌ Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right; font-weight:600;">Total:</td>
                    <td colspan="2" style="font-weight:600; color:#009688;">₱<?= number_format($total, 2) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="empty">Your cart is empty.</td>
                </tr>
            <?php endif; ?>
        </table>

        </table> <!-- Make sure this closes before the form -->

<?php if ($total >= 100 && !empty($_SESSION['cart'])): ?>
    <div style="text-align:center; margin-top:20px;">
        <form action="checkout.php" method="GET">
            <button type="submit" class="btn checkout">Proceed to Checkout</button>
        </form>
    </div>
<?php elseif ($total > 0): ?>
    <p class="warning">⚠ Minimum checkout amount is ₱100.</p>
<?php endif; ?>

    </div>
</body>
</html>
