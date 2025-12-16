<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name = isset($_POST['jmeno']) ? strip_tags(trim($_POST['jmeno'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['text']) ? strip_tags(trim($_POST['text'])) : '';

    // Validate form fields
    if (empty($jmeno)) {
        $errors[] = 'Jméno je prázdné';
    }

    if (empty($email)) {
        $errors[] = 'Email je prázdný';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email není validní';
    }

    if (empty($text)) {
        $errors[] = 'Zpráva je prázdná';
    }

    // If no errors, send email
    if (empty($errors)) {
        // Recipient email address (replace with your own)
        $recipient = "e.duhonsky@gmail.com";

        // Additional headers
        $headers = "From: $jmeno <$email>";

        // Send email
        if (mail($recipient, $text, $headers)) {
            echo "Email úspěšně odeslán!";
        } else {
            echo "Nepodařilo se odeslat email. Zkuste znovu později.";
        }
    } else {
        // Display errors
        echo "The form contains the following errors:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Not a POST request, display a 403 forbidden error
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
?>