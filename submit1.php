<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>

<h2>Submit Form</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="document">Upload Document:</label><br>
    <input type="file" id="document" name="document" accept=".pdf,.doc,.docx" required><br><br>

    <input type="submit" value="Submit">
</form>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Assuming you want to handle file upload, you can access the uploaded file details like this
    $file_name = $_FILES['document']['name'];
    $file_temp = $_FILES['document']['tmp_name'];
    
    // Perform any necessary validation on the form data

    // Example: Save the uploaded file to a directory
    $upload_dir = __DIR__ . "/uploads/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true); // create the directory if it doesn't exist
    }
    if (move_uploaded_file($file_temp, $upload_dir . $file_name)) {
        // Example: Save form data to a database (replace with your database connection code)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "schemeseva1";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert form data into a table
        $sql = "INSERT INTO applications (email, password, document) VALUES ('$email', '$password', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            echo "Form submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error uploading file.";
    }
}
?>

</body>
</html>
