<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concepcion Balagtas Dichoso Lying Maternity Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="appointment.css">
</head>
<br>
    <nav class="menu">
        <div class="profile-picture">
            <img src="profile.jpg" alt="John Andrei C. Guzman">
        </div>
        <div class="name">
            John Andrei C. Guzman<br>
            <p>Dashboard</p>
        </div>
        <nav class="navbar">
    <ul>
        <li>
            <a class="btn btn-profile" href="myprofile.php">
                <img src="profile.png" alt="Profile">Profile
            </a>
        </li>
        <li>
            <a class="btn btn-appointment" href="appointment.php">
                <img src="calendar.png" alt="Appointment">Appointment
            </a>
        </li>
        <li>
            <a class="btn btn-transaction" href="transaction.php">
                <img src="transaction.png" alt="Transaction">Transaction
            </a>
        </li>
    </ul>
</nav>
        <h2>Help Desk</h2>
        <div class="p">
            <i class="fas fa-phone"></i>
        </div>
        <p4>0910683527</p4>
        <div class="e">
            <i class="fas fa-envelope"></i>
        </div>
        <p3>aceattacker028@gmail.com</p3>
        <div class="l">
            <i class="fas fa-out"></i>
        </div>
    </nav>
    <div class="content">
            NAME:
            <input type="text" name="name" id="name" required>

            AGE:
            <input type="age" name="age" id="age" required>

            SEX:
                <select id="sex" name="sex" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
                </select>

            BIRTHDAY:
            <input type="birthday" name="birthday" id="birthday" required>

            ADDRESS:
            <input type="text" name="address" id="address" required>

            EMAIL:
            <input type="email" name="email" id="email" required>

            MOBILE NUMBER:
            <input type="number" name="number" id="number" required>

            USERNAME:
            <input type="username" name="username" id="username" required>

            DATE CREATED:
            <input type="date" name="date" id="date" required>

            <div class="edit-profile">
            <a href="edit-profile.php" class="btn btn-primary">Update Profile</a>
        </div>
        </div>
       
  </header>
</body>
</html>