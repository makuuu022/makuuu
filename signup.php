<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concepcion Balagtas Dichoso Lying Maternity Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="signup.css ">
</head>
<body>
    <div class="menu1">
       <h1>SIGN UP HERE!</h1>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
           <div class="input-container">
               <input type="text" class="button-container" id="username" name="username" placeholder="Enter Username">
               <input type="text" class="button-container" id="email" name="email" placeholder="Enter Email">
               <div class="password-container">
                   <input type="password" class="button-container" id="password" name="password" placeholder="Password">
                   <i class="fas fa-eye" id="togglePassword1" onclick="togglePassword('password')"></i>
               </div>
               <div class="password-container">
               <input type="password" class="button-container" id="password" name="password" placeholder="Password">
                   <i class="fas fa-eye" id="togglePassword1" onclick="togglePassword('password')"></i>
               </div>
           </div>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "finalproject";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit;
    }

    if ($password != $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    $sql = "INSERT INTO userlogin (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "New successfully registered";
    } else {
        echo "Error: ". $sql. "<br>". $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>