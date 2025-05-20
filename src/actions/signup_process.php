<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config_file = parse_ini_file("../includes/config.env");
$secret_key = $config_file["email_password"];
$admin_email = $config_file["admin_email"];
$ip_address = $config_file["DB_HOST"];
$application_url = $config_file["application_url"];

if ($_SERVER["REQUEST_METHOD"] == "POST" and htmlspecialchars($_POST['email']) == $admin_email) {
    include "../includes/db.php";
    $user_name = htmlspecialchars($_POST['username']);
    $user_email = htmlspecialchars($_POST['email']);
    $user_password = htmlspecialchars($_POST['password']);
    $password_hash = password_hash($user_password, PASSWORD_BCRYPT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_name, $user_email, $password_hash);
        $stmt->execute();
        $user_id = $stmt->insert_id;

        $token = bin2hex(random_bytes(32));
        $stmt = $conn->prepare("INSERT INTO email_verification (user_id, token) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $token);
        $stmt->execute();

    
        $verify_link = "http://$application_url/actions/verify.php?token=$token";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $admin_email; 
        $mail->Password =  $secret_key; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('noreply@cardealership.com', 'Car Dealership');
        $mail->addAddress($user_email);
        $mail->Subject = 'Verify Your Email';
        $mail->Body = "Hi $user_name,\n\nPlease click the link to verify your email:\n$verify_link";
        $mail->send();
        
        include "../includes/header.php";
        echo <<<HTML
        <div class="container mt-5"> 
            <div class="row justify-content-center">
                <div class="card shadow p-4">
                    <p class="text-center">Check your email to verify your account.</p>
                </div>
            </div>
        </div>
        HTML;
        include "../includes/footer.php";
    } catch (Exception $e) {
        echo "Something went wrong: " . $e->getMessage();
    }
}
else {
    include "../includes/header.php";
    echo "<p>You are not allowed to Sign Up as an admin, Go to <a href='../dashboard.php'>Home Page</a></p>";
    include "../includes/footer.php";
}
?>
