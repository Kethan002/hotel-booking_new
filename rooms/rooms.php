<?php
require_once '../includes/functions.php';

// Get the check-in and check-out dates from user input, or set default values
$check_in = isset($_GET['check_in']) ? $_GET['check_in'] : date('Y-m-d');
$check_out = isset($_GET['check_out']) ? $_GET['check_out'] : date('Y-m-d', strtotime('+1 day'));

// Define a function to fetch rooms available within a given date range
function getAvailableRooms($check_in, $check_out) {
    global $pdo;

    // SQL query to fetch available rooms, considering existing bookings
    $query = "
        SELECT r.*, 
               b.check_in AS booked_check_in, 
               b.check_out AS booked_check_out 
        FROM rooms r
        LEFT JOIN bookings b 
            ON r.id = b.room_id 
            AND ((b.check_in <= :check_in AND b.check_out >= :check_in) 
              OR (b.check_in <= :check_out AND b.check_out >= :check_out))
        WHERE b.id IS NULL
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':check_in', $check_in);
    $stmt->bindParam(':check_out', $check_out);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get rooms that are available during the specified date range
$rooms = getAvailableRooms($check_in, $check_out);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Rooms</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* Styling for the availability form with transparent box */
        .availability-box {
            display: flex; /* Use flexbox for alignment */
            justify-content: center; /* Center the form */
            align-items: center; /* Align elements vertically */
            padding: 20px; /* Padding around the box */
            background: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
            margin: 20px; /* Margin from the edges */
            color: green;
            background-color: #f2f2f2;
        }

        .availability-box label {
            font-size: 18px; /* Larger font size */
            font-weight: bold; /* Bold text */
            margin-right: 10px; /* Space between label and input */
        }

        .availability-box input {
            font-size: 16px; /* Input field font size */
            padding: 8px; /* Padding inside input fields */
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px; /* Rounded corners */
            margin-right: 15px; /* Spacing between fields */
        }

        .availability-box button {
            font-size: 16px; /* Button font size */
            padding: 10px 20px; /* Padding */
            background-color: #007bff; /* Blue background */
            color: white; /* White text */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor */
        }

        .availability-box button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="rooms.php">Rooms</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Our Rooms</h1>
        <!-- Form with transparent background -->
        <div class="availability-box">
            <form method="GET" action="rooms.php">
                <label for="check_in">Check-in Date:</label>
                <input type="date" name="check_in" id="check_in" value="<?= $check_in ?>" required>

                <label for="check_out">Check-out Date:</label>
                <input type="date" name="check_out" id="check_out" value="<?= $check_out ?>" required>

                <button type="submit">Check Availability</button>
            </form>
        </div>

        <section class="rooms">
            <?php if (empty($rooms)): ?> <!-- If no rooms are available -->
            <p>No rooms are available for the selected dates. Please try other dates.</p>
            <?php else: ?> <!-- Display available rooms -->
            <?php foreach ($rooms as $room): ?>
            <div class="room">
                <img src="../assets/images/<?= $room['image'] ?>" alt="<?= $room['room_type'] ?>">
                <h3><?= $room['room_type'] ?></h3>
                <p><?= $room['description'] ?></p>
                <p>Price: ₹<?= $room['price']?> per night</p> <!-- Price in Indian Rupees -->
                <a href="room-details.php?id=<?= $room['id'] ?>&check_in=<?= $check_in ?>&check_out=<?= $check_out ?>">View Details</a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?> <!-- End of room display section -->
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Hotel Booking. All rights reserved.</p>
    </footer>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
