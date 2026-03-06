<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validate data
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid input. Please provide a valid name and email.";
    } else {
        // Prepare SQL to prevent raw user input in query (Secure coding)
        $stmt = $pdo->prepare("INSERT INTO registrations (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
        echo "Registration successful!";
    }
}
?>

<form method="POST">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    <button type="submit">Register</button>
</form>
