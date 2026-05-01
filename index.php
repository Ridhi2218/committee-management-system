<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFEES Committee</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/fontawesome/css/all.min.css">
</head>

<header>
    <div class="header">
        <img src="logos/drdo-logo.png" alt="DRDO Logo">
        <div class="titles">
            <h2>अग्नि, विस्फोटक और पर्यावरण सुरक्षा केंद्र</h2>
            <h2>CENTRE FOR FIRE, EXPLOSIVE AND ENVIRONMENT SAFETY</h2>
        </div>
    </div>

    <!-- Blue Navigation  -->
     <div class="navbar">
        <!-- <a href="dashboard.php">Home</a>
        <a href="php/admin/add_committee.php">Add Committee</a>
        <a href="php/admin/deleted_committee.php">Deleted Committee</a> -->
    </div>
</header>

<body>
    <div class="login-wrapper">
        <form action="/cfees_committee/login.php" method="POST" class="login-form">
            <h1>Login</h1>


            <label for="username"><i class="fas fa-user"></i> <strong>Username:</strong></label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>


            <label for="password"><i class="fas fa-lock"></i> <strong>Password:</strong></label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>


            <label for="role"><i class="fas fa-user-tag"></i> <strong>Select Role:</strong></label>
            <select id="role" name="role" required>
                <option value="">-- Select your role --</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>


            <button type="submit">Login</button>
        </form>
    </div>

</body>
<footer>
    <p>CENTRE FOR FIRE, EXPLOSIVE AND ENVIRONMENT SAFETY</p>
</footer>

</html>