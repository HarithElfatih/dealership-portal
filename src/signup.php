<?php include "includes/header.php"; ?>

<div class="container mt-5">
  <div class="row justify-content-center"> 
    <div class="col-md-6 col-lg-5">
      <div class="card shadow p-4">
        <h2 class="text-center">Create Account</h2>
        <form action="actions/signup_process.php" method="post">
          
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
          </div>

          <div class="mb-4 text-center">
            <button type="submit" class="btn btn-primary">Sign Up</button>
          </div>
        </form>
</div>
        <p class="mt-3 text-center">
          Already have an account? <a href="login.php">Login here</a>.
        </p>
      </div>
    
  </div>
</div>

<?php include "includes/footer.php"; ?>
