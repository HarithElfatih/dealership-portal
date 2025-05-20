<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];

    // Prepare and execute statement
    $stmt = $conn->prepare("SELECT id, password, activated FROM users WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

   

    if ($user = $result->fetch_assoc()) {

        if ($user['activated'] != 1) {
            echo "Please verify your email first.";
        } elseif (password_verify($user_password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../dashboard.php");
            exit;
        } else {

            include "../includes/header.php";
        echo <<<HTML
        <div class="container mt-5"> 
            <div class="row justify-content-center">
                <div class="card shadow p-4">
                    <p class="text-center">Invalid password.</p>
                </div>
            </div>
        </div>
        HTML;
        include "../includes/footer.php";

        }

    } else {

         include "../includes/header.php";
        echo <<<HTML
        <div class="container mt-5"> 
            <div class="row justify-content-center">
                <div class="card shadow p-4">
                    <p class="text-center">No user found.</p>
                </div>
            </div>
        </div>
        HTML;
        include "../includes/footer.php";
    }
}
?>
