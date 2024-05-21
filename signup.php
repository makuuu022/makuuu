<?php
// Include database connection
include 'conn.php';

// Function to display error message
function displayError($error) {
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
}

// Check if the form is submitted
if (isset($_POST['register_btn'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $pp = $_FILES['file']['name'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO userlogin (username, password, email, pp) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed_password, $email, $pp);

        // Check if the uploads directory exists, if not, create it
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Upload profile picture
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        if ($stmt->execute()) {
            // Registration successful
            $success_msg = "Registration successful!";
            // Redirect to user.php after 2 seconds
            header("refresh:2;url=user.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
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
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<div class="menu">
    <h1>Sign Up Here!</h1>
    <?php if (isset($success_msg)): ?>
    <div class="alert alert-success" role="alert"><?php echo $success_msg; ?></div>
<?php endif; ?>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="input-container">
            <input type="text" class="button-container" id="username" name="username" placeholder="Enter Username" required>
            <input type="text" class="button-container" id="email" name="email" placeholder="Enter Email" required>
            <div class="password-container">
                <input type="password" class="button-container" id="password" name="password" placeholder="Enter Password" required>
                <i class="fas fa-eye" id="togglePassword1" onclick="togglePassword('password')"></i>
            </div>
            <div class="password-container">
                <input type="password" class="button-container" id="confirm_password" name="confirm_password" placeholder="Re-enter Password" required>
                <i class="fas fa-eye" id="togglePassword2" onclick="togglePassword('confirm_password')"></i>
            </div>
            <div class="file-container">
                <input type="file" class="file-container1" id="file" name="file" accept=".jpg, .jpeg, .png" required>
            </div>
        </div>
        <p>Profile Picture</p>
        <p>Already have an account? <a href="user.php">Sign In</a></p>
        <div class="button-container">
            <button type="submit" class="btn" name="register_btn">REGISTER</button>
        </div>
    </form>
</div>


<div class="content">
    <div class="image-container">
        <img src="logo.png" alt="Logo">
    </div>
</div>

<script src="signup.js"></script>
</body>
</html>
