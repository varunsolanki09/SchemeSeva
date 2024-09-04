<!DOCTYPE html>
<html>
<head>
    <title>Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" style="font-size: x-large;"><img src="seva.png" width="40" height="40" alt="seva"> SchemeSeva</a>
    </div>
</nav>

<br>
    
<h2>Submit Your Documents</h2>
<h6 style="text-align:center;">Please upload scheme related documents only</h6>

<br>

<hr>
<hr>

<br>
<form method="post" enctype="multipart/form-data">
    <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
        <label for="email">Email address</label>
    </div>
    <div class="form-floating mb-3" style="width: 40%; margin-left: 30%;">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
    </div>

    <div class="form-floating mb-3" style="width: 40%; margin-left: 47%;">
        <input type="file" id="document" name="document" accept=".pdf,.doc,.docx" required>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-outline-secondary" style="width: 100px; text-align: center; margin-left: 47%;">SUBMIT</button>


    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_FILES['document'])) {
        $file_name = $_FILES['document']['name'];
        $file_temp = $_FILES['document']['tmp_name'];

        $upload_dir = __DIR__ . "/uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        if (move_uploaded_file($file_temp, $upload_dir . $file_name)) {
            $servername = "localhost";
            $username = "root";
            $db_password = ""; // Change this to your database password
            $dbname = "schemeseva1";

            // Create connection
            $conn = new mysqli($servername, $username, $db_password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL statement to prevent SQL injection
            $sql = $conn->prepare("INSERT INTO applications (email, password, document) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $email, $password, $file_name);

            if ($sql->execute() === TRUE) {
                header("Locaiton:Dashboard.html");
            } else {
                echo "Error: " . $sql->error;
            }

            // Close prepared statement and database connection
            $sql->close();
            $conn->close();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Document not uploaded.";
    }
}
?>


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
