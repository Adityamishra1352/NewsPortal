<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="headerchangehome.css">
  <link rel="stylesheet" href="home.css" />
  <script src="https://kit.fontawesome.com/5544926563.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
  <title>
    N24WATCHDOG : News, Breaking News, World News, India News, ...
  </title>
  <style>
    .newsHighlightedLeftHeading {
      width: 100%;
    }

    .left {
      display: grid;
      background: white;
      place-items: center;
    }

    .menuSiteLogoIcon {
      width: 22%;
      height: 22%;
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
        <a href="index.php" class="menuItems">Home</a>
        <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
          echo '<a href="content/login.php" class="menuItems">Log-in</a>';
        } else {
          echo '<a href="content/dashboard.php" class="menuItems">Dashboard</a>';
        }
        ?>
        <!-- <a href="content/login.php" class="menuItems">Log-in</a> -->
        <div class="menuSiteLogoIcon">
          <img src="content/images/wd.png" height="50px" width="50px" />
        </div>
        <a href="content/changemaker.php" class="menuItems">Change Maker</a>
        <a href="content/createStory.php" class="menuItems menuCreateStory"
          style="border: 1px solid white; border-radius: 4px">Create
          Story</a>
      </div>
    </div>

    <div class="right">
      <a href="content/business.php">Business</a>
      <a href="content/Entertainment.php">Entertainment</a>
      <a href="content/enviornment.php">Environment</a>
      <a href="content/health.php">Health</a>
      <a href="content/science.php">Science</a>
      <a href="content/sports.php">Sports</a>
      <a href="content/technology.php">Technology</a>
      <a href="content/world.php">World</a>
    </div>
  </header>
  <?php 
  $update=false;
  if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['updates'])){
  $update=$_GET['updates'];
  if($update){
    echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <strong>You will now recieve updates on your email!!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}
  ?>
  <!-- <a href="/package.json" download>dkv</a> -->
  <section class="newsContainer">
    <div class="newsHighlighted">
      <?php
      include 'content/_dbconnect.php';
      $query = "SELECT * FROM `approvednews` ORDER BY `timestamp` DESC LIMIT 1";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $news_id = $row['news_id'];
        $newsTitle = $row['title'];
        $newstype = $row['newstype'];
        $newsPicture = $row['newsphoto'];
        if ($newsPicture != NULL) {
          $pic = "content/$newsPicture";
        } else {
          $pic = "https://source.unsplash.com/400x400/?' . $newstype . '";
        }
        echo '<div class="newsHighlightedLeft">
        <img src="'.$pic.'" alt="newsImg" />
        <div class="newsHighlightedLeftHeading">
          <a href="content/news.php?newsId=' . $news_id . '">' . $newsTitle . '</a>
        </div>
      </div>';
      }
      ?>
      <div class="newsHighlightedRight">
        <?php
        include 'content/_dbconnect.php';
        $sql = "SELECT * FROM `approvednews` LIMIT 2";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $newsTitle = $row['title'];
            $news_id = $row['news_id'];
            $newstype = $row['newstype'];
            $newsPicture = $row['newsphoto'];
        if ($newsPicture != NULL) {
          $pic = "content/$newsPicture";
        } else {
          $pic = "https://source.unsplash.com/200x200/?' . $newstype . '";
        }
            $user = $row['user_name'];
            $user_sql = "SELECT * FROM `users` WHERE `username`='$user'";
            $user_result = mysqli_query($conn, $user_sql);
            $user_row = mysqli_fetch_assoc($user_result);
            $userId=$user_row['user_id'];
            $fname = $user_row['firstname'];
            $lname = $user_row['lastname'];
            $timestamp = $row['timestamp'];
            $unixTimestamp = strtotime($timestamp);
            $formattedDate = date("d F Y", $unixTimestamp);
            echo '<div class="newsHighlightedRightNews">
                    <div class="newsHighlightedRightNewsLeftItem">
                    <img src="'.$pic.'" alt="">
                    </div>
                    <div class="newsHighlightedRightNewsRightItem">
                      <div class="newsHighlightedRightNewsRightItemNewsCategory">
                        Opinion
                      </div>
                      <div class="newsHighlightedRightNewsRightItemNewsHeadline">
                        <a href="content/news.php?newsId=' . $news_id . '">' . $newsTitle . '</a>
                      </div>
                      <div class="newsHighlightedRightNewsRightItemNewsPublishTime">
                        Published on ' . $formattedDate . ' by
                      </div>
                      <div class="newsHighlightedRightNewsRightItemNewsPublishBy">
                        <a href="content/profile.php?userId='.$userId.'">' . $fname . ' ' . $lname . '</a>
                      </div>
                    </div>
                  </div>';
          }
        }
        ?>
      </div>
    </div>
    <div class="newsSugestions">
      <?php
      include 'content/_dbconnect.php';
      $sql = "SELECT * FROM `approvednews` ORDER BY `timestamp` DESC";
      $result = mysqli_query($conn, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $newsTitle = $row['title'];
          $newstype = $row['newstype'];
          $news_id = $row['news_id'];
          $user = $row['user_name'];
          $user_sql = "SELECT * FROM `users` WHERE `username`='$user'";
          $user_result = mysqli_query($conn, $user_sql);
          $user_row = mysqli_fetch_assoc($user_result);
          $timestamp = $row['timestamp'];
          $unixTimestamp = strtotime($timestamp);
          $formattedDate = date("d F Y", $unixTimestamp);
          $newsPicture = $row['newsphoto'];
        if ($newsPicture != NULL) {
          $pic = "content/$newsPicture";
        } else {
          $pic = "https://source.unsplash.com/600x200/?' . $newstype . '";
        }
          echo '<div class="newsSugestion">
                    <div class="newsSugestionNewsImg">
                    <img src="'.$pic.'" alt="">
                    </div>
                    <div class="newsSugestionRightItems">
                      <div class="newsSugestionRightItemsNewsHeadline">
                        <a href="content/news.php?newsId=' . $news_id . '">' . $newsTitle . '</a>
                      </div>
                      <div class="newsSugestionRightItemsNewsCategory">' . $newstype . '</div>
                    </div>
                  </div>';
        }
      }
      ?>
    </div>
  </section>

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
        <div class="footerSubscribeText">Subscribe</div>
        <form action="content/subscribe.php" method="post">
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
      <a href="#"></a>
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