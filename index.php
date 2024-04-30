<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="assets/css/styles1.css">
    <script src="assets/js/scripts.js" defer></script>
    <style>
        /* CSS to remove the scrollbar and add a background image */
        html, body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Hides the scrollbar */
            height: 100%; /* Full height */
            background-image: url('assets/images/background.jpg'); /* Background image path */
            background-size: cover; /* Cover the entire page */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Avoid repetition */
        }



            /* Heading and footer styles */
            .animated-heading {
                font-size: 48px; /* Larger font size */
                display: inline-flex; /* Display each letter as an inline element */
                gap: 5px; /* Gap between letters */
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
    <main>
        <section class="hero">
            <div class="hero-image active" style="background-image: url('assets/images/hero2.jpg');"></div>
            <div class="hero-image" style="background-image: url('assets/images/hero5.jpg');"></div>
            <div class="hero-image" style="background-image: url('assets/images/hero3.jpg');"></div>
            <div class="hero-image" style="background-image: url('assets/images/hero4.jpg');"></div>
            <div class="hero-image" style="background-image: url('assets/images/hero1.jpg');"></div>
            <div class="hero-content">
                <h1 class="animated-heading">Welcome to Our Hotel</h1>
                <p>Experience Luxury and Comfort at Its Finest.</p>
            </div>
            <div class="hero-buttons">
                <span class="hero-button prev">&#128522;</span>
                <span class="hero-button next">&#128522;</span>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Hotel Booking. All Rights Reserved.</p>
    </footer>
</body>
</html>