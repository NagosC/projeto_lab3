<?php include_once __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <h2>Register</h2>
    <form action="/controllers/UserController.php?action=register" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
</div>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>