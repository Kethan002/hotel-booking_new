<?php
require_once '../includes/functions.php';

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    $room = getRoom($roomId); // Use the getRoom() function from functions.php
} else {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $room['room_type'] ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .room-details {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        .room-details img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .room-details-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            text-align: center;
        }

        .booking-form {
            max-width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .form-group {
            flex-basis: 20%;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .text-center {
            text-align: center;
        }

        .btn {
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 25px;
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
            </ul>
        </nav>
    </header>
    <main>
        <div class="room-details">
            <img src="../assets/images/<?= $room['image'] ?>" alt="<?= $room['room_type'] ?>">
            <div class="room-details-content">
                <h1><?= $room['room_type'] ?></h1>
                <p><?= $room['description'] ?></p>
                <p>Price: ₹<?= $room['price']?> per night</p>
                <form action="../booking/room-details.php" method="post" class="booking-form">
                    <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                    <div class="form-group">
                        <label for="check_in">Check-in Date:</label>
                        <input type="date" id="check_in" name="check_in" required>
                    </div>
                    <div class="form-group">
                        <label for="check_out">Check-out Date:</label>
                        <input type="date" id="check_out" name="check_out" required>
                    </div>
                    <div class="form-group">
                        <label for="guests">Number of Guests:</label>
                        <input type="number" id="guests" name="guests" min="1" max="4" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_name">Name:</label>
                        <input type="text" id="customer_name" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Email:</label>
                        <input type="email" id="customer_email" name="customer_email" required>
                    </div>
                    <div class="form-group">
                        <label for="house_no">House No.:</label>
                        <input type="text" id="house_no" name="house_no" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Hotel Booking. All rights reserved.</p>
    </footer>
    <script>
        // Get the current date
        const today = new Date().toISOString().split('T')[0];

        // Set the min attribute for the check-in date input
        document.getElementById('check_in').min = today;

        // Update the min attribute for the check-out date input when the check-in date changes
        document.getElementById('check_in').addEventListener('change', function() {
            document.getElementById('check_out').min = this.value;
        });
    </script>
</body>
</html>