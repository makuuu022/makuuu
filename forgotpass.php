<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

function displayError($error) {
    echo "<div class='error'>$error</div>";
}

$stmt = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM userlogin WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
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
    <link rel="stylesheet" href="forgotpassword.css">
</head>
<body>
    <div class="menu">
        <h1>Hello,</h1>
        <h2>Welcome!</h2>
        <?php if (isset($error)):?>
            <?php displayError($error);?>
        <?php endif;?>
        <form method="POST" action="">
            <div class="input-container">
                <input type="text" id="username" name="username" placeholder="Username">
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password">
                    <i class="fas fa-eye" id="togglePassword" onclick="togglePassword('password')"></i>
                </div>
            </div>
            <input type="checkbox" id="rememberMe" name="rememberMe">
            <label for="rememberMe">Remember Me</label>
            <p>Don't have an account?<a href="signup.php">Sign up</a></p>
            <a href="#" class="open-button" onclick="openForm()">Forget password?</a>
            <div class="form-popup" id="myForm">
                <form action="/action_page.php" class="form-container">
                    <h3>Forgot Password</h3>
                    <p4 style="text-align: center;">Enter your email address to reset your password</p4>
                    <input type="text" id="email" name="email" placeholder="Email" style="width: 390px;" aria-required="true">
                    <div class="button-container1">
                        <button type="button" name="send" class="btn1" onclick="sendCode()">Send Code</button>
                        <button type="button" class="btn1" onclick="closeForm()">Close</button>
                    </div>
                </form>
            </div>
            <div class="form-popup" id="verificationForm" style="display: none;">
                <form action="/action_page.php" class="form-container">
                    <h3>Verification Code</h3>
                    <p4 style="padding-left: 32px;">Enter the verification code sent to your email</p4>
                    <input type="text" id="verificationCode" name="verificationCode" placeholder="Verification Code" aria-required="true">
                    <div class="button-container1" style="padding-left: 32px;">
                        <button type="button" class="btn1" onclick="verifyCode()">Verify Code</button>
                        <button type="button" class="btn1" onclick="closeForm()">Close</button>
                    </div>
                </form>
            </div>
            <p2><a href="homepage.php">Switch to Admin?</a></p2>
            <div class="button-container">
                <button type="submit" name="submit" class="btn" aria-label="Log in to your account">LOGIN</button>
            </div>
       </form>
    </div>
    <div class="content">
        <div class="image-container">
            <img src="logo.png" alt="Logo">
        </div>
    </div>
<script src="forgotpass.js"></script>
</body>
</html>