<?php include "includes/header.php" ?>


<div class="container mt-5">
  <div class="row justify-content-center"> 
    <div class="col-md-6 col-lg-5">
      <div class="card shadow p-4">
        <h2 class="text-center">Login Page</h2>
        <form action="actions/login_process.php" method="post">
  
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="user_email" type="email" name="user_email" class="form-control" required>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input id="user_password" type="password" name="user_password" class="form-control" required>
          </div>

          <div class="mb-4 text-center">
            <button type="submit" class="btn btn-primary justify-content-center">Login</button>
          </div>
        </form>

        <p class="mt-3 text-center">
          Don't have an account? <a href="signup.php">Sign up here</a>.
        </p>
      </div>
</div>
  </div>
</div>

<?php include "includes/footer.php" ?>

