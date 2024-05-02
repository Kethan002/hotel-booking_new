<?php
require_once 'database.php'; // Ensure this doesn't lead to recursive includes

// Fetch all rooms
function getRooms() {
    global $pdo;
    $query = "SELECT * FROM rooms"; // Make sure this query doesn't return too much data
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative arrays
}

// Save booking to the database
function saveBooking($roomId, $checkIn, $checkOut, $guests, $customerName, $customerEmail, $houseNo, $city, $state, $totalCost) {
    global $pdo;
    
    $query = "INSERT INTO bookings (room_id, check_in, check_out, guests, customer_name, customer_email, house_no, city, state, total_cost)
              VALUES (:room_id, :check_in, :check_out, :guests, :customer_name, :customer_email, :house_no, :city, :state, :total_cost)";
    
    $stmt = $pdo->prepare($query); // Properly prepare the query
    $stmt->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $stmt->bindParam(':check_in', $checkIn, PDO::PARAM_STR);
    $stmt->bindParam(':check_out', $checkOut, PDO::PARAM_STR);
    $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
    $stmt->bindParam(':customer_name', $customerName, PDO::PARAM_STR);
    $stmt->bindParam(':customer_email', $customerEmail, PDO::PARAM_STR);
    $stmt->bindParam(':house_no', $houseNo, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_STR);
    $stmt->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);

    $stmt->execute(); // Execute the query
    
    return $pdo->lastInsertId(); // Return the last inserted ID
}

function getRoom($id) {
    global $pdo;
    $query = "SELECT * FROM rooms WHERE id = :id"; // Ensure this query is optimized
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch only one row
}

function calculateTotalCost($checkIn, $checkOut, $roomPrice) {
    $start = new DateTime($checkIn);
    $end = new DateTime($checkOut);
    $interval = $start->diff($end);
    $nights = $interval->days;
    return $nights * $roomPrice; // Return the calculated cost
}

function bookRoom($roomId, $checkIn, $checkOut, $guests, $customerName, $customerEmail, $houseNo, $city, $state, $totalCost) {
    global $pdo;
    
    $query = "INSERT INTO bookings (room_id, check_in, check_out, guests, customer_name, customer_email, house_no, city, state, total_cost)
              VALUES (:room_id, :check_in, :check_out, :guests, :customer_name, :customer_email, :house_no, :city, :state, :total_cost)";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $stmt->bindParam(':check_in', $checkIn, PDO::PARAM_STR);
    $stmt->bindParam(':check_out', $checkOut, PDO::PARAM_STR);
    $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
    $stmt->bindParam(':customer_name', $customerName, PDO::PARAM_STR);
    $stmt->bindParam(':customer_email', $customerEmail, PDO::PARAM_STR);
    $stmt->bindParam(':house_no', $houseNo, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_STR);
    $stmt->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);
    return $stmt->execute();
}

// Functions for admin page
function getTotalRooms() {
    global $pdo;
    $query = "SELECT COUNT(*) FROM rooms";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn(); // Return total rooms
}

function getBookedRooms() {
    global $pdo;
    $query = "SELECT COUNT(*) FROM bookings WHERE check_out > NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn(); // Return currently booked rooms
}

function getRecentBookings() {
    global $pdo;
    $query = "SELECT b.*, r.room_type FROM bookings b JOIN rooms r ON b.room_id = r.id ORDER BY b.created_at DESC LIMIT 10";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function calculateTotalRevenue() {
    global $pdo;
    $query = "SELECT SUM(total_cost) FROM bookings";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn(); // Return total revenue
}

function deleteBooking($bookingId)
{
    global $pdo;
    $query = "DELETE FROM bookings WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $bookingId, PDO::PARAM_INT);
    return $stmt->execute();
}

// Functions for getting and updating bookings
function getBooking($bookingId) {
    global $pdo;
    $query = "SELECT * FROM bookings WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $bookingId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateBooking($bookingId, $checkIn, $checkOut, $guests, $customerName, $customerEmail, $houseNo, $city, $state, $totalCost,$price){
    global $pdo;
    try {
        $query = "UPDATE bookings 
                  SET check_in = :check_in, 
                      check_out = :check_out, 
                      guests = :guests, 
                      customer_name = :customer_name, 
                      customer_email = :customer_email,
                      house_no = :house_no,
                      city = :city,
                      state = :state,
                      total_cost = :total_cost
                  WHERE id = :id";

        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':check_in', $checkIn, PDO::PARAM_STR);
        $stmt->bindParam(':check_out', $checkOut, PDO::PARAM_STR);
        $stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
        $stmt->bindParam(':customer_name', $customerName, PDO::PARAM_STR);
        $stmt->bindParam(':customer_email', $customerEmail, PDO::PARAM_STR);
        $stmt->bindParam(':house_no', $houseNo, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':state', $state, PDO::PARAM_STR);
        $stmt->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);
        $stmt->bindParam(':id', $bookingId, PDO::PARAM_INT);

        $stmt->execute();
    } catch (PDOException $e) {
    echo "Error updating booking: " . $e->getMessage();
}
}
