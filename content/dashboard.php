<?php
include '_dbconnect.php';
session_start();
$uploadDir = 'uploads/profilepictures/';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true || $_SESSION['username']== NULL) {
    header("location:403.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_SESSION['username'];
    if (isset($_FILES['profilePicture'])) {
        $file = $_FILES['profilePicture'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileError = $file['error'];
        $uniqueName = uniqid() . '_' . $fileName;
        $destination = $uploadDir . $uniqueName;
        if (move_uploaded_file($fileTmp, $destination)) {
            $sql = "UPDATE `users`SET `profileimage`='$destination' WHERE `users`.`username`='$username'";
            $resultprofile = mysqli_query($conn, $sql);
        } else {
            echo "Error uploading the image.";
        }
    }
    $usersql = "SELECT * FROM `users` WHERE `username`='$username'";
    $usersqlresult = mysqli_query($conn, $usersql);
    $row = mysqli_fetch_assoc($usersqlresult);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $newfirstname = $_POST['firstname'];
    $newlastname = $_POST['lastname'];
    $bio = $_POST['bio'];
    $location = $_POST['location'];
    if ($newfirstname != null) {
        $update_sql = "UPDATE `users` SET `firstname` = '$newfirstname' WHERE `users`.`username` = '$username'";
        $updateresult = mysqli_query($conn, $update_sql);
    }
    if ($newlastname != null) {
        $update_sql = "UPDATE `users` SET `lastname` = '$newlastname' WHERE `users`.`username` = '$username'";
        $updateresult = mysqli_query($conn, $update_sql);
    }
    if ($bio != null) {
        $update_sql = "UPDATE `users` SET `bio` = '$bio' WHERE `users`.`username` = '$username'";
        $updateresult = mysqli_query($conn, $update_sql);
    }
    if ($location != null) {
        $update_sql = "UPDATE `users` SET `location` = '$location' WHERE `users`.`username` = '$username'";
        $updateresult = mysqli_query($conn, $update_sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N24 WatchDog: Edit Profile</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="/NewsPortal/headerchange.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
            font-size:16px;
            font-weight: 700;
            margin: 10px;
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
    <?php
    $username = $_SESSION['username'];
    $username_sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $username_result = mysqli_query($conn, $username_sql);
    $usernamerow = mysqli_fetch_assoc($username_result);
    $userID = $usernamerow['user_id'];
    ?>

    <header id="header">
        <div class="left">
            <div class="menuItem">
                <a href="/NewsPortal/index.php" class="menuItems">Home</a>

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
                <?php echo '<a href="profile.php?userId=' . $userID . '" class="menuItems">Profile</a>'; ?>
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
    <div class="main_page">
        <?php
        if (isset($_GET["passwordsuccess"]) && $_GET["passwordsuccess"] === "true") {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Your password has been changed!!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <h1 class="text-center">Dashboard</h1>
        <br>
        <div class="container">
        <span class="font-weight-bold"><b>Welcome to your Dashboard</b></span><br><br>
        <span>You can <button id="editProfile_btn" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#editProfile">Edit
                Profile</button> or <button class="btn btn-primary" id="chnagePassword" data-bs-toggle="modal"
                data-bs-target="#changepass">Change
                Password</button></span>
        </div>
        <div class="modal fade" id="changepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Your Password:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="changepassword.php" method="post">
                            <input type="hidden" name="usernamehidden" value="<?php echo $username ?>">
                            <div class="mb-3">
                                <label for="newpass" class="form-label">New Password:</label>
                                <input type="password" class="form-control" id="newpass" name="newpass">
                            </div>
                            <div class="mb-3">
                                <label for="comfirmpass" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmpass" name="confirmpass">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Your Profile!!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="dashboard.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="bio"
                                    style="height: 100px" name="bio"></textarea>
                                <label for="floatingTextarea2">Wanna change Bio?</label>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location:</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                            <div class="mb-3">
                                <label for="profilePicture" class="form-label">Upload Profile Picture</label>
                                <input type="file" class="form-control" id="profilePicture" name="profilePicture">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <div class="footer-logo">
                    <img src="images/wd.png" alt="">
                </div>
                <div class="footer-social">
                    <svg fill="#c2c2c2" height="200px" width="200px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-143 145 512 512" xml:space="preserve" stroke="#c2c2c2">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M272.8,560.7 c-20.8,20.8-44.9,37.1-71.8,48.4c-27.8,11.8-57.4,17.7-88,17.7c-30.5,0-60.1-6-88-17.7c-26.9-11.4-51.1-27.7-71.8-48.4 c-20.8-20.8-37.1-44.9-48.4-71.8C-107,461.1-113,431.5-113,401s6-60.1,17.7-88c11.4-26.9,27.7-51.1,48.4-71.8 c20.9-20.8,45-37.1,71.9-48.5C52.9,181,82.5,175,113,175s60.1,6,88,17.7c26.9,11.4,51.1,27.7,71.8,48.4 c20.8,20.8,37.1,44.9,48.4,71.8c11.8,27.8,17.7,57.4,17.7,88c0,30.5-6,60.1-17.7,88C309.8,515.8,293.5,540,272.8,560.7z">
                                </path>
                                <path
                                    d="M146.8,313.7c10.3,0,21.3,3.2,21.3,3.2l6.6-39.2c0,0-14-4.8-47.4-4.8c-20.5,0-32.4,7.8-41.1,19.3 c-8.2,10.9-8.5,28.4-8.5,39.7v25.7H51.2v38.3h26.5v133h49.6v-133h39.3l2.9-38.3h-42.2v-29.9C127.3,317.4,136.5,313.7,146.8,313.7z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <svg fill="#c2c2c2" height="200px" width="200px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-143 145 512 512" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M272.8,560.7 c-20.8,20.8-44.9,37.1-71.8,48.4c-27.8,11.8-57.4,17.7-88,17.7c-30.5,0-60.1-6-88-17.7c-26.9-11.4-51.1-27.7-71.8-48.4 c-20.8-20.8-37.1-44.9-48.4-71.8C-107,461.1-113,431.5-113,401s6-60.1,17.7-88c11.4-26.9,27.7-51.1,48.4-71.8 c20.9-20.8,45-37.1,71.9-48.5C52.9,181,82.5,175,113,175s60.1,6,88,17.7c26.9,11.4,51.1,27.7,71.8,48.4 c20.8,20.8,37.1,44.9,48.4,71.8c11.8,27.8,17.7,57.4,17.7,88c0,30.5-6,60.1-17.7,88C309.8,515.8,293.5,540,272.8,560.7z">
                                </path>
                                <path
                                    d="M234.3,313.1c-10.2,6-21.4,10.4-33.4,12.8c-9.6-10.2-23.3-16.6-38.4-16.6c-29,0-52.6,23.6-52.6,52.6c0,4.1,0.4,8.1,1.4,12 c-43.7-2.2-82.5-23.1-108.4-55c-4.5,7.8-7.1,16.8-7.1,26.5c0,18.2,9.3,34.3,23.4,43.8c-8.6-0.3-16.7-2.7-23.8-6.6v0.6 c0,25.5,18.1,46.8,42.2,51.6c-4.4,1.2-9.1,1.9-13.9,1.9c-3.4,0-6.7-0.3-9.9-0.9c6.7,20.9,26.1,36.1,49.1,36.5 c-18,14.1-40.7,22.5-65.3,22.5c-4.2,0-8.4-0.2-12.6-0.7c23.3,14.9,50.9,23.6,80.6,23.6c96.8,0,149.7-80.2,149.7-149.7 c0-2.3,0-4.6-0.1-6.8c10.3-7.5,19.2-16.7,26.2-27.3c-9.4,4.2-19.6,7-30.2,8.3C222.1,335.7,230.4,325.4,234.3,313.1z">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <svg fill="#c2c2c2" height="200px" width="200px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="-143 145 512 512" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M113,145c-141.4,0-256,114.6-256,256s114.6,256,256,256s256-114.6,256-256S254.4,145,113,145z M272.8,560.7 c-20.8,20.8-44.9,37.1-71.8,48.4c-27.8,11.8-57.4,17.7-88,17.7c-30.5,0-60.1-6-88-17.7c-26.9-11.4-51.1-27.7-71.8-48.4 c-20.8-20.8-37.1-44.9-48.4-71.8C-107,461.1-113,431.5-113,401s6-60.1,17.7-88c11.4-26.9,27.7-51.1,48.4-71.8 c20.9-20.8,45-37.1,71.9-48.5C52.9,181,82.5,175,113,175s60.1,6,88,17.7c26.9,11.4,51.1,27.7,71.8,48.4 c20.8,20.8,37.1,44.9,48.4,71.8c11.8,27.8,17.7,57.4,17.7,88c0,30.5-6,60.1-17.7,88C309.8,515.8,293.5,540,272.8,560.7z">
                                </path>
                                <path
                                    d="M196.9,311.2H29.1c0,0-44.1,0-44.1,44.1v91.5c0,0,0,44.1,44.1,44.1h167.8c0,0,44.1,0,44.1-44.1v-91.5 C241,355.3,241,311.2,196.9,311.2z M78.9,450.3v-98.5l83.8,49.3L78.9,450.3z">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-anchor">
                    <div class="footer-anchors">
                        <a href="">About Us</a>
                        <a href="">Masthead</a>
                        <a href="">Careers</a>
                    </div>
                    <div class="footer-anchors">
                        <a href="">Contact Us</a>
                        <a href="">Submit to Us</a>
                        <a href="">Syndication</a>
                    </div>
                </div>
                <div class="footer-anchor">
                    <div class="footer-anchors">
                        <a href="">Subscribe</a>
                        <a href="">Announcements</a>
                        <a href="">Advertising</a>
                    </div>
                    <div class="footer-anchors">
                        <a href="">Privacy Policy</a>
                        <a href="">Terms and Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
</body>

</html>