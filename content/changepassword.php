<?php 
include '_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $newpass=$_POST['newpass'];
    $cpass=$_POST['confirmpass'];
    $username=$_POST['usernamehidden'];
        if($newpass==$cpass){
            $hash=password_hash($newpass,PASSWORD_DEFAULT);
            $sql="UPDATE`users` SET `password`='$hash' WHERE `username`='$username'";
            $result=mysqli_query($conn,$sql);
            if($result){
                header('location:/NewsPortal/content/dashboard.php?passwordsuccess=true');
                exit();
            }
        }
        else{
            header('location:/NewsPortal/content/dashboard.php?passwordsuccess="error"');
        }
}
?>