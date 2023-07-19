<?php
include '_dbconnect.php';
$login = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $search_sql = "SELECT * FROM `users` WHERE `username`='$username'";
  $result = mysqli_query($conn, $search_sql);
  $num = mysqli_num_rows($result);
  $admin_sql = "SELECT * FROM `admin` where `username`='$username'";
  $admin_result = mysqli_query($conn, $admin_sql);
  $admin_num=mysqli_num_rows($admin_result);
  if($admin_num==1){
    while($row_admin= mysqli_fetch_assoc($admin_result)){
      if(password_verify($password,$row_admin['password'])){
        $login="Logged in Successfully!!";
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        $_SESSION['admin']=true;
        header('location:/NewsPortal/content/admin.php');
      }
    }
  }
  if ($num == 1) {
    while ($rowLogin = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $rowLogin['password'])) {
        $login = "Logged in successfully!!";
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('location:/NewsPortal/content/dashboard.php');
      } else {
        $login = "Invalid Credentials";
      }
    }
  } else {
    $login = "Invalid Credentials";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Log-in</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="/NewsPortal/home.css" />
  <link rel="stylesheet" href="login.css" />
  <link rel="stylesheet" href="/NewsPortal/headerchange.css">
  <script src="https://kit.fontawesome.com/5544926563.js" crossorigin="anonymous"></script>
  <style>
    .newsHighlightedLeftHeading {
      width: 100%;
    }

    .left {
      display: grid;

      place-items: center;
    }

    .menuSiteLogoIcon {
      width: 22%;
      height: 22%;
      margin-left: 0;
    }

    .menuSiteLogoIcon img {
      width: 100%;
      height: 100%;
      margin: 5%;
    }

    .menuItem {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      transition: all 0.5s ease-in;
    }

    .menuItem a {
      padding: 5px;
      margin: 10px;
      font-size: 16px;
      font-weight: 700;
    }

    .menuItems {
      cursor: pointer;
      font-size: 14px;
      color: black;
      opacity: 0.6;
      text-decoration: none;
      padding: 0px 10px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .menuItems:hover {
      opacity: 1;
    }
  </style>
</head>

<body>
  <header id="header">
    <div class="left">
      <div class="menuItem">
        <a href="/index.php" class="menuItems">Home</a>

        <?php
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
          echo '<a href="signup.php" class="menuItems">Signup</a>';
        } else {
          echo '<a href="dashboard.php" class="menuItems">Dashboard</a><a href="logout.php" class="menuItems">Logout</a>';
        }
        ?>

        <div class="menuSiteLogoIcon">
          <img src="images/wd.png" height="50px" width="50px" />
        </div>
        <a href="changemaker.php" class="menuItems">Change Maker</a>
        <a href="createStory.php" class="menuItems menuCreateStory"
          style="border: 1px solid white; border-radius: 4px">Create
          Story</a>
      </div>
    </div>
    <div class="right">
      <a href="business.php"><b>Business</b></a>
      <a href="entertainment.php"><b>Entertainment</b></a>
      <a href="enviornment.php"><b>Environment</b></a>
      <a href="health.php"><b>Health</b></a>
      <a href="science.php"><b>Science</b></a>
      <a href="sports.php"><b>Sports</b></a>
      <a href="technology.php"><b>Technology</b></a>
      <a href="world.php"><b>World</b></a>
    </div>
  </header>

  <div class="logInBody">
    <?php
    if ($login) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>' . $login . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>
    <h1 class="loginHeadText h1">Log-in</h1>
    <div class="loginHeadSubText">
      Please, use the following form to log-in:
    </div>
    <div class="loginForm">
      <form method="post" action="login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="loginNewRegisterText">
      Don't have an account? <a href="signUp.php">Register here</a>
    </div>
    <div class="loginForgotPasswordText">
      <a href="#">Forgotten your password?</a>
    </div>

  </div>

  <section class="footer">
    <div class="footerUpper">
      <div class="footerFollowUs">
        <div class="footerFollowUsText">Follow us</div>
        <div class="footerFollowUsIcons">
          <a href="#" class="footerFollowUsIcon">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="#" class="footerFollowUsIcon">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
          <a href="#" class="footerFollowUsIcon">
            <i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="footerFollowUsIcon">
            <i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="footerFollowUsIcon">
            <i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
      <div class="footerUsefulLinks">
        <div class="footerUsefulLinksText">Useful Links</div>
        <div class="footerUsefulLinksItems">
          <div class="footerUsefulLinksItemsLeft">
            <a href="#">Home</a>
            <a href="#">Privacy</a>
          </div>
          <div class="footerUsefulLinksItemsRight">
            <a href="#">About</a>
            <a href="#">Contact</a>
          </div>
        </div>
      </div>
      <div class="footerSubscribe">
        <form action="subscribe.php" method="post">
          <div class="footerSubscribeBox">

            <input placeholder="Email Address" type="email" name="subscribemail" />
            <div class="footerSubscribeBtn">
              <button><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </form>
      </div>
    </div>
    </div>
    <div class="footerLower">
      Copyright &#169; 2020-2022, All Right Reserved&nbsp;
      <a href="#">Thesocialtalks</a>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
  <script>
    document.querySelector(".menuBarIcon").addEventListener("click", () => {
      if (document.querySelector(".menuItem").style.display == "none") {
        document.querySelector(".menuItem").style.display = "flex";
      } else {
        document.querySelector(".menuItem").style.display = "none";
      }
    });
  </script>
</body>

</html>