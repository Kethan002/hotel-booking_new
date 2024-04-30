<?php
require_once '../includes/functions.php';
require_once '../includes/mail_config.php'; // Include email functionality

// Retrieve form data from the room booking form
$roomId = $_POST['room_id'];
$checkInDate = $_POST['check_in'];
$checkOutDate = $_POST['check_out'];
$guests = $_POST['guests'];
$customerName = $_POST['customer_name'];
$customerEmail = $_POST['customer_email'];
$houseNo = $_POST['house_no'];
$city = $_POST['city'];
$state = $_POST['state'];

// Calculate the number of nights
$checkInDateTime = new DateTime($checkInDate);
$checkOutDateTime = new DateTime($checkOutDate);
$nights = $checkOutDateTime->diff($checkInDateTime)->days; // Correct syntax

// Fetch room details
$room = getRoom($roomId);

// Calculate the total cost
$totalCost = $room['price'] * $nights;
$gst_amount = $totalCost * 0.18; // GST calculation
$final_cost = $totalCost + $gst_amount + 500; // Including cleaning tax

// Book the room
$bookingSuccess = bookRoom($roomId, $checkInDate, $checkOutDate, $guests, $customerName, $customerEmail, $houseNo, $city, $state, $final_cost);

if ($bookingSuccess) {
    $bookingId = $pdo->lastInsertId();

    // Create booking information to pass to sendMail
    $booking = [
        'room_id' => $roomId,
        'customer_name' => $customerName,
        'room_type' => $room['room_type'],
        'check_in' => $checkInDateTime->format('Y-m-d'),
        'check_out' => $checkOutDateTime->format('Y-m-d'),
        'house_no' => $houseNo,
        'city' => $city,
        'state' => $state,
        'price' => $room['price'],
        'nights' => $nights,
        'total_cost' => $totalCost,
        'gst_amount' => $gst_amount,
        'final_cost' => $final_cost,
    ];

    // Send the confirmation email with the booking information
    $subject = 'Booking Confirmation';
    sendMail($customerEmail, $subject, $booking); // Send the email

    // Redirect to the confirmation page with the booking ID
    header("Location: confirmation.php?booking_id=$bookingId");
    exit;
} else {
    echo "Error: Could not book the room. Please try again later.";
}
