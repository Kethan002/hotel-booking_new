<?php
require_once '../includes/functions.php';

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];
    $query = "SELECT b.*, r.room_type, r.price FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.id = :booking_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
    $stmt->execute();
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: ../index.php');
    exit;
}

// Calculate taxes and total costs
$gst = 0.18;
$cleaning_tax = 500.00;
$room_price = $booking['price'];
$check_in_date = new DateTime($booking['check_in']);
$check_out_date = new DateTime($booking['check_out']);
$nights = $check_out_date->diff($check_in_date)->days;

$total_cost = $room_price * $nights;
$gst_amount = $total_cost * $gst;
$final_cost = $total_cost + $gst_amount + $cleaning_tax;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* General styling */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%; /* Full height */
            background-image: url('../assets/images/invoice.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Transparent box for content */
        .transparent-box {
            background: rgba(255, 255, 255, 0.7); /* Semi-transparent */
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            margin: auto; /* Centered horizontally */
            max-width: 600px;
        }

        /* Table styling */
        table {
            width: 100%; /* Full width */
            border-collapse: collapse; /* No gaps */
        }

        table, th, td {
            border: 1px solid #ddd; /* Light border */
        }

        th, td {
            padding: 8px; /* Padding */
        }

        th {
            background-color: #f2f2f2; /* Light gray for headers */
        }

        /* Footer styling */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #333; /* Dark background */
            color: #fff; /* White text */
            text-align: center; /* Centered text */
            padding: 20px; /* Padding */
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../rooms/rooms.php">Rooms</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="transparent-box">
            <h1>Booking Confirmation</h1>
            <h2>Invoice</h2>
            <p>Room No: <?= $booking['room_id'] ?></p>
            <p>Customer Name: <?= $booking['customer_name'] ?></p>
            <p>Room Type: <?= $booking['room_type'] ?></p>
            <p>Check-in Date: <?= $booking['check_in'] ?></p>
            <p>Check-out Date: <?= $booking['check_out'] ?></p>
            <p>Address: <?= "{$booking['house_no']}, {$booking['city']}, {$booking['state']}" ?></p>

            <table>
                <tr>
                    <th>Item</th>
                    <th>Cost (₹)</th>
                </tr>
                <tr>
                    <td>Room Cost (per day)</td>
                    <td><?= $room_price ?></td>
                </tr>
                <tr>
                    <td>Number of Nights</td>
                    <td><?= $nights ?></td>
                </tr>
                <tr>
                    <td>Room Cost (total)</td>
                    <td><?= $total_cost ?></td>
                </tr>
                <tr>
                    <td>GST (18%)</td>
                    <td><?= $gst_amount ?></td>
                </tr>
                <tr>
                    <td>Cleaning Tax</td>
                    <td><?= $cleaning_tax ?></td>
                </tr>
                <tr>
                    <th>Total Cost (Including Taxes)</th>
                    <th><?= $final_cost ?></th>
                </tr>
            </table>

            <!-- Display success message -->
            <p>Your room booking was successful. The invoice has been sent to your email.</p>
        </div>
    </main>
    <footer>
        <p>Thank you for booking with us! We look forward to your stay.</p>
        <p>&#128522 Happy Booking! &#128522</p>
    </footer>
</body>
</html>
