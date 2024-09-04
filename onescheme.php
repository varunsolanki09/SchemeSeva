<!DOCTYPE html>
<html>
<head>
    <title>AGRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style3.css">
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
<div style="background-image: url(img.webp);">
    <br>
    <h2 style="text-align: center; margin-right: 1%; text-decoration-line: none;">SCHEME DETAILS</h2>

    <h4 style="text-align: center;">Schemes for you:</h4>
    <br>
</div>

<br>

<div class="container">
    <?php
    // Retrieve scheme details from query parameters
    $title = $_GET['title'];
    $details = $_GET['details'];
    $eligibility = $_GET['eligibility'];
    $benefits = $_GET['benefits'];
    $application_procedures = $_GET['application_procedures'];
    $document_required = $_GET['document_required'];
    $further_details = $_GET['further_details'];
    $further_benefits = $_GET['further_benefits'];
    $category = $_GET['category'];

    // Display scheme details
    echo '<h1>' . $title . '</h1>';
    echo '<p><strong>Details:</strong> ' . $details . '</p>';
    echo '<p><strong>Eligibility:</strong> ' . $eligibility . '</p>';
    echo '<p><strong>Benefits:</strong> ' . $benefits . '</p>';
    echo '<p><strong>Application Procedures:</strong> ' . $application_procedures . '</p>';
    echo '<p><strong>Documents Required:</strong> ' . $document_required . '</p>';
    echo '<p><strong>Further Details:</strong> ' . $further_details . '</p>';
    echo '<p><strong>Further Benefits:</strong> ' . $further_benefits . '</p>';
    echo '<p><strong>Category:</strong> ' . $category . '</p>';
    ?>

    <!-- Apply Now button -->
    <a href="submit.php">
    <button type="button" class="btn btn-secondary" id="applyNowButton" data-bs-toggle="modal" data-bs-target="#applyNowModal">Apply Now</button>
    </a>
</div>

<br>


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

<!-- JavaScript to handle modal -->
<script>
    var myModal = new bootstrap.Modal(document.getElementById('applyNowModal'), {
        keyboard: false
    });

    document.getElementById('applyNowButton').addEventListener('click', function () {
        myModal.show();
    });
</script>

</body>
</html>
