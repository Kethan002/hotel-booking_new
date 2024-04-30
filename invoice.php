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
    <title>Invoice</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
        }
    </style>
</head>
<body>
    <div class="print-area">
        <h1>INVOICE</h1>
        <h2>HOTEL BLUE HOUSE</h2>
        <p>27 Leitz Road<br>Houston, TX 33035<br>www.bluehousehotel.com</p>
        <h3><?= $booking['customer_name'] ?></h3>
        <p>INVOICE #AB-54321</p>
        <ul>
            <li>Account: 10001</li>
            <li>Room: <?= $booking['room_type'] ?></li>
            <li>Arrival Date: <?= $booking['check_in'] ?></li>
            <li>Departure Date: <?= $booking['check_out'] ?></li>
        </ul>
        <table>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Comment</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td>ROOM CHARGES</td>
                <td><?= calculateTotalCost($booking['check_in'], $booking['check_out'], 1) ?> Nights</td>
                <td>$<?= $booking['price'] ?>/person/night</td>
                <td>Room <?= $booking['room_type'] ?>, Standard Deluxe</td>
                <td>$<?= $booking['total_cost'] ?></td>
            </tr>
            <?php if (isset($booking['room_service_charge']) && $booking['room_service_charge'] > 0): ?>
                <tr>
                    <td>ROOM SERVICE</td>
                    <td></td>
                    <td>$<?= $booking['room_service_charge'] ?></td>
                    <td></td>
                    <td>$<?= $booking['room_service_charge'] ?></td>
                </tr>
            <?php endif; ?>
            <?php if (isset($booking['spa_service_charge']) && $booking['spa_service_charge'] > 0): ?>
                <tr>
                    <td>SPA SERVICE</td>
                    <td></td>
                    <td>$<?= $booking['spa_service_charge'] ?></td>
                    <td></td>
                    <td>$<?= $booking['spa_service_charge'] ?></td>
                </tr>
            <?php endif; ?>
        </table>
        <p>Subtotal: ₹<?= $booking['total_cost'] + ($booking['room_service_charge'] ?? 0) + ($booking['spa_service_charge'] ?? 0) ?></p>
        <p>State Tax (4%): ₹<?= ($booking['total_cost'] + ($booking['room_service_charge'] ?? 0) + ($booking['spa_service_charge'] ?? 0)) * 0.04 ?></p>
        <p>GST (12%): ₹<?= ($booking['total_cost'] + ($booking['room_service_charge'] ?? 0) + ($booking['spa_service_charge'] ?? 0)) * 0.12 ?></p>
        <h3>GRAND TOTAL: ₹<?= ($booking['total_cost'] + ($booking['room_service_charge'] ?? 0) + ($booking['spa_service_charge'] ?? 0)) * 1.16 ?></h3>
        <p>*Your qualifying points will be automatically added to your premium account.</p>
        <p>WE HOPE YOU HAD A GREAT STAY!</p>
    </div>
    <button onclick="window.print()">Print Invoice</button>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>