<!--Navigation BAR STARTS  -->
<nav class="navbar navbar bg-white fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand fs-1 text-primary fw-bolder" href="#">E-VOTING</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Navigation Bar</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body text-primary">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pdatabase/signup.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pdatabase/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="otp.php">User Details</a>
          </li>

        </ul>
        <form class="d-flex mt-3" role="search" method="post" action="Contact Form/mail.php">
          <input class="form-control me-2" type="search" placeholder="Post your queries" aria-label="Search">
          <button name="btn-send" class="btn btn-success" type="submit">Send</button>
        </form>
      </div>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<!--Navigation BAR ENDS  -->