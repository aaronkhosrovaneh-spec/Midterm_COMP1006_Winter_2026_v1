<?php
require 'db.php';

// Handle Delete request
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM registrations WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: admin.php");
}

// Read: Fetch all registrations
$stmt = $pdo->query("SELECT * FROM registrations");
$registrations = $stmt->fetchAll();
?>

<h1>Admin Panel - Manage Registrations</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($registrations as $row): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
            <a href="update.php?id=<?= $row['id'] ?>">Edit</a> | 
            <a href="admin.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
