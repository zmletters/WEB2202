<?php
session_start();
require('mysqli_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/userprofile.css">
</head>

<body>
    <?php include('inc/navbar.inc.php'); ?>
    <div class="profile-page">


        <div class="profile-container">
            <aside class="profile-sidebar">
                <ul>
                    <li><a href="#" class="active">Personal info</a></li>
                    <li><a href="#">Login and security</a></li>
                    <li><a href="#">My payments</a></li>
                    <li><a href="#">My orders</a></li>
                </ul>
            </aside>

            <section class="profile-content">
                <h1>Personal info</h1>

                <form action="update_profile.php" method="POST" class="profile-form">
                    <fieldset>
                        <legend>Account info</legend>

                        <div class="form-group">
                            <label for="display-name">Display Name</label>
                            <input type="text" id="display-name" name="display_name" placeholder="Enter your display name">
                        </div>

                        <div class="form-group">
                            <label for="real-name">Real Name</label>
                            <input type="text" id="real-name" name="real_name" value="PHAM TRAN LAN CAM NGOC" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" placeholder="Phone number">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="sunieux@gmail.com" readonly>
                        </div>

                        <div class="form-group">
                            <label for="address">Your Address</label>
                            <input type="text" id="address" name="address" value="123 Ave, New York, United States">
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button type="submit" class="btn-update">Update profile</button>
                        <button type="reset" class="btn-clear">Clear all</button>
                    </div>
                </form>
            </section>
        </div>


    </div>
</body>
<?php include('inc/footer.inc.php'); ?>

</html>