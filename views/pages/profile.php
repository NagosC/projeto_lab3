<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /views/pages/login.php');
    exit();
}

include_once __DIR__ . '/../templates/header.php';
?>

<div class="container">
    <h2>User Profile</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
    <p><a href="/controllers/UserController.php?action=logout">Logout</a></p>
</div>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>