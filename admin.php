<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayError($error) {
    echo "<div class='error'>$error</div>";
}

$stmt = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM admins WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, redirect to dashboard
                header("Location: dashboard.php");
                exit();
            }
        }
        // Invalid username or password
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concepcion Balagtas Dichoso Lying Maternity Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admins.css">
</head>
<body>
<div class="menu">
    <h1>Admin Login,</h1>
    <h2>Please enter your details</h2>
    <?php if (isset($error)): ?>
        <?php displayError($error); ?>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="input-container">
            <input type="text" class="button-container" id="username" name="username" placeholder="Username">
            <div class="password-container">
                <input type="password" class="button-container" id="password" name="password" placeholder="Password">
                <i class="fas fa-eye" id="togglePassword" onclick="togglePassword('password')"></i>
            </div>
        </div>
        <input type="checkbox" id="rememberMe" name="rememberMe">
        <label for="rememberMe">Remember Me</label>
        <p><a href="homepage.php">Switch to Admin?</a></p>
        <p1><a href="forgetpassadmin.php">Forgot password?</a></p1>
        <div class="button-container">
            <button type="submit" name="submit" class="btn">LOGIN</button>
        </div>
    </form>
</div>

<div class="content">
    <div class="image-container">
        <img src="logo.png" alt="Logo">
    </div>
</div>

<script src="useradmin.js"></script>
</body>
</html>
