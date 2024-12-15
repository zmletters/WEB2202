<?php
include('inc/session.inc.php');
require('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update Success</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/profile_update_success.css">
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>

    <div class="success-page">
        <h1>Password Updated Successfully!</h1>
        <p>Your password have been updated successfully.</p>
        <a href="userprofile.php" class="btn-return">Back to Profile</a>
    </div>

    <?php include('inc/footer.inc.php'); ?>
</body>

</html>