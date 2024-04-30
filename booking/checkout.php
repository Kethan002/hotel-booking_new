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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        @media print {
            header, nav, footer {
                display: none;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../rooms/rooms.php">Rooms</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Booking Confirmation</h1>
        <div class="confirmation">
            <h2>Invoice</h2>
            <p>Booking ID: <?= $bookingId ?></p>
            <p>Customer Name: <?= $booking['customer_name'] ?></p>
            <p>Room Type: <?= $booking['room_type'] ?></p>
            <p>Check-in Date: <?= $booking['check_in'] ?></p>
            <p>Check-out Date: <?= $booking['check_out'] ?></p>
            <p>House No: <?= $booking['house_no'] ?></p>
            <p>City: <?= $booking['city'] ?></p>
            <p>State: <?= $booking['state'] ?></p>
            <p>Total Cost: ₹<?= $booking['total_cost'] ?></p>
            <button onclick="window.print()">Print Invoice</button>
        </div>
    </main>
    <footer>
        <p>&#128522 Thank You! Happy Booking &#128522 <br><br>&copy; 2024 Hotel Booking. All rights reserved.</p>
    </footer>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>