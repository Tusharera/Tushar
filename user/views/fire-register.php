<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fire Registration</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/fire-register.css">
  <link rel="stylesheet" href="../styles/nav-style.css">
</head>

<body>

  <!-- <nav class="navbar navbar-expand-lg " id="NAVBAR">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">Fire System </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="../../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Fire Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="./view-reports.php">Track Status</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="../../Admin/views/admin-dashboard.php">Admin</a>
          </li>
        </ul>

      </div>
    </div>
  </nav> -->
  <?php
  include './navbar.php';
  ?>

  <!-- ----------- -->
  <div class="container mt-3" id="registration_form">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm registration-card">
          <div class="card-header text-center">
            <h4>Fire Registration</h4>
          </div>
          <div class="card-body">
            <form method="post" action="../repos/fire-register.php">
              <!-- Full Name Field -->
              <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Your name" name="name" required>
              </div>

              <!-- Email Field -->
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
              </div>

              <!-- Mobile Number Field -->
              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="123-456-7890" required>
              </div>

              <!-- Address Field -->
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="4" placeholder="Write your address here..." required></textarea>
              </div>

              <!-- Message Field -->
              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="4" name="message" placeholder="Write your message here..." required></textarea>
              </div>

              <!-- Buttons -->
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-warning me-md-2">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>