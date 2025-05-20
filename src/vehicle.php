<?php
include "includes/header.php";
include "includes/db.php";

if (!isset($_GET['id'])) {
    echo "<div class='container mt-5'><p class='text-danger'>Vehicle not found.</p></div>";
    exit;
}

$vehicle_id = (int) $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM vehicles WHERE id = ?");
$stmt->bind_param("i", $vehicle_id);
$stmt->execute();
$result = $stmt->get_result();

if ($vehicle = $result->fetch_assoc()) {
    echo "
    <div class='container mt-5'>
      <div class='row justify-content-center'>
        <div class='col-md-8'>
          <div class='card'>
            <img src='" . htmlspecialchars($vehicle['image_path']) . "' class='card-img-top img-fluid' alt='Car Image'>
            <div class='card-body text-center'>
              <h3 class='card-title'>" . htmlspecialchars($vehicle['vehicle_name']) . " " . htmlspecialchars($vehicle['vehicle_model']) . "</h3>
              <p class='card-text'><strong>Price:</strong> $" . number_format($vehicle['vehicle_price'], 2) . "</p>
              <p class='card-text'><strong>Mileage:</strong> " . number_format($vehicle['vehicle_mileage']) . " miles</p>
              <!-- You can add more vehicle details here -->
            </div>
          </div>
        </div>
      </div>
    </div>";
} else {
    echo "<div class='container mt-5'><p class='text-danger'>Vehicle not found.</p></div>";
}

include "includes/footer.php";
?>
