<?php 
include "includes/header.php";
include "includes/db.php";

if (isset($_SESSION['user_id'])) {
      echo <<<HTML
<div class="container mt-5">
  <div class="row justify-content-center">  
    <div class="col-md-8 col-lg-6">
      <div class="card shadow p-4">
        <h2 class="text-center mb-4">List A Vehicle for Sale</h2>
        <form action="actions/create_listing_process.php" enctype="multipart/form-data" method="post">
          
          <div class="mb-3">
            <label for="vehicle_name" class="form-label">Vehicle Name</label>
            <input id="vehicle_name" type="text" name="vehicle_name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="vehicle_model" class="form-label">Vehicle Model</label>
            <input id="vehicle_model" type="text" name="vehicle_model" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="vehicle_price" class="form-label">Vehicle Price</label>
            <input id="vehicle_price" type="text" name="vehicle_price" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="vehicle_mileage" class="form-label">Vehicle Mileage</label>
            <input id="vehicle_mileage" type="number" name="vehicle_mileage" class="form-control" required>
          </div>

          <div class="mb-4">
            <label for="vehicle_image" class="form-label">Vehicle Image</label>
            <input id="vehicle_image" type="file" name="vehicle_image" class="form-control" accept=".png, .jpg, .jpeg" required>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
HTML;
} else {
    echo <<<HTML
    <div class="container mt-5"> 
        <div class="row justify-content-center">
             <div class="card shadow p-4">
            <p class= "text-center">Please log in to create a sale listing. <a href='../login.php'>Login</a></p>
            </div>
        </div>
    </div>
    HTML;
}

include "includes/footer.php";
?>
