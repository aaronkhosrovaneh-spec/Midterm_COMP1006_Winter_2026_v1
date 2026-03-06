<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM registrations WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $stmt = $pdo->prepare("UPDATE registrations SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $id]);
    header("Location: admin.php");
}
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $user['name'] ?>">
    Email: <input type="email" name="email" value="<?= $user['email'] ?>">
    <button type="submit">Update Registration</button>
</form>
