<?php
require_once '../includes/functions.php';

if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];
    $booking = getBooking($bookingId);

    if ($booking) {
        $roomId = $booking['room_id'];
        $room = getRoom($roomId);

        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $checkIn = $_POST['check_in'];
            $checkOut = $_POST['check_out'];
            $guests = $_POST['guests'];
            $customerName = $_POST['customer_name'];
            $customerEmail = $_POST['customer_email'];
            $houseNo = $_POST['house_no'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $price = $_POST['price']; // New field for room price
            $totalCost = calculateTotalCost($checkIn, $checkOut, $price);

            // Call updateBooking with all necessary fields, including room price
            updateBooking(
                $bookingId, 
                $checkIn, 
                $checkOut, 
                $guests, 
                $customerName, 
                $customerEmail, 
                $houseNo, 
                $city, 
                $state, 
                $totalCost,
                $price // Pass price to updateBooking
            );

            // Redirect to the admin page after updating
            header('Location: admin.php');
            exit;
        }
    } else {
        echo "Invalid booking ID.";
        exit;
    }
} else {
    echo "Booking ID not provided.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
            body {
                background-image: url('../assets/images/about.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                font-family: 'Open Sans', sans-serif;
            }

            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: rgba(255, 255, 255, 0.8);
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="email"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 3px;
                box-sizing: border-box;
            }

            button[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            button[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
</head>
<body>
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $bookingId; ?>">
            <label for="check_in">Check-In:</label>
            <input type="text" id="check_in" name="check_in" value="<?php echo $booking['check_in']; ?>" required>

            <label for="check_out">Check-Out:</label>
            <input type="text" id="check_out" name="check_out" value="<?php echo $booking['check_out']; ?>" required>

            <label for="guests">Number of Guests:</label>
            <input type="text" id="guests" name="guests" value="<?php echo $booking['guests']; ?>" required>

            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" value="<?php echo $booking['customer_name']; ?>" required>

            <label for="customer_email">Customer Email:</label>
            <input type="email" id="customer_email" name="customer_email" value="<?php echo $booking['customer_email']; ?>" required>

            <label for="house_no">House Number:</label>
            <input type="text" id="house_no" name="house_no" value="<?php echo $booking['house_no']; ?>" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $booking['city']; ?>" required>

            <label for "state">State:</label>
            <input type="text" id="state" name="state" value="<?php echo $booking['state']; ?>" required>

            <label for="price">Room Price:</label> <!-- New field for price -->
            <input type="text" id="price" name="price" value="<?php echo $room['price']; ?>" required> 

            <button type="submit">Update Booking</button>
        </form>
    </div>
</body>
</html>








 
