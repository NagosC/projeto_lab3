<?php
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit();
}
?>

<div class="container">
    <h2>User Profile</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
</div>