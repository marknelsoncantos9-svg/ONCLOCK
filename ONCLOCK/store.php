<?php
session_start();

// Sample gadget products with categories
$products = [
    1 => ["name" => "ONCLOCK TIME (BLACK/RED)", "price" => 599, "image" => "images/2.FRONT.jpg", "category" => "Clothing"],
    2 => ["name" => "ONCLOCK TIME (WHITE/RED)", "price" => 599, "image" => "images/3.FRONT.jpg", "category" => "Clothing"],
    3 => ["name" => "ONCLOCK MINIMAL (BLACK/GRAY)", "price" => 650, "image" => "images/4.FRONT.jpg", "category" => "Clothing"],
    4 => ["name" => "ONCLOCK MINIMAL (WHITE/GREEN)", "price" => 650, "image" => "images/5.FRONT.jpg", "category" => "Clothing"]
];

// Add to cart
if (isset($_GET['add'])) {
    $id = (int) $_GET['add'];
    if (isset($products[$id])) {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
    header("Location: store.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ONCLOCK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #7b7b7bff;
            margin: 0;
        }

        .navbar {
            background: #263238;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 26px;
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
            max-width: 1200px;
            margin: 40px auto;
        }

        .cart-preview {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
        }

        .product {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
        }

        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
        }

        .product h3 {
            margin: 15px 0 5px;
            font-size: 20px;
        }

        .product p {
            color: #009688;
            font-weight: 600;
            margin: 10px 0;
        }

        .product a {
            background: #009688;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .product a:hover {
            background: #00796B;
        }
        .btn.checkout {
    background: #009688;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
}

.btn.checkout:hover {
    background: #00796B;
}

    </style>
</head>
<body>
    <div class="navbar">
        <h1>ONCLOCK WORLDWIDE</h1>
        </div>
    </div>

    <div class="container">
        <div class="cart-preview">
            <strong>🛒 Cart Items:</strong>
            <?php if (!empty($_SESSION['cart'])): ?>
    <div style="text-align: right; margin-top: 10px;">
        <a href="cart.php" class="btn checkout">CART</a>
        <a href="track.php" class="btn checkout">TRACK YOUR ORDER</a>
    </div>
<?php endif; ?>

            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    echo "<div>{$products[$id]['name']} x {$qty}</div>";
                }
            } else {
                echo "<div>Your cart is empty.</div>";
            }
            ?>
        </div>

        <div class="products">
            <?php foreach ($products as $id => $product): ?>
                <div class="product">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    <h3><?= $product['name'] ?></h3>
                    <p>₱<?= number_format($product['price']) ?></p>
                    <a href="?add=<?= $id ?>">Add to Cart</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
