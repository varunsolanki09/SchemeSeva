<!DOCTYPE html>
<html>
<head>
    <title>ALL SCHEMES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style3.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" style="font-size: x-large;"><img src="seva.png" width="40" height="40" alt="seva"> SchemeSeva</a>
        <form class="d-flex" role="search" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input class="form-control me-2" type="search" name="search" placeholder="Search Schemes" aria-label="Search">
            <button class="btn btn-outline-light-secondary" type="submit"><img src="search.png" width="30" height="30" alt="search"></button>
            <button class="btn btn-outlines-secondary" type="submit"><img src="profile.png" width="30" height="30" alt="search"></button>
        </form>
    </div>
</nav>

<br>
<div style="background-image: url(img.webp);">
    <br>
    <h2 style="text-align: center; margin-right: 1%; text-decoration-line: none;"> ALL SCHEMES ON ONE PAGE</h2>

    <h4 style="text-align: center;">Schemes for you:</h4>
    <br>
</div>

<br>

<div class="container">
    <?php
    // Database connection
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

    // Default SQL query to fetch all schemes
    $sql = "SELECT title, details, eligibility, benefits, application_procedures, document_required, further_details, further_benefits, category FROM schemes";

    // Check if the form has been submitted with a search query
    if (isset($_GET['search'])) {
        // Get the search query entered by the user
        $searchQuery = $_GET['search'];

        // Modify the SQL query to include a WHERE clause for filtering based on the search query
        $sql .= " WHERE title LIKE '%$searchQuery%' OR details LIKE '%$searchQuery%'";
    }

    $result = $conn->query($sql);

    // Check if there are any rows returned from the query
    if ($result->num_rows > 0) {
        // Loop through each row and output the card
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">' . $row['title'] . '</h4>';
            echo '<p class="card-text">' . $row['details'] . '</p>';
            // Add a link to onescheme.php passing scheme details as query parameters
            echo '<a href="onescheme.php?title=' . urlencode($row['title']) . '&details=' . urlencode($row['details']) . '&eligibility=' . urlencode($row['eligibility']) . '&benefits=' . urlencode($row['benefits']) . '&application_procedures=' . urlencode($row['application_procedures']) . '&document_required=' . urlencode($row['document_required']) . '&further_details=' . urlencode($row['further_details']) . '&further_benefits=' . urlencode($row['further_benefits']) . '&category=' . urlencode($row['category']) . '" class="btn btn-primary">Learn More</a>';
            echo '</div>';
            echo '</div>';
            echo '<br>';
        }
    } else {
        echo "No results found.";
    }

    // Close the connection
    $conn->close();
    ?>
</div>

<footer>
    <div class="hstack gap-6">
        <div class="p-2">SchemeSeva</div>
        <div class="p-2 ms-auto"><img src="insta1.png" width="25" height="25" alt="insta1"></div>
        <div class="vr"></div>
        <div class="p-2"><img src="faceb1.png" width="25" height="25" alt="faceb1"></div>
        <div class="vr"></div>
        <div class="p-2"><img
