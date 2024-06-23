<?php
$title = "Home";
$cssFiles = [
    "/assets/css/login.css"
];
include '../components/head.php';
include '../components/navbar.php';


// print the session


?>

<section class="login-section">
    <div class="login-card">
        <h2>Login</h2>
        <?php if (isset($data['errorMessage'])): ?>
            <p class="error-message"><?php echo $data['errorMessage']; ?></p>
        <?php endif; ?>
        <form action="/login" method="post">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="passenger">Passagier</option>
                <option value="worker">Medewerker</option>
            </select>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</section>

<?php include '../components/footer.php'; ?>