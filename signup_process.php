<?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "schemeseva1";

    // Create connection
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
?>
