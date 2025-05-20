<?php
include '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['vehicle_image'])) {
  $vehicle_name = $_POST['vehicle_name'];
  $vehicle_model = $_POST['vehicle_model'];
  $vehicle_mileage = $_POST['vehicle_mileage'];
  $vehicle_price = (float) $_POST['vehicle_price'];
  $user_id = $_SESSION['user_id'];

  // Set upload directory
  $upload_dir = "../uploads/user_$user_id/";

  // Create directory if not exists
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
  }

  // Get image info
  $image_name = basename($_FILES["vehicle_image"]["name"]);
  $unique_name = time() . "_" . $image_name;
  $target_path = $upload_dir . $unique_name;

  // Move uploaded file
  if (move_uploaded_file($_FILES["vehicle_image"]["tmp_name"], $target_path)) {
    try{

      $relative_path = "uploads/user_$user_id/" . $unique_name;
      $stmt = $conn->prepare("INSERT INTO vehicles (owner_id, vehicle_name, vehicle_model, vehicle_mileage, image_path, vehicle_price) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("issssd", $user_id, $vehicle_name, $vehicle_model, $vehicle_mileage, $relative_path, $vehicle_price);
      $stmt->execute();
      include "../includes/header.php";
      echo <<<HTML
      <div class="container mt-5"> 
          <div class="row justify-content-center">
              <div class="card shadow p-4">
                  <p class="text-center">Listing created successfully.</p>
              </div>
          </div>
      </div>
      HTML;

    include "../includes/footer.php";
    } catch (Exception $e) {
        echo "Something went wrong: " . $e->getMessage();
      }

  } else {
    echo "Failed to upload image.";
  }

} else {
  echo "Invalid form submission.";
}
?>
