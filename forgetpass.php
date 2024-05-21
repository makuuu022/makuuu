<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = $conn->real_escape_string($_POST['email']);

        $stmt = $conn->prepare("SELECT * FROM userlogin WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(50));
            $stmt = $conn->prepare("UPDATE userlogin SET reset_token=?, reset_expires=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email=?");
            $stmt->bind_param("ss", $token, $email);
            $stmt->execute();

            // Store token in session
            $_SESSION['reset_token'] = $token;

            $resetLink = "http://localhost/final/createnewpass.php?token=" . urlencode($token);
            $subject = "Password Reset Request";
            $message = "Hello,\n\nWe received a request to reset your password. Please click the following link to reset your password and Create New Password:\n\n";
            $message .= $resetLink . "\n\nIf you did not request a password reset, please ignore this email or contact support.\n\nThank you,\nConcepcion Balagtas Dichoso Lying Maternity Clinic";

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jadesupremo0@gmail.com'; // Replace with your Gmail address
                $mail->Password = 'epyh iydi fgmq xwya'; // Replace with your Gmail password or app password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('jadesupremo0@gmail.com', 'Jade Supremo');
                $mail->addAddress($email);

                //Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                $success = "A password reset link has been sent to your email.";
            } catch (Exception $e) {
                $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "No account found with that email address.";
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="forgetpass.css">
</head>
<body>

<div class="menu">
    <h1>Forgot Password</h1>
    <?php if (isset($error)): ?>
        <?php displayError($error); ?>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <div class='success'><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="input-container">
            <input type="email" class="button-container" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="button-container">
            <button type="submit" name="submit" class="btn">Submit</button>
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
