<?php
include('inc/session.inc.php');
require('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $description = htmlspecialchars(trim($_POST['description']));

    // Insert data into the inquiry table
    $query = "INSERT INTO inquiry (name, email, description) VALUES (?, ?, ?)";
    $stmt = $dbc->prepare($query);
    $stmt->bind_param('sss', $name, $email, $description);

    if ($stmt->execute()) {
        // Redirect or show success message
        header('Location: contact_success.php');
        exit();
    } else {
        // Handle error
        echo "<p>There was an error submitting your inquiry. Please try again later.</p>";
    }

    $stmt->close();
}
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
                <!-- Contact Form Section -->
                <div class="form-container">
                    <h2>Contact Us</h2>
                    <form action="contact.php" method="POST">
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

                <!-- Map and Contact Details Section -->
                <div class="form-container">
                    <img src="img/map.png" alt="Map" />
                    <div class="contact-details">
                        <h3>Contact Information</h3>
                        <p><strong>Email:</strong> admin@freshara.com</p>
                        <p><strong>Phone:</strong> +601-2345-6789</p>
                        <p><strong>Address:</strong> 52, Bandar Sunway, PJ, Malaysia</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('inc/footer.inc.php'); ?>
</body>

</html>