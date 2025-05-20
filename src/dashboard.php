<?php
include "includes/header.php";
include "includes/db.php";

// Fetch all cars
$stmt = $conn->prepare("SELECT * FROM vehicles");
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container py-5">
  <div class="row g-4">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='col-md-4'>
              <a href='vehicle.php?id=" . $row['id'] . "' class='text-decoration-none text-dark'>
                <div class='card h-100'>
                  <img src='" . htmlspecialchars($row['image_path']) . "' class='card-img-top' alt='Car Image' style='height: 200px; object-fit: cover;'>
                  <div class='card-body'>
                    <h5 class='card-title'>" . htmlspecialchars($row['vehicle_name']) . " " . htmlspecialchars($row['vehicle_model']) . "</h5>
                    <p class='card-text mb-1'><strong>Price:</strong> $" . number_format($row['vehicle_price'], 2) . "</p>
                    <p class='card-text'><strong>Mileage:</strong> " . number_format($row['vehicle_mileage']) . " miles</p>
                  </div>
                </div>
              </a>
            </div>";
        }
    } else {
        echo "<p class='text-center'>No cars available in the inventory right now.</p>";
    }
    ?>
  </div>
</div>

<?php include "includes/footer.php"; ?>
