<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "tracking");
$status = null;
$customer = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $conn->real_escape_string($_POST['tracking_code']);
    $query = $conn->query("SELECT customer_name, status FROM tracking WHERE tracking_code = '$code'");
    
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $customer = $row['customer_name'];
        $status = $row['status'];
    } else {
        $status = "Tracking code not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Track Your Parcel | Onclock</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #f1f8e9);
            margin: 0;
            padding: 0;
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
            max-width: 500px;
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

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button {
            background: #009688;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #00796B;
        }

        .result {
            margin-top: 20px;
            font-weight: 600;
            color: #333;
        }

        .not-found {
            color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>ONCLOCK TRACKING</h1>
        <div class="nav-links">
            <a href="store.php">HOME</a>
        </div>
    </div>

    <div class="container">
        <h2>Track Your Parcel</h2>
        <form method="POST">
            <input type="text" name="tracking_code" placeholder="Enter your tracking code" required>
            <button type="submit">Check Status</button>
        </form>

        <?php if ($status !== null): ?>
            <div class="result <?= ($status === 'Tracking code not found.') ? 'not-found' : '' ?>">
                <?= ($customer) ? "Hi <strong>$customer</strong>, your parcel status is: <strong>$status</strong>" : $status ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
