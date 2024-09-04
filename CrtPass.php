<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <h1><img src="seva.png" width="60" height="60" alt="Subtract"> SchemeSeva</h1>

    <hr>
    <br>
    
    <h2>Sign Up</h2>

    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Create New Password</label>
        </div>
        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password">
            <label for="confirmPassword">Confirm New Password</label>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];

            if ($password !== $confirmPassword) {
                $passwordErr = "Passwords do not match";
            } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
                $passwordErr = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 8 characters long";
            } else {              
                // Establish connection to your MySQL database
                $servername = "localhost";
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password
                $dbname = "schemeseva1"; // Your MySQL database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // You should perform further validation and sanitization here to prevent SQL injection
                $password = $_POST['password'];
                // Insert password into database
                $sql = "INSERT INTO passwords (password) VALUES ('$password')";
                if ($conn->query($sql) === TRUE) {
                    header("Location:Dashboard.html");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
                $conn->close();
            }
        }
        ?>
        
        <?php if (!empty($passwordErr)): ?>
            <div class="alert alert-danger" style="width: 40%; margin-left: 30%;"><?php echo $passwordErr; ?></div>
        <?php endif; ?>

        <br>
        <button type="submit" class="btn btn-outline-secondary" style="width: 150px; text-align: center; margin-left: 45%;">Create Password</button>
    </form>


    <footer>    
        <div class="hstack gap-6">
            <div class="p-2">SchemeSeva</div>
            <div class="p-2 ms-auto"><img src="insta1.png" width="25" height="25" alt="insta1"></div>
            <div class="vr"></div>
            <div class="p-2"><img src="faceb1.png" width="25" height="25" alt="faceb1"></div>
            <div class="vr"></div>
            <div class="p-2"><img src="twitter1.png" width="25" height="25" alt="twitter1"></div>
            <div class="vr"></div>
            <div class="p-2">About Us</div>
        </div>
    </footer>
</body>
</html>
