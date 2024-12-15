<?php
session_start();
require('mysqli_connect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <main>
        <div class="contact-us">
            <div class="contacts-container">
                <div class="form-container">
                    <h2>Contact Us</h2>
                    <form action="submit_contact.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" required />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" required />
                        </div>
                        <div class="form-group">
                            <textarea name="description" placeholder="Description (optional)"></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Send</button>
                    </form>
                </div>
                <div class="form-container">
                    <img src="img/map.png" alt="Map" />
                </div>
            </div>


        </div>
    </main>
    <?php include('inc/footer.inc.php'); ?>
</body>


</html>