<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mb-0 h1" href="">MobileStyx</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login_form.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reg.php">Registration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>
    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['email'])) { ?>

      <img style="height:45px; width:45px;" src="<?php echo $_SESSION['image']; ?>" class="rounded">&nbsp;
      <h5 class="text-white">Hello <?php echo $_SESSION['name']; ?>&nbsp;&nbsp;</h5>

      <button type="button" class="btn btn-warning btn-sm  nav-item">
        <a class="nav-link text-primary" href="update_form.php?id=<?= $_SESSION['id'] ?>">UPDATE PROFILE</a>
        <?php
    }    
    ?>
    
  </div>
</nav>