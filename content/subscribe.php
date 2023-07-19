<?php
include '_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['subscribemail'];
    $sql="INSERT INTO `subscriptions`(`email`) VALUES ('$email')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:/NewsPortal/home.php?updates=true');
        exit();
    }
}
?>