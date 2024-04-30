<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            background-image: url('assets/images/contact.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Open Sans', sans-serif;
            color: #fff;
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
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.8);
        }
        footer {
                background-color: #333; /* Dark background */
                color: #fff; /* White text */
                padding: 20px; /* Padding */
                text-align: center; /* Centered text */
                position: absolute; /* Ensure it stays at the bottom */
                bottom: 0; /* Position at the bottom of the page */
                width: 100%; /* Full width */
            }
        .container {
            background: rgba(255, 255, 255, 0.7); /* Semi-transparent */
            padding: 10px; /* Padding inside the box */
            margin: 100px auto; /* Center the box */
            max-width: 600px; /* Set maximum width */
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center; /* Center the text */
        }
        .blue-button {
            background-color: blue; /* Blue button */
            color: white; /* White text */
            padding: 10px 20px; /* Padding */
            border-radius: 5px; /* Rounded corners */
            border: none; /* No border */
            cursor: pointer; /* Cursor change on hover */
            font-size: 16px; /* Font size */
            margin-top: 20px; /* Margin above the button to push it down */
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="rooms/rooms.php">Rooms</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Contact Us</h1>
        <form>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit" class="blue-button">Send Message</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Hotel Booking. All Rights Reserved.</p>
    </footer>
</body>
</html>