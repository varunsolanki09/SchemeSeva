<?php
$passwordErr = ""; // Initialize password error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Verify if passwords match and meet requirements
    if ($password !== $confirmPassword) {
        $passwordErr = "Passwords do not match";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {
        $passwordErr = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 8 characters long";
    } else {              
        // Passwords match and meet requirements, proceed with form submission

        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "schemeseva1";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Escape user inputs for security
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $occupation = $_POST['occupation'];
        $category = $_POST['category'];
        $password=$_POST['password'];

        // Insert user data into the database
        $sql = "INSERT INTO finalusers (fullname, email, phonenumber, age, gender, occupation, category, password_hash) 
                VALUES ('$fullname', '$email', '$phonenumber', '$age', '$gender', '$occupation', '$category','$password')";

        if (mysqli_query($conn, $sql)) {
            header("Location: Dashboard.html");
            exit(); // Ensure no further output is sent
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    }
}
?>
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
    <h1><img src="seva.png" width="60" height="60" alt="Subtract"> SchemeSeva</h1>
    <hr>
    <br>
    <h2>Sign Up</h2>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="fullname">
            <label for="floatingInput">Full Name</label>
        </div>
        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="tel" class="form-control" name="phonenumber" id="phonenumber" placeholder="phonenumber">
            <label for="floatingInput">Phone Number</label>
        </div>
        <br>

        <select class="form-select" name="age" id="age" aria-label="Default select example" style="width: 40%; margin-left: 30%;">
            <option selected>Select Your Age</option>
            <?php
            for ($i = 16; $i <= 50; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
        <br>

        <select class="form-select" name="gender" aria-label="Default select example" style="width: 40%; margin-left: 30%;">
            <option selected>Select Your Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select>
        <br>

        <select class="form-select" name="occupation" aria-label="Default select example" style="width: 40%; margin-left: 30%;">
            <option selected>Select Your Occupation</option>
            <option value="Farmer">Farmer</option>
            <option value="Student">Student</option>
            <option value="Job">Job</option>
            <option value="Small_Buisness">Small Business</option>
            <option value="Teacher">Teacher</option>
            <option value="Gov_Employee">Govt. Employee</option>
        </select>
        <br>

        <select class="form-select" name="category" aria-label="Default select example" style="width: 40%; margin-left: 30%;">
            <option selected>Select Your Category</option>
            <option value="General">General</option>
            <option value="SC">Scheduled Caste (SCs)</option>
            <option value="ST">Scheduled Tribes (STs)</option>
            <option value="OBC">Other Backward Classes (OBCs)</option>
            <option value="PWD">Physically Disabled</option>
            <option value="EWS">Economically Weaker Section</option>
            <option value="Other">Other</option>
        </select>
        <br>

        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Create New Password</label>
        </div>
        <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password">
            <label for="confirmPassword">Confirm New Password</label>
        </div>
        <?php if (!empty($passwordErr)): ?>
            <div class="alert alert-danger" style="width: 40%; margin-left: 30%;"><?php echo $passwordErr; ?></div>
        <?php endif; ?>

        
        <button type="submit" name="submit" class="btn btn-outline-secondary" style="width: 100px; text-align: center; margin-left: 47%;"> SUBMIT</button>
       
    </form>
    <br>
    <br>
</body>
</html>
