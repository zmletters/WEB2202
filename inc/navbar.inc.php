<div class="navbar">
    <div class="navbar-logo">
        <span class="navbar-title">FRESHARA</span>
    </div>
    <div class="navbar-links">
        <a href="home.php" class="navbar-link">Home</a>
        <a href="products.php" class="navbar-link">Products</a>
        <a href="about.php" class="navbar-link">About Us</a>
        <a href="contact.php" class="navbar-link">Contact</a>
    </div>
    <div class="navbar-right">
        <div class="navbar-cart">
            <a href="cart.php">
                <img src="img/shopping-cart-outline.svg" alt="Cart" class="icon">
            </a>
            <?php
            // Database query to fetch cart item count
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $query = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = ?";
                $stmt = $dbc->prepare($query);
                $stmt->bind_param('i', $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $cartData = $result->fetch_assoc();
                $totalItems = $cartData['total_items'] ?? 0;

                // Display badge only if items exist
                if ($totalItems > 0) {
                    echo '<span class="cart-badge">' . $totalItems . '</span>';
                }
                $stmt->close();
            }
            ?>
        </div>
        <div class="navbar-notification">
            <img src="img/notification-bell.svg" alt="Notifications" class="icon">
        </div>
        <div class="navbar-user">
            <a href="userprofile.php">
                <img src="img/user-circle.svg" alt="User" class="icon">
            </a>
            <span class="user-action">
                <?php
                if (isset($_SESSION['first_name'])) {
                    echo '<a href="userprofile.php">' . htmlspecialchars($_SESSION['first_name']) . '</a>';
                    echo '<a href="logout.php"><img src="img/logout.svg" alt="Logout" class="logout-icon"></a>';
                } else {
                    echo '<a href="login.php">Sign In</a>';
                }
                ?>
            </span>
        </div>
    </div>
</div>