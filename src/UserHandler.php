<?php
declare(strict_types=1);
include "./User.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = sha1($_POST['pwd']);
    $contact = $_POST['contact'];
    $userObj = new User($connection);
    $res = $userObj->create($name,$username,$pwd,$email,$contact);
    if($res){
        header("location: index.php");
    }
}