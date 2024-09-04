<?php
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


    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM finalusers WHERE
    email = '$email' AND password_hash = '$password'";

    $result = $conn->query($query);

    if($result -> num_rows == 1){
        //customer login
        $row = $result -> fetch_array();
        // session_start();
        // $_SESSION["aid"] = $row["c_id"];
        // $_SESSION["firstname"] = $row["c_firstname"];
        // $_SESSION["lastname"] = $row["c_lastname"];
        // $_SESSION["utype"] = "ADMIN";

        header("location:Dashboard.html");
        exit(1);
    }else{
        ?>
        <script>
            alert("You entered wrong email_id and/or password!");
            history.back();
        </script>
        <?php
    }
?>