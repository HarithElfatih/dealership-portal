<?php
include '../includes/db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Get user_id from token
    $stmt = $conn->prepare("SELECT user_id FROM email_verification WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];

        // Mark user as verified
        $stmt = $conn->prepare("UPDATE users SET activated = 1 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Remove token
        $stmt = $conn->prepare("DELETE FROM email_verification WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        include "../includes/header.php";
        echo <<<HTML
        <div class="container mt-5"> 
            <div class="row justify-content-center">
                <div class="card shadow p-4">
                    <p class="text-center">Email verified! You can now <a href='../login.php'>log in</a></p>
                </div>
            </div>
        </div>
        HTML;
        include "../includes/footer.php";
        
    } else {
        echo "Invalid or expired token.";
    }
}
?>
