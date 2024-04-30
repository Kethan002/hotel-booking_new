<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

function sendMail($toEmail, $subject, $booking) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'veldandikethankumar@gmail.com'; // Your email address
        $mail->Password = 'ehfx zsil futk feio'; // Your email password
        $mail->SMTPSecure = 'ssl'; // Encryption protocol (use 'tls' for TLS)
        $mail->Port = 465; // SMTP port for SSL; if TLS, use 587

        // Email setup
        $mail->setFrom('veldandikethankumar@gmail.com', 'Jujutsu Hotel'); // Sender's email
        $mail->addAddress($toEmail); // Recipient's email
        $mail->isHTML(true); // Allow HTML content
        $mail->Subject = $subject;

        // Email body with booking information
        $mail->Body = "
        <h1>Booking Confirmation</h1>
        <h2>Invoice</h2>
        <p>Room No: {$booking['room_id']}</p>
        <p>Customer Name: {$booking['customer_name']}</p>
        <p>Room Type: {$booking['room_type']}</p>
        <p>Check-in Date: {$booking['check_in']}</p>
        <p>Check-out Date: {$booking['check_out']}</p>
        <p>Address: {$booking['house_no']}, {$booking['city']}, {$booking['state']}</p>

        <table style='width:100%; border-collapse: collapse;'>
            <tr>
                <td>Item</td>
                <td>Cost (₹)</td>
            </tr>
            <tr>
                <td>Room Cost (per day)</td>
                <td>{$booking['price']}</td>
            </tr>
            <tr>
                <td>Number of Nights</td>
                <td>{$booking['nights']}</td>
            </tr>
            <tr>
                <td>Room Cost (total)</td>
                <td>{$booking['total_cost']}</td>
            </tr>
            <tr>
                <td>GST (18%)</td>
                <td>{$booking['gst_amount']}</td>
            </tr>
            <tr>
                <td>Cleaning Tax</td>
                <td>500.00</td>
            </tr>
            <tr>
                <td>Total Cost (Including Taxes)</td>
                <td>{$booking['final_cost']}</td>
            </tr>
        </table>

        <p>Thank you for booking with us! We look forward to your stay.</p>
        ";

        // Send the email
        $mail->send(); // If no exception, email was sent successfully
        return true; // Success
    } catch (Exception $e) { // Correct catch syntax
        error_log('PHPMailer error: ' . $e->getMessage()); // Log the error
        return false; // Email failed to send
    }
}
