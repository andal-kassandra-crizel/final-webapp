<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>

<style>
  body {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .login-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 40px;
    max-width: 450px;
    width: 100%;
  }
  .login-card h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #0d6efd;
    font-weight: 700;
  }
  .form-control {
    border-radius: 10px;
  }
  .btn {
    border-radius: 10px;
    font-weight: 600;
    padding: 10px;
  }
  .btn-primary {
    width: 100%;
  }
  .btn-secondary {
    width: 100%;
    margin-top: 10px;
  }
  .signup-link {
    text-align: center;
    margin-top: 15px;
  }
  .signup-link a {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 600;
  }
  .signup-link a:hover {
    text-decoration: underline;
  }
  
  .error-message {
    color: #dc3545 !important;     
    font-size: 0.9rem !important;
    margin-top: 6px !important;
    display: none;
    background: none !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
    font-weight: normal !important;
  }
</style>

<div class="login-card">
  <h2>Login</h2>

  <form action="log.php" method="post" id="loginForm" class="php-email-form">
    <div class="mb-3">
      <label class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
      <div class="error-message" id="errorMessage">
        <?php
          session_start();
          if (!empty($_SESSION['msg'])) {
              echo htmlspecialchars($_SESSION['msg']);
              unset($_SESSION['msg']);
          }
        ?>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
    <a href="index.html" class="btn btn-secondary">Cancel</a>

    <div class="signup-link">
      <p>Don’t have an account? <a href="signup.php">Sign up here</a></p>
    </div>
  </form>
</div>

<script>
  const errorMessage = document.getElementById('errorMessage');
  const inputs = document.querySelectorAll('#loginForm input');

  // Show message only if it has content
  if (errorMessage.textContent.trim() !== "") {
    errorMessage.style.display = "block";
  }

  // Hide message when user starts typing again
  inputs.forEach(input => {
    input.addEventListener('input', () => {
      errorMessage.style.display = "none";
    });
  });
</script>

</body>
</html>
