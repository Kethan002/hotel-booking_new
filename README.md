# Online Hotel Booking System

This is an online hotel booking system built with PHP and the XAMPP server. It allows users to browse available rooms, view room details, and make reservations.

## Features

- View a list of available rooms with images, descriptions, and prices
- Filter rooms by price range
- View detailed information about each room
- Book a room by selecting check-in and check-out dates, and providing guest and contact information
- Receive a confirmation page with booking details after successful reservation
- Responsive design for optimal viewing experience on various devices

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- JavaScript

## Installation

1. Clone the repository or download the source code.
2. Set up a local development environment with XAMPP or any other Apache and MySQL server.
3. Create a new database named `hotel_booking`.
4. Import the `hotel_booking.sql` file located in the `database` directory to create the required tables.
5. Update the database credentials in the `includes/config.php` file.
6. Place the project files in the XAMPP `htdocs` directory (or the appropriate directory for your local server).
7. Start the Apache and MySQL services.
8. Open your web browser and navigate to `http://localhost/hotel-booking` (or the appropriate URL for your local server).

## Usage

1. On the home page, you'll see a list of featured rooms. Click on the "Book Now" button to view room details and make a reservation.
2. On the room details page, select your check-in and check-out dates, enter the number of guests, and provide your name and email address.
3. Click the "Book Now" button to proceed with the booking.
4. You'll be redirected to a confirmation page displaying your booking details.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

- This project was inspired by the need for a simple and user-friendly hotel booking system.
- Special thanks to the open-source communities for providing valuable resources and libraries.