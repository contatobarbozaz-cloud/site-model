<?php
session_start();
require_once 'connect.php';

// Check if the connection is valid
if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']); // Escape input to prevent SQL injection
    $password = $conn->real_escape_string($_POST['password']); // Escape input to prevent SQL injection

    // Example query
    $sql = "SELECT * FROM tb_usuarios WHERE usuario = '$username' AND senha = '$password'"; // Replace 'tb_usuarios' with your actual table name
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        // Login failed
        $error = 'Invalid username or password.';
    }

    $conn->close();
}
?>
<!DOCTYPE html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="styles/style.css"/>
    </head>
    <body>
        <div class="login-container">
            <h1>Login</h1>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form class="login-form" action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>