<?php
include('inc/session.inc.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Contact Us - Success</title>
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/contact.css" />
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <div class="success-page">
        <h1>Thank You!</h1>
        <p>Your inquiry has been submitted successfully. We will get back to you shortly.</p>
        <a href="home.php" class="btn-home">Back to Home</a>
    </div>
    <?php include('inc/footer.inc.php'); ?>
</body>

</html>