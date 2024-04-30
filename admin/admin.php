<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit;
}
require_once '../includes/functions.php';

$totalRooms = getTotalRooms();
$totalBookedRooms = getBookedRooms();
$recentBookings = getRecentBookings();
$totalRevenue = calculateTotalRevenue();

// Delete booking
if (isset($_GET['delete'])) {
    $bookingId = $_GET['delete'];
    deleteBooking($bookingId);
    header('Location: admin.php'); // Redirect to prevent form resubmission
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        .stats {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Admin Dashboard</h1>
        <div class="stats">
            <h2>Statistics</h2>
            <p>Total Rooms: <?= $totalRooms ?></p>
            <p>Booked Rooms: <?= $totalBookedRooms ?></p>
            <p>Total Revenue: ₹<?= $totalRevenue * 20 ?></p>
        </div>
        <div class="recent-bookings">
            <h2>Recent Bookings</h2>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Room Type</th>
                    <th>Guests</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>House No.</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Total Cost (₹)</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($recentBookings as $booking): ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= $booking['customer_name'] ?></td>
                        <td><?= $booking['room_type'] ?></td>
                        <td><?= $booking['guests'] ?></td>
                        <td><?= $booking['check_in'] ?></td>
                        <td><?= $booking['check_out'] ?></td>
                        <td><?= $booking['house_no'] ?></td>
                        <td><?= $booking['city'] ?></td>
                        <td><?= $booking['state'] ?></td>
                        <td>₹<?= $booking['total_cost'] * 20 ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?= $booking['id'] ?>">Edit</a>
                            <a href="?delete=<?= $booking['id'] ?>" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Hotel Booking. All Rights Reserved.</p>
    </footer>
</body>
</html>